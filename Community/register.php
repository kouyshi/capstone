<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $mysqli->real_escape_string($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    
    if ($mysqli->query($query)) {
        header("Location: login.html");
    } else {
        echo "Error: " . $mysqli->error;
    }
}
?>
