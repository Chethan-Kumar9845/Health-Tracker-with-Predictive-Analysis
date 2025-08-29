<?php
// Author: Chethan Kumar
// Health Tracker Project - Login Page


session_start();
include 'db_config.php';

$message = ""; // Initialize message variable to store error or success messages

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Query to check if email exists in the database
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // If email exists, fetch the user record
            $user = $result->fetch_assoc();
            
            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Start session for the logged-in user
                $_SESSION['email'] = $email;
                $_SESSION['username'] = $user['name'];  // Save the patient's full name in session
                $_SESSION['profile_image'] = $user['photo']; // Save the profile image path
                
                // Redirect to the homepage (index.php)
                header("Location: index.php");
                exit();
            } else {
                $message = "<p class='error-message'>Invalid password.</p>";
            }
        } else {
            $message = "<p class='error-message'>No user found with this email.</p>";
        }
    } else {
        $message = "<p class='error-message'>Please enter both email and password.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Health Tracker</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="login-bg">
  <div class="login-container">
    <h2>Login to your account</h2>
    <form action="login.php" method="POST">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">Login</button>

      <!-- Display the error message below the form -->
      <?php if ($message != ""): ?>
        <div class="message-container">
          <?php echo $message; ?>
        </div>
      <?php endif; ?>
      
      <p>Don't have an account? <a href="register.php">Register here</a></p>
      
    </form>

  </div>
    <!-- Credit outside of login-container -->
    <p class="footer-credit" style="font-size: 12px; color: #cccccc; text-align: right; position: fixed; bottom: 12px; right: 12px;">
    &copy; 2025 Health Tracker. Developed by <strong>Chethan Kumar</strong>.
  </p>
</body>
</html>
