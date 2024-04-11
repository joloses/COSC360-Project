<?php
session_start();
require_once 'connectDB.php';

// Check if postId is set in the URL
if(isset($_GET['postId'])) {
    $postId = $_GET['postId'];

    // Fetch post details based on postId
    $sql = "SELECT * FROM Post WHERE postId = $postId";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $postTitle = $row["postTitle"];
            $topic = $row['topic'];
            $postContent = $row["postContent"];
        } else {
            $postTitle = "No post found";
            $topic = "";
            $postContent = "";
        }
    } else {
        $postTitle = "Error fetching post";
        $topic = "";
        $postContent = "Error executing query: " . mysqli_error($connection);
    }
    // Fetch topics
    $sql_topics = "SELECT DISTINCT `topic` FROM Post";
    $result_topics = mysqli_query($connection, $sql_topics);

    // Fetch comments
    $sql_comments = "SELECT * FROM Comments WHERE postId = $postId";
    $result_comments = mysqli_query($connection, $sql_comments);

    $comments = [];
    if ($result_comments && mysqli_num_rows($result_comments) > 0) {
        while ($row_comment = mysqli_fetch_assoc($result_comments)) {
        $comments[] = $row_comment['commentBody'];
        }
    }

} else {
    $postTitle = "No postId specified";
    $topic = "";
    $postContent = "";
    $comments = [];
}

// Check if search query is provided
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $sql_search = "SELECT `postId`, `postTitle`, `postContent` FROM Post WHERE `postTitle` LIKE '%$search%' OR `topic` LIKE '%$search%'";
    $result_posts = mysqli_query($connection, $sql_search);
} else {
    // Default query to fetch all posts
    $sql_posts = "SELECT `postId`, `postTitle`, `postContent` FROM Post";
    $result_posts = mysqli_query($connection, $sql_posts);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <link rel="stylesheet" href="css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/post-page.css?v=<?php echo time(); ?>">
</head>

<body>
    <header>
        <nav>
            <a href="home.php" class="logo"><img src="images/logo.png"></a>
            <form method="GET" action="home.php" class="search-form">
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
            <h2><?php echo $postTitle; ?></h2>
            <a id="topicLink" href="home.php?search=<?php echo urlencode($topic); ?>"><?php echo $topic; ?></a>
            <p><?php echo $postContent; ?></p>
            <hr>
            <div class="comments">
                <h3>Comments</h3>
                    <?php if (!empty($comments)): ?>
                        <ul>
                            <?php foreach ($comments as $comment): ?>
                                <li><?php echo $comment; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p>No comments yet.</p>
                    <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container-2">
        <div class="secondary-content">
            <h4>Topics</h4>
            <ul>
                <?php
                if ($result_topics && mysqli_num_rows($result_topics) > 0) {
                    while ($row = mysqli_fetch_assoc($result_topics)) {
                        echo "<li id='topicList'><a href='home.php?search=" . $row['topic'] . "'>" . $row['topic'] . "</a></li>";
                    }
                } else {
                    echo "<li>No topics found.</li>";
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
