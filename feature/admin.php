-- admin.php --
<?php
session_start();
// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
// Determine current page
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="admin.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="admin.php">Admin Panel</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="adminNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link <?php echo $page=='dashboard'?'active':'' ?>" href="admin.php?page=dashboard">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link <?php echo $page=='users'?'active':'' ?>" href="admin.php?page=users">Users</a></li>
        <li class="nav-item"><a class="nav-link <?php echo $page=='logs'?'active':'' ?>" href="admin.php?page=logs">Logs</a></li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link text-warning" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-4">
  <?php
    $allowed = ['dashboard','users','logs'];
    if (!in_array($page, $allowed)) $page = 'dashboard';
    include __DIR__ . "/$page.php";
  ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

-- login.php --
<?php
session_start();
$err = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    // hardcoded credentials for demo
    if ($user === 'admin' && $pass === 'password') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $err = 'Invalid credentials';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"><title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head><body class="bg-light">
<div class="container pt-5">
  <div class="row justify-content-center">
    <div class="col-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-4">Admin Login</h5>
          <?php if ($err): ?><div class="alert alert-danger"><?=htmlspecialchars($err)?></div><?php endif; ?>
          <form method="post">
            <div class="mb-3"><input name="username" class="form-control" placeholder="Username"></div>
            <div class="mb-3"><input type="password" name="password" class="form-control" placeholder="Password"></div>
            <button class="btn btn-primary w-100">Login</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>

-- logout.php --
<?php
session_start();
session_destroy();
header('Location: login.php');
exit;
?>

-- dashboard.php --
<h1>Dashboard</h1>
<p>Welcome to the admin dashboard. Use the menu to navigate.</p>

-- users.php --
<h1>Users</h1>
<p>List your users here.</p>

-- logs.php --
<h1>Logs</h1>
<p>View system logs here.</p>

-- admin.css --
body { background: #f5f5f5; font-family: sans-serif; }
.navbar-brand { font-size: 1.4rem; font-weight: bold; }
.nav-link { font-size: 1rem; }
.nav-link.active { font-weight: bold; color: #0d6efd !important; }
.container { background: #fff; padding: 20px; border-radius: 0.5rem; }
