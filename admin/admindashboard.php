
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../css/admindashboard.css" />
</head>
<body>
  <div class="container">
    <aside class="sidebar" id="sidebar">
      <div class="logo" onclick="toggleSidebar()">
        <img src="../Images/logo.png" alt="Readly Logo" />
      </div>
      <nav class="nav">
        <a href="admindashboard.php" onclick="toggleSidebar()"><img class="icon" src="../Images/dashboard.png" alt="Dashboard Icon" /><span>Dashboard</span></a>
        <a href="AdminBookEdit.php" onclick="toggleSidebar()"><img class="icon" src="../Images/BookDetails.png" alt="Book Edit Icon" /><span>Book Edit</span></a>
        <a href="AdminUserPage.php" onclick="toggleSidebar()"><img class="icon" src="../Images/userpage.png" alt="User Page Icon" /><span>User Page</span></a>
        <a href="SettingAdmin.php" onclick="toggleSidebar()"><img class="icon" src="../Images/settings.png" alt="Settings Icon" /><span>Settings</span></a>      
      </nav>
      <div class="sign-out">
        <a href="#" onclick="toggleSidebar()"><img class="icon" src="../Images/signout.png" alt="Signout Icon" /><span>Sign Out</span></a>
      </div>
    </aside>

    <main class="main-content">
      <header class="header">
        <div class="spacer"></div>
        <div class="header-icons">
          <img class="icon" src="../Images/notif.png" alt="Notification Icon">
          <img class="icon" src="../Images/profile.png" alt="Profile Icon">
        </div>
      </header>

      <section class="dashboard">
        <h2 class="dashboard-title">Hello, Admin! <span class="date-time">April 5, 2025 | Saturday, 10:00 AM</span></h2>

        <div class="dashboard-cards">
          <div class="card">
            <h3>Books Borrowed</h3>
            <img src="../Images/borrowed-chart.png" alt="Books Borrowed Chart" class="chart-img" />
            <p class="card-footer">previous books used: 150 &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; books metrics</p>
          </div>

          <div class="card">
            <h3>Pending Overdue</h3>
            <img src="../Images/overdue.png" alt="Pending Overdue Chart" class="chart-img" />
            <p><strong>65</strong> Pending Borrow Request</p>
            <p><strong class="overdue">28</strong> Overdue Returns</p>
          </div>

          <div class="card wide">
         <h3>User Activity</h3>
        <img src="../Images/user-activity.png" alt="User Activity Chart" class="chart-img user-chart" />
        </div>

        <div class="card users">
            <h3>Top Users</h3>
            <ul>
              <li><img src="../Images/user-profile.png" alt="Daniel"> Daniel</li>
              <li><img src="../Images/user-profile.png" alt="Primo"> Primo</li>
              <li><img src="../Images/user-profile.png" alt="Georgina"> Georgina</li>
              <li><img src="../Images/user-profile.png" alt="Mia"> Mia</li>
              <li><img src="../Images/user-profile.png" alt="Ely"> Ely</li>
              <li><img src="../Images/user-profile.png" alt="Jackie"> Jackie</li>
            </ul>
          </div>
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
