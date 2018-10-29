

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
-- Tabellenstruktur für Tabelle `rel_user_user_story`
--

CREATE TABLE `rel_user_user_story` (
  `fk_user` int(11) NOT NULL,
  `fk_user_story` int(11) NOT NULL,
  `points` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rel_vote_user`
--

CREATE TABLE `rel_vote_user` (
  `fk_user` int(11) NOT NULL,
  `fk_vote` int(11) NOT NULL
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
  `title` varchar(255) NOT NULL,
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
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `rel_user_user_story`
--
ALTER TABLE `rel_user_user_story`
  ADD PRIMARY KEY (`fk_user`,`fk_user_story`),
  ADD KEY `fk_user_story` (`fk_user_story`);

--
-- Indizes für die Tabelle `rel_vote_user`
--
ALTER TABLE `rel_vote_user`
  ADD PRIMARY KEY (`fk_user`,`fk_vote`),
  ADD KEY `fk_vote` (`fk_vote`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vote` (`fk_vote`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_story`
--
ALTER TABLE `user_story`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `rel_user_user_story`
--
ALTER TABLE `rel_user_user_story`
  ADD CONSTRAINT `rel_user_user_story_ibfk_1` FOREIGN KEY (`fk_user_story`) REFERENCES `user_story` (`id`),
  ADD CONSTRAINT `rel_user_user_story_ibfk_2` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `rel_vote_user`
--
ALTER TABLE `rel_vote_user`
  ADD CONSTRAINT `rel_vote_user_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `rel_vote_user_ibfk_2` FOREIGN KEY (`fk_vote`) REFERENCES `vote` (`id`);

--
-- Constraints der Tabelle `user_story`
--
ALTER TABLE `user_story`
  ADD CONSTRAINT `user_story_ibfk_1` FOREIGN KEY (`fk_vote`) REFERENCES `vote` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
