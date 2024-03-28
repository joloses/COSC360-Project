<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['email'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}


$username = $_SESSION['username']; 
$email = $_SESSION['email']; 
$bio = $_SESSION['bio']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/user-profile.css?v=<?php echo time(); ?>">
</head>
<body>
<header>
    <nav> 
        <a href="home.php" class="logo"><img src="images/logo.png"></a>
        <input type="text" class="search-bar" placeholder="Search...">
        <a href="create-post.php" class="create-post-btn"><img src="images/createPost.png"></a>
        <a href="user-profile.php" class="user-profile-btn"><img src="images/profile-icon.png"></a>
        
        <?php if(isset($_SESSION['email'])): ?>
            <a href="logout.php" class="logout-btn">Logout</a>
        <?php else: ?>
            <a href="login.php" class="login-register-btn">Login/Register</a>
        <?php endif; ?>
        
    </nav>
</header>

<div class="profile-container">
    <div class="profile-picture"> </div>
    <div class="profile-username"> Username: <?php echo $username; ?></div>
    <div class="profile-email"> Email: <?php echo $email; ?></div>
    <div class="profile-bio"> Bio: <?php echo $bio; ?></div>
    <a href="edit-profile.php" class="edit-profile-btn">Edit Profile</a>
</div>
</body>
</html>
