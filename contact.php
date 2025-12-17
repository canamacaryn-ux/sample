<?php
// contact.php - converted from contact.html
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BSIT Department - Contact</title>
  <link rel="stylesheet" href="index.css">

  <!-- PROTECT PAGE IF NOT LOGGED IN -->
  <script>
    if (localStorage.getItem("isLoggedIn") !== "true") {
      window.location.href = "index.html";
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
        <h2 class="section-title">Contact Us</h2>
        <div class="card">
          <form id="contactForm">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="text" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Message" required></textarea>
            <button type="submit">Send</button>
          </form>
        </div>
      </section>

      <div id="thankYouModal" class="modal">
        <div class="modal-content">
          <span id="closeModal" class="close">&times;</span>
          <h3>Thank you!</h3>
          <p>Your message has been received.</p>
          <button id="okBtn">OK</button>
        </div>
      </div>
    </main>

    <footer>
      <p>&copy; 2025 BSIT Department — All Rights Reserved.</p>
    </footer>
  </div>

  <script src="nav.js"></script>
  <script>
    const form = document.getElementById('contactForm');
    const modal = document.getElementById('thankYouModal');
    const closeBtn = document.getElementById('closeModal');

    form.addEventListener('submit', function(e) {
      e.preventDefault(); // prevent actual form submission
      modal.style.display = 'flex'; // show modal
      form.reset(); // clear form inputs
    });

    closeBtn.addEventListener('click', function() {
      modal.style.display = 'none';
    });

    // optional: click outside modal to close
    window.addEventListener('click', function(e) {
      if(e.target === modal) {
        modal.style.display = 'none';
      }
    });
  </script>
</body>
</html>
