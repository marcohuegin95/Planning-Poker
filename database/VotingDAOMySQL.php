<?php 

require 'VotingDAO.php';
require 'model/Vote.php';
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
	    $stmt = $con->prepare("INSERT user_story (description, end) VALUES (:description, :end)");
                $stmt->bindParam(':description', $description_var);
                $stmt->bindParam(':end', $end_var);
                
                $description_var = $story->getDescription();
                $end_var = $story->getEnd();
                $stmt->execute(); 
				
		$story_id = $con->lastInsertId();
		$story->setId($story_id);
	
        $stmt = $con->prepare("INSERT rel_vote_user_story (fk_user_story, fk_vote) VALUES (:storyid, :voteid)");
                $stmt->bindParam(':storyid', $story_id_var);
                $stmt->bindParam(':voteid', $vote_id_var);
                
                $vote_id_var = $vote->getId();
                $story_id_var = $story->getId();
                $stmt->execute(); 
    }
    

    private function insertIntoVotes($con, $vote){
        $stmt = $con->prepare("INSERT INTO vote (name) VALUES (:name)");
                $stmt->bindParam(':name', $name_var);
        
                $name_var = $vote->getName();
                $stmt->execute(); 
        return $con->lastInsertId();

    }
    
    private function getUserStorys($byVoteId){
        $result = [];
        $stmt = $con->prepare("SELECT story.id, story.description,story.end FROM user_story story INNER JOIN rel_vote_user_story rel_story ON story.id = rel_story.fk_user_story ON WHERE rel_story.fk_vote = :voteid");
        $stmt->bindParam(':voteid', $voteid_var);
        $avoteid_var = $byVoteId;
        try{
            while($row = $statement->fetch()) {
                $story = new UserStory();
                $story->setId($row['id']);
                $story->setDescription($row['description']);
                $vote->setEnd($row['end']);
               
                $result[] = $story;

             }
    
        }catch(Exception $e){

        }
        return $result;

    }

    private function getUsers($byVoteId){
        $result = [];
        $stmt = $con->prepare("SELECT usr.id, usr.username, usr.email FROM rel_vote_user rel_usr INNER JOIN user usr ON rel_usr.id = rel_usr.fk_user ON WHERE rel_usr.fk_vote = :voteid");
        $stmt->bindParam(':voteid', $voteid_var);
        $avoteid_var = $byVoteId;
        try{
            while($row = $statement->fetch()) {
                $acc = new Account();
                $acc->setId($row['id']);
                $acc->setUsername($row['username']);
                $acc->setEmail($row['email']);
               
                $result[] = $acc;

             }
    
        }catch(Exception $e){

        }
        return $result;

    }

    function getVotings($byAccountId){
        $result = [];
        $stmt = $con->prepare("SELECT v.id, v.name FROM vote v INNER JOIN rel_vote_user rel_usr ON v.id = rel_acc.fk_vote ON  WHERE  rel_usr.fk_user = :userid");
        $stmt->bindParam(':userid', $userid_var);
        $userid_var = $byAccountId;
        try{
            while($row = $statement->fetch()) {
                $vote = new Vote();
                $vote->setId($row['id']);
                $vote->setName($row['name']);
                $vote->setUserStorys($this->getUserStorys($row['id']));
                $vote->setUsers($this->getUsers($row['id']));
               
                $result[] = $vote;

             }
    
        }catch(Exception $e){

        }
        return $result;
    }
}

?>