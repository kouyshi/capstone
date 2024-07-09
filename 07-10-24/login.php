<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "user_auth";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Invalid Username or Password.";
        }
    } else {
        $error_message = "No user found with that username.";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,0,0">
</head>
<body>

<div class="holder" id="signIn">
    <form class="login-form" method="POST" action="login.php">
        <h1>Login</h1>
        <div class="textbox">
            <input type="text" placeholder="Username" name="username" required>
            <span class="material-symbols-outlined">account_circle</span>
        </div>
        <div class="textbox">
            <input type="password" id="password" placeholder="Password" name="password" required>
            <span class="material-symbols-outlined" id="lock-icon">lock</span>
            <button type="button" class="visibility-btn-login" onclick="togglePasswordVisibility()">
                <span class="material-symbols-outlined" id="visibility-icon" style="display: none;">visibility</span>
                <span class="material-symbols-outlined" id="visibility-off-icon">visibility_off</span>
            </button>
        </div>
        <?php if (!empty($error_message)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
        <?php endif; ?>
        <p class="recover">
            <a href="#">Forgot Password?</a>
        </p>
        <button type="submit">LOGIN</button>

        <div class="links">
            <p>
                Don't have an account? <a href="signup.php">Sign Up</a>
            </p>
        </div>
    </form>
</div>

<script src="JS/login.js"></script>
</body>
</html>
