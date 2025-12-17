<?php
// events.php - converted from events.html
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BSIT Department - Events</title>
  <link rel="stylesheet" href="index.css">
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
        <h2 class="section-title">Upcoming Events</h2>

        <div class="grid">
          <div class="event-card">
            <img src="image2.jpg" alt="IT Seminar">
            <h3>IT Seminar2025</h3>
            <p class="short-desc">
              <button class="detailsBtn" 
              data-title="IT Seminar2025" 
              data-details="Join our IT Seminar 2025 to learn the latest trends in technology, networking, and innovation. Don't miss this opportunity!"
              data-image="image5.jpg">Click to view details</button>
            </p>
          </div>

          <div class="event-card">
            <img src="image1.jpg" alt="Hackathon">
            <h3>Hackathon</h3>
            <p class="short-desc">
              <button class="detailsBtn" 
              data-title="Hackathon" 
              data-details="Join our 2025 Hackathon to showcase your skills in coding, problem-solving, and innovation. Prizes await top teams!"
              data-image="image5.jpg">Click to view details</button>
            </p>
          </div>

          <div class="event-card">
            <img src="image.jpg" alt="Alumni Event">
            <h3>Alumni Event</h3>
            <p class="short-desc">
              <button class="detailsBtn" 
              data-title="Alumni Event" 
              data-details="Reconnect with former students at our Alumni Event. Network, share experiences, and celebrate achievements with your batchmates!"
              data-image="image5.jpg">Click to view details</button>
            </p>
          </div>
        </div>
      </section>
    </main>

    <footer>
      <p>&copy; 2025 BSIT Department — All Rights Reserved.</p>
    </footer>
  </div>

  <!-- Event Details Modal -->
  <div id="eventModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <h2 id="modalTitle"></h2>
      <p id="modalDetails"></p>
      <button id="okBtn">OK</button>
    </div>
  </div>

  <script src="nav.js"></script>
  <script>
    const detailsBtns = document.querySelectorAll('.detailsBtn');
    const eventModal = document.getElementById('eventModal');
    const closeEvent = eventModal.querySelector('.close');
    const okBtnEvent = document.getElementById('okBtn');
    const modalTitle = document.getElementById('modalTitle');
    const modalDetails = document.getElementById('modalDetails');

    // Show modal on button click
    detailsBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        modalTitle.textContent = btn.dataset.title;
        modalDetails.textContent = btn.dataset.details;
        eventModal.style.display = 'block';
      });
    });

    // Close modal
    closeEvent.onclick = function() {
      eventModal.style.display = 'none';
    };
    okBtnEvent.onclick = function() {
      eventModal.style.display = 'none';
    };

    // Close when clicking outside modal content
    window.addEventListener('click', function(event) {
      if (event.target == eventModal) {
        eventModal.style.display = 'none';
      }
    });
  </script>
</body>
</html>
