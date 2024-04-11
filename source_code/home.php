<?php
session_start();
require_once 'connectDB.php';

// Fetch topics
$sql_topics = "SELECT DISTINCT `topic` FROM Post";
$result_topics = mysqli_query($connection, $sql_topics);

if (!$result_topics) {
    echo "Error: " . mysqli_error($connection);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css?v=<?php echo time(); ?>">
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
            <h3>Posts</h3>
            <hr>
            <?php
            $sql_posts = "SELECT `postId`, `postTitle`, `postContent` FROM Post";
            $result_posts = mysqli_query($connection, $sql_posts);

            if (!$result_posts) {
                echo "Error: " . mysqli_error($connection);
                exit();
            }

            if (mysqli_num_rows($result_posts) > 0) {
                while ($row = mysqli_fetch_assoc($result_posts)) {
                    echo "<div class='post'>";
                    echo "<h2><a href='postPage.php?postId=" . $row['postId'] . "'>" . $row['postTitle'] . "</a></h2>";
                    echo "<p><small>" . date("Y-m-d") . "</small></p>";
                    echo "</div>";
                }
            } else {
                echo "No posts found.";
            }
            ?>
        </div>
    </div>

    <div class="container-2">
        <div class="secondary-content">
            <h4>Topics</h4>
            <ul>
                <?php
                if (mysqli_num_rows($result_topics) > 0) {
                    while ($row = mysqli_fetch_assoc($result_topics)) {
                        echo "<li id=topicList><a href='searchResult.php?topic=" . $row['topic'] . "'>" . $row['topic'] . "</a></li>";
                    }
                } else {
                    echo "No topics found.";
                }
                ?>
            </ul>
            <br>
            <h4>Resources</h4>
            <ul>
                <li class="other"><a href="about-us.php">About Us!</a></li>
                <li class="other"><a href="contact.php">Contact</a></li>
                <li class="other"><a href="TOS.php">Terms of Service</a></li>
            </ul>
        </div>
    </div>
</body>

</html>
