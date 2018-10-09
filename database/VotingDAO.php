<?php 
/**
 * VotingtDAO
 *
 * Interface for voting operations
 */
interface VotingDAO{
    function save($vote);
    function getVotings($byAccountId);
}

?>