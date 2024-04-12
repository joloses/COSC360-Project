<?php
session_start();
require_once 'connectDB.php';

// Check if the user is logged in and has admin privileges
if (!(isset($_SESSION['role']) && $_SESSION['role'] === 'admin')) {
    header("Location: home.php"); // Redirect to home page if not admin
    exit();
}

// Fetch usage statistics
$post_count = $comment_count = $user_count = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["filter"])) {
        header("Location: adminpage.php"); // Redirect to no selection
        exit();
    } else {
        if ($_POST["filter"] == "posts") {
            $sql_posts_count = "SELECT COUNT(*) AS postCount FROM Post";
            $result_posts_count = mysqli_query($connection, $sql_posts_count);
            $post_count = mysqli_fetch_assoc($result_posts_count)['postCount'];
        } elseif ($_POST["filter"] == "comments") {
            $sql_comments_count = "SELECT COUNT(*) AS commentCount FROM Comments";
            $result_comments_count = mysqli_query($connection, $sql_comments_count);
            $comment_count = mysqli_fetch_assoc($result_comments_count)['commentCount'];
        } elseif ($_POST["filter"] == "users") {
            $sql_users_count = "SELECT COUNT(*) AS userCount FROM User";
            $result_users_count = mysqli_query($connection, $sql_users_count);
            $user_count = mysqli_fetch_assoc($result_users_count)['userCount'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Reports</title>
    <link rel="stylesheet" href="css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/adminPage.css?v=<?php echo time(); ?>">
</head>

<body>
    <header>
        <nav>
            <a href="home.php" class="logo"><img src="images/logo.png"></a>
            <form method="GET" action="" class="search-form">
                <input type="text" class="search-bar" name="search" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                <button type="submit" class="submitBtn">Search</button>
            </form>

            <?php if (isset($_SESSION['email'])): ?>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                    <a href="adminpage.php" class="admin-page-btn">Admin Page</a>
                <?php endif; ?>
                <a href="create-post.php" class="create-post-btn"><img src="images/createPost.png"></a>
                <a href="user-profile.php" class="user-profile-btn"><img src="images/profile-icon.png"></a>
                <a href="logout.php" class="logout-btn">Logout</a>
            <?php else: ?>
                <a href="login.php" class="login-register-btn">Login/Register</a>
            <?php endif; ?>

        </nav>
    </header>

    <div class="container">
        <h1>Admin Reports</h1>
        <br>
        <form method="post">
            <label for="posts">Posts</label>
            <input type="radio" name="filter" id="posts" value="posts" <?php if (isset($_POST['filter']) && $_POST['filter'] == 'posts') echo 'checked'; ?>>
            <label for="comments">Comments</label>
            <input type="radio" name="filter" id="comments" value="comments" <?php if (isset($_POST['filter']) && $_POST['filter'] == 'comments') echo 'checked'; ?>>
            <label for="users">Users</label>
            <input type="radio" name="filter" id="users" value="users" <?php if (isset($_POST['filter']) && $_POST['filter'] == 'users') echo 'checked'; ?>>
            <button type="submit">Filter</button>
        </form>
        <div class="reports">
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <?php if (!isset($_POST["filter"])): ?>
                    <p>Please select a filter.</p>
                <?php elseif ($_POST["filter"] == "posts"): ?>
                    <div class="report">
                        <h2>Posts</h2>
                        <p>Total Posts: <?php echo $post_count; ?></p>
                    </div>
                <?php elseif ($_POST["filter"] == "comments"): ?>
                    <div class="report">
                        <h2>Comments</h2>
                        <p>Total Comments: <?php echo $comment_count; ?></p>
                    </div>
                <?php elseif ($_POST["filter"] == "users"): ?>
                    <div class="report">
                        <h2>Users</h2>
                        <p>Total Users: <?php echo $user_count; ?></p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
