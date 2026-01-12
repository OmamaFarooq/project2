<?php
// jobs.php
require_once("settings.php");

// Connect to MySQL
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) die("Database connection failed: " . mysqli_connect_error());

// Fetch all jobs
$sql = "SELECT * FROM jobs";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Job Listings</title>
<link rel="stylesheet" href="styles/style.CSS">
</head>
<body class="classic-theme">

<?php include 'header.inc'; ?>

<h1 class="classic-theme intro">Job Listings</h1>
<p class="classic-theme intro">Explore exciting career opportunities with us!</p>

<div class="content-wrapper classic-theme">
<main class="classic-theme">

<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<section class="job-listing">';
        echo '<h2>Job Description - ' . htmlspecialchars($row['job_title']) . '</h2>';

        // Position Overview
        echo '<h3>Position Overview</h3>';
        echo '<ul>';
        echo '<li><strong>Reference Number:</strong> ' . htmlspecialchars($row['job_ref']) . '</li>';
        echo '<li><strong>Position Title:</strong> ' . htmlspecialchars($row['job_title']) . '</li>';
        echo '<li><strong>Salary Range:</strong> ' . htmlspecialchars($row['salary']) . '</li>';
        echo '<li><strong>Location:</strong> ' . htmlspecialchars($row['location']) . '</li>';
        echo '<li><strong>Job Type:</strong> ' . htmlspecialchars($row['job_type']) . '</li>';
        echo '<li><strong>Reports To:</strong> ' . htmlspecialchars($row['reports_to']) . '</li>';
        echo '</ul>';

        // Brief Description
        echo '<h3>Brief Description</h3>';
        echo '<div class="box"><p>' . nl2br(htmlspecialchars($row['job_description'])) . '</p></div>';

        // Key Responsibilities
        echo '<h3>Key Responsibilities</h3>';
        echo '<ol>';
        $responsibilities = explode(';', $row['responsibilities']);
        foreach ($responsibilities as $resp) {
            echo '<li>' . htmlspecialchars(trim($resp)) . '</li>';
        }
        echo '</ol>';

        // Qualifications
        echo '<h3>Required Qualifications & Skills</h3>';
        echo '<ul>';
        $qualifications = explode(';', $row['qualifications']);
        foreach ($qualifications as $qual) {
            echo '<li>' . htmlspecialchars(trim($qual)) . '</li>';
        }
        echo '</ul>';

        // Compensation & Benefits
        echo '<h3>Compensation & Benefits</h3>';
        echo '<ul>';
        $benefits = explode(';', $row['benefits']);
        foreach ($benefits as $b) {
            echo '<li>' . htmlspecialchars(trim($b)) . '</li>';
        }
        echo '</ul>';

        echo '</section>';
    }
} else {
    echo '<p>No jobs available at the moment.</p>';
}

mysqli_close($conn);
?>

</main>

<aside class="classic-theme">
<h3>How to Apply</h3>
<p>Please visit the <a href="apply.php">Apply</a> page to submit your application.
Send documents to <a href="mailto:careers@primenova.com">careers@primenova.com</a>.</p>
</aside>

</div>
<?php include 'footer.inc'; ?>

</body>
</html>
