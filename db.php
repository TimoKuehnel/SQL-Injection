<?php
$host = 'mysql';
$db   = 'sql_demo';
$user = 'root';
$pass = '1234';

$pdo = new PDO(
    "mysql:host=$host;dbname=$db;charset=utf8mb4",
    $user,
    $pass,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
