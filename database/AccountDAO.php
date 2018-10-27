<?php 

/**
 * AccountDAO
 * @author Timon Müller-Wessling
 */
interface AccountDAO{
    function register($account);
    function findAndFill($account);
    function getAllUsers();
    function getUserById($id);
}

?>