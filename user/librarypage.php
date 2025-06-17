<?php
session_start();
include('..\dbcon.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ..\login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch borrowed books
$borrowed_books = [];
$borrowed_result = mysqli_query($conn, "SELECT book_id FROM borrowed_books WHERE user_id = $user_id AND return_date IS NULL");
while ($row = mysqli_fetch_assoc($borrowed_result)) {
    $borrowed_books[] = $row['book_id'];
}

// Fetch books by genre
$genres = ['Science Fiction', 'Thriller', 'Romance', 'Fantasy', 'Horror', 'History'];
$books_by_genre = [];

foreach ($genres as $genre) {
    $stmt = $conn->prepare("SELECT * FROM books WHERE category = ?");
    $stmt->bind_param("s", $genre);
    $stmt->execute();
    $result = $stmt->get_result();
    $books_by_genre[$genre] = $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Library</title>
  <link rel="stylesheet" href="../css/librarypage.css" />
  <style>
    .btn {
      padding: 10px 20px;
      font-size: 14px;
      font-weight: 600;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .borrow {
      background-color: #4CAF50; /* Green */
      color: white;
    }

    .borrow:hover {
      background-color: #45a049;
    }

    .borrowed {
      background-color: #ccc;  /* Light gray */
      color: #555;
      cursor: not-allowed;
    }

    .btn {
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }


  </style>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
      <div class="logo" onclick="toggleSidebar()">
        <img src="../Images/logo.png" alt="Readly Logo" />
      </div>
      <nav class="nav">
        <a href="homepage.php"><img class="icon" src="../Images/dashboard.png" /><span>Dashboard</span></a>
        <a href="librarypage.php"><img class="icon" src="../Images/Library.png" /><span>Library</span></a>
        <a href="Book-Details.php"><img class="icon" src="../Images/Details.png" /><span>Book Details</span></a>
        <a href="track&record.php"><img class="icon" src="../Images/Track.png" /><span>Track and Record</span></a>
        <a href="support.php"><img class="icon" src="../Images/Support.png" /><span>Support Page</span></a>
        <a href="setting.php"><img class="icon" src="../Images/settings.png" /><span>Settings</span></a>
      </nav>
      <div class="sign-out">
        <a href="../logout.php"><img class="icon" src="../Images/signout.png" /><span>Sign Out</span></a>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Header -->
      <header class="header">
        <div class="spacer"></div>
        <div class="header-icons">
          <img class="icon" src="../Images/notif.png" />
          <img class="icon" src="../Images/profile.png" />
        </div>
      </header>

      <!-- Page Content -->
      <section class="content">
        <div class="dashboard-header">
          <h2>Available Books</h2>
        </div>

        <div class="search-bar">
          <input type="text" placeholder="Search" />
          <button><img src="../Images/Search.jpg" /></button>
        </div>

        <!-- Loop through each genre -->
        <?php foreach ($books_by_genre as $genre => $book_list): ?>
          <div class="book-category">
            <h3><?php echo htmlspecialchars($genre); ?></h3>
            <div class="book-row">
              <?php while ($book = mysqli_fetch_assoc($book_list)): ?>
                <div class="book-card">
                  <img src="../Images/<?php echo htmlspecialchars($book['cover_image']); ?>" alt="Cover" style="width: 150px; height: 220px; object-fit: cover; border-radius: 8px;" />
                  <p><?php echo htmlspecialchars($book['title']); ?></p>
                  <?php if (in_array($book['id'], $borrowed_books)): ?>
                    <button class="btn borrowed" disabled>Borrowed</button>
                  <?php else: ?>
                    <a href="borrow.php?book_id=<?php echo $book['id']; ?>">
                      <button class="btn borrow">Borrow</button>
                    </a>
                  <?php endif; ?>

                </div>
              <?php endwhile; ?>
            </div>
          </div>
        <?php endforeach; ?>
      </section>
    </main>
  </div>

  <script>
    function toggleSidebar() {
      document.getElementById("sidebar").classList.toggle("collapsed");
    }
  </script>
</body>
</html>
