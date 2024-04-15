<?php
// session_start();
delCookie('user');
unset($_SESSION['user']);
header('Location: index.php?action=login');
exit();