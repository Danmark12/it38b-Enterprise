<?php
// login.php
session_start();
require 'config.php';
require 'functions.php'; // ✅ Include the logging function

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';

    if ($email && $password) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            // ✅ Update last_login timestamp
            $updateStmt = $conn->prepare("UPDATE users SET last_login = NOW() WHERE id = :id");
            $updateStmt->execute(['id' => $user['id']]);

            // ✅ Store user info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['first_name'] = $user['first_name'];

            // ✅ Log the login event
            log_event($conn, $user['id'], 'login', $user['first_name'] . ' logged in.');

            // ✅ Redirect based on user type
            switch ($user['user_type']) {
                case 'admin':
                    header("Location: admin.php");
                    break;
                case 'doctor':
                    header("Location: doctor_dashboard.php");
                    break;
                case 'nurse':
                    header("Location: nurse_dashboard.php");
                    break;
                case 'patient':
                    header("Location: patient_dashboard.php");
                    break;
                default:
                    $error = "Unknown user role.";
            }
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
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MF Clinic Login</title>
  <link rel="stylesheet" href="../style/login.css" />
</head>
<body>
  <div class="container">
    <!-- Login Section -->
    <div class="login-section">
      <div class="logo"><span>MF</span> CLINIC</div>
      <div class="login-form">
        <h2>LOGIN</h2>
        <?php if (!empty($error)): ?>
          <div class="error-message" style="color: red; margin-bottom: 10px;">
            <?= htmlspecialchars($error) ?>
          </div>
        <?php endif; ?>
        <form action="login.php" method="POST">
          <input type="text" name="email" placeholder="Enter Email" required>
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
