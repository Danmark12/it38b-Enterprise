<?php
// login.php
session_start();
require 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    if ($email && $password) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            // Store user info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['first_name'] = $user['first_name'];

            // Redirect to dashboard or homepage
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MF Clinic Login</title>
  <link rel="stylesheet" href="../style/login.css">
  require 'config.php';
</head>
<body>
  <div class="container">
    <!-- Login Section -->
    <div class="login-section">
      <div class="logo"><span>MF</span> CLINIC</div>
      <div class="login-form">
        <h2>LOGIN</h2>
        <form action="#" method="POST">
          <input type="text" name="email" placeholder="Enter Email or Username" required>
          <input type="password" name="password" placeholder="Enter Password" required>
          <button type="submit">Log in</button>
        </form>
        <div class="signup-link">
          You don't have an account? <a href="register.php">Sign up here!</a>
        </div>
      </div>
    </div>

    <!-- Image Section -->
    <div class="image-section">
      <img src="../image/doctor.jpg" alt="Doctor">
      <div class="logo-bottom"><span>MF</span> CLINIC</div>
    </div>
  </div>
</body>
</html>
