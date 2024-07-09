<?php
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "user_auth"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Array to store image data and plant info
$data = [];

$specific_ids = [1, 2, 3]; // IDs for the cards

foreach ($specific_ids as $id) {
    $sql = "SELECT plantIMG, plantinfo FROM plantdb WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data[] = [
            'image' => base64_encode($row['plantIMG']),
            'info' => $row['plantinfo']
        ];
    } else {
        $data[] = null; // Handle case where no data is found
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,600;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <header>
        <div class="search-container">
            <input type="text" placeholder="Search..." class="search-bar">
        </div>
        <div class="title">
            <a href="dashboard.html"> 
                <img src="https://raw.githubusercontent.com/kouyshi/capstone/748e52b836a4264996b105f2ce7e03738cc8168b/logo%202/1.svg" alt="">
            </a>
        </div>
        <!-- new -->
        <div class="ACTIONS-HEADER"> 
        <nav class="bar">
            <div class="home">
                <a href="dashboard.php"><span class="material-symbols-outlined">home</span>
                <h5>Home</h5></a>
            </div>
            <div class="garden">
                <a href="garden.html"><span class="material-symbols-outlined">psychiatry</span>
                <h5>My Garden</h5></a>
            </div>
            <div class="discovery">
                <a href="discover.html"><span class="material-symbols-outlined">menu_book</span>
                <h5>Discovery</h5></a>
            </div>
            <div class="profile">
                <a href="profile.html"><span class="material-symbols-outlined">person</span>
                <h5>Profile</h5></a>
            </div>
            </div>
        </nav>
    </header>
    
    <div class="img">
        <img src="https://github.com/kouyshi/capstone/blob/main/logo%202/Untitled6_20240622171445.png?raw=true" alt="">
        <div class="imgtext">
            <h2>Green Haven</h2>
            <p>Breathe Life <br> Into Your Home</p>
            <button class="abt">About Us</button>
        </div>
    </div>
    <div class="list">
        <h2>WHAT TO GROW</h2>
        <p>LIST OF PLANTS</p>

        <div class="HERO2">
            
        <div class="card">
        <img src="data:image/svg+xml;base64,<?php echo $data[0]['image']; ?>" alt="Card Image">
        <h2>Tomato</h2>

        <div class="info">
        <p><?php echo $data[0]['info']; ?></p>
        </div>

        <a href="#">Read more</a>
    </div>

    <div class="card">
        <img src="data:image/svg+xml;base64,<?php echo $data[1]['image']; ?>" alt="Card Image">
        <h2>Eggplant</h2>

        <div class="info">
        <p><?php echo $data[1]['info']; ?></p>
        </div>
        
        <a href="#">Read more</a>
    </div>

    <div class="card">
        <img src="data:image/svg+xml;base64,<?php echo $data[2]['image']; ?>" alt="Card Image">
        <h2>Bitter Gourd</h2>

        <div class="info">
        <p><?php echo $data[2]['info']; ?></p>
        </div>

        <a href="#" class="Readmore">Read more</a>
    </div>
        </div>
    </div>
    <div> 
    </div>


        <section class="services-section">
            <div class="services-header">
                <h2>PLANTING <span class="highlight">PROCESS</span></h2>
                <h1>Helps You Make Clean And Safe Vagetables At Home </h1>
            </div>
            <div class="services-container">
                <div class="Planting-card">
                    <div class="icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/6218/6218725.png" alt="Sowing">
                    </div>
                    <h3>Sowing</h3>
                    <p>Acina phasellus tellus egetas into curius urna suscipit vehicula ottua pellentesque placerat</p>
                    <a href="#" class="read-more">Read More →</a>
                </div>
                <div class="Planting-card">
                    <div class="icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/8809/8809609.png" alt="Seedling">
                    </div>
                    <h3>Seedling</h3>
                    <p>Acina phasellus tellus egetas into curius urna suscipit vehicula ottua pellentesque placerat</p>
                    <a href="#" class="read-more">Read More →</a>
                </div>
                <div class="Planting-card">
                    <div class="icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/2153/2153788.png" alt="Vegetative">
                    </div>
                    <h3>Vegetative</h3>
                    <p>Acina phasellus tellus egetas into curius urna suscipit vehicula ottua pellentesque placerat</p>
                    <a href="#" class="read-more">Read More →</a>
                </div>
                <div class="Planting-card">
                    <div class="icon">
                        <img src="https://cdn-icons-png.flaticon.com/128/5312/5312538.png" alt="Harvest">
                    </div>
                    <h3>Harvest</h3>
                    <p>Acina phasellus tellus egetas into curius urna suscipit vehicula ottua pellentesque placerat</p>
                    <a href="#" class="read-more">Read More →</a>
                </div>
            </div>
        </section>
  

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
