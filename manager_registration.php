<?php
require_once("settings.php");
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) die("Database connection failed");

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    if (!preg_match("/^[A-Za-z0-9_]{3,20}$/", $username)) {
        $message = "Username must be 3-20 letters, numbers, or underscores.";
    } elseif (!preg_match("/^(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*]).{8,}$/", $password)) {
        $message = "Password must be 8+ chars, include uppercase, number, and special char.";
    } else {
        $username = mysqli_real_escape_string($conn, $username);

        $check = mysqli_query($conn, "SELECT * FROM managers WHERE username='$username'");
        if (mysqli_num_rows($check) > 0) {
            $message = "Username already exists.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            mysqli_query($conn, "INSERT INTO managers (username, password_hash) VALUES ('$username','$hash')");
            $message = "Manager registered successfully.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manager Registration</title>
<link rel="stylesheet" href="styles/style.CSS">
</head>
<body class="theme-futuristic">
<?php include 'header.inc'; ?>
<h1>Manager Registration</h1>
<form method="post">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Register</button>
</form>
<?php if ($message) echo "<p>$message</p>"; ?>
<?php include 'footer.inc'; ?>
</body>
</html>
