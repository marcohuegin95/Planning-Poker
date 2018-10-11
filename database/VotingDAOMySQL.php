<?php 

require 'VotingDAO.php';

/**
 * VotingtDAO
 *
 * MySQL Implementation for voting operations
 */
class VotingDAOMySQL implements VotingDAO{
    
    
    function save($vote){
        if ($voting->validate()){
            $con = Connection::createConnection();

            try{
                $con->beginTransaction();

                //save vote object and retrieve the new id from the database
                $new_vote_id = $this->insertIntoVotes($con, $vote);
                $vote->setId($new_vote_id);

				foreach($vote-getUsers() as $user){
					$this->insertUserRelations($con, $vote, $user);
				}

				foreach($vote->getUserStorys() as $story){
					$this->insertUserStory($con, $vote, $story);
				}
               
                $con->commit();
                return true;
            }catch(Exception $e){
                $con->rollback();
            }
			return false;
               
        }
        return false;
    }

    private function insertUserRelations($con, $vote, $user){
        $stmt = $con->prepare("INSERT rel_voting_accounts (fk_user, fk_vote) VALUES (:userid, :voteid)");
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
	
        $stmt = $con->prepare("INSERT rel_voting_user_story (fk_user_story, fk_vote) VALUES (:storyid, :voteid)");
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
    
    function getVotings($byAccountId){
        
    }
}

?>