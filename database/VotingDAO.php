<?php 
/**
 * VotingtDAO
 *
 * Interface for voting operations
 */
interface VotingDAO{
    function insert($vote);
    function getVotings($byAccountId);
    function getVote($currentUser, $voteId);
    function setVotePoints($userId, $userStoryId, $points);
    function getVotePoints($userId, $userStoryId, $currentUserId);
}

?>