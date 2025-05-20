<?php
// register.php
require 'config.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = trim($_POST['first_name'] ?? '');
    $last_name = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone_number = trim($_POST['phone_number'] ?? '');
    $user_type = $_POST['user_type'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validation
    if (!$first_name || !$last_name || !$email || !$phone_number || !$user_type || !$password || !$confirm_password) {
        $errors[] = "All fields are required.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // Check for duplicate email
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->fetch()) {
        $errors[] = "Email is already registered.";
    }

    if (empty($errors)) {
        // Hash password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Insert user
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone_number, user_type, password_hash) 
                                VALUES (:first_name, :last_name, :email, :phone_number, :user_type, :password_hash)");
        $stmt->execute([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone_number' => $phone_number,
            'user_type' => $user_type,
            'password_hash' => $password_hash
        ]);

        $success = "Registration successful! You can now <a href='login.php'>log in</a>.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MF Clinic Register</title>
  <link rel="stylesheet" href="../style/register.css" />
</head>
<body>
  <div class="container">
    <div class="register-section">
      <div class="logo"><span>MF</span> CLINIC</div>
      <div class="register-form">
        <h2>Sign Up</h2>

        <!-- Display messages -->
        <?php if (!empty($errors)): ?>
          <div style="color: red;">
            <?php foreach ($errors as $error): ?>
              <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
          </div>
        <?php elseif ($success): ?>
          <div style="color: green;">
            <p><?= $success ?></p>
          </div>
        <?php endif; ?>

        <form action="register.php" method="POST">
          <div class="input-group">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
          </div>
          <input type="email" name="email" placeholder="Enter Email" required>
          <input type="tel" name="phone_number" placeholder="Enter Phone Number" required>
          <select name="user_type" required>
            <option value="">Select User Type</option>
            <option value="patient">Patient</option>
            <option value="admin">Admin</option>
            <option value="nurse">Nurse</option>
            <option value="doctor">Doctor</option>
          </select>
          <input type="password" name="password" placeholder="Password" required>
          <input type="password" name="confirm_password" placeholder="Confirm Password" required>
          <button type="submit">Register</button>
        </form>

        <div class="login-link">
          Already have an account? <a href="login.php">Log In here!</a>
        </div>
      </div>
    </div>

    <div class="image-section">
      <img src="../image/doctor.jpg" alt="Doctor">
    </div>
  </div>
</body>
</html>
