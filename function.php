<?php 
function getFlashSession($field) {
    if (isset($_SESSION[$field])) {
        echo "<span>".$_SESSION[$field]."</span> <br>";
        unset($_SESSION[$field]);
    }
}