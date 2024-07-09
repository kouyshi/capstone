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

$specific_ids = [1, 2, 3, 4, 5, 6, 7, 8, 9]; // IDs for the cards

foreach ($specific_ids as $id) {
    $sql = "SELECT plantIMG, plantname FROM plantdb WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $data[] = [
            'image' => base64_encode($row['plantIMG']),
            'pname' => $row['plantname']
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
    <title>Plantlist</title>
    <link rel="stylesheet" href="css/plantlist.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,600;1,600&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <header>

        <div class="search-container">
            <input type="text" placeholder="Search..." class="search-bar">
        </div>

        <div class="title">
            <a href="dashboard.html"> <img src="img/logo1.png" alt=""></a>
        </div>

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

        </nav>
    </header>

<div class="card-discovery">
        <h1>Plantlist</h1>

        <div class="discovery-content">
            <div class="card-content">
            <img src="data:image/svg+xml;base64,<?php echo $data[0]['image']; ?>" alt="Card Image">
            <p><?php echo $data[0]['pname']; ?></p>
                <button>Add</button>
            </div>
    
            <div class="card-content">
            <img src="data:image/svg+xml;base64,<?php echo $data[1]['image']; ?>" alt="Card Image">
            <p><?php echo $data[1]['pname']; ?></p>
                <button>Add</button>
            </div>
    
            <div class="card-content">
            <img src="data:image/svg+xml;base64,<?php echo $data[2]['image']; ?>" alt="Card Image">
                <p><?php echo $data[2]['pname']; ?></p>
                <button>Add</button>
            </div>
    
            <div class="card-content">
            <img src="data:image/svg+xml;base64,<?php echo $data[3]['image']; ?>" alt="Card Image">
                <p><?php echo $data[3]['pname']; ?></p>
                <button>Add</button>
            </div>
    
            <div class="card-content">
            <img src="data:image/svg+xml;base64,<?php echo $data[4]['image']; ?>" alt="Card Image">
                <p><?php echo $data[4]['pname']; ?></p>
                <button>Add</button>
            </div>

            <div class="card-content">
            <img src="data:image/svg+xml;base64,<?php echo $data[5]['image']; ?>" alt="Card Image">
                <p><?php echo $data[5]['pname']; ?></p>
                <button>Add</button>
            </div>

            <div class="card-content">
            <img src="data:image/svg+xml;base64,<?php echo $data[6]['image']; ?>" alt="Card Image">
                <p><?php echo $data[6]['pname']; ?></p>
                <button>Add</button>
            </div>

            <div class="card-content">
            <img src="data:image/svg+xml;base64,<?php echo $data[7]['image']; ?>" alt="Card Image">
                <p><?php echo $data[7]['pname']; ?></p>
                <button>Add</button>
            </div>

            <div class="card-content">
            <img src="data:image/svg+xml;base64,<?php echo $data[8]['image']; ?>" alt="Card Image">
                <p><?php echo $data[8]['pname']; ?></p>
                <button>Add</button>
            </div>


        </div>     
    </div>
    
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