<?php 

require 'VotingDAO.php';
require 'model/Vote.php';
require 'model/User.php';

/**
 * VotingtDAO
 * 
 * Verwaltet Datenbank Zugriffe für alle Vote Tabellen
 * @author Timon Müller-Wessling
 */
class VotingDAOMySQL implements VotingDAO{
    
    /**
     * Speichert ein Vote objekt mit allen Abhänigkeiten.
     * Der Vorgang wird mittels Transaktion durchgeführt um inkonsistente Daten zu vermeiden
     */
    function insert($vote){
        
        if ($vote->validate()){
            $con = Connection::createConnection();

            try{
                $con->beginTransaction();

                //speicher das objekt und lade die von der Datenbank generierte ID
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
                error_log("Interner Fehler ". $e->getMessage(), 0);
                $con->rollback();
            }
               
        }
        return false;
    }

    /**
     * Speichert relationen zu Benutzern
     */
    private function insertUserRelations($con, $vote, $user){
        $stmt = $con->prepare("INSERT rel_vote_user (fk_user, fk_vote) VALUES (:userid, :voteid)");
                $stmt->bindParam(':userid', $user_id_var);
                $stmt->bindParam(':voteid', $vote_id_var);
                
                $vote_id_var = $vote->getId();
                $user_id_var = $user->getId();
                $stmt->execute(); 
    }

    /**
     * Speichert relationen zu User Storys
     */
    private function insertUserStory($con, $vote, $story){
	    $stmt = $con->prepare("INSERT user_story (title, description, fk_vote) VALUES (:title, :description, :fk_vote)");
                $stmt->bindParam(':description', $description_var);
                $stmt->bindParam(':title', $title_var);
                $stmt->bindParam(':fk_vote', $fk_vote_var);
                
                
                $description_var = $story->getDescription();
                $title_var = $story->getTitle();
                $fk_vote_var = $vote->getId();
                $stmt->execute(); 
				
        $story_id = $con->lastInsertId();
		$story->setId($story_id);

    }
    

    /**
     * Speichert ein Vote Objekt
     * @return die id des gespeicherten Objektes
     */
    private function insertIntoVotes($con, $vote){
        $stmt = $con->prepare("INSERT INTO vote (name, end) VALUES (:name, :end)");
                $stmt->bindParam(':name', $name_var);
                $stmt->bindParam(':end', $end_var);
                
                $end_var = $vote->getEnd();
                $name_var = $vote->getName();
                $stmt->execute(); 
        return $con->lastInsertId();

    }
    
    /**
     * Gibt die User Storys zu einer vote id zurück
     */
    private function getUserStorys($con, $byVoteId){
        $result = [];
        $stmt = $con->prepare("SELECT story.id,story.title, story.description FROM user_story story WHERE story.fk_vote = :voteid");
        $stmt->bindParam(':voteid', $voteid_var);
        $voteid_var = $byVoteId;
        try{
            $stmt->execute();
            while($row = $stmt->fetch()) {
                $story = new UserStory();
                $story->setId($row['id']);
                $story->setTitle($row['title']);
                $story->setDescription($row['description']);             
                $result[] = $story;

             }
    
        }catch(Exception $e){
            error_log("Interner Fehler ". $e->getMessage(), 0);
        }
        return $result;

    }

