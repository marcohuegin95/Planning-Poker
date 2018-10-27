<?php

require 'views/LoginPage.php';
require 'database/UserDAOMySQL.php';
require 'model/User.php';

/**
 * LoginController
 *
 * Verwaltet alle Nutzerbezogenen Aktionen 
 * @author Timon Müller-Wessling
 */
class UserController{

    /**
    * Zeigt die Normale Login Seite 
    */
    public function index(){
        $page = new LoginPage();
        $page->render();
    }

    /**
    * Versucht anhand der übergebenen Paramtern einen Nutzer Account
    * zu Speichern. Falls die Eingaben korrekt sind wird zum Dashboard weitergeleitet 
    */
    public function login(){
        $page = new LoginPage();
        $account = $this->createAccountFromParams(true);
        if ($account != NULL){
            $dao = new UserDAOMySQL();
            if ($dao->findAndFill($account)){
                $_SESSION["userid"] = $account->getId();
                $_SESSION["username"] = $account->getUsername();
                $_SESSION["email"] = $account->getEmail();
                
                header("Location: /Dashboard");
                die();
            }else{
                $page->setError('E-Mail oder Password falsch');
            }
        }else{
            $page->setError('Falsche Eingaben');
        }
        $page->render();
    }


    /**
    * loggt den aktuellen Benutzer aus 
    * dabei wird nicht überprüft ob ein Nutzer angemeldet wird sondern es wird
    * der Nutzer Wert der Session entfernt und die session beendet 
    */
    public function logout(){
        session_destroy();
        header("Location: /");
        die();
    }

    /**
    * Versucht anhand der übergebenen Paramtern einen Nutzer Account
    * zu Registrieren
    */
    public function register(){
        $page = new LoginPage();
        
        $account = $this->createAccountFromParams(false);
        if ($account != NULL){
            $dao = new UserDAOMySQL();
            if ($account->validate()){
                if ($dao->register($account)){
                    $page->setMessage('Erfolgreich registriert');
                }else{
                    $page->setError('Fehler beim Speichern');
                }
            }else{
                $page->setError($account->getLastValidateError());
            }
        }else{
            $page->setError('Falsche Eingaben');
        }

        $page->render();
    }

    /**
    * Versucht ein User Objekt anhand der POST Paramter zu erstellen
    * @return User Falls alle notwendigen Parameter gesetzt sind wird ein User Objekt zurückgegeben, wenn nicht NULL  
    */
    private function createAccountFromParams($onlyemail){
        if (($onlyemail  || isset($_POST['username'])) && isset($_POST['email']) && isset($_POST['password'])){
            $account = new User();
            if (!$onlyemail){
                $account->setUsername($_POST['username']);
            }
            $account->setEmail($_POST['email']);
            $account->setPassword($_POST['password']);
            return $account;
        }
        return NULL;
    }

}