<?php
session_start();
require_once 'connection.php';
require_once 'functions.php';
// require_once 'database.php';
require_once 'session.php';
require_once 'cookie.php';

$action = 'login';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

if (file_exists($action.'.php')) {
    require_once $action.'.php';
} else {
    echo 'File ' . $action.'.php not found';
}
