<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>About Our Group</title>

<link rel="stylesheet" href="styles/style.CSS">
</head>

<body class="modern">

<!-- HEADER / NAVIGATION -->
<?php include 'header.inc'; ?>

<!-- ABOUT US SECTION -->
<section class="about-us">
  <h1>About Our Group</h1>

  <!-- Group Members Box -->
  <div class="group-members-box">

    <figure class="about-figure">
      <img src="images/groupphoto.jpg" alt="Group Photo">
      <figcaption>Our Project Team</figcaption>
    </figure>

    <div class="members-info">
      <h2>Group Members</h2>

      <ul>
        <li>
          <strong>Omama Mohammad Farooq</strong>
          <span class="student-id">106203928</span>
        </li>

        <li>
          <strong>Shanzay Gul</strong>
          <span class="student-id">106235235</span>
        </li>

        <li>
          <strong>Mariam Al Ali</strong>
          <span class="student-id">106194158</span>
        </li>
      </ul>

    </div>
  </div>

  <!-- Member Contributions -->
  <div class="list-box">
    <h2>Member Contributions</h2>

    <dl>
      <dt>Omama Mohammad Farooq</dt>
      <dd>
        Took a leadership role by establishing the Jira workspace and creating the GitHub organization.
        Developed jobs.html and about.html pages while ensuring consistency and quality across the project.
        In part 2 of the project, she modified the CSS for responsiveness and enhanced user experience, she 
        also modified some html scripts. she created the manage.php, login.php. manger_registration.php pages 
        and process_eoi.php; she contributed to the backend functionality using PHP. Also explained the enhancements made in part 2 in enhancements.php. 

      <dt>Shanzay Gul</dt>
      <dd>
        Completed all assigned Jira tasks and user stories, created the apply.html page, and implemented her page styling while maintaining cohesive site design.
      </dd>

      <dt>Mariam Al Ali</dt>
      <dd>
        Developed index.html and styled it through CSS, completed assigned Jira tasks, and ensured visual and technical consistency throughout the project.
        Maryam converted the HTML files to PHP files and created header.inc and footer.inc for better code reusability. She also created the settings.php page 
        and contributed to the backend functionality using PHP.
  </div>

  <!-- Members Interests Table -->
  <div class="list-box">
    <h2>Members' Interests</h2>

    <table class="about-table">
      <caption>Group Interests Overview</caption>

      <thead>
        <tr>
          <th>Name</th>
          <th colspan="2">Interests</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>Omama</td>
          <td>Cybersecurity</td>
          <td>Web Development</td>
        </tr>

        <tr>
          <td>Shanzay</td>
          <td colspan="2">Digital Art</td>
        </tr>

        <tr>
          <td>Mariam</td>
          <td>AI & Robotics</td>
          <td>Systems Analysis</td>
        </tr>
      </tbody>
    </table>
  </div>

</section>

<!-- FOOTER -->
<?php include 'footer.inc'; ?>

</body>
</html>
