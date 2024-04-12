<?php
session_start();
?>

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
        <h2>Overview:</h2>
        <p>This semester-long project is designed to help develop relevant skills for full stack development. With this
            project, we will build an online application that will allow users to register, create and participate in
            different features of our site.</p>

        <h3>Project Statement:</h3>
        <p>To build a web-based tool that allows users engage in activities permitted for registered users. Registered
            users
            should be able to access specific portions/features of your site that are not accessible to unregistered
            users.
        </p>

        <h3>Our Site:</h3>
        <p>Our website will allow registered users to engage in online discussions and unregistered users to view
            discussions similar to forums such as Reddit and HackerNews. The goal is to produce a similar type service
            that
            allows users to register, post content and make comments on items. Additionally, unregistered users will be
            able
            to search and view the content but will not be able to edit or comment on posts. Registered users will be
            able
            to leave comments and replies.</p>

        <p>Majority of the project information and requirements were taken from these provided sources: <a
                href="https://canvas.ubc.ca/courses/133337/pages/project-info?module_item_id=6511100">Project Info</a>
            and
            <a href="https://canvas.ubc.ca/courses/133337"> Canvas Page</a>.
        </p>
    </div>

</body>

</html>