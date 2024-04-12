<?php
session_start();
require_once 'connectDB.php';

if (empty($_SESSION["email"])) { // If user hard-codes link into URL
    header("Location: login.php");
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $new_bio = $_POST['bio'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Update profile picture if uploaded
    $pfp_direct = "pfp/";

    if (!empty($_FILES['profile_picture']['name'])) {
        $file_name = basename($_FILES["profile_picture"]["name"]);
        $target_path = $pfp_direct . $file_name;
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_path)) {
            $update_picture_query = "UPDATE User SET pfp='$target_path' WHERE email='$email'";
            mysqli_query($connection, $update_picture_query);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    if (!empty($new_username)) { // Update username
        $update_username_query = $connection->prepare("UPDATE User SET username=? WHERE email=?");
        $update_username_query->bind_param("ss", $new_username, $email);
        $update_username_query->execute();
        $_SESSION['username'] = $new_username; 
    }
    if (!empty($new_email)) { // Update email
        $email_update_stmt = $connection->prepare("UPDATE User SET email=? WHERE email=?");
        $email_update_stmt->bind_param("ss", $new_email, $email);
        $email_update_stmt->execute();
        $_SESSION['email'] = $new_email;
    }
    if (!empty($new_bio)) { // Update bio
        $bio_update_stmt = $connection->prepare("UPDATE User SET bio=? WHERE email=?");
        $bio_update_stmt->bind_param("ss", $new_bio, $email);
        $bio_update_stmt->execute();
    }
    header("Location: user-profile.php");
    exit;
}

// Show current pfp (if available)
$query = "SELECT pfp FROM User WHERE email = '$email'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$profile_picture = $row['pfp'];

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
            <?php if ($profile_picture && file_exists($profile_picture)): ?>
                <img src="<?php echo $profile_picture; ?>">
            <?php else: ?>
                <img src="placeholder.jpg">
            <?php endif; ?>
        </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <input type="file" class="input-field" name="profile_picture" accept="image/*">
            <input type="text" class="input-field" name="username" placeholder="Username">
            <input type="email" class="input-field" name="email" placeholder="Email">
            <textarea class="input-field" name="bio" maxlength="255"
                placeholder="Tell us something about yourself..."></textarea>
            <hr>
            <button type="submit" class="edit-profile-btn" name="action" value="save-changes">Save Changes</button>
        </form>
    </div>
</body>

</html>