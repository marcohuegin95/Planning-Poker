<?php 
/**
 * AccountDAO
 *
 * Interface for basic account operations
 */
interface AccountDAO{
    function register($account);
    function findAndFill($account);
}

?>