<?php 
$file_name = 'log.txt';
$text = 'Log ở đây <br>';
file_put_contents('logs.txt', $text.PHP_EOL , FILE_APPEND | LOCK_EX);
$_SESSION['noti'] = 'Đã log';