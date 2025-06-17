<?php
session_start();
include('../dbcon.php');

if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit();
}

$user_id = $_SESSION['user_id'];

// Fetch total borrowed books
$borrowedQuery = $conn->prepare("SELECT COUNT(*) FROM borrowed_books WHERE user_id = ?");
$borrowedQuery->bind_param("i", $user_id);
$borrowedQuery->execute();
$borrowedQuery->bind_result($borrowedCount);
$borrowedQuery->fetch();
$borrowedQuery->close();

// Fetch read books (assuming return_date is not NULL = read)
$readQuery = $conn->prepare("SELECT COUNT(*) FROM borrowed_books WHERE user_id = ? AND return_date IS NOT NULL");
$readQuery->bind_param("i", $user_id);
$readQuery->execute();
$readQuery->bind_result($readCount);
$readQuery->fetch();
$readQuery->close();

// Fetch currently reading (borrowed but not returned)
$currentQuery = $conn->prepare("SELECT COUNT(*) FROM borrowed_books WHERE user_id = ? AND return_date IS NULL");
$currentQuery->bind_param("i", $user_id);
$currentQuery->execute();
$currentQuery->bind_result($currentCount);
$currentQuery->fetch();
$currentQuery->close();

// Fetch reading progress (get latest month progress)
$month = date('m-Y');
$progressQuery = $conn->prepare("SELECT books_read, total_books_goal FROM reading_progress WHERE user_id = ? AND month_year = ?");
$progressQuery->bind_param("is", $user_id, $month);
$progressQuery->execute();
$progressResult = $progressQuery->get_result();
if ($progressResult->num_rows > 0) {
  $progress = $progressResult->fetch_assoc();
  $booksRead = $progress['books_read'];
  $totalGoal = $progress['total_books_goal'];
} else {
  $booksRead = 0;
  $totalGoal = 20;
}
$percentRead = ($totalGoal > 0) ? round(($booksRead / $totalGoal) * 100) : 0;

// Fetch borrowed book table data
$borrowedBooksQuery = $conn->prepare("
  SELECT books.title, borrowed_books.borrow_date, borrowed_books.due_date, borrowed_books.return_date 
  FROM borrowed_books 
  JOIN books ON borrowed_books.book_id = books.id 
  WHERE borrowed_books.user_id = ?
  ORDER BY borrowed_books.borrow_date DESC
");
$borrowedBooksQuery->bind_param("i", $user_id);
$borrowedBooksQuery->execute();
$borrowedBooksResult = $borrowedBooksQuery->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Track and Record</title>
  <link rel="stylesheet" href="../css/track&record.css" />
</head>
<body>
  <div class="container">
    <aside class="sidebar" id="sidebar">
      <div class="logo" onclick="toggleSidebar()">
        <img src="../Images\logo.png" alt="Readly Logo" />
      </div>
      <nav class="nav">
     <a href="homepage.php" onclick="toggleSidebar()"><img class="icon" src="../Images\dashboard.png" alt="Dashboard Icon" /><span>Dashboard</span></a>
        <a href="librarypage.php" onclick="toggleSidebar()"><img class="icon" src="../Images\Library.png" alt="Library Icon" /><span>Library</span></a>
        <a href="Book-Details.php" onclick="toggleSidebar()"><img class="icon" src="../Images\Details.png" alt="Details Icon" /><span>Book Details</span></a>
        <a href="track&record.php" onclick="toggleSidebar()"><img class="icon" src="../Images\Track.png" alt="Track Icon" /><span>Track and Record</span></a>
        <a href="support.php" onclick="toggleSidebar()"><img class="icon" src="../Images\Support.png" alt="Support Icon" /><span>Support Page</span></a>
        <a href="setting.php" onclick="toggleSidebar()"><img class="icon" src="../Images\settings.png" alt="Settings Icon" /><span>Settings</span></a>       
      </nav>
      <div class="sign-out">
      <a href="logout.php"><img class="icon" src="../Images\signout.png" alt="Signout Icon" /><span>Sign Out</span></a>
      </div>
    </aside>


       <main class="main-content">
            <header class="header">
                <div class="spacer"></div>
                <div class="header-icons">
                <img class="icon" src="../Images\notif.png">
                <img class="icon" src="../Images\profile.png">
                </div>
            </header>

            <section class="track-record-section">
  <h2>Track & Record</h2>
  <p class="subtext">Keep track of the books you've Borrowed and Read.</p>

  <div class="stats-cards">
  <div class="stat-card">
    <img src="../Images/borrowed.png" alt="Borrowed Books" />
    <div>
      <strong>Books Borrowed</strong>
      <p><?= $borrowedCount ?> Books</p>
    </div>
  </div>
  <div class="stat-card">
    <img src="../Images/read.png" alt="Read Books" />
    <div>
      <strong>Read Books</strong>
      <p><?= $readCount ?> Books</p>
    </div>
  </div>
  <div class="stat-card">
    <img src="../Images/currently.png" alt="Currently Reading" />
    <div>
      <strong>Currently Reading</strong>
      <p><?= $currentCount ?> Books</p>
    </div>
  </div>
  <div class="reading-progress">
    <div class="circle">
      <span><?= $percentRead ?>%</span>
    </div>
    <p>You’ve read <?= $booksRead ?> out of <?= $totalGoal ?> books this month.</p>
  </div>
</div>


  <div class="tabs">
    <button class="active">Borrowed Book</button>
    <button class="active">Timeline</button>
  </div>

  <div class="content-grid">
    <table class="borrowed-table">
      <thead>
        <tr>
          <th>Book Title</th>
          <th>Borrow Date</th>
          <th>Due Date</th>
          <th>Return</th>
        </tr>
      </thead>
      <tbody>
  <?php while($row = $borrowedBooksResult->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['title']) ?></td>
      <td><?= date("F j, Y", strtotime($row['borrow_date'])) ?></td>
      <td><?= date("F j, Y", strtotime($row['due_date'])) ?></td>
      <td><?= $row['return_date'] ? date("F j, Y", strtotime($row['return_date'])) : 'Not Returned' ?></td>
    </tr>
  <?php endwhile; ?>
</tbody>

    </table>
  </div>
</section>

    </main>
  </div>
 
   <script>
    function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("collapsed");
    }
    </script>


</body>
</html>


