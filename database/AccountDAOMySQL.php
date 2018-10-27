<?php 

require 'Connection.php';
require 'AccountDAO.php';
/**
 * AccountDAOMySQL
 *
 * Verwaltet die Datenbank zugriffe für user
 */
class AccountDAOMySQL implements AccountDAO{


    /**
     * Versucht den übergebenen Nutzer zu Speichern
     */
    public function register($account){
        if ($account->validate()){
            $con = Connection::createConnection();

            try{
                $stmt = $con->prepare("INSERT INTO user (username, email, password) VALUES (:username, :email, PASSWORD(:password))");
                $stmt->bindParam(':username', $account_var);
                $stmt->bindParam(':email',  $email_var);
                $stmt->bindParam(':password', $password_var);
        
                $account_var = $account->getUsername();
                $email_var = $account->getEmail();
                $password_var = $account->getPassword();
                $stmt->execute(); 
                return true;
            }catch(Exception $e){
                error_log("Interner Fehler ". $e->getMessage(), 0);
                return false; 
            }   
        }
        return false;

    }

    /**
     * Sucht einen user mit der E-Mail und dem Password des
     * übergebenen Benutzers, falls dieser gefunden werden kann
     * werden die Werte id und username ergänzt
     */
    public function findAndFill($account){
        $con = Connection::createConnection();

        try{
            $stmt = $con->prepare("SELECT id, username FROM user where  (email = ?) AND (password = PASSWORD(?))");
            if ($stmt->execute(array($account->getEmail(), $account->getPassword()))) {
                if ($stmt->rowCount() > 0){
                    $row = $stmt->fetch();
                    $account->setId($row['id']);
                    $account->setUsername($row['username']);
                    return true;
                }
            }
        }catch(Exception $e){
            error_log("Interner Fehler ". $e->getMessage(), 0);
            return false;
        }  
        return false;
    }

    /**
     * Läd alle Benutzer. Die Passwörter werden nicht geladen
     * um die Liste auch sicher ans Frontend weitergeben zu können
     */
    public function getAllUsers(){
        $con = Connection::createConnection();
        $result = [];
        try{

            foreach ($con->query("SELECT id, username, email FROM user") as $row) {
                $user = new User();
                $user->setId($row['id']);
                $user->setUsername($row['username']);
                $user->setEmail($row['email']);
                $result[] = $user;
             }

        }catch(Exception $e){
            error_log("Interner Fehler ". $e->getMessage(), 0);
        }        
        return $result;

    }

    public function getUserById($id){
        $con = Connection::createConnection();

        try{
            $stmt = $con->prepare("SELECT id, username, email FROM user where  (id = ?)");
            if ($stmt->execute(array($id))) {
                if ($stmt->rowCount() > 0){
                    $row = $stmt->fetch();
                    $user = new User();
                    $user->setId($row['id']);
                    $user->setUsername($row['username']);
                    $user->setEmail($row['email']);
                    return $user;
                }
            }
        }catch(Exception $e){
            error_log("Interner Fehler ". $e->getMessage(), 0);
        }
            
        return NULL;        
    }

}
?>