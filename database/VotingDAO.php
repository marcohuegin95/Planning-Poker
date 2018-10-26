<?php 
/**
 * VotingtDAO
 *
 * Interface for voting operations
 */
interface VotingDAO{
    function insert($vote);
    function getVotings($byAccountId);
    function getVote($voteId);
    function setVotePoints($userId, $userStoryId, $points);
}

?>