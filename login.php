<?php
session_start();
require_once("settings.php");
$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) die("Database connection failed");

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $username_esc = mysqli_real_escape_string($conn, $username);
    $res = mysqli_query($conn, "SELECT * FROM managers WHERE username='$username_esc'");
    
    if ($row = mysqli_fetch_assoc($res)) {
        if ($row['lockout_time'] && strtotime($row['lockout_time']) > time()) {
            $message = "Account locked. Try again later.";
        } elseif (password_verify($password, $row['password_hash'])) {
            $_SESSION['manager'] = $row['username'];
            mysqli_query($conn, "UPDATE managers SET failed_attempts=0, lockout_time=NULL WHERE manager_id={$row['manager_id']}");
            header("Location: manage.php");
            exit();
        } else {
            // stops after 3 attempts
            $failed = $row['failed_attempts'] + 1;
            $lockout = null;
            if ($failed >= 3) {
                $lockout = date("Y-m-d H:i:s", strtotime("+5 minutes")); // lock 5 min
                $failed = 0;
            }
            mysqli_query($conn, "UPDATE managers SET failed_attempts=$failed, lockout_time=" . ($lockout ? "'$lockout'" : "NULL") . " WHERE manager_id={$row['manager_id']}");
            $message = "Invalid credentials.";
        }
    } else {
        $message = "Account locked, Try again in 5 minutes.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manager Login</title>
<link rel="stylesheet" href="styles/style.CSS">
</head>
<body class="theme-futuristic">
<?php include 'header.inc'; ?>
<h1>Manager Login</h1>
<form method="post">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Login</button>
</form>
<?php if ($message) echo "<p>$message</p>"; ?>
<?php include 'footer.inc'; ?>
</body>
</html>
