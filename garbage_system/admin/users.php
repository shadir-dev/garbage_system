
<?php
$conn = new mysqli('localhost', 'root', '', 'smart_garbage');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$query = "SELECT id, name, email, role, last_activity FROM users";
if ($search) {
    $query .= " WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR role LIKE '%$search%'";
}

$result = $conn->query($query);

$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
} else {
    $users = null;
}

// Summary counts
$countResult = $conn->query("SELECT role, COUNT(*) AS total FROM users GROUP BY role");
$summary = [];
while ($row = $countResult->fetch_assoc()) {
    $summary[$row['role']] = $row['total'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Users - Smart Waste</title>
  <style>
      nav a {
      color: rgb(243, 225, 225);
      text-decoration: none;
      font-weight: bold;
      transition: color 0.3s;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      display: flex;
      font-family: Arial, sans-serif;
      background-color: #f4f6f9;
    }

    .sidebar {
      width: 220px;
      background-color: #158b30;
      color: #fff;
      padding: 20px;
      min-height: 100vh;
    }

    .sidebar h2 {
      text-align: center;
      margin-bottom: 30px;
    }

    .sidebar ul {
      list-style-type: none;
      padding: 0;
    }

    .sidebar ul li {
      padding: 12px;
      margin-bottom: 10px;
      background-color: #34495e;
      border-radius: 5px;
      cursor: pointer;
    }

    .sidebar ul li:hover {
      background-color: #1abc9c;
    }

    .main-panel {
      flex: 1;
      padding: 30px;
    }

    .main-panel h1 {
      margin-bottom: 20px;
      color: #2c3e50;
    }

    .user-list {
      background-color: white;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .user-list table {
      width: 100%;
      border-collapse: collapse;
    }

    .user-list th, .user-list td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    .user-list th {
      background-color: #1abc9c;
      color: white;
    }

    .action-buttons button {
      margin-right: 5px;
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      color: white;
    }

    .btn-edit {
      background-color: #2980b9;
    }

    .btn-remove {
      background-color: #e74c3c;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .main-panel {
        padding: 15px;
      }
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <nav>
        <ul>
          <li class="nav-item"><a class="nav-link" href="admin_index.html">Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="manage_request.php">Manage Request</a></li>
          <li class="nav-item"><a class="nav-link" href="trucks.php">Manage Trucks</a></li>
          <li class="nav-item"><a class="nav-link" href="users.php">Users</a></li>
          <li class="nav-item"><a class="nav-link" href="route.html">Optimized Route</a></li>
          <li class="nav-item"><a class="nav-link" href="messages.html">Messages</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
  </div>

  <!-- Main Panel -->
  <div class="main-panel">
    <h1>Active Users</h1>
    <div class="user-list">
      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Last Activity</th>
        </tr>
        <?php
          if ($users) {
            foreach ($users as $user) {
              echo "<tr>
                      <td>{$user['id']}</td>
                      <td>{$user['name']}</td>
                      <td>{$user['email']}</td>
                      <td>{$user['role']}</td>
                      <td>{$user['last_activity']}</td>
                    </tr>";
            }
          } else {
            echo "<tr><td colspan='5'>No active users found.</td></tr>";
          }
        ?>
      </table>
    </div>
  </div>
  <script>
  // Disable right-click
  document.addEventListener('contextmenu', event => event.preventDefault());

  // Disable F12, Ctrl+Shift+I, Ctrl+U
  document.onkeydown = function(e) {
    if (e.keyCode === 123) return false; // F12
    if (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74)) return false; // Ctrl+Shift+I/J
    if (e.ctrlKey && e.keyCode === 85) return false; // Ctrl+U
  };
</script>

</body>
</html>
