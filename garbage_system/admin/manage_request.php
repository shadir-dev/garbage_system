
 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Requests - Smart Waste</title>
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
      list-style: none;
      padding: 0;
    }

    .sidebar ul li {
      padding: 10px;
      margin-bottom: 10px;
      background-color: #34495e;
      border-radius: 4px;
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
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #ccc;
      text-align: left;
    }

    th {
      background-color: #27ae60;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      color: white;
    }

    .btn-assign {
      background-color: #3498db;
    }

    .btn-track {
      background-color: #e67e22;
    }

    @media (max-width: 768px) {
      .sidebar {
        display: none;
      }

      .main-panel {
        padding: 15px;
      }

      table, thead, tbody, th, td, tr {
        display: block;
      }

      th, td {
        padding: 10px;
        border: none;
        border-bottom: 1px solid #ddd;
      }

      th {
        background-color: transparent;
        color: #333;
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
        <li class="nav-item"><a class="nav-link" href="manage_request.php">Manage_request</a></li>
        <li class="nav-item"><a class="nav-link" href="trucks.php">Manage_trucks</a></li>
        <li class="nav-item"><a class="nav-link" href="users.php">Users</a></li>
        <li class="nav-item"><a class="nav-link" href="route.html">Optimized_Route</a></li>
        <li class="nav-item"><a class="nav-link" href="messages.html">Messages</a></li>
        <li>Logout</li>
      </ul>
    </nav>
  </div>

  <!-- Main Panel -->
  <div class="main-panel">
    <h1>Pickup Requests</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>EMAIL</th>
          <th>Location</th>
          <th>Waste</th>
          <th>Status</th>
          
        </tr>
      </thead>
      <tbody>
        <?php include 'request.php'; ?>
      </tbody>
    </table>
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
