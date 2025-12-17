<?php
session_start();
// -------------------- DATABASE CONNECTION --------------------
$servername = "localhost";
$username = "root"; // your DB username
$password = "";     // your DB password 
$dbname = "sample";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// -------------------- HANDLE FORM SUBMISSION (Post/Redirect/Get) --------------------
$message = "";

// -------------------- HANDLE EDIT MODE (load existing record for editing) --------------------
$editing = false;
$edit_id = 0;
$edit_title = '';
$edit_description = '';
$edit_event_date = '';
$edit_image = '';
if(isset($_GET['edit'])){
    $edit_id = intval($_GET['edit']);
    if($stmt = $conn->prepare("SELECT id, title, description, image, event_date FROM events WHERE id = ?")){
        $stmt->bind_param("i", $edit_id);
        $stmt->execute();
        $res = $stmt->get_result();
        if($row = $res->fetch_assoc()){
            $editing = true;
            $edit_title = $row['title'];
            $edit_description = $row['description'];
            $edit_event_date = $row['event_date'];
            $edit_image = $row['image'];
        }
        $stmt->close();
    }
}

// -------------------- HANDLE UPDATE SUBMISSION --------------------
if(isset($_POST['update']) && isset($_POST['edit_id'])){
    $id = intval($_POST['edit_id']);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];

    // handle image: if new uploaded, move it; otherwise keep existing
    $image = isset($_POST['existing_image']) ? $_POST['existing_image'] : '';
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $unique = time() . '_' . uniqid() . '.' . $ext;
        $uploadDir = __DIR__ . '/uploads';
        if(!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $target = $uploadDir . '/' . $unique;
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            // delete old file if exists
            if(!empty($image) && file_exists($uploadDir . '/' . $image)) @unlink($uploadDir . '/' . $image);
            $image = $unique;
        }
    }

    if($stmt = $conn->prepare("UPDATE events SET title = ?, description = ?, image = ?, event_date = ? WHERE id = ?")){
        $stmt->bind_param("ssssi", $title, $description, $image, $event_date, $id);
        if($stmt->execute()){
            $_SESSION['message'] = "Announcement updated successfully.";
        } else {
            $_SESSION['message'] = "Error updating announcement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Error preparing update statement: " . $conn->error;
    }

    header('Location: announcements.php');
    exit;
}

