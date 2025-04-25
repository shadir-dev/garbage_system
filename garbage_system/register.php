<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// DB connection
$conn = new mysqli("localhost", "root", "", "smart_garbage");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sanitize input
function clean($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = clean($_POST["full_name"]);
    $email = clean($_POST["email"]);
    $username = clean($_POST["username"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Basic validations
    if (empty($full_name)) $errors[] = "Full name is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if (!preg_match('/^\w+$/', $username)) $errors[] = "Username can only contain letters, numbers, or underscores.";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if ($password !== $confirm_password) $errors[] = "Passwords do not match.";

    // Check username in `users`
    $stmtCheck = $conn->prepare("SELECT username FROM users WHERE username = ?");
    $stmtCheck->bind_param("s", $username);
    $stmtCheck->execute();
    $stmtCheck->store_result();
    if ($stmtCheck->num_rows > 0) $errors[] = "Username already exists.";
    $stmtCheck->close();

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert into `registration`
        $stmt1 = $conn->prepare("INSERT INTO registration (full_name, email, username, password) VALUES (?, ?, ?, ?)");
        $stmt1->bind_param("ssss", $full_name, $email, $username, $hashed_password);

        // Insert into `users` (only username)
        $stmt2 = $conn->prepare("INSERT INTO users (username) VALUES (?)");
        $stmt2->bind_param("s", $username);

        if ($stmt1->execute() && $stmt2->execute()) {
            $success = "✅ Registration successful. <a href='login.html' style='color: white; text-decoration: underline;'>Login here</a>.";
        } else {
            $errors[] = "❌ Registration failed: " . $conn->error;
        }

        $stmt1->close();
        $stmt2->close();
    }
}

$conn->close();
?>
