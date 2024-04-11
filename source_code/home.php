<?php
session_start();
require_once 'connectDB.php';

// Fetch topics
$sql_topics = "SELECT DISTINCT `topic` FROM Post";
$result_topics = mysqli_query($connection, $sql_topics);

if (!$result_topics) {
    echo "Error fetching topics: " . mysqli_error($connection);
    exit();
}

// Default query to fetch all posts
$sql_posts = "SELECT `postId`, `postTitle`, `postContent` FROM Post";
$result_posts = mysqli_query($connection, $sql_posts);

if (!$result_posts) {
    echo "Error fetching posts: " . mysqli_error($connection);
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
            <form method="GET" action="" class="search-form">
                <input type="text" class="search-bar" name="search" placeholder="Search..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                <button type="submit" class="submitBtn">Search</button>
            </form>

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
            if (isset($_GET['search']) && $_GET['search'] != "" ) {
                // If search query is provided, show search results
                $search = mysqli_real_escape_string($connection, $_GET['search']);
                echo "<h3>Showing Posts Containing or In $search </h3>";
                echo"<hr>";
                $sql_search = "SELECT `postId`, `postTitle`, `postContent` FROM Post WHERE `postTitle` LIKE '%$search%' OR  `topic` LIKE '%$search%' ";
                $result_posts = mysqli_query($connection, $sql_search);

                if (!$result_posts) {
                    echo "Error fetching search results: " . mysqli_error($connection);
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
                    echo "No matching posts found.";
                }
            } else {
                // Show all posts by default
                echo "<h3> All Posts </h3>";
                echo"<hr>";
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
                        echo "<li class='topicItem'><a href='javascript:void(0);' onclick='setSearch(\"" . $row['topic'] . "\")'>" . $row['topic'] . "</a></li>";
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

    <script>
        function setSearch(topic) {
            document.querySelector('.search-bar').value = topic;
            document.querySelector('.search-form').submit();
        }
    </script>
</body>

</html>
