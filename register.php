<?php
// register.php - voter registration prototype
// Later: POST to voter/voter_register.php or similar
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Register - Online Voting</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <div class="card form">
      <div class="header">
        <div class="brand">Register</div>
        <div class="top-links"><a href="index.php">Login</a></div>
      </div>

      <h2>Create voter account</h2>
      <div id="formMessages"></div>

      <form id="registerForm" method="post" action="voter/voter_register.php" novalidate>
        <div class="input">
          <label for="full_name">Full name</label>
          <input id="full_name" name="full_name" placeholder="Full name" required>
        </div>
        <div class="input">
          <label for="username">Username</label>
          <input id="username" name="username" placeholder="Choose a username" required>
        </div>
        <div class="input">
          <label for="password">Password</label>
          <input id="password" type="password" name="password" placeholder="Password" required>
        </div>
        <button class="btn" type="submit">Register</button>
      </form>
    </div>
  </div>
  <script src="assets/js/validation.js"></script>
  <script>attachRegisterHandler();</script>
</body>
</html>
