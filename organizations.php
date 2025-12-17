<?php
// organizations.php - converted from organizations.html
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BSIT Department - Student Organizations</title>
  <link rel="stylesheet" href="index.css">
</head>
<body>
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
  <main class="container">
    <h2 class="section-title">Student Organizations</h2>

    <section class="org-cards">
      <div class="org-card">
        <h3>IT Society</h3>
        <p>A student organization that promotes IT knowledge and skill-building activities.</p>
      </div>

      <div class="org-card">
        <h3>Programmers Club</h3>
        <p>Focuses on software development, coding competitions, and workshops.</p>
      </div>

      <div class="org-card">
        <h3>Networking Guild</h3>
        <p>Encourages learning about networking, servers, and cybersecurity topics.</p>
      </div>

      <div class="org-card">
        <h3>Game Developers Group</h3>
        <p>Students collaborate to create games and learn game design principles.</p>
      </div>
    </section>
  </main>
  
  <footer>
    <p>&copy; 2025 BSIT Department — All Rights Reserved.</p>
  </footer>

  <script src="nav.js"></script>
</body>
</html>