    /**
     * Läd alle Eingeladenen User zu einem Vote
     */
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
            error_log("Interner Fehler ". $e->getMessage(), 0);
        }
        return $result;

    }

    /**
     * Speichert die Punkte zu einer user story.
     * Falls bereits Punkte gesetzt wurden, werden diese überschrieben
     */
    function setVotePoints($userId, $userStoryId, $points){
        $con = Connection::createConnection();
        try{

            $stmt = $con->prepare("INSERT INTO rel_user_user_story (fk_user, fk_user_story, points) 
                                   VALUES (:fk_user, :fk_user_story, :points)
                                   ON DUPLICATE KEY UPDATE
                                   points= :points");
            $stmt->bindParam(':fk_user', $user_var);
            $stmt->bindParam(':fk_user_story', $user_story_var);
            $stmt->bindParam(':points', $points_var);


            $user_var = $userId;
            $user_story_var = $userStoryId;
            $points_var = $points;

            return $stmt->execute();
        }catch(Exception $e){
            error_log("Interner Fehler ". $e->getMessage(), 0);
        }
        return false;

    }



    /**
     * Läd die Anzahl an Nutzer, die in der UserStory abgestimmt haben.
     * Nur wenn der momentan angemeldete Nutzer in dem Vote eingeladen ist, werden
     * die Daten geladen
     */
    function getVoteCount($userstoryId, $currentUser){
        $con = Connection::createConnection();
        $sql = "SELECT count(*) as anz FROM rel_user_user_story rel INNER JOIN user_story story ON rel.fk_user_story = story.id
                INNER JOIN rel_vote_user rel_user ON rel_user.fk_vote = story.fk_vote
                INNER JOIN vote v ON story.fk_vote = v.id 
                WHERE story.id = :stroyid AND rel_user.fk_user = :currentUser ";

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':stroyid', $story_var);
        $stmt->bindParam(':currentUser', $current_user_var);
        
        $story_var = $userstoryId;
        $current_user_var = $currentUser;
        try{
            $stmt->execute();
            if($row = $stmt->fetch()) {
                return $row['anz'];
             }
    
        }catch(Exception $e){
            error_log("Interner Fehler ". $e->getMessage(), 0);

        }
        return NULL;
    }


    /**
     * Läd alle Votings zu denen der übergeben Nutzer eingeladen wurde
     */
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
            error_log("Interner Fehler ". $e->getMessage(), 0);

        }
        return $result;
    }

    /**
     * Läd die Punkte zu einer User Story.
     * Die Punkte können nur geladen werden, falls der aktuelle Benutzer im
     * Vote auch eingeladen wurde um zu vermeiden, dass Punkte zu fremden Abstimmungen geladen
     * werden können
     * @return Punkte NULL falls der gewüsnchte Nutzer noch nicht abgestimmt hat oder der aktuelle Benutzer nicht authoriziert ist
     *                     die Punkte einzusehen 
     * 
     */
    function getVotePoints($userId, $userStoryId, $currentUserId){
        $con = Connection::createConnection();
        $sql = "SELECT points FROM rel_user_user_story rel INNER JOIN user_story story ON rel.fk_user_story = story.id
                INNER JOIN rel_vote_user rel_user ON rel_user.fk_vote = story.fk_vote
                INNER JOIN vote v ON story.fk_vote = v.id 
                WHERE story.id = :stroyid AND rel_user.fk_user = :currentUser AND rel.fk_user = :userId";

        //die Punkte anderer Spieler dürfen nur geladen werden, falls das vote beendet ist
        if (!($userId == $currentUserId)){
            $sql .= " AND v.end <= NOW()";
        }
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':stroyid', $story_var);
        $stmt->bindParam(':currentUser', $current_user_var);
        $stmt->bindParam(':userId', $user_var);
        
        $story_var = $userStoryId;
        $current_user_var = $currentUserId;
        $user_var = $userId;
        try{
            $stmt->execute();
            if($row = $stmt->fetch()) {
                return $row['points'];
             }
    
        }catch(Exception $e){
            error_log("Interner Fehler ". $e->getMessage(), 0);

        }
        return NULL;        
    }

    /**
     * Läd ein Vote zu einer Id. Das Vote kann nur geladen werden, falls der aktuelle Benutzer
     * authorisiert ist, dieses auch zu sehen.
     * @return Vote NULL falls der Nutzer nicht authorisiert ist oder das Vote nicht exsitiert
     */
    function getVote($currentUser, $voteId){
        $con = Connection::createConnection();
        $stmt = $con->prepare("SELECT v.id, v.name, v.end FROM vote v INNER JOIN rel_vote_user rel_usr ON v.id = rel_usr.fk_vote WHERE v.id = :voteid 
                                                                                                                                 AND rel_usr.fk_user = :currentUser");
        $stmt->bindParam(':voteid', $vote_var);
        $stmt->bindParam(':currentUser', $user_var);
        
        $vote_var = $voteId;
        $user_var = $currentUser;
        try{
            $stmt->execute();
            if($row = $stmt->fetch()) {
                $vote = new Vote();
                $vote->setId($row['id']);
                $vote->setName($row['name']);
                $vote->setEnd($row['end']);
                $vote->setUserStorys($this->getUserStorys($con, $row['id']));
                $vote->setUsers($this->getUsers($con, $row['id']));
                return $vote;

             }
    
        }catch(Exception $e){
            error_log("Interner Fehler ". $e->getMessage(), 0);

        }
        return NULL;
        
    }
}

?>