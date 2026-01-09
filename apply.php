<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>
    <link rel="stylesheet" href="styles/style.CSS">
</head>

<body class="theme-futuristic">

<?php include 'header.inc'; ?>

<h1>Job Application Form</h1>

<form action="process_eoi.php" method="post" novalidate="novalidate">

    <label for="JobRef">Your Job Reference Number</label>
    <select name="job_ref" id="JobRef" required>
        <option value="">Please Select</option>
        <option value="IT7A3">IT7A3</option>
        <option value="PM7H5">PM7H5</option>
    </select>

    <label for="FirstName">First Name</label>
    <input type="text" name="first_name" id="FirstName" maxlength="20">

    <label for="LastName">Last Name</label>
    <input type="text" name="last_name" id="LastName" maxlength="20">

    <label for="dob">Date of Birth</label>
    <input type="text" id="dob" name="dob" placeholder="dd/mm/yyyy">

    <fieldset>
        <legend>Gender</legend>
        <label><input type="radio" name="gender" value="Male"> Male</label>
        <label><input type="radio" name="gender" value="Female"> Female</label>
    </fieldset>

    <label for="UnitNumber">Unit Number</label>
    <input type="text" id="UnitNumber" name="unit_number">

    <label for="BuildingNumber">Building Number</label>
    <input type="text" id="BuildingNumber" name="building_number">

    <label for="StreetName">Street Name</label>
    <input type="text" id="StreetName" name="street_name" maxlength="40">

    <label for="StreetNumber">Street Number</label>
    <input type="text" id="StreetNumber" name="street_number">

    <label for="Zone">Zone</label>
    <input type="text" id="Zone" name="zone" maxlength="2">

    <label for="City">City</label>
    <select name="city" id="City">
        <option value="">Select City</option>
        <option value="Doha">Doha</option>
        <option value="Al Wakra">Al Wakra</option>
        <option value="Al Khor">Al Khor</option>
        <option value="Dukhan">Dukhan</option>
        <option value="Al Shamal">Al Shamal</option>
        <option value="Mesaieed">Mesaieed</option>
        <option value="Ras Laffan">Ras Laffan</option>
    </select>

    <label for="Email">Email Address</label>
    <input type="text" id="Email" name="email">

    <label for="Phone">Phone Number</label>
    <input type="text" id="Phone" name="phone" maxlength="8">

    <fieldset>
        <legend>Required Technical Skills</legend>
        <label><input type="checkbox" name="skills[]" value="HTML"> HTML</label><br>
        <label><input type="checkbox" name="skills[]" value="CSS"> CSS</label><br>
        <label><input type="checkbox" name="skills[]" value="JavaScript"> JavaScript</label><br>
        <label><input type="checkbox" name="skills[]" value="SQL"> SQL</label><br>
    </fieldset>

    <label for="OtherSkills">Other Skills</label>
    <textarea id="OtherSkills" name="other_skills" rows="4"></textarea>

    <button type="submit">APPLY</button>

</form>

<?php include 'footer.inc'; ?>

</body>
</html>
