<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Enhancements</title>
    <link rel="stylesheet" href="styles/style.CSS">
</head>

<body class="enhance">

<?php include 'header.inc'; ?>

<h1>Enhancements</h1>

<p>
This page documents the enhancements implemented beyond the basic specified requirements.
Each enhancement is described below with an explanation of how it was implemented.
</p>

<hr>

<h2>1. Sorting EOI Records by Selected Field</h2>
<p>
Managers are able to select the field used to sort EOI records when viewing applications.
A dropdown menu allows sorting by EOInumber, first name, last name, job reference number, or status.
</p>

<p>
The selected field is passed through a POST request and used in the SQL <code>ORDER BY</code> clause.
</p>

<pre>
$sort_field = mysqli_real_escape_string($conn, $_POST['sort_field']);
$sql = "SELECT * FROM eoi ORDER BY $sort_field";
</pre>

<p>
This enhancement improves usability by allowing managers to easily organize and review applications.
</p>

<hr>

<h2>2. Manager Registration with Server-Side Validation</h2>
<p>
A manager registration page was created to allow new managers to register securely.
Server-side validation ensures:
</p>
<ul>
    <li>Usernames are unique</li>
    <li>Passwords meet complexity rules</li>
</ul>

<p>
Passwords must be at least 8 characters long and include an uppercase letter, a number,
and a special character.
Passwords are securely stored using hashing.
</p>

<pre>
$hash = password_hash($password, PASSWORD_DEFAULT);
INSERT INTO managers (username, password_hash)
</pre>

<p>
This enhancement improves security and allows controlled manager access to the system.
</p>

<hr>

<h2>3. Controlled Access to manage.php</h2>
<p>
Access to the manager dashboard (<code>manage.php</code>) is restricted.
Only authenticated managers with a valid session can access this page.
</p>

<p>
If a user attempts to access the page without being logged in, they are redirected to the login page.
</p>

<pre>
session_start();
if (!isset($_SESSION['manager'])) {
    header("Location: login.php");
    exit();
}
</pre>

<p>
This enhancement prevents unauthorized access to sensitive application data.
</p>

<hr>

<h2>4. Account Lockout After Multiple Failed Login Attempts</h2>
<p>
To improve security, manager accounts are temporarily locked after three failed login attempts.
</p>

<p>
When the limit is reached, the account is locked for five minutes.
The lockout time is stored in the database and checked during login.
</p>

<pre>
if ($failed >= 3) {
    $lockout = date("Y-m-d H:i:s", strtotime("+5 minutes"));
}
</pre>

<p>
This enhancement protects the system against brute-force login attempts.
</p>

<hr>

<h2>Summary</h2>
<p>
These enhancements improve the system’s security, usability, and robustness.
They ensure safe manager authentication, controlled access, and flexible data management.
</p>

<?php include 'footer.inc'; ?>

</body>
</html>
