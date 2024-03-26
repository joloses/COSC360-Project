<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/edit-profile.css?v=<?php echo time(); ?>">

</head>
<body>
<header>
        <nav> 
            <a href="home.php" class="logo"><img src="images/logo.png"></a>
            <input type="text" class="search-bar" placeholder="Search...">
            <a href="create-post.php" class="create-post-btn"><img src="images/createPost.png"></a>
            <a href="user-profile.php" class="user-profile-btn"><img src="images/profile-icon.png"></a>
            <a href="login.php" class="login-register-btn">Login/Register</a>
        </nav>
    </header>

    <div class="container">
        <h1>User Profile</h1>
        <form action="user-profile.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" readonly value="Mr.Test">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="bio">Bio:</label>
                <textarea id="bio" name="bio" rows="4" cols="50" placeholder="Tell us about yourself..."></textarea>
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>

    <script>
        function exitProfile() {
            window.location.href = "home.php";
        }
    </script>
</body>
</html>
