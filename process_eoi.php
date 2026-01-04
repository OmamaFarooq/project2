<?php
// this prevents direct access
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: apply.php");
    exit();
}

// Include database connection
require_once("settings.php");
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) die("Database connection failed");


function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$job_ref      = sanitize($_POST['job_ref'] ?? '');
$first_name   = sanitize($_POST['first_name'] ?? '');
$last_name    = sanitize($_POST['last_name'] ?? '');
$dob          = sanitize($_POST['dob'] ?? '');
$gender       = sanitize($_POST['gender'] ?? '');
$unit_number  = sanitize($_POST['unit_number'] ?? '');
$building_number = sanitize($_POST['building_number'] ?? '');
$street_name  = sanitize($_POST['street_name'] ?? '');
$street_number = sanitize($_POST['street_number'] ?? '');
$zone         = sanitize($_POST['zone'] ?? '');
$city         = sanitize($_POST['city'] ?? '');
$email        = sanitize($_POST['email'] ?? '');
$phone        = sanitize($_POST['phone'] ?? '');
$skills       = $_POST['skills'] ?? [];
$other_skills = sanitize($_POST['other_skills'] ?? '');


$errors = [];
if (empty($job_ref)) $errors[] = "Job reference required";
if (!preg_match("/^[A-Za-z]{1,20}$/", $first_name)) $errors[] = "First name invalid";
if (!preg_match("/^[A-Za-z]{1,20}$/", $last_name)) $errors[] = "Last name invalid";
if (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $dob)) $errors[] = "Date of birth invalid";
if (!in_array($gender, ['Male','Female'])) $errors[] = "Gender invalid";
if (strlen($street_name) > 40) $errors[] = "Street name too long";
if (strlen($unit_number) > 5 || strlen($building_number) > 5 || strlen($street_number) > 5) $errors[] = "Address numbers invalid";
if (!preg_match("/^\d{1,2}$/", $zone)) $errors[] = "Zone invalid";
$allowed_cities = ['Doha','Al Wakra','Al Khor','Dukhan','Al Shamal','Mesaieed','Ras Laffan'];
if (!in_array($city, $allowed_cities)) $errors[] = "City invalid";
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email invalid";
if (!preg_match("/^\d{8}$/", $phone)) $errors[] = "Phone number invalid";
if (!empty($skills) && empty($other_skills)) $errors[] = "Other skills required if checkbox selected";

// Show errors if any
if (!empty($errors)) {
    echo "<h1>Validation Error</h1><ul>";
    foreach ($errors as $err) echo "<li>$err</li>";
    echo "</ul><a href='apply.php'>Go back to form</a>";
    exit();
}

// this creating eoi table if it doesent exist
$sql_create = "
CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT AUTO_INCREMENT PRIMARY KEY,
    job_reference_number VARCHAR(20),
    first_name VARCHAR(20),
    last_name VARCHAR(20),
    dob VARCHAR(10),
    gender VARCHAR(10),
    unit_number VARCHAR(5),
    building_number VARCHAR(5),
    street_name VARCHAR(40),
    street_number VARCHAR(5),
    zone INT,
    city VARCHAR(20),
    email VARCHAR(100),
    phone VARCHAR(8),
    skill1 VARCHAR(50),
    skill2 VARCHAR(50),
    other_skills TEXT,
    status ENUM('New','Current','Final') DEFAULT 'New'
)";
mysqli_query($conn, $sql_create);


$skill1 = $skills[0] ?? null;
$skill2 = $skills[1] ?? null;
$skill3 = $skills[2] ?? null;

$sql_insert = "INSERT INTO eoi (
    job_reference_number, first_name, last_name, dob, gender,
    unit_number, building_number, street_name, street_number, zone, city,
    email, phone, skill1, skill2, other_skills
) VALUES (
    '$job_ref','$first_name','$last_name','$dob','$gender',
    '$unit_number','$building_number','$street_name','$street_number','$zone','$city',
    '$email','$phone','$skill1','$skill2','$other_skills'
)";

if (mysqli_query($conn, $sql_insert)) {
    $eoi_number = mysqli_insert_id($conn);
    echo "<h1>Application Submitted</h1>";
    echo "<p>Your EOInumber is: <strong>$eoi_number</strong></p>";
} else {
    echo "Error inserting record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
