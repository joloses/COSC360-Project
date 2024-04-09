<?php
session_start();

$username = $_SESSION['username'];
$email = $_SESSION['email'];

?>

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

            <?php if (isset($_SESSION['email'])): ?>
                <a href="create-post.php" class="create-post-btn"><img src="images/createPost.png"></a>
                <a href="user-profile.php" class="user-profile-btn"><img src="images/profile-icon.png"></a>
                <a href="logout.php" class="logout-btn">Logout</a>
            <?php else: ?>
                <a href="login.php" class="login-register-btn">Login/Register</a>
            <?php endif; ?>

        </nav>
    </header>

    <div class="edit-container">
        <div class="profile-picture">
            <img src="placeholder.jpg">
        </div>
        <form action="#" method="post" enctype="multipart/form-data">
            <input type="file" class="input-field" name="profile_picture" accept="image/*">
            <input type="text" class="input-field" name="username" placeholder="Username" >
            <input type="email" class="input-field" name="email" placeholder="Email" >
            <textarea class="input-field" name="bio" placeholder="Tell us something about yourself..."></textarea>
            <hr>
            <input type="password" class="input-field" name="current_password" placeholder="Current Password">
            <input type="password" class="input-field" name="new_password" placeholder="New Password">
            <input type="password" class="input-field" name="confirm_password" placeholder="Confirm New Password">
            <button type="submit" class="edit-profile-btn">Save Changes</button>
        </form>
    </div>

    <script>
        function exitProfile() {
            window.location.href = "user-profile.php";
        }
    </script>
</body>

</html>