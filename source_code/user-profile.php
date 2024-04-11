<?php
session_start();
require_once 'connectDB.php';

if (empty($_SESSION["email"])) { // If user hard-codes link into URL
    header("Location: login.php");
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];

$query = "SELECT * FROM User WHERE email = '$email'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$bio = $row['bio'];
$profile_picture = $row['pfp'];

// If empty, show nothing (prevent undefined error)
$bio = $row['bio'] ?? '';
$profile_picture = $row['pfp'] ?? '';
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

            <?php if (isset($_SESSION['email'])): ?>
                <a href="create-post.php" class="create-post-btn"><img src="images/createPost.png"></a>
                <a href="user-profile.php" class="user-profile-btn"><img src="images/profile-icon.png"></a>
                <a href="logout.php" class="logout-btn">Logout</a>
            <?php else: ?>
                <a href="login.php" class="login-register-btn">Login/Register</a>
            <?php endif; ?>

        </nav>
    </header>

    <div class="profile-container">
        <div class="profile-picture"><img src="<?php echo $profile_picture; ?>"></div>
        <div class="profile-username"> Username: <?php echo $username; ?></div>
        <div class="profile-email"> Email: <?php echo $email; ?></div>
        <div class="profile-bio"> <strong> Bio: </strong> <?php echo $bio; ?> </div>

        <a href="edit-profile.php" class="edit-profile-btn">Edit Profile</a>
        <a href="change-password.php" class="change-pass-btn">Change Password</a>
    </div>
</body>

</html>