<?php
const DB_NAME = 'php_database';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_DNS = 'mysql:host=localhost;dbname='.DB_NAME;
global $connection;
try {
    $connection = new PDO(DB_DNS, DB_USERNAME, DB_PASSWORD);
} catch(PDOException $e) {
    die('Lỗi: ' . $e->getMessage());
}

