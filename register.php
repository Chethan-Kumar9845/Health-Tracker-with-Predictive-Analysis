<?php
require 'db_config.php';

$message = ""; // Variable to store success or error message

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Securely hash the password
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];

    // Handle photo upload
    $imagePath = ""; 
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $uploadDir = 'uploads/';
        $imageName = basename($_FILES['profile_image']['name']);
        $targetFilePath = $uploadDir . $imageName;
        
        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetFilePath)) {
            $imagePath = $targetFilePath; // Save the image path
        } else {
            $message = "<p class='error-message'>Photo upload failed.</p>";
        }
    }

    // Save profile image path in session
    $_SESSION['profile_image'] = $imagePath;

    // Check if email already exists
    $check_email_query = "SELECT * FROM users WHERE email = ?";
    $stmt_check = $conn->prepare($check_email_query);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Email already exists
        $message = "<p class='error-message'>This email is already registered. Please use another one.</p>";
    } else {
        // Insert query if email does not exist
        $sql = "INSERT INTO users (name, email, password, address, pincode, photo) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $name, $email, $password, $address, $pincode, $imagePath);

        if ($stmt->execute()) {
            $message = "<p class='success-message'>Registration successful!</p>";
        } else {
            $message = "<p class='error-message'>Error: " . $stmt->error . "</p>";
        }

        $stmt->close();
    }

    $stmt_check->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Health Tracker</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="register-bg">
  <div class="container">
    <h1>Create an Account</h1>
    <form action="register.php" method="POST" class="register-form" enctype="multipart/form-data">
      <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" id="name" name="name" required>
      </div>
  
      <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
      </div>
  
      <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" id="password" name="password" required>
      </div>
  
      <div class="form-group">
          <label for="address">Address:</label>
          <textarea id="address" name="address" rows="4" required></textarea>
      </div>
  
      <div class="form-group">
          <label for="pincode">Pincode:</label>
          <input type="number" id="pincode" name="pincode" required>
      </div>

     <!-- Form field for image -->
<div class="form-group">
    <label for="photo">Upload Passport Photo:</label>
    <input type="file" id="photo" name="profile_image" accept="image/*" required>
</div>

  
      <button type="submit">Register</button>
    </form>

    <!-- Display success or error message -->
    <?php echo $message; ?>
    
    <p>Already have an account? <a href="login.php">Login here</a></p>

  </div>
  <p class="footer-credit" style="font-size: 12px; color: #cccccc; text-align: right; position: fixed; bottom: 10px; right: 18px;">
    &copy; 2025 Health Tracker. Developed by <strong>Chethan Kumar</strong>.
  </p>
</body>
</html>
