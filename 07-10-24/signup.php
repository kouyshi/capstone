<?php
$servername = "localhost";
$db_username = "root";
$db_password = "";
$dbname = "user_auth";

$conn = new mysqli($servername, $db_username, $db_password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
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
    <title>SIGN UP</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,600,0,0">
</head>
<body>

  <div class="holder" id="signUp">
    <form class="login-form" method="POST" action="signup.php">
      <h1>Sign Up</h1>
  
      <div class="textbox">
        <input type="text" placeholder="Username" name="username" required>
        <span class="material-symbols-outlined">alternate_email</span>
      </div>
  
      <div class="textbox">
        <input type="email" placeholder="Email" name="email" required>
        <span class="material-symbols-outlined">account_circle</span>
      </div>

      <div class="textbox">
        <input type="password" id="password" placeholder="Enter your password" name="password" required>
        <span class="material-symbols-outlined" id="lock">lock</span>
        <button type="button" class="visibility-btn" onclick="togglePasswordVisibility()">
            <span class="material-symbols-outlined" id="visibility-icon" style="display: none;">visibility</span>
            <span class="material-symbols-outlined" id="visibility-off-icon" >visibility_off</span>
          </button>
        <div id="password-strength" class="strength">Password strength: <span id="strength-text">WEAK</span></div>
        <div class="composition">
            <h3>Password composition</h3>
            <ul>
                <li id="length" class="invalid">At least 12 characters</li>
                <li id="lowercase" class="invalid">Lowercase</li>
                <li id="uppercase" class="invalid">Uppercase</li>
                <li id="symbols" class="invalid">Symbols (#?!@...)</li>
                <li id="numbers" class="invalid">Numbers</li>
            </ul>
        </div>
      </div>
  
      <button type="submit">Sign Up</button>
      <div class="links">
        <p>
          Already Have Account ? <a href="login.php">Sign In</a>
        </p>
      </div>
    </form>
  </div>

  <script src="JS/login.js"></script>

</body>
</html>
