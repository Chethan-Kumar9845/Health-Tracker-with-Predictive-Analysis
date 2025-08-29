<?php
session_start(); // Start the session

// Check if the report data exists in the session
if (!isset($_SESSION['report'])) {
    echo "No report found. Please generate the report first.";
    exit();
}

require_once 'vendor/autoload.php'; // Include TCPDF autoloader

$reportContent = $_SESSION['report'];
$patientName = isset($_SESSION['username']) ? $_SESSION['username'] : "Guest";
$email = isset($_SESSION['email']) ? $_SESSION['email'] : "Unknown Email";
$imagePath = isset($_SESSION['profile_image']) ? $_SESSION['profile_image'] : ''; // Get profile image path from session

date_default_timezone_set('Asia/Kolkata');
$currentDate = date("Y-m-d H:i:s");

// Create new PDF document
$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('times', '', 12); // Set Times New Roman font

// Updated HTML content using a table for layout
$html = <<<HTML
<style>
    body {
        font-family: 'Times New Roman', Times, serif;
        font-size: 12px;
        margin: 0;
        padding: 0;
        line-height: 1.5;
    }

    .header {
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #000;
    }

    .header-table {
        width: 100%;
        border-collapse: collapse;
    }

    .header-left {
        text-align: left;
        vertical-align: middle; /* Align text vertically */
        width: 70%; /* Allow this cell to take most of the space */
    }

    .header-right {
        text-align: right;
        width: 17%; /* Fixed width for the image */
        vertical-align: middle; /* Align image vertically */
    }

    .image-container {
        margin: 0; /* Remove margin around the image */
        padding: 5px; /* Optional: Add padding inside the margin */
        display: inline-block; /* Ensure the container fits the image */
    }

    .header-right img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
    }

    .report-content {
        padding: 20px;
        margin: 10px 10px;
        background-color: #f5f5f5;
        border: 1px solid #000;
        border-radius: 5px;
    }

    .footer {
        text-align: center;
        font-size: 10px;
        color: #555;
        margin-top: 15px;
    }
</style>

<div class="header">
    <table class="header-table">
        <tr>
            <td class="header-left">
                <p><strong>Patient Name:</strong> $patientName</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Date:</strong> $currentDate</p>
            </td>
            <td class="header-right">
                <div class="image-container">
                    <img src="$imagePath" alt="Patient Photo">
                </div>
            </td>
        </tr>
    </table>
</div>

<div class="report-content">
    $reportContent
</div>

<div class="footer">
    &copy; 2025 Health Tracker. Developed by <a href="https://www.linkedin.com/in/chethan-kumar-331987265/" target="_blank">Chethan Kumar</a>. All rights reserved.
</div>

HTML;

// Write HTML content to PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Output the PDF as a download
$pdf->Output('health_report Summary.pdf', 'D'); // Forces download
exit();