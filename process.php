<?php

//Author:Chethan Kumar

require 'vendor/autoload.php';
session_start();
require 'db_config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $heartbeat = $_POST['heartbeat'];
    $sleep = $_POST['sleepHour'];
    $age = $_POST['age'];
    $height = $_POST['height'];
    $weight = $_POST['weight'];

    // BMI Calculation
    $bmi = $weight / (($height / 100) ** 2);
    $healthStatus = "";
    $precautions = "";

    // Heartbeat Analysis
    $heartbeatStatus = "";
    $heartbeatPrecautions = "";

    if ($heartbeat < 60) {
        $heartbeatStatus = "Low Heartbeat (Bradycardia)";
        $heartbeatPrecautions = "<ul>
            <li>Monitor your heart rate regularly.</li>
            <li>Ensure proper hydration and electrolyte balance.</li>
            <li>Limit alcohol and caffeine intake.</li>
            <li>Include gentle cardiovascular exercises like walking.</li>
            <li>Consult a cardiologist for further evaluation.</li>
        </ul>";
    } elseif ($heartbeat >= 60 && $heartbeat <= 100) {
        $heartbeatStatus = "Normal Heartbeat";
        $heartbeatPrecautions = "<ul>
            <li>Maintain a balanced diet with adequate hydration.</li>
            <li>Incorporate 30 minutes of moderate exercise daily.</li>
            <li>Manage stress through relaxation techniques.</li>
        </ul>";
    } else {
        $heartbeatStatus = "High Heartbeat (Tachycardia)";
        $heartbeatPrecautions = "<ul>
            <li>Avoid stimulants like caffeine and nicotine.</li>
            <li>Practice stress management techniques like yoga or meditation.</li>
            <li>Limit high-intensity activities and consult a healthcare provider.</li>
        </ul>";
    }

    // Sleep Analysis
    $sleepStatus = "";
    $sleepPrecautions = "";

    if ($sleep < 7) {
        $sleepStatus = "Insufficient Sleep";
        $sleepPrecautions = "<ul>
            <li>Avoid screen time an hour before bed.</li>
            <li>Maintain a consistent sleep schedule.</li>
            <li>Practice relaxation techniques before sleeping.</li>
        </ul>";
    } elseif ($sleep >= 7 && $sleep <= 9) {
        $sleepStatus = "Healthy Sleep";
        $sleepPrecautions = "<ul>
            <li>Continue maintaining good sleep hygiene.</li>
            <li>Avoid heavy meals close to bedtime.</li>
        </ul>";
    } else {
        $sleepStatus = "Excessive Sleep";
        $sleepPrecautions = "<ul>
            <li>Evaluate sleep quality and avoid oversleeping.</li>
            <li>Engage in regular physical activity to improve energy levels.</li>
        </ul>";
    }

    // BMI Analysis
    if ($bmi < 18.5) {
        $healthStatus = "Underweight";
        $precautions = "<ul>
            <li>Increase calorie intake with nutrient-dense foods.</li>
            <li>Include high-protein snacks in your diet.</li>
            <li>Consult a nutritionist for a personalized diet plan.</li>
        </ul>";
    } elseif ($bmi >= 18.5 && $bmi < 24.9) {
        $healthStatus = "Normal";
        $precautions = "<ul>
            <li>Maintain your current healthy lifestyle.</li>
            <li>Ensure a balanced diet and regular physical activity.</li>
        </ul>";
    } else {
        $healthStatus = "Overweight";
        $precautions = "<ul>
            <li>Reduce sugar and processed food intake.</li>
            <li>Incorporate at least 150 minutes of exercise weekly.</li>
            <li>Consult a dietitian for weight management strategies.</li>
        </ul>";
    }

    // Additional Recommendations
    $waterIntakeRecommendation = "<ul>
        <li>Drink at least 8-10 glasses of water daily.</li>
        <li>Stay hydrated, especially after physical activities.</li>
    </ul>";

    $exerciseTips = "<ul>
        <li>Engage in a mix of aerobic and strength-training exercises.</li>
        <li>Take breaks to stretch during long periods of sitting.</li>
    </ul>";

    $mentalHealthSuggestions = "<ul>
        <li>Practice mindfulness or meditation regularly.</li>
        <li>Stay socially connected with family and friends.</li>
        <li>Seek professional help if you feel persistently stressed or anxious.</li>
    </ul>";

    if (isset($_SESSION['patient_name'])) {
        $patientName = $_SESSION['patient_name'];  // Get patient name from session
    } else {
        $patientName = "Guest";  // Default if the session variable is not set
    }


    // Prepare the report
    $report = "<h1>Health Report</h1>";
    $report .= "<h3>Heartbeat Status</h3>";
    $report .= "Your heartbeat is: $heartbeat bpm.<br>";
    $report .= "Condition: $heartbeatStatus<br>";
    $report .= "Precautions: $heartbeatPrecautions<br>";

    $report .= "<h3>BMI Status</h3>";
    $report .= "Your BMI is: $bmi<br>";
    $report .= "Condition: $healthStatus<br>";
    $report .= "Precautions: $precautions<br>";

    $report .= "<h3>Sleep Status</h3>";
    $report .= "Your sleep hours: $sleep hours.<br>";
    $report .= "Condition: $sleepStatus<br>";
    $report .= "Precautions: $sleepPrecautions<br>";

    $report .= "<h3>Water Intake Recommendations</h3>";
    $report .= $waterIntakeRecommendation;

    $report .= "<h3>Exercise Tips</h3>";
    $report .= $exerciseTips;

    $report .= "<h3>Mental Health Suggestions</h3>";
    $report .= $mentalHealthSuggestions;

    // Store the report in the session
    $_SESSION['report'] = $report;
    // Save to database
    $query = "INSERT INTO health_reports (heartbeat, sleep_hour, age, height, weight, bmi, status, precautions)
              VALUES ('$heartbeat', '$sleep', '$age', '$height', '$weight', '$bmi', '$healthStatus', '$precautions')";

    mysqli_query($conn, $query);
    mysqli_close($conn);

    // Redirect to report page
    header("Location: report.php");
    exit();
}
?>
