<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Settings - READLY</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f7f4;
    }

    .container {
      display: flex;
      height: 100vh;
    }

    .sidebar {
      background-color: #0e3a5d;
      width: 250px;
      color: white;
      display: flex;
      flex-direction: column;
      transition: width 0.3s ease;
    }

    .sidebar.collapsed {
      width: 70px;
    }

    .sidebar.collapsed span {
      display: none;
    }

    .logo {
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      cursor: pointer;
      padding: 10px;
    }

    .logo img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
    }

    .nav {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      padding-top: 20px;
    }

    .nav a,
    .sign-out a {
      display: flex;
      align-items: center;
      padding: 15px 20px;
      color: white;
      text-decoration: none;
      transition: background 0.2s;
    }

    .nav a:hover,
    .sign-out a:hover {
      background-color: #12476f;
    }

    .icon {
      width: 25px;
      height: 25px;
    }

    .nav span,
    .sign-out span {
      margin-left: 10px;
      white-space: nowrap;
    }

    .sign-out {
      margin-top: auto;
    }

    .header {
      position: fixed;
      top: 0;
      left: 250px;
      width: calc(100% - 250px);
      z-index: 1000;
      padding: 12px 20px;
      background-color: #ffffff;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #e0e0e0;
      height: 60px;
      box-sizing: border-box;
      transition: left 0.3s ease, width 0.3s ease;
    }

    .header-icons .icon {
      margin-left: 10px;
      cursor: pointer;
      width: 30px;
      height: 30px;
    }

    .main-content {
      flex: 1;
      padding: 60px 20px 20px;
      background-color: #f5f5f5;
      overflow-y: auto;
      transition: padding-left 0.3s ease;
    }

    h2 {
      font-size: 24px;
      margin-bottom: 5px;
    }

    p {
      font-size: 14px;
      color: #333;
      margin-bottom: 20px;
    }

    .tabs {
      margin: 10px 0 20px;
    }

    .tabs button {
      background: #003d5c;
      color: white;
      padding: 10px 20px;
      border: none;
      margin-right: 10px;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .account-box {
      background: white;
      padding: 20px;
      border-radius: 8px;
      border: 1px solid #ddd;
      margin-top: 10px;
    }

    .account-row {
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 15px;
      font-size: 16px;
    }

    .change-link {
      color: #005b7f;
      text-decoration: none;
      font-weight: 500;
    }

    .change-link:hover {
      text-decoration: underline;
    }

    .account-box h3 {
      margin: 20px 0 10px;
      font-size: 18px;
    }

    .personal-info-grid {
      display: grid;
      grid-template-columns: repeat(5, 1fr);
      gap: 10px;
      margin-bottom: 20px;
    }

    .personal-info-grid input[type="text"],
    .personal-info-grid select,
    .personal-info-grid input[type="date"] {
      padding: 8px;
      font-size: 14px;
      border: 1px solid #aaa;
      border-radius: 4px;
      width: 100%;
    }

    .personal-info-grid .wide {
      grid-column: span 4;
    }

    .save-btn {
  display: block;
  margin-left: auto; /* pushes the button to the right */
  margin-top: 10px;  /* space from inputs above */
  background-color: #003d5c;
  color: white;
  padding: 10px 25px;
  font-size: 14px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

    .save-btn:hover {
      background-color: #005b7f;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        height: 100%;
        z-index: 1001;
        left: 0;
        top: 0;
      }

      .header {
        left: 70px;
        width: calc(100% - 70px);
      }

      .sidebar:not(.collapsed) ~ .main-content .header {
        left: 250px;
        width: calc(100% - 250px);
      }

      .main-content {
        padding-left: 70px;
      }

      .sidebar:not(.collapsed) ~ .main-content {
        padding-left: 250px;
      }

      .personal-info-grid {
        grid-template-columns: repeat(2, 1fr);
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <aside class="sidebar" id="sidebar">
      <div class="logo" onclick="toggleSidebar()">
        <img src="../Images/logo.png" alt="Readly Logo" />
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
          <img class="icon" src="../Images/notif.png" alt="Notifications">
          <img class="icon" src="../Images/profile.png" alt="Profile">
        </div>
      </header>

      <h2>Settings</h2>
      <p>Manage your personal information and account preferences</p>

      <div class="tabs">
        <button>Account</button>
        <button>Notification</button>
        <button>Content Preferences</button>
      </div>

      <div class="account-box">
        <div class="account-row">
          <label><strong>Username:</strong></label>
          <span>Gabbi Garcia</span>
          <a href="#" class="change-link">change</a>
        </div>

        <div class="account-row">
          <label><strong>Password:</strong></label>
          <a href="#" class="change-link">create password</a>
        </div>

        <div class="account-row">
          <label><strong>Email:</strong></label>
          <span>gabiii.g@gmail.com</span>
          <a href="#" class="change-link">change</a>
        </div>

        <div class="account-row birthdate-row">
          <label><strong>Birth Date:</strong></label>
          <input type="date">
        </div>

        <h3>Personal Information</h3>

        <div class="personal-info-grid">
          <input type="text" placeholder="Lastname">
          <input type="text" placeholder="Firstname">
          <input type="text" placeholder="M.I">
          <input type="text" placeholder="Age">
          <input type="text" placeholder="Contact">
          <input type="text" placeholder="Address" class="wide">
          <select>
            <option disabled selected>Gender</option>
            <option value="female">Female</option>
            <option value="male">Male</option>
            <option value="other">Other</option>
            <option value="prefer_not_say">Prefer not to say</option>
          </select>
        </div>

        <button class="save-btn">Save Changes</button>
      </div>
    </main>
  </div>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const header = document.querySelector('.header');
      sidebar.classList.toggle('collapsed');

      if (sidebar.classList.contains('collapsed')) {
        header.style.left = '70px';
        header.style.width = 'calc(100% - 70px)';
      } else {
        header.style.left = '250px';
        header.style.width = 'calc(100% - 250px)';
      }
    }

    window.addEventListener('DOMContentLoaded', () => {
      if (window.innerWidth <= 768) {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.add('collapsed');
        const header = document.querySelector('.header');
        header.style.left = '70px';
        header.style.width = 'calc(100% - 70px)';
      }
    });
  </script>
</body>
</html>

