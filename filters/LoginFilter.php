<?php 

/**
 * LoginFilter
 *
 * Prüft ob ein Nutzer angenmeldet ist. Falls nicht wird
 * zum index umgeleitet.
 * @author Timon Müller-Wessling
 */
class LoginFilter implements Filter{
    
    function filter(){
        if (!isset($_SESSION["userid"])){
            header("Location: /");
            die();
        }
    }

}

?>