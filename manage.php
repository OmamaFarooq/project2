
<?php
    require_once("settings.php");
session_start();
if (!isset($_SESSION['manager'])) {
    header("Location: login.php");
    exit();
}
?>

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) die("Database connection failed");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['delete_job_ref'])) {
        $job_ref = mysqli_real_escape_string($conn, $_POST['delete_job_ref']);
        mysqli_query($conn, "DELETE FROM eoi WHERE job_reference_number='$job_ref'");
        $message = "All EOIs for job reference $job_ref have been deleted.";
    }
    if (isset($_POST['update_status_id'], $_POST['new_status'])) {
        $id = intval($_POST['update_status_id']);
        $status = mysqli_real_escape_string($conn, $_POST['new_status']);
        mysqli_query($conn, "UPDATE eoi SET status='$status' WHERE EOInumber=$id");
        $message = "EOI #$id status updated to $status.";
    }

    if (isset($_POST['query_type'])) {
        $query_type = $_POST['query_type'];
        $where = "";
        if ($query_type == "job_ref" && !empty($_POST['job_ref_filter'])) {
            $job_ref_filter = mysqli_real_escape_string($conn, $_POST['job_ref_filter']);
            $where = "WHERE job_reference_number='$job_ref_filter'";
        } elseif ($query_type == "applicant") {
            $fname = mysqli_real_escape_string($conn, $_POST['first_name_filter'] ?? '');
            $lname = mysqli_real_escape_string($conn, $_POST['last_name_filter'] ?? '');
            $conditions = [];
            if ($fname) $conditions[] = "first_name='$fname'";
            if ($lname) $conditions[] = "last_name='$lname'";
            if ($conditions) $where = "WHERE " . implode(" AND ", $conditions);
        }
        $sql_list = "SELECT * FROM eoi $where";
        $result = mysqli_query($conn, $sql_list);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage EOIs</title>
    <link rel="stylesheet" href="styles/style.CSS">
</head>
<body class="theme-futuristic">

<h1>Manage EOIs</h1>

<?php if (!empty($message)) echo "<p>$message</p>"; ?>

<h2>List EOIs</h2>
<form method="post">
    <select name="query_type">
        <option value="all">All EOIs</option>
        <option value="job_ref">By Job Reference</option>
        <option value="applicant">By Applicant</option>
    </select><br><br>

    <label>Job Reference: <input type="text" name="job_ref_filter"></label><br>
    <label>First Name: <input type="text" name="first_name_filter"></label><br>
    <label>Last Name: <input type="text" name="last_name_filter"></label><br>
    <button type="submit">Run Query</button>
</form>

<?php
if (!empty($result)) {
    echo "<h3>Results:</h3><table border='1' cellpadding='5'>";
    echo "<tr>
        <th>EOInumber</th><th>Job Ref</th><th>Name</th><th>Email</th>
        <th>Phone</th><th>Skills</th><th>Other Skills</th><th>Status</th>
        <th>Change Status</th>
    </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $skills = trim($row['skill1'] . " " . $row['skill2']);
        echo "<tr>
            <td>{$row['EOInumber']}</td>
            <td>{$row['job_reference_number']}</td>
            <td>{$row['first_name']} {$row['last_name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['phone']}</td>
            <td>$skills</td>
            <td>{$row['other_skills']}</td>
            <td>{$row['status']}</td>
            <td>
                <form method='post'>
                    <input type='hidden' name='update_status_id' value='{$row['EOInumber']}'>
                    <select name='new_status'>
                        <option value='New'>New</option>
                        <option value='Current'>Current</option>
                        <option value='Final'>Final</option>
                    </select>
                    <button type='submit'>Update</button>
                </form>
            </td>
        </tr>";
    }
    echo "</table>";
}
?>

<h2>Delete EOIs by Job Reference</h2>
<form method="post">
    <label>Job Reference: <input type="text" name="delete_job_ref"></label>
    <button type="submit">Delete</button>
</form>

</body>
</html>

<?php mysqli_close($conn); ?>
