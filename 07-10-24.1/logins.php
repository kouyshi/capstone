<?php
session_start();

$servername = "localhost"; // Change this to your database server
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "user_auth"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);

    // Execute the query
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Bind result variables
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Password is correct, start a new session
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;

            // Redirect to a welcome page (or dashboard)
            header("Location: dashboard.php");
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "Invalid username.";
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
        <form class="login-form" method="POST" >
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
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </div>
        </form>
    </div>
    <script src="JS/login.js"></script>
</body>
</html>
