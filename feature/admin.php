<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - MF CLINIC</title>
  <link rel="stylesheet" href="../style/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="logo"> <span>MF</span> CLINIC </div>
      <nav class="menu">
        <ul>
          <li><a href="#" class="active" onclick="showSection('dashboard')"><i class="fas fa-chart-line"></i> Dashboard</a></li>
          <li><a href="#" onclick="showSection('users')"><i class="fas fa-users"></i> Users</a></li>
          <li><a href="#" onclick="showSection('logs')"><i class="fas fa-clipboard-list"></i> Logs</a></li>
        </ul>
      </nav>
      <div class="sidebar-bottom">
        <div class="admin-info">
          <img src="avatar.png" alt="Admin" class="avatar">
          <div>
            <p>John Doe</p>
            <small>Admin</small>
          </div>
        </div>
        <a href="logout.php" class="logout-btn">Log Out</a>
      </div>
    </aside>

    <!-- Main content -->
    <main class="main-content">
      <header class="topbar">
        <h1>Dashboard</h1>
        <input type="text" placeholder="Search anything..." class="search-bar">
      </header>

      <section id="dashboard" class="content-section">
        <h2>Welcome Mr. John</h2>
        <div class="stats">
          <div class="stat-box blue"> <p>Total Patients</p> <h3>1</h3> </div>
          <div class="stat-box orange"> <p>Total Doctors</p> <h3>1</h3> </div>
          <div class="stat-box green"> <p>Total Nurses</p> <h3>1</h3> </div>
        </div>

        <div class="recent-users">
          <h3>Recent Users</h3>
          <table>
            <thead>
              <tr>
                <th>User</th>
                <th>Last Logged-in</th>
                <th>Role</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><img src="avatar1.png" class="avatar-sm"> Dan Mark Javier</td>
                <td>3/24/2025</td>
                <td>Patient</td>
              </tr>
              <tr>
                <td><img src="avatar2.png" class="avatar-sm"> Jonard Pinalas</td>
                <td>3/24/2025</td>
                <td>Doctor</td>
              </tr>
              <tr>
                <td><img src="avatar3.png" class="avatar-sm"> John Doe</td>
                <td>3/24/2025</td>
                <td>Staff</td>
              </tr>
            </tbody>
          </table>
        </div>
      </section>

      <section id="users" class="content-section" style="display:none">
        <h2>Users</h2>
        <p>Manage users here...</p>
      </section>

      <section id="logs" class="content-section" style="display:none">
        <h2>Logs</h2>
        <p>View system logs here...</p>
      </section>
    </main>
  </div>

  <script>
    function showSection(id) {
      const sections = document.querySelectorAll('.content-section');
      sections.forEach(section => section.style.display = 'none');
      document.getElementById(id).style.display = 'block';

      const links = document.querySelectorAll('.menu a');
      links.forEach(link => link.classList.remove('active'));
      event.target.classList.add('active');
    }
  </script>
</body>
</html> 