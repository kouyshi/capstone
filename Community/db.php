<?php
$host = 'localhost'; // usually 'localhost' for local development
$db = 'community_db';
$user = 'root'; // replace with your database username
$pass = ''; // replace with your database password

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}
?>