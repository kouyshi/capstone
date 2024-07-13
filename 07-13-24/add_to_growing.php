<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sample";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    $response['message'] = "Connection failed: " . $conn->connect_error;
    echo json_encode($response);
    exit();
}

$response = ['success' => false, 'message' => ''];

if (!isset($_SESSION['user_id'])) {
    
    $response['message'] = 'User not logged in.';
    echo json_encode($response);
    exit();
}

$user_id = $_SESSION['user_id'];
$plant_id = $_POST['plant_id'];
$plant_name = $_POST['plant_name'];
$plant_image = base64_decode($_POST['plant_image']);

$sql = "INSERT INTO growing (user_id, plant_name, plant_image) VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $user_id, $plant_name, $plant_image);

if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['message'] = "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

echo json_encode($response);
?>
