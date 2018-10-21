

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `planningpoker`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rel_vote_user`
--

CREATE TABLE `rel_vote_user` (
  `fk_user` int(11) NOT NULL,
  `fk_vote` int(11) NOT NULL,
  `points_voted` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_story`
--

CREATE TABLE `user_story` (
  `id` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `fk_vote` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `end` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Indizes für die Tabelle `rel_vote_user`
--
ALTER TABLE `rel_vote_user`
  ADD PRIMARY KEY (`fk_user`,`fk_vote`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indizes für die Tabelle `user_story`
--
ALTER TABLE `user_story`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `user_story`
--
ALTER TABLE `user_story`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
