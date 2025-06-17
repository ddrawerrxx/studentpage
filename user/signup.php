<?php
session_start();
include "../dbcon.php";

$signup_error = "";
$signup_success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fullname = trim($_POST['fullname']);
  $email = trim($_POST['email']);
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  

  if ($password !== $confirm_password) {
    $signup_error = "Passwords do not match.";
  }     if (empty($email) || empty($fullname) || empty($password) || empty($confirmPassword)) {
        echo "All fields are required.";
    }

    if (strlen($password) < 8){
      echo "Mali pass baks hindi eight.";
    } else {
      echo "valid ka baks, nice!";
    }
    if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', subject: $password)) {
        echo "Password must be at least 8 characters long and include at least one uppercase letter, a lowercase letter, a number, and a special character.";
    }
else {
    // Check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $signup_error = "Email already registered.";
    } else {
      // Insert user with default role: 'student'
      $stmt = $conn->prepare("INSERT INTO users (fullname, email, password, role) VALUES (?, ?, ?, 'student')");
      $stmt->bind_param("sss", $fullname, $email, $password);

      if ($stmt->execute()) {
        header("Location: ../login.php");
        exit();
      } else {
        $signup_error = "Something went wrong. Please try again.";
      }
    }

    $stmt->close();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up Digital Library</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Libre Baskerville', sans-serif;
      background-color: #f8f4f0;
      display: flex;
      height: 100vh;
    }

    .signup-container {
      display: flex;
      width: 100%;
    }

    .signup-form {
      flex: 1;
      background-color: #f8f4f0;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 0 80px;
      text-align: center;
      height: 100vh;
    }

    .form-wrapper {
      width: 100%;
      max-width: 400px;
    }

    .form-wrapper h1 {
      font-family: 'Libre Baskerville', serif;
      font-size: 2rem;
      margin-bottom: 10px;
    }

    .form-wrapper p {
      margin-bottom: 30px;
      color: #666;
    }

    .form-wrapper input {
      width: 100%;
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid #1a1919;
      border-radius: 8px;
      font-size: 1rem;
    }

    .form-wrapper a {
      text-decoration: none;
      font-size: 0.9rem;
      color: #0077cc;
    }

    .form-wrapper button {
      background-color: #1f3556;
      color: white;
      border: 1px solid #1a1919;
      padding: 15px;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      margin-top: 10px;
    }

    .google-login {
      text-align: center;
      margin-top: 20px;
    }

    .google-login img {
      width: 30px;
      cursor: pointer;
    }

    .signup-image {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f8f4f0;
      padding: 40px;
    }

    .signup-image img {
      max-width: 110%;
      height: auto;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .divider {
      text-align: center;
      margin: 30px 0 20px;
      position: relative;
    }

    .divider::before, .divider::after {
      content: '';
      position: absolute;
      top: 50%;
      width: 45%;
      height: 1px;
      background-color: #ccc;
    }

    .divider::before { left: 0; }
    .divider::after { right: 0; }

    .divider span {
      padding: 0 10px;
      background-color: #fff;
      color: #888;
    }

    .message.error {
      color: red;
      margin-bottom: 15px;
    }

    .message.success {
      color: green;
      margin-bottom: 15px;
    }
  </style>
</head>
<body>
  <div class="signup-container">
    <div class="signup-form">
      <div class="form-wrapper">
        <h1>Hello!</h1>
        <p>Fill in all informations.</p>

        <?php if ($signup_error): ?>
          <div class="message error"><?= htmlspecialchars($signup_error) ?></div>
        <?php elseif ($signup_success): ?>
          <div class="message success"><?= htmlspecialchars($signup_success) ?></div>
        <?php endif; ?>

        <form action="signup.php" method="POST">
          <input type="text" name="fullname" placeholder="Full Name" required />
          <input type="email" name="email" placeholder="Email Address" required />
          <input type="password" name="password" placeholder="Password" required />
          <input type="password" name="confirm_password" placeholder="Confirm Password" required />
          <p>Already have an account? <a href="../login.php">Sign In</a></p>
          <button type="submit">Sign Up</button>
        </form>

        <div class="divider"><span>or sign-up with</span></div>

        <div class="google-login">
          <img src="../Images/google.png" alt="Google Sign Up" />
        </div>
      </div>
    </div>

    <div class="signup-image">
      <img src="../Images/library-signup.png" alt="Library Sign Up" />
    </div>
  </div>
</body>
</html>
