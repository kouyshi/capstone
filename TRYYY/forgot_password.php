<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_auth";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(50));
    $expTime = date("Y-m-d H:i:s", strtotime('+1 hour'));

    $sql = "UPDATE users SET reset_token='$token', token_expiration='$expTime' WHERE email='$email'";

    if ($conn->query($sql) === TRUE) {
        // Send reset link to email (email sending code not included)
        echo "Password reset link sent!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
