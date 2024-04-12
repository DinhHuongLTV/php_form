<?php 
session_start();
require_once 'function.php';
$action = 'showlog';
$_SESSION['count'] = 0;
if (isset($_GET['action'])) 
    $action = $_GET['action'];
    // var_dump(file_exists($action.'.php'))
if (file_exists($action.'.php')) {
    require_once $action.'.php';
}

getFlashSession('noti');
?>


    <a href="index.php?action=log">Log</a> <br>
    <a href="index.php?action=upload">Upload image</a> <br>
    <a href="index.php?action=showlog">Show Log</a>