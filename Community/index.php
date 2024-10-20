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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discovery</title>
    <link rel="stylesheet" href="discover.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="disco.js"></script>
</head>

<body>
    <header>
        <div class="search-container">
            <input type="text" placeholder="Search..." class="search-bar">
        </div>
        <div class="title">
            <a href="dashboard.php">
                <img src="https://raw.githubusercontent.com/kouyshi/capstone/748e52b836a4264996b105f2ce7e03738cc8168b/logo%202/1.svg" alt="">
            </a>
        </div>
        <!-- new -->
        <div class="ACTIONS-HEADER"> 
        <nav class="bar">
            <div class="home">
                <a href="dashboard.php"><span class="material-symbols-outlined">home</span>
                    <h5>Home</h5>
                </a>
            </div>
            <div class="garden">
                <a href="garden.php">
                    <span class="material-symbols-outlined">psychiatry</span>
                        <h5>My Garden</h5>
                </a>
            </div>
            <div class="discovery">
                <a href="discover.html">
                    <span class="material-symbols-outlined">menu_book</span>
                    <h5>Discovery</h5>
                </a>
            </div>
            <div class="profile">
                <a href="profile.html">
                    <span class="material-symbols-outlined">person</span>
                    <h5>Profile</h5>
                </a>
            </div>
            </div>
        </nav>
    </header>

<main>

<div class="discovers">
    <div class="radio-inputs">
        <div class="radio">
            <input type="radio" id="feed" name="discover" onclick="showSection('feed')" checked>
            <label class="name" for="feed">Feed</label>
        </div>
        <div class="radio">
            <input type="radio" id="community" name="discover" onclick="showSection('community')">
            <label class="name" for="community">Community</label>
        </div>
    </div>

    <div class="discover-feed">
        <div class="discoverss">

        
    <div class="card-discovery">
        <h1>Sowing</h1>

        <div class="discovery-content" >
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
        </div>     
    </div>

    <div class="card-discovery">
        <h1>sprout</h1>
        <div class="discovery-content">
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
        </div>     
    </div>

    <div class="card-discovery">
        <h1>vegetative</h1>
        <div class="discovery-content">
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
        </div>     
    </div>

    <div class="card-discovery">
        <h1>flowering</h1>
        <div class="discovery-content">
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>

            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>

            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
        </div>     
    </div>

    <div class="card-discovery">
        <h1>harvest</h1>
        <div class="discovery-content">
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
    
            <div class="card-content">
                <img src="img/tomato.webp" alt="">
                <p>Tomato</p>
            </div>
        </div>     
    </div>
</div>
</div>

<div class="discover-community">
    <div class="discoverss">
    <section class="post-section">
        <h2>Post Your Thoughts</h2>
        <form action="index.php" method="post">
            <textarea name="content" placeholder="Write A Message"></textarea>
            <button type="submit">Post</button>
        </form>
    </section>

    <section class="posts-display">
        <h2>Recent Posts</h2>

        <div>
            <?php while ($post = $posts->fetch_assoc()): ?>
                <div>
                    <h3><?php echo htmlspecialchars($post['username']); ?></h3>
                    <p><?php echo htmlspecialchars($post['content']); ?></p>
                    <small><?php echo $post['timestamp']; ?></small>
                </div>
            <?php endwhile; ?>
        <ul id="postsList"></ul>
    </section>
    
</div>
</div>
</main>

<footer>
    <div class="a">
        <h2>SAMPLE</h2>
        <p>Help you grow your plants and learn new things.</p>
        <br>
        <p>follow us on:</p>
        <img src="img/fb.png" alt="">
        <img src="img/twt.png" alt="">
    </div>

    <div class="b">
            <h2>SITE LINKS</h2>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">My Garden</a></li>
            <li><a href="#">Discovery</a></li>
            <li><a href="#">Profile</a></li>
        </ul>
    </div>

    <div class="c">
            <h2>Support</h2>
        <ul>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Help Center</a></li>
            <li><a href="#">Privacy Policy</a></li>
        </ul>
    </div>
        <hr>
        <p>&copy; 2024 Your Company Name. All rights reserved.</p>
</footer>


</body>
</html>