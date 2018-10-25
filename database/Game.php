<?php
require 'VotingDAOMySQL.php';

$saveVoting= new VotingDAOMySQL();

if (isset($_POST['action']) && !empty($_POST['action'])) {
    $saveVoting->insert($_POST['action']);
}

?>