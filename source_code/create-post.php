<?php
session_start();
require_once 'connectDB.php';

if (empty($_SESSION["email"])) { // If user hard-codes link into URL
    header("Location: login.php");
}

$username = $_SESSION['username'];
$userId = $_SESSION['userId'];
$email = $_SESSION['email'];

$sql_user_posts = "SELECT postId, postTitle FROM Post WHERE userId = '$userId'";
$result_user_posts = mysqli_query($connection, $sql_user_posts);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/create-post.css?v=<?php echo time(); ?>">
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

    <div class="container">
        <div class="main-content">
            <?php
            $username = $_SESSION['username'];
            ?>
            <div class="user-info">
                <p>Welcome, <?php echo $username; ?></p> 
            </div>

            <h2>Create Post</h2>
            <!-- Form to create a new post (attached to logged in user)-->
            <form action="process-post.php" method="post">
                <div class="form-group">
                    <label for="post-title">Title:</label>
                    <input type="text" id="post-title" name="post-title" maxlength="100"
                        placeholder="Title... Keep it short!" required>
                </div>
                <div class="form-group">
                    <label for="post-content">Content:</label>
                    <textarea id="post-content" name="post-content" rows="6" placeholder="Text..." required></textarea>
                </div>
                <div class="form-group">
                    <label for="post-topic">Topic:</label>
                    <input type="text" id="post-topic" name="post-topic" placeholder="Topic..." required>
                </div>
                <button type="submit">Post</button>
            </form>
        </div>
    </div>

    <div class="container-2">
    <div class="secondary-content">
        <h4>Your Previous Posts</h4>
        <?php
            if ($result_user_posts && mysqli_num_rows($result_user_posts) > 0) {
                // Iterate through user's posts and display them with a link
                echo "<ul class='user-posts'>";
                while ($row_user_post = mysqli_fetch_assoc($result_user_posts)) {
                    echo "<li class='prev-post'><a href='postPage.php?postId=" . $row_user_post['postId'] . "'>" . $row_user_post['postTitle'] . "</a></li>";
                }
                echo "</ul>";
            } else {
                // If no posts are found, display a message
                echo "<p class='no-posts'>No posts found.</p>";
            }
            
        ?>

    </div>
</div>



</body>

</html>
