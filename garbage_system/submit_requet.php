<?php
// submit_request.php

$host = "localhost";
$user = "root";
$pass = "";
$db = "smart_garbage";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Sanitize input
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$location = mysqli_real_escape_string($conn, $_POST['location']);
$waste_type = mysqli_real_escape_string($conn, $_POST['waste-type']);
$preferred_time = mysqli_real_escape_string($conn, $_POST['preferred-time']);
$contact_info = mysqli_real_escape_string($conn, $_POST['contact-info']);

// Check for available truck
$truck_query = "SELECT * FROM trucks WHERE availability = 'available' LIMIT 1";
$truck_result = $conn->query($truck_query);

if ($truck_result && $truck_result->num_rows > 0) {
    $truck = $truck_result->fetch_assoc();
    $truck_id = $truck['id'];

    // Assign truck to request
    $insert_request = "INSERT INTO garbage_requests (name, email, location, waste_type, preferred_time, contact_info, truck_id, status)
                       VALUES ('$name', '$email', '$location', '$waste_type', '$preferred_time', '$contact_info', '$truck_id', 'Assigned')";
    $conn->query($insert_request);

    // Update truck availability
    $update_truck = "UPDATE trucks SET availability = 'assigned' WHERE id = $truck_id";
    $conn->query($update_truck);

    $response = [
        "status" => "success",
        "message" => "Request submitted. Truck assigned successfully."];

    }
else {
    // No trucks available
    $insert_request = "INSERT INTO garbage_requests (name, email, location, waste_type, preferred_time, contact_info, status)
                       VALUES ('$name', '$email', '$location', '$waste_type', '$preferred_time', '$contact_info', 'Pending')";
    $conn->query($insert_request);

    echo "Request submitted. view_status to truck your request";
}

$conn->close();
?>
