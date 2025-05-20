<?php
require 'admin.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];

    if (!$first_name || !$last_name || !$email || !$phone || !$user_type || !$password) {
        $errors[] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } elseif (!in_array($user_type, ['admin', 'doctor', 'nurse', 'patient'])) {
        $errors[] = "Invalid user type.";
    }

    if (empty($errors)) {
        // Hash password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert user
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, phone_number, user_type, password_hash)
                                VALUES (?, ?, ?, ?, ?, ?)");
        try {
            $stmt->execute([$first_name, $last_name, $email, $phone, $user_type, $password_hash]);
            $success = "User added successfully!";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $errors[] = "Email already exists.";
            } else {
                $errors[] = "Database error: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New User</title>
  <link rel="stylesheet" href="../style/add_user.css">
</head>
<body>

  <form method="POST" action="add_user.php">
    <h2>Add New User</h2>

    <?php if (!empty($success)): ?>
      <div class="message success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <?php foreach ($errors as $error): ?>
      <div class="message error"><?= htmlspecialchars($error) ?></div>
    <?php endforeach; ?>

    <label>First Name</label>
    <input type="text" name="first_name" required>

    <label>Last Name</label>
    <input type="text" name="last_name" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Phone Number</label>
    <input type="text" name="phone" required>

    <label>User Type</label>
    <select name="user_type" required>
      <option value="">-- Select Role --</option>
      <option value="admin">Admin</option>
      <option value="doctor">Doctor</option>
      <option value="nurse">Nurse</option>
      <option value="patient">Patient</option>
    </select>

    <label>Password</label>
    <input type="password" name="password" required>

    <button type="submit" class="btn">➕ Add User</button>
    <br><br>
    <a href="user.php" class="back-link">← Back to User List</a>
  </form>

</body>
</html>
