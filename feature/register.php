<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MF Clinic - Register</title>
  <link rel="stylesheet" href="style/register.css">
</head>
<body>
  <div class="container">
    <!-- Register Section -->
    <div class="register-section">
      <div class="logo"><span>MF</span> CLINIC</div>
      <div class="register-form">
        <h2>Sign Up</h2>
        <form action="#" method="POST">
          <div class="form-group">
            <input type="text" name="first_name" placeholder="First Name" required>
            <input type="text" name="last_name" placeholder="Last Name" required>
          </div>
          <input type="email" name="email" placeholder="Enter Email" required>
          <input type="text" name="phone" placeholder="Phone Number" required>
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
    <!-- Image Section -->
    <div class="image-section">
      <img src="image/doctor.jpg" alt="Doctor">
    </div>
  </div>
</body>
</html>
