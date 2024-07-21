<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $mysqli->real_escape_string($_POST['content']);
    $user_id = $_SESSION['user_id'];
    $mysqli->query("INSERT INTO posts (user_id, content) VALUES ('$user_id', '$content')");
}

$posts = $mysqli->query("SELECT posts.content, posts.timestamp, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.timestamp DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Community</title>
</head>
<body>
    <form action="index.php" method="post">
        <textarea name="content" required></textarea>
        <button type="submit">Post</button>
    </form>

    <div>
        <?php while ($post = $posts->fetch_assoc()): ?>
            <div>
                <h3><?php echo htmlspecialchars($post['username']); ?></h3>
                <p><?php echo htmlspecialchars($post['content']); ?></p>
                <small><?php echo $post['timestamp']; ?></small>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
