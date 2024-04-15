<?php 
function checkUser($isLogin = true) {
    if ($isLogin) {
        if (isset($_SESSION['user'])) {
            header('Location: index.php?action=home');
            exit();
        }
    } else {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit();
        } else if (isset($_COOKIE['user'])) {
            $_SESSION['user'] = $_COOKIE['user'];
        }
    }
}