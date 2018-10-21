<?php
require 'base/router.php';

error_reporting(E_ALL);

session_start();

$router = new Router();
$router->dispatch($_SERVER['REQUEST_URI']);

?>