<?php
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "sample";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$specific_id = 1;

$sql = "SELECT plantIMG FROM plantdb";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    $row = $result->fetch_assoc();
    $image_data = base64_encode($row['plantIMG']);

} else {
    die("No data found for the specified ID.");
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INFO</title>
    <script src="JS/info.js"></script>
    <link rel="stylesheet" href="css/info.css">
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
            <a href="dashboard.php"> <img src="https://raw.githubusercontent.com/kouyshi/capstone/748e52b836a4264996b105f2ce7e03738cc8168b/logo%202/1.svg" alt=""></a>
        </div>
        <!-- new -->
        <div class="ACTIONS-HEADER"> 
        <nav class="bar">
            <div class="home">
                <a href="dashboard.html"><span class="material-symbols-outlined">home</span>
                <h5>Home</h5></a>
            </div>
            <div class="garden">
                <a href="garden.php"><span class="material-symbols-outlined">psychiatry</span>
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

    <main>
        <section class="image-section">
        <img src="data:image/svg+xml;base64,<?php echo $image_data; ?>" alt="">
            <div class="info">
                <div class="info-t">
                    <p>Local Climate</p>
                    <img src="img/sun.png" alt="">
                    <p>34<br>Tarlac City</p>
                </div>
                <div class="info-t">
                    <p>Plant type</p>
                    <img src="img/sprout.png" alt="">
                    <p>Frost Sensitive</p>
                </div>
            </div>
            <br>
            <div class="buttons">
                <button>Add to Planning</button>
                <button>Add to Growing</button>
            </div>
            
        </section>

        <section class="suitable-location">
            <h2>Suitable Location</h2>
            <div class="location-info">
                <div class="location-item">
                    <img src="img/sprout.png" alt="">
                    <p>Hardiness zone <br> <strong>2 - 10</strong></p>
                </div>
                <div class="location-item">
                    <img src="img/temperature.png" alt="">
                    <p>Temperature <br> <strong>20°C - 35°C</strong></p>
                </div>
                <div class="location-item">
                    <img src="img/sun.png" alt="">
                    <p>Preferred sunlight <br> <strong>Full Sun</strong><br><br> Also suitable with <br><strong>Partial sun</strong></p>
                </div>             
            </div>
        </section>

        <section class="growth-timeline">
            <h2>Growth timeline</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="day">Day 1</div>
                    <div class="icon">🌱</div>
                    <div class="label">Sowing</div>
                </div>
                <div class="timeline-item">
                    <div class="day">Day 7-10</div>
                    <div class="icon">🌿</div>
                    <div class="label">Sprout</div>
                </div>
                <div class="timeline-item">
                    <div class="day">Day 20-30</div>
                    <div class="icon">🌳</div>
                    <div class="label">Vegetative</div>
                </div>
                <div class="timeline-item">
                    <div class="day">Day 40-60</div>
                    <div class="icon">🌸</div>
                    <div class="label">Flowering</div>
                </div>
            </div>
        </section>

        <section>
        <div class="how">
            <h2>How-Tos</h2>
            <div class="sowing">
                <div class="sowing-header" onclick="toggleContent('sowing-content', 'arrow')">
                    <span>Sowing</span>
                    <span id="arrow">▼</span>
                </div>

                <div class="sowing-content" id="sowing-content">
                    <p><strong>Starting methods</strong> <br>
                    Start indoors &gt; Direct sow</p>
                    <p><strong>Spacing</strong><br>
                    15 - 25 cm</p>
                    <p><strong>Seed depth</strong><br>
                    6 mm</p>
                    <p><strong>Soil temperature for germination</strong><br>
                    18-25 °C</p>
                    <p><strong>Water after sowing</strong><br>
                    Twice a day</p>
                </div>
            </div>
        
            <div class="sowing">
                <div class="sowing-header" onclick="toggleContent('fertilizing-content', 'arrow-2')">
                    <span>Seeding</span>
                    <span id="arrow-2">▼</span>
                </div>
                <div class="sowing-content" id="fertilizing-content">
                    <p><strong>Initial Fertilizing</strong> <br>
                    Use balanced fertilizer </p>
                    <p><strong>Frequency</strong><br>
                    Every 2 weeks</p>
                </div>
            </div>
        
            <div class="sowing">
                <div class="sowing-header" onclick="toggleContent('watering-content', 'arrow-3')">
                    <span>Vegetative</span>
                    <span id="arrow-3">▼</span>
                </div>
                <div class="sowing-content" id="watering-content">
                    <p><strong>Watering Frequency</strong><br>
                    Once a day in the morning</p>
                    <p><strong>Water Amount</strong><br>
                    Enough to keep soil moist</p>
                </div>
            </div>
        
            <div class="sowing">
                <div class="sowing-header" onclick="toggleContent('pruning-content', 'arrow-4')">
                    <span>Harvest</span>
                    <span id="arrow-4">▼</span>
                </div>
                <div class="sowing-content" id="pruning-content">
                    <p><strong>Pruning Time</strong> <br>
                    Early spring</p>
                    <p><strong>Tools</strong> <br>
                    Sharp pruning shears</p>
                </div>
            </div>
        </div>
        </section>
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