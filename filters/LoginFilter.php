<?php 

require 'Filter.php';

/**
 * Filter
 *
 * Filters Users that are not logged in
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