<?php
session_start();
include('../dbcon.php');

// Add Book functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_book'])) {
  $title = $_POST['title'];
  $author = $_POST['author'];
  $category = $_POST['category'];
  $description = $_POST['description'];
  $cover_image = $_FILES['cover_image']['name'];
  $image_temp = $_FILES['cover_image']['tmp_name'];

  $upload_dir = "./Images/";
  move_uploaded_file($image_temp, $upload_dir . $cover_image);

  // Make sure your table is named `books` not `book`
  $stmt = $conn->prepare("INSERT INTO books (title, author, category, cover_image, views, description, created_at) VALUES (?, ?, ?, ?, 0, ?, NOW())");
  
  if (!$stmt) {
    die("Prepare failed: " . $conn->error);
  }

  $stmt->bind_param("sssss", $title, $author, $category, $cover_image, $description);
  $stmt->execute();
  $stmt->close();
}


// Fetch all unique categories
$category_query = "SELECT DISTINCT category FROM books";
$category_result = mysqli_query($conn, $category_query);
if (!$category_result) {
  die("Error fetching categories: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Book Edit</title>
  <link rel="stylesheet" href="../css/AdminBookEdit.css" />
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="logo" onclick="toggleSidebar()">
        <img src="../Images/logo.png" alt="Readly Logo" />
      </div>
      <nav class="nav">
        <a href="admindashboard.php"><img class="icon" src="../Images/dashboard.png" alt="Dashboard Icon" /><span>Dashboard</span></a>
        <a href="AdminBookEdit.php"><img class="icon" src="../Images/BookDetails.png" alt="Book Edit Icon" /><span>Book Edit</span></a>
        <a href="AdminUserPage.php"><img class="icon" src="../Images/userpage.png" alt="User Page Icon" /><span>User Page</span></a>
        <a href="SettingAdmin.php"><img class="icon" src="../Images/settings.png" alt="Settings Icon" /><span>Settings</span></a>      
      </nav>
      <div class="sign-out">
        <a href="logout.php"><img class="icon" src="../Images/signout.png" alt="Signout Icon" /><span>Sign Out</span></a>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Header with Icons -->
      <header class="header">
        <div class="header-icons">
          <img class="icon" src="../Images/notif.png" alt="Notification Icon">
          <img class="icon" src="../Images/profile.png" alt="Profile Icon">
        </div>
      </header>

      <!-- Title & Search Bar Section -->
      <section class="book-controls">
        <h2 class="book-title">Available Books</h2>
        <div class="search-bar">
          <input type="text" placeholder="Search" />
          <button><img src="../Images/search-icon.png" alt="Search Icon"></button>
        </div>
      </section>

            <!-- Add Book Form -->
      <section style="padding: 20px;">
        <form action="" method="POST" enctype="multipart/form-data">
          <h3>Add New Book</h3>
          <input type="text" name="title" placeholder="Title" required><br><br>
          <input type="text" name="author" placeholder="Author" required><br><br>
          <input type="text" name="category" placeholder="Category" required><br><br>
          <textarea name="description" placeholder="Description" required></textarea><br><br>
          <input type="file" name="cover_image" accept="image/*" required><br><br>
          <button type="submit" name="add_book">Add Book</button>
        </form>
      </section>


      <!-- Book Display Section -->
      <div class="book-section">
        <?php while ($cat = mysqli_fetch_assoc($category_result)):
          $category = $cat['category'];
          $stmt = $conn->prepare("SELECT * FROM books WHERE category = ?");
          if (!$stmt) {
            echo "<p>Error preparing query: " . $conn->error . "</p>";
            continue;
          }
          $stmt->bind_param("s", $category);
          $stmt->execute();
          $books_result = $stmt->get_result();
          ?>

          <h3><?php echo htmlspecialchars($category); ?></h3>
          <div class="book-row">
            <?php while ($book = mysqli_fetch_assoc($books_result)): ?>
              <img src="./Images/<?php echo htmlspecialchars($book['cover_image']); ?>" 
                   alt="<?php echo htmlspecialchars($book['title']); ?>" 
                   class="book-cover"
                    onclick="openEditModal(<?php echo $book['id']; ?>)" />
            <?php endwhile; ?>
          </div>

        <?php endwhile; ?>
      </div>
    </main>
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      sidebar.classList.toggle("collapsed");
    }
    function openEditModal(bookId) {
      // Open modal in a new window/tab, or you can load via AJAX into a modal container
      window.location.href = "Edit-Book-Modal.php?id=" + bookId;
    }
  </script>
</body>
</html>
