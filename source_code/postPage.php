<?php
session_start();
require_once 'connectDB.php';

// Initialize required variables
$postTitle = "";
$topic = "";
$postContent = "";
$userId = null;
$comments = [];
$posterName = "";

// Check if postId is set in the URL
if(isset($_GET['postId'])) {
    $postId = $_GET['postId'];

    // Get post details based on postId from URL
    $sql = "SELECT * FROM Post WHERE postId = $postId";
    $result = mysqli_query($connection, $sql);

    if ($result) { //iterate result and assign each attribute to a var
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $postTitle = $row["postTitle"];
            $topic = $row['topic'];
            $postContent = $row["postContent"];
            $userId =  $row["userId"];
        } else {
            $postTitle = "No post found";
        }
    } else {
        $postTitle = "Error fetching post";
        $postContent = "Error executing query: " . mysqli_error($connection);
    }

    // Retrieve topics
    $sql_topics = "SELECT DISTINCT `topic` FROM Post";
    $result_topics = mysqli_query($connection, $sql_topics);

    // Retrieve existing comments
    $sql_comments = "SELECT * FROM Comments WHERE postId = $postId";
    $result_comments = mysqli_query($connection, $sql_comments);

    if ($result_comments && mysqli_num_rows($result_comments) > 0) { 
        while ($row_comment = mysqli_fetch_assoc($result_comments)) {
            //sql to retrieve the commenter's name
            $currCommentUserId = $row_comment['userId'];
            $sql_commPoster = "SELECT `firstName`, `lastName` FROM User WHERE userId = $currCommentUserId";
            $result_commPoster = mysqli_query($connection, $sql_commPoster);
    
            if ($result_commPoster && mysqli_num_rows($result_commPoster) > 0) {
                $row_commPoster = mysqli_fetch_assoc($result_commPoster);
                $commenterName = $row_commPoster['firstName'] . ' ' . $row_commPoster['lastName']; // Store commenter's name separately
            } else {
                $commenterName = "Unknown";
            }
    
            $commentBody = $row_comment['commentBody'];
            if (!empty($commentBody)) { //skip comment if it's empty - avoid displaying blank lines
                // Store each comment along with its commenter's name in an array
                $comments[] = ['comment' => $commentBody, 'commenterName' => $commenterName];
            }
        }
    }
    


    // Get poster's name to display with post
    if ($userId) {
        $sql_poster = "SELECT `firstName`, `lastName` FROM User WHERE userId = $userId";
        $result_poster = mysqli_query($connection, $sql_poster);

        if ($result_poster) {
            $row_poster = mysqli_fetch_assoc($result_poster);
            $posterName = $row_poster['firstName'] . ' ' . $row_poster['lastName'];
        } else {
            $posterName = "Unknown";
        }
    }

} else { //error
    $postTitle = "No postId specified";
}

// Check if search query is provided
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $sql_search = "SELECT `postId`, `postTitle`, `postContent` FROM Post WHERE `postTitle` LIKE '%$search%' OR `topic` LIKE '%$search%'";
    $result_posts = mysqli_query($connection, $sql_search);
} else {
    // Default query to get all posts for no search
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
                <select name="sort" class="sort-dropdown">
                    <option value="asc">Date: Low to High</option>
                    <option value="desc">Date: High to Low</option>
                </select>
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
        <div class="main-content">
        <h2 class="post"><?php echo $postTitle; ?></h2>
        <!-- Display post's author -->
        <div style="display: flex; align-items: center;">
            <img src="images/profile-icon.png" width="15px" height="15px">
            <p style="margin-left: 5px;"><?php echo $posterName; ?></p>
        </div>
        <!-- Display post's topic with link to search result of that topic -->
        Topic: <a id="topicLink" href="home.php?search=<?php echo urlencode($topic); ?>"> <?php echo $topic; ?></a><br>
        <p><?php echo $postContent; ?></p>
            <hr>
            <div class="comments">
                <h3>Comments</h3>
                <?php if (isset($_SESSION['email'])): ?> <!-- If user is logged in, they can comment-->
                        <a id="addCommentLink" href="addComment.php?postId=<?php echo $postId; ?>#comments" class="commentBtn">Add Comment</a>
                <?php endif; ?>
                <?php if (!empty($comments)): ?>
                    <!-- Display each comment if any exist -->
                    <?php foreach ($comments as $comment): ?>
                        <div class="commentList">
                            <div style="display: flex; align-items: center;">
                                <img src="images/profile-icon.png" width="15px" height="15px">
                                <p style="margin-left: 5px;"><?php echo $comment['commenterName']; ?></p>
                            </div>
                            <p><?php echo $comment['comment']; ?></p>
                            <hr id="commentBreaks">
                        </div>
                    <?php endforeach; ?>
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
