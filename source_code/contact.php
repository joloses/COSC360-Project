<!DOCTYPE html>
<html lang=en>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Profile</title>
  <link rel="stylesheet" href="css/header.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="css/info-page.css?v=<?php echo time(); ?>">
</head>

<body>
  <header>
    <nav>
      <a href="home.php" class="logo"><img src="images/logo.png"></a>
      <input type="text" class="search-bar" placeholder="Search...">

      <?php if (isset($_SESSION['email'])): ?>
        <a href="create-post.php" class="create-post-btn"><img src="images/createPost.png"></a>
        <a href="user-profile.php" class="user-profile-btn"><img src="images/profile-icon.png"></a>
        <a href="logout.php" class="logout-btn">Logout</a>
      <?php else: ?>
        <a href="login.php" class="login-register-btn">Login/Register</a>
      <?php endif; ?>

    </nav>
  </header>

  <div class="info-container">
    <h2>Contact Us!</h2>
    <form action="mailto:placeholder@example.com" method="post" enctype="text/plain">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <div class="form-group">
        <label for="message">Message:</label>
        <textarea id="message" name="message" placeholder="Enter your message" required></textarea>
      </div>
      <button type="submit" class="submit-btn">Submit</button>
    </form>
  </div>

</body>

</html>