<?php 
/**
 * VotingtDAO
 *
 * Interface for voting operations
 */
interface VotingDAO{
    function insert($vote);
    function getVotings($byAccountId);
}

?>