<?php
// Author: Chethan Kumar
//AIET Mijar
session_start();

// Check if the report is available in the session
if (!isset($_SESSION['report'])) {
    // Generate the report here (replace this with actual report generation logic)
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username']; // Retrieve the actual username from the session
    } else {
        $username = "Guest"; // Default to "Guest" if no username is found
    }

    // Example of report content (replace this with actual report generation logic)
    $reportContent = "<h2>Health Report for " . htmlspecialchars($username) . "</h2>";
    $reportContent .= "<p>Details about health...</p>"; // Add actual report details here

    // Store the generated report in session
    $_SESSION['report'] = $reportContent;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Status</title>
    <link rel="stylesheet" href="report_css.css">
</head>
<body>
    <div class="container">
        <!-- Report Display -->
        <div class="report-container">
            <?php echo $_SESSION['report']; ?>
        </div>

        <!-- Back Button -->
        <a href="index.php" class="back-btn">Back to Home</a>

        <!-- Download PDF Button -->
        <form method="POST" action="generate_report.php">
            <button type="submit" name="download" class="download-btn">Download Report as PDF</button>
        </form>
    </div>
</body>
</html>

