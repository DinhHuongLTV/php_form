<?php 
function saveCookie($data = [], $timeExpiration = 1) {
    foreach($data as $key => $value) {
        setcookie($key, $key, time() + $timeExpiration * 24 * 60 * 60);
    }
}

function delCookie($key) {
    setcookie($key, 1, time() - 1);
}