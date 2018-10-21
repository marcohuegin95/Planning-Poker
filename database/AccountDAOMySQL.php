<?php 

require 'Connection.php';
require 'AccountDAO.php';
/**
 * AccountDAOMySQL
 *
 * Object to implement basic account database operations
 */
class AccountDAOMySQL implements AccountDAO{

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
                return false; 
            }
               
        }
        return false;

    }
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
            return false;
        }
            
        return false;
    }

}
?>