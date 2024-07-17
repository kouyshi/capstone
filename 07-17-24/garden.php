<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sample";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['action']) && $_GET['action'] == 'fetch_reminders') {
    $reminder_sql = "SELECT plant_name, plant_image, last_watered FROM growing WHERE user_id = $user_id";
    $reminder_result = $conn->query($reminder_sql);

    $reminders = [];
    if ($reminder_result->num_rows > 0) {
        while ($row = $reminder_result->fetch_assoc()) {
            $row['plant_image'] = base64_encode($row['plant_image']);
            $row['last_watered'] = date('F j, Y', strtotime($row['last_watered']));
            $reminders[] = $row;
        }
    }

    echo json_encode($reminders);
    $conn->close();
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['plant_name']) && isset($_POST['plant_image'])) {
        $plant_image = base64_decode($_POST['plant_image']);
        $plant_name = $_POST['plant_name'];

        $stmt = $conn->prepare("INSERT INTO growing (user_id, plant_image, plant_name, last_watered) VALUES (?, ?, ?, NOW())");
        $stmt->bind_param("iss", $user_id, $plant_image, $plant_name);

        if ($stmt->execute()) {
            $delete_stmt = $conn->prepare("DELETE FROM planning WHERE user_id = ? AND plant_name = ?");
            $delete_stmt->bind_param("is", $user_id, $plant_name);
            $delete_stmt->execute();
            $delete_stmt->close();

            echo "Success";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        exit();
    } elseif (isset($_POST['reminder_checkbox']) && isset($_POST['plant_name'])) {
        $plant_name = $_POST['plant_name'];
        $current_date = date('Y-m-d');

        $update_stmt = $conn->prepare("UPDATE growing SET last_watered = ? WHERE user_id = ? AND plant_name = ?");
        $update_stmt->bind_param("sis", $current_date, $user_id, $plant_name);

        if ($update_stmt->execute()) {
            echo "Success";
        } else {
            echo "Error: " . $update_stmt->error;
        }

        $update_stmt->close();
        exit();
    }
}

$planning_sql = "SELECT plant_name, plant_image FROM planning WHERE user_id = $user_id";
$planning_result = $conn->query($planning_sql);

$growing_sql = "SELECT plant_name, plant_image FROM growing WHERE user_id = $user_id";
$growing_result = $conn->query($growing_sql);

