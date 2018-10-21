<?php 

require 'VotingDAO.php';
require 'model/Vote.php';
require 'model/User.php';
require 'Connection.php';
/**
 * VotingtDAO
 *
 * MySQL Implementation for voting operations
 */
class VotingDAOMySQL implements VotingDAO{
    
    
    function insert($vote){
        if ($vote->validate()){
            $con = Connection::createConnection();

            try{
                $con->beginTransaction();

                //save vote object and retrieve the new id from the database
                $new_vote_id = $this->insertIntoVotes($con, $vote);
                $vote->setId($new_vote_id);

				foreach($vote->getUsers() as $user){
					$this->insertUserRelations($con, $vote, $user);
				}

				foreach($vote->getUserStorys() as $story){
					$this->insertUserStory($con, $vote, $story);
				}
               
                $con->commit();
                return true;
            }catch(Exception $e){
                echo 'Exception abgefangen: ',  $e->getMessage(), "\n"; 
                $con->rollback();
            }
			return false;
               
        }
        return false;
    }

    private function insertUserRelations($con, $vote, $user){
        $stmt = $con->prepare("INSERT rel_vote_user (fk_user, fk_vote) VALUES (:userid, :voteid)");
                $stmt->bindParam(':userid', $user_id_var);
                $stmt->bindParam(':voteid', $vote_id_var);
                
                $vote_id_var = $vote->getId();
                $user_id_var = $user->getId();
                $stmt->execute(); 
    }

    private function insertUserStory($con, $vote, $story){
	    $stmt = $con->prepare("INSERT user_story (description, end, fk_vote) VALUES (:description, :end, :fk_vote)");
                $stmt->bindParam(':description', $description_var);
                $stmt->bindParam(':end', $end_var);
                $stmt->bindParam(':fk_vote', $fk_vote_var);
                
                
                $description_var = $story->getDescription();
                $end_var = $story->getEnd();
                $fk_vote_var = $vote->getId();
                $stmt->execute(); 
				
		$story_id = $con->lastInsertId();
		$story->setId($story_id);

    }
    

    private function insertIntoVotes($con, $vote){
        $stmt = $con->prepare("INSERT INTO vote (name, end) VALUES (:name, :end)");
                $stmt->bindParam(':name', $name_var);
                $stmt->bindParam(':end', $end_var);
                
                $end_var = $vote->getEnd();
                $name_var = $vote->getName();
                $stmt->execute(); 
        return $con->lastInsertId();

    }
    
    private function getUserStorys($con, $byVoteId){
        $result = [];
        $stmt = $con->prepare("SELECT story.id, story.description FROM user_story story WHERE story.fk_vote = :voteid");
        $stmt->bindParam(':voteid', $voteid_var);
        $voteid_var = $byVoteId;
        try{
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $story = new UserStory();
                $story->setId($row['id']);
                $story->setDescription($row['description']);             
                $result[] = $story;

             }
    
        }catch(Exception $e){
            echo 'Exception abgefangen: ',  $e->getMessage(), "\n"; 
        }
        return $result;

    }

    private function getUsers($con, $byVoteId){
        $result = [];
        $stmt = $con->prepare("SELECT usr.id, usr.username, usr.email FROM rel_vote_user rel_usr INNER JOIN user usr ON usr.id = rel_usr.fk_user WHERE rel_usr.fk_vote = :voteid");
        $stmt->bindParam(':voteid', $voteid_var);
        $voteid_var = $byVoteId;
        try{
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $acc = new User();
                $acc->setId($row['id']);
                $acc->setUsername($row['username']);
                $acc->setEmail($row['email']);
               
                $result[] = $acc;

             }
    
        }catch(Exception $e){
            echo 'Exception abgefangen: ',  $e->getMessage(), "\n"; 
        }
        return $result;

    }

    function getVotings($byAccountId){
        $result = [];
        $con = Connection::createConnection();
        $stmt = $con->prepare("SELECT v.id, v.name, v.end FROM vote v INNER JOIN rel_vote_user rel_usr ON v.id = rel_usr.fk_vote WHERE  rel_usr.fk_user = :userid");
        $stmt->bindParam(':userid', $userid_var);
        $userid_var = $byAccountId;
        try{
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $vote = new Vote();
                $vote->setId($row['id']);
                $vote->setName($row['name']);
                $vote->setEnd($row['end']);
                $vote->setUserStorys($this->getUserStorys($con, $row['id']));
                $vote->setUsers($this->getUsers($con, $row['id']));
                $result[] = $vote;

             }
    
        }catch(Exception $e){
            echo 'Exception abgefangen: ',  $e->getMessage(), "\n"; 

        }
        return $result;
    }
}

?>