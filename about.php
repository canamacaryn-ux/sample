<?php
// about.php - converted from about.html
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BSIT Department - Program Profile</title>
  <link rel="stylesheet" href="index.css">

  <!-- PROTECT PAGE IF NOT LOGED IN -->
  <script>
    if (localStorage.getItem("isLoggedIn") !== "true") {
      window.location.href = "index.php";
    }
  </script>

</head>

<body>
  <div class="wrapper">
    <header>
      <div class="container nav">
        <h2 class="logo">BSIT Department</h2>

        <nav>
          <a href="about.php">About</a>
          <a href="faculty.php">Faculty</a>
          <a href="organizations.php">Student Organizations</a>
          <a href="announcements.php">Announcements</a>
          <a href="events.php">Events</a>
          <a href="contact.php">Contact</a>
        </nav>

        <!-- Hamburger Icon -->
        <div class="hamburger" onclick="toggleMenu()">☰</div>
      </div>
    </header>

    <!-- Hamburger Dropdown -->
    <div id="hamburgerMenu" class="hamburger-menu">
      <button onclick="logout()">Logout</button>
    </div>

    <main>
      <section class="container">
        <h2 class="section-title">About the BSIT Program</h2>
          <div class="card">
            <p>
              The Bachelor of Science in Information Technology (BSIT) program develops students' skills in software development, networking, database management, and web technologies. Graduates are prepared for IT-related careers in various industries including software development, system administration, and IT support.
            </p>
            <p>
              The program emphasizes practical experience, problem-solving, and innovation. Students gain knowledge in web and mobile development, cloud computing, and emerging technologies to meet the demands of the modern IT industry.
            </p>
          </div>
        </section>
      </section>
    </main>

    <footer>
      <p>&copy; 2025 BSIT Department — All Rights Reserved.</p>
    </footer>
  </div>

  <script src="nav.js"></script>
</body>
</html>
