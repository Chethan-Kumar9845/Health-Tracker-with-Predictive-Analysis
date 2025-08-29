<?php


// Author: Chethan Kumar
//AIET Mijar
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Initialize report variables
$report = "";
$bmi = "";
$healthStatus = "";
$precautions = "";

// Displaying the report if session variables are set (redirected from process.php)
if (isset($_SESSION['report'])) {
    $report = $_SESSION['report'];
    unset($_SESSION['report']);  // Clear the report session after displaying it
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Health Tracker - Home</title>
  <link rel="stylesheet" href="style.css">
</head>
<body class="home-bg">
  <div class="container">
    <h1>Welcome to Health Tracker</h1>
    <p class="index_p">Your personalized health report will be generated here.</p>

    <!-- Input Form for Health Tracker -->
    <form action="process.php" method="POST">
      <div class="form-group">
        <label for="heartbeat">Heartbeat:</label>
        <input type="number" id="heartbeat" name="heartbeat" required>
      </div>

      <div class="form-group">
        <label for="sleepHour">Sleep Hours:</label>
        <input type="number" id="sleepHour" name="sleepHour" required>
      </div>

      <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>
      </div>

      <div class="form-group">
        <label for="height">Height (cm):</label>
        <input type="number" id="height" name="height" required>
      </div>

      <div class="form-group">
        <label for="weight">Weight (kg):</label>
        <input type="number" id="weight" name="weight" required>
      </div>

      <button type="submit">Check Your Health Status</button>
    </form>


    <br>
    <a href="logout.php" class="logout-btn">Logout</a>

  </div>
</body>
</html>
