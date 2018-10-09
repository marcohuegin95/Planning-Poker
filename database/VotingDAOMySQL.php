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

                //TODO für jeden user insertUserRelations aufrufen

                //TODO für jede user story eine relation anlegen
        
                $con->commit();
                return true;
            }catch(Exception $e){
                $con->rollback();
            }
               
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