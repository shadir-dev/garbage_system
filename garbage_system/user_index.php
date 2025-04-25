<?php
session_start();

// Redirect to login if user not logged in
if (!isset($_SESSION['username'])) {
    header("Location: site_login.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Welcome - Smart Garbage Collection</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url('garb.png');
    }

    header {
      background-color: #158b30;
      color: white;
      padding: 10px 0;
    }

    nav .nav-item {
      display: inline;
      margin-right: 20px;
    }

    nav .nav-link {
      color: white;
      text-decoration: none;
      font-size: 18px;
    }

    .profile-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      cursor: pointer;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      right: 10px;
      background-color: #333;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      min-width: 160px;
      z-index: 1;
    }

    .dropdown-content a {
      color: white;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #575757;
    }

    .welcome-container {
      text-align: center;
      margin-top: 50px;
    }

    .welcome-container h1 {
      font-size: 36px;
      color: #333;
    }

    .welcome-container p {
      font-size: 18px;
      color: #555;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      background-color: #28a745;
      color: white;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #218838;
    }

    .section {
      padding: 20px;
      margin-top: 20px;
      background-color: #fff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    footer {
      text-align: center;
      padding: 10px;
      background-color: #158b30;
      color: white;
      position: fixed;
      width: 100%;
      bottom: 0;
    }
  </style>
</head>
<body>

<header>
  <nav>
    <div>
      <ul>
        <li class="nav-item"><a class="nav-link" href="user_index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="request_form.html">Request Pickup</a></li>
        <li class="nav-item"><a class="nav-link" href="view_status.html">View Status</a></li>
        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
      </ul>

      <aside>
        <div class="dropdown">
          <img src="https://studentportal.mmu.ac.ke/img/profile_m.png" alt="Profile Picture" class="profile-img" onclick="toggleDropdown()">
          <div class="dropdown-content" id="dropdownMenu">
            <a href="profile.php">Profile</a>
            <a href="logout.php">Logout</a>
          </div>
        </div>
      </aside>
    </div>
  </nav>
</header>

<!-- Personalized Welcome Section -->
<div class="welcome-container">
  <h1 class="display-4">Welcome, <span style="color:#158b30;"><?php echo htmlspecialchars($username); ?></span>!</h1>
  <p class="lead">Smart Waste Collection Made Easy</p>
  <p>Book, track, and manage your garbage pickups with ease.</p>
  <a href="request_form.html">
    <button>Request Pickup Now</button>
  </a>
</div>

<!-- Sections -->
<div class="section">
  <h5>How It Works</h5>
  <p>Submit your location, select waste type, and get service within hours.</p>
</div>

<div class="section">
  <h5>Why Choose Us</h5>
  <p>Fast, reliable pickups and environment-conscious waste handling.</p>
</div>

<footer>
  <p>© 2025 SmartWaste - All Rights Reserved</p>
</footer>

<script>
  function toggleDropdown() {
    var menu = document.getElementById("dropdownMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
  }

  window.onclick = function(event) {
    if (!event.target.matches('.profile-img')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (let i = 0; i < dropdowns.length; i++) {
        let openDropdown = dropdowns[i];
        if (openDropdown.style.display === "block") {
          openDropdown.style.display = "none";
        }
      }
    }
  };

  document.addEventListener('contextmenu', event => event.preventDefault());
  document.onkeydown = function(e) {
    if (e.keyCode === 123 || (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74)) || (e.ctrlKey && e.keyCode === 85)) {
      return false;
    }
  };
</script>

</body>
</html>
