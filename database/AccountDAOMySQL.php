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


            $stmt = $con->prepare("INSERT INTO Accounts (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $account_var);
            $stmt->bindParam(':email',  $email_var);
            $stmt->bindParam(':password', $password_var);
    
            $account_var = $account->getUsername();
            $email_var = $account->getEmail();
            $password_var = $account->getPassword();
            $stmt->execute(); 
            return true;   
        }
        return false;

    }
    public function isValid($account){
        if ($account->validate()){
            $con = Connection::createConnection();

            $stmt = $dbh->prepare("SELECT * FROM Accounts where  email = ? AND password = ?");
            if ($stmt->execute(array($account->getUsername(), $account->getEmail(), $account->getPassword()))) {
              if ($stmt->rowCount() > 0){
                return true;
              }
            }
        return false;
        }
    }

}
?>