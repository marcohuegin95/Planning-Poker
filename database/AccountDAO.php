<?php 
interface AccountDAO{

    function register($account);
    function isValid($account);

}

?>