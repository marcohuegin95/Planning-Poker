<?php 

/**
 * UserDAO
 * @author Timon Müller-Wessling
 */
interface UserDAO{
    function register($account);
    function findAndFill($account);
    function getAllUsers();
    function getUserById($id);
}

?>