// Handle delete requests (safe POST + PRG)
if(isset($_POST['delete']) && isset($_POST['id'])){
    $id = intval($_POST['id']);

    // attempt to fetch image filename to remove file
    if($stmt = $conn->prepare("SELECT image FROM events WHERE id = ?")){
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        if($row = $res->fetch_assoc()){
            if(!empty($row['image'])){
                $file = __DIR__ . '/uploads/' . $row['image'];
                if(file_exists($file)) @unlink($file);
            }
        }
        $stmt->close();
    }

    if($stmt = $conn->prepare("DELETE FROM events WHERE id = ?")){
        $stmt->bind_param("i", $id);
        if($stmt->execute()){
            $_SESSION['message'] = "Announcement deleted successfully.";
        } else {
            $_SESSION['message'] = "Error deleting announcement: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Error preparing delete statement: " . $conn->error;
    }

    header('Location: announcements.php');
    exit;
}
if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];

    // Handle image upload
    $image = "";
    if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
        $image = $_FILES['image']['name'];
        $target = "uploads/".basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }

    $sql = "INSERT INTO events (title, description, image, event_date) 
            VALUES ('$title', '$description', '$image', '$event_date')";
    
    if($conn->query($sql) === TRUE){
        $_SESSION['message'] = "Announcement added successfully!";
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
    }

    // Redirect to avoid duplicate insert on refresh (PRG pattern)
    header('Location: announcements.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BSIT Department - Announcements</title>
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
        <h2 class="section-title">Add New Announcement</h2>
        <?php
        if(isset($_SESSION['message'])){
            echo "<p class='message'>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($edit_image); ?>">
            <?php if($editing){ ?>
                <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
            <?php } ?>

            <input type="text" name="title" placeholder="Title" required value="<?php echo htmlspecialchars($edit_title); ?>">
            <textarea name="description" placeholder="Description" required><?php echo htmlspecialchars($edit_description); ?></textarea>
            <input type="date" name="event_date" required value="<?php echo htmlspecialchars($edit_event_date); ?>">
            <input type="file" name="image" accept="image/*">
            <?php if($editing){ ?>
                <button type="submit" name="update">Update Announcement</button>
                <a href="announcements.php" style="margin-left:8px;">Cancel</a>
            <?php } else { ?>
                <button type="submit" name="submit">Add Announcement</button>
            <?php } ?>
        </form>
      </section>

        <h2 class="section-title">Latest Announcements</h2>
        <div class="announcements-wrapper">
            <!-- ---- DUMMY ANNOUNCEMENTS ---- -->
                        <div class="announcement-card">
                                <img src="image7.jpg" alt="New Semester Enrollment">
                                <div class="announcement-content">
                                    <h3>New Semester Enrollment</h3>
                                    <p>Enrollment for the new semester starts on Jan 5, 2026.</p>
                                </div>
                        </div>
                        <div class="announcement-card">
                                <img src="image8.jpg" alt="Department Workshop">
                                <div class="announcement-content">
                                    <h3>Department Workshop</h3>
                                    <p>A web development workshop will be held on Dec 20, 2025.</p>
                                </div>
                        </div>
                        <div class="announcement-card">
                                <img src="image9.jpg" alt="IT Seminar">
                                <div class="announcement-content">
                                    <h3>IT Seminar</h3>
                                    <p>All students are invited to join the IT seminar on Jan 15, 2026.</p>
                                </div>
                        </div>

            <!-- ---- DYNAMIC ANNOUNCEMENTS FROM DATABASE ---- -->
            <?php
            $sql = "SELECT * FROM events ORDER BY event_date DESC";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    echo '<div class="announcement-card">';
                    if(!empty($row['image'])){
                        echo '<img src="uploads/'.$row['image'].'" alt="'.$row['title'].'">';
                    }
                    echo '<div class="announcement-content">';
                    echo '<h3>'.$row['title'].'</h3>';
                    echo '<p>'.$row['description'].'</p>';
                    echo '<p><strong>Date:</strong> '.$row['event_date'].'</p>';

                    // Edit + Delete actions
                    echo '<div class="card-actions">';
                    echo '<a href="announcements.php?edit='.$row['id'].'" style="display:inline-block; padding:8px 12px; background:#f0c36d; color:#000; border-radius:6px; text-decoration:none; margin-right:6px;">Edit</a>';
                    echo '<form method="post" style="display:inline-block;" onsubmit="return confirm(\'Delete this announcement?\');">';
                    echo '<input type="hidden" name="id" value="'.$row['id'].'">';
                    echo '<button type="submit" name="delete" class="delete-button">Delete</button>';
                    echo '</form>';
                    echo '</div>';

                    echo '</div>'; // .announcement-content
                    echo '</div>'; // .announcement-card
                }
            }
            ?>
        </div>
    </main>

        <footer>
            <div class="container">
                <p>&copy; 2025 BSIT Department — All Rights Reserved.</p>
            </div>
        </footer>
</div>
</body>
</html>
<script src="nav.js"></script>
<script>
// Toggle Hamburger Menu
function toggleMenu() {
    const menu = document.getElementById("hamburgerMenu");
    if(!menu) return;
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

// Logout
function logout() {
    localStorage.removeItem("isLoggedIn");
    window.location.href = "index.html";
}

// Close menu when clicking outside
window.addEventListener("click", function(e) {
    const menu = document.getElementById("hamburgerMenu");
    const burger = document.querySelector(".hamburger");
    if (menu && burger && !menu.contains(e.target) && !burger.contains(e.target)) {
        menu.style.display = "none";
    }
});
</script>