$reminder_sql = "SELECT plant_name, plant_image, last_watered FROM growing WHERE user_id = $user_id";
$reminder_result = $conn->query($reminder_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garden</title>
    <link rel="stylesheet" href="css/garden.css">
    <script src="JS/garden.js"></script>
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
            <a href="dashboard.php"><img src="https://raw.githubusercontent.com/kouyshi/capstone/748e52b836a4264996b105f2ce7e03738cc8168b/logo%202/1.svg" alt=""></a>
        </div>
        <div class="ACTIONS-HEADER"> 
            <nav class="bar">
                <div class="home">
                    <a href="dashboard.php"><span class="material-symbols-outlined">home</span>
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
            </nav>
        </div>
    </header>

    <div class="gardens">
        <div class="radio-inputs">
            <label class="radio">
                <input type="radio" name="radio" checked onclick="toggleContent('planning')" />
                <span class="name">Planning</span>
            </label>
            <label class="radio">
                <input type="radio" name="radio" onclick="toggleContent('growing')" />
                <span class="name">Growing</span>
            </label>
            <label class="radio">
                <input type="radio" name="radio" onclick="toggleContent('reminder')" />
                <span class="name">Reminder</span>
            </label>
        </div>

        <div class="weather-widget">
            <div id="location">Identifying location...</div>
            <div class="datee"><div id="date"></div></div>
            <div class="wead">
                <div id="weather"></div>
                <img id="icon" src="" alt="Weather Icon">
                <span id="temperature"></span>
            </div>
            <div id="description"></div>
        </div>

        <div class="card-container" id="planning">
            <div class="plantlist">
                <a href="plantlist.php"><button>Add Plants?</button></a>
            </div>
            <div id="planning-cards">
                <?php
                if ($planning_result->num_rows > 0) {
                    while($row = $planning_result->fetch_assoc()) {
                        $imageData = base64_encode($row["plant_image"]);
                        echo '<div class="card">';
                        echo '<a href="info.php"><img src="data:image/svg+xml;base64,' . $imageData . '" alt="Card Image"></a>';
                        echo '<h2>'.$row["plant_name"].'</h2>';
                        echo '<form class="growForm" method="post" onsubmit="moveToGrowing(event, this)">';
                        echo '<input type="hidden" name="plant_image" value="' . $imageData . '">';
                        echo '<input type="hidden" name="plant_name" value="' . $row["plant_name"] . '">';
                        echo '<button type="submit">Growing</button>';
                        echo '</form>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="noplant">';
                    echo "<p>No plants found.</p>";
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <div class="card-container" id="growing">
            <div class="plantlist">
                <a href="plantlist.php"><button>Add Plants?</button></a>
            </div>
            <div id="growing-cards">
                <?php
                if ($growing_result->num_rows > 0) {
                    while($row = $growing_result->fetch_assoc()) {
                        $imageData = base64_encode($row["plant_image"]);
                        echo '<div class="card">';
                        echo '<a href="info.php"><img src="data:image/svg+xml;base64,' . $imageData . '" alt="Card Image"></a>';
                        echo '<h2>'.$row["plant_name"].'</h2>';
                        echo '<div class="harvest">Harvest in X days</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="noplant">';
                    echo "<p>No plants found.</p>";
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <div class="card-container" id="reminder">
            <div class="plantlist">
                <a href="plantlist.php"><button>Add Plants?</button></a>
            </div>
            <div id="reminder-cards">
                <?php
                if ($reminder_result->num_rows > 0) {
                    while($row = $reminder_result->fetch_assoc()) {
                        $imageData = base64_encode($row["plant_image"]);
                        echo '<div class="card-rem">';
                        echo '<a href=""><img src="data:image/svg+xml;base64,' . $imageData . '" alt="Plant Image"></a>';
                        echo '<div class="content">';
                        echo '<h2>' . $row["plant_name"] . '</h2>';
                        echo '<p class="last-watered"><strong>Last Watered:</strong> <br>' . date('F j, Y', strtotime($row["last_watered"])) . '</p>';
                        echo '</div>';
                        echo '<div class="checkbox-container">';
                        echo '<form class="reminderForm" method="post" onsubmit="updateReminder(event, this)">';
                        echo '<input type="hidden" name="plant_name" value="' . $row["plant_name"] . '">';
                        echo '<input type="checkbox" name="reminder_checkbox" class="reminder-checkbox">';
                        echo '</form>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="noplant">';
                    echo "<p>No plants found.</p>";
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Plant moved to Growing successfully!</p>
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
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <hr>
        <p>&copy; 2024 Your Company Name. All rights reserved.</p>
    </footer>
    <script>
       document.addEventListener("DOMContentLoaded", function () {
    function toggleContent(contentId) {
        var containers = document.querySelectorAll('.card-container');
        containers.forEach(function (container) {
            container.classList.toggle('active', container.id === contentId);
        });
    }
    toggleContent('planning');

    window.moveToGrowing = function(event, form) {
        event.preventDefault();

        var formData = new FormData(form);
        var plantName = form.querySelector('input[name="plant_name"]').value;
        var plantImage = form.querySelector('input[name="plant_image"]').value;

        fetch('', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes("Error")) {
                console.error('Error:', data);
                return;
            }

            var planningCard = form.closest('.card');
            var growingContainer = document.getElementById('growing-cards');
            var planningContainer = document.getElementById('planning-cards');

            // Remove from planning
            planningCard.remove();

            // Create new card in growing
            var newCard = document.createElement('div');
            newCard.classList.add('card');
            newCard.innerHTML = `
                <a href="info.php"><img src="data:image/svg+xml;base64,${plantImage}" alt="Card Image"></a>
                <h2>${plantName}</h2>
                <div class="harvest">Harvest in X days</div>
            `;
            growingContainer.appendChild(newCard);

            // Check if there are no plants left in planning and show message if needed
            if (planningContainer.children.length === 0) {
                var noPlantMessage = document.createElement('div');
                noPlantMessage.classList.add('noplant');
                noPlantMessage.innerHTML = "<p>No plants found.</p>";
                planningContainer.appendChild(noPlantMessage);
            }

            // Show success modal
            var modal = document.getElementById('successModal');
            modal.style.display = "block";
            var span = document.getElementsByClassName("close")[0];
            span.onclick = function() {
                modal.style.display = "none";
            };
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };

            // Fetch updated reminders
            fetch(`?action=fetch_reminders`)
                .then(response => response.json())
                .then(reminders => {
                    var reminderContainer = document.getElementById('reminder-cards');
                    reminderContainer.innerHTML = '';

                    reminders.forEach(reminder => {
                        var reminderCard = document.createElement('div');
                        reminderCard.classList.add('card-rem');
                        reminderCard.innerHTML = `
                            <a href=""><img src="data:image/svg+xml;base64,${reminder.plant_image}" alt="Plant Image"></a>
                            <div class="content">
                                <h2>${reminder.plant_name}</h2>
                                <p class="last-watered"><strong>Last Watered:</strong> <br>${reminder.last_watered}</p>
                            </div>
                            <div class="checkbox-container">
                                <form class="reminderForm" method="post" onsubmit="updateReminder(event, this)">
                                    <input type="hidden" name="plant_name" value="${reminder.plant_name}">
                                    <input type="checkbox" name="reminder_checkbox" class="reminder-checkbox">
                                </form>
                            </div>
                        `;
                        reminderContainer.appendChild(reminderCard);
                    });

                    // Reattach event listeners for checkboxes
                    document.querySelectorAll('.reminderForm input[type="checkbox"]').forEach(checkbox => {
                        checkbox.addEventListener('change', function () {
                            var form = this.closest('form');
                            updateReminder(new Event('submit'), form);
                        });
                    });
                })
                .catch(error => console.error('Error:', error));
        })
        .catch(error => console.error('Error:', error));
    };

    window.updateReminder = function(event, form) {
        event.preventDefault();

        var formData = new FormData(form);

        fetch('', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.includes("Error")) {
                console.error('Error:', data);
                return;
            }

            if (data.includes("Success")) {
                var plantDate = new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
                form.closest('.card-rem').querySelector('.last-watered').innerHTML = '<strong>Last Watered:</strong><br>' + plantDate;
            }
        })
        .catch(error => console.error('Error:', error));
    };

    // Attach initial event listeners for checkboxes in reminder cards
    document.querySelectorAll('.reminderForm input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            var form = this.closest('form');
            updateReminder(new Event('submit'), form);
        });
    });
});

    </script>
</body>
</html>
