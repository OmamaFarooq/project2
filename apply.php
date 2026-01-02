<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>

    <link rel="stylesheet" href="styles/style.CSS">
</head>

<body class="theme-futuristic">

<!-- HEADER / NAVIGATION -->
<?php include 'header.inc'; ?>

<h1>Job Application Form</h1>

<!-- APPLICATION FORM -->
<form action="https://mercury.swin.edu.au/it000000/formtest.php" method="post">

    <!-- Job Reference -->
    <label for="JobRef">Your Job Reference Number</label>
    <select name="Job Reference Number" id="JobRef" required>
        <option value="">Please Select</option>
        <option value="IT7A3">IT7A3</option>
        <option value="PM7H5">PM7H5</option>
    </select>

    <!-- First Name -->
    <label for="FirstName">First Name</label>
    <input type="text" name="First name" id="FirstName"
           pattern="[A-Za-z]{1,20}" required
           title="First name must contain only letters (max 20).">

    <!-- Last Name -->
    <label for="LastName">Last Name</label>
    <input type="text" name="Last name" id="LastName"
           pattern="[A-Za-z]{1,20}" required
           title="Last name must contain only letters (max 20).">

    <!-- Date of Birth -->
    <label for="dob">Date of Birth</label>
    <input type="text" id="dob" name="Date of birth"
           pattern="^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[0-2])/[0-9]{4}$"
           placeholder="dd/mm/yyyy" required
           title="Date of birth must be in the format dd/mm/yyyy.">

    <!-- Gender -->
    <fieldset>
        <legend>Gender</legend>
        <label><input type="radio" name="gender" value="Male" required> Male</label>
        <label><input type="radio" name="gender" value="Female" required> Female</label>
    </fieldset>

    <!-- Address -->
    <label for="UnitNumber">Unit Number</label>
    <input type="text" id="UnitNumber" name="Unit Number"
           pattern="[0-9]{1,5}" required>

    <label for="BuildingNumber">Building Number</label>
    <input type="text" id="BuildingNumber" name="Building Number"
           pattern="[0-9]{1,5}" required>

    <label for="StreetName">Street Name</label>
    <input type="text" id="StreetName" name="Street Name"
           maxlength="40" required>

    <label for="StreetNumber">Street Number</label>
    <input type="text" id="StreetNumber" name="Street Number"
           pattern="[0-9]{1,5}" required>

    <label for="Zone">Zone</label>
    <input type="text" id="Zone" name="Zone"
           pattern="[0-9]{1,2}" required>

    <label for="City">City</label>
    <input type="text" id="City" name="City"
           maxlength="40" required>

    <!-- Contact Info -->
    <label for="Email">Email Address</label>
    <input type="email" id="Email" name="Email Address"
           required>

    <label for="Phone">Phone Number</label>
    <input type="text" id="Phone" name="Phone Number"
           pattern="^[0-9]{8,12}$" required>

    <!-- Skills -->
    <fieldset>
        <legend>Required Technical Skills</legend>
        <label><input type="checkbox" name="skills[]" value="HTML"> HTML</label><br>
        <label><input type="checkbox" name="skills[]" value="CSS"> CSS</label><br>
        <label><input type="checkbox" name="skills[]" value="JavaScript"> JavaScript</label><br>
        <label><input type="checkbox" name="skills[]" value="SQL"> SQL</label><br>
    </fieldset>

    <!-- Other Skills -->
    <label for="OtherSkills">Other Skills</label>
    <textarea id="OtherSkills" name="Other Skills" rows="4"></textarea>

    <!-- Submit -->
    <button type="submit">APPLY</button>

</form>

<!-- FOOTER -->
<?php include 'footer.inc'; ?>

</body>
</html>
