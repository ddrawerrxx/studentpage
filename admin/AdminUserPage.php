../<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Users Page</title>
  <link rel="stylesheet" href="../css/AdminUserPage.css" />
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
          <img class="icon" src="../Images/notif.png">
          <img class="icon" src="../Images/profile.png">
        </div>
      </header>

      <div class="users-content">
        <h2 class="section-title">USERS</h2>
        <div class="users-table">
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Borrowed Book</th>
                <th>Registered</th>
                <th>Role</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Daniel Padilla</td>
                <td>shesdatingthegangster@gmail.com</td>
                <td>5</td>
                <td>04/25/22</td>
                <td>User</td>
                <td>Active</td>
              </tr>
              <tr>
                <td>Kathryn Bernardo</td>
                <td>shesdatingthegangster@gmail.com</td>
                <td>10</td>
                <td>04/25/22</td>
                <td>Admin</td>
                <td>Active</td>
              </tr>
              <tr>
                <td>Jackie Serrano</td>
                <td>shesdatingthegangster@gmail.com</td>
                <td>5</td>
                <td>04/25/22</td>
                <td>User</td>
                <td>Active</td>
              </tr>
              <tr>
                <td>Mia Dela Torre</td>
                <td>shesdatingthegangster@gmail.com</td>
                <td>5</td>
                <td>04/25/22</td>
                <td>User</td>
                <td>Active</td>
              </tr>
              <tr>
                <td>Gab Dela Cuesta</td>
                <td>shesdatingthegangster@gmail.com</td>
                <td>10</td>
                <td>04/25/22</td>
                <td>User</td>
                <td>Active</td>
              </tr>
              <tr>
                <td>Primo Alvarez</td>
                <td>shesdatingthegangster@gmail.com</td>
                <td>5</td>
                <td>04/25/22</td>
                <td>User</td>
                <td>Active</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
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
