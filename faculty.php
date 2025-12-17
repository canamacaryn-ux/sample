<?php
// faculty.php - converted from faculty.html
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BSIT Department - Faculty</title>
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
        <h2 class="section-title">Faculty Members</h2>

        <section class="faculty-grid container">
          <div class="faculty-card">
            <img src="image4.jpg" alt="Mrs. Jae-an Buhia">
            <h3>Mrs. Jae-an Buhia</h3>
            <p>Instructor I</p>
            <button class="viewProfileBtn"
              data-name="Mrs. Jae-an Buhia"
              data-position="Instructor I"
              data-details="Expert in programming and IT fundamentals, teaching since 2018."
              data-image="image4.jpg">
               View Profile
          </button>

          </div>

          <div class="faculty-card">
            <img src="image3.jpg" alt="Johnrel Paglinawan">
            <h3>Mr. Johnrel Paglinawan</h3>
            <p>Instructor II</p>
            <button class="viewProfileBtn"
              data-name="Mrs. Jae-an Buhia"
              data-position="Instructor II"
              data-details="Focus on web development and application design, teaching since 2019."
              data-image="image3.jpg">View Profile</button>
          </div>

          <div class="faculty-card">
            <img src="image5.jpg" alt="Jimf Bocales">
            <h3>Mr. Jimf Bocales</h3>
            <p>Instructor III</p>
            <button class="viewProfileBtn" 
            data-name="Mr. Jimf Bocales" 
            data-position="Instructor III" 
            data-details="Experienced in software engineering and project-based learning."
            data-image="image5.jpg">View Profile</button>
          </div>

          <div class="faculty-card">
            <img src="image6.jpg" alt="Leonardo Albit jr.">
            <h3>Mr. Leonardo Albit jr.</h3>
            <p>Instructor I</p>
            <button class="viewProfileBtn" 
            data-name="Mr. Leonardo Albit jr." 
            data-position="Instructor I" 
            data-details="Specializes in database management and networking courses."
            data-image="image6.jpg">View Profile</button>
          </div>
        </section>
      </section>
    </main>

    <footer>
      <p>&copy; 2025 BSIT Department — All Rights Reserved.</p>
    </footer>
  </div>

  <div id="profileModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>

    <div class="profile-box">
      <img id="profileImage" src="" alt="Profile Picture">
      <div class="profile-info">
        <h2 id="profileName"></h2>
        <h4 id="profilePosition"></h4>
        <p id="profileDetails"></p>
      </div>
    </div>
  </div>
</div>



<script src="nav.js"></script>
<script>
  const modal = document.getElementById("profileModal");
  const closeBtn = document.querySelector(".close");

  document.querySelectorAll(".viewProfileBtn").forEach(btn => {
    btn.addEventListener("click", () => {
      document.getElementById("profileName").textContent = btn.dataset.name;
      document.getElementById("profilePosition").textContent = btn.dataset.position;
      document.getElementById("profileDetails").textContent = btn.dataset.details;
      document.getElementById("profileImage").src = btn.dataset.image;

      modal.style.display = "flex";
    });
  });

  closeBtn.onclick = () => modal.style.display = "none";
  window.addEventListener('click', e => {
    if (e.target === modal) modal.style.display = 'none';
  });
</script>

</body>
</html>
