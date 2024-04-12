<?php
session_start();
require_once 'connectDB.php';

if (empty($_SESSION["email"])) { // If user hard-codes link into URL
    header("Location: login.php");
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$userId = $_SESSION['userId'];

$sql_user_posts = "SELECT postId, postTitle FROM Post WHERE userId = '$userId'";
$result_user_posts = mysqli_query($connection, $sql_user_posts);

$query = "SELECT * FROM User WHERE email = '$email'";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_assoc($result);
$bio = $row['bio'];
$profile_picture = $row['pfp'];

// If empty, show nothing (prevent undefined error)
$bio = $row['bio'] ?? '';
$profile_picture = $row['pfp'] ?? '';

// Assuming $userId contains the ID of the logged-in user
$sql_user_comments = "SELECT c.commentId, c.commentBody, c.postId, p.postTitle FROM Comments c JOIN Post p ON c.postId = p.postId WHERE c.userId = '$userId'";
$result_user_comments = mysqli_query($connection, $sql_user_comments);

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
    <title>User Profile</title>
    <link rel="stylesheet" href="css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/user-profile.css?v=<?php echo time(); ?>">
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

    <!-- Profile Posts Container -->
    <div class="profile-container">
        <div class="profile-picture"><img src="<?php echo $profile_picture; ?>"></div>
        <div class="profile-username"> Username: <?php echo $username; ?></div>
        <div class="profile-email"> Email: <?php echo $email; ?></div>
        <div class="profile-bio"> <strong> Bio: </strong> <?php echo $bio; ?> </div>

        <a href="edit-profile.php" class="edit-profile-btn">Edit Profile</a>
        <a href="change-password.php" class="change-pass-btn">Change Password</a>
    </div>
    
    <!-- Previous Posts Container -->
    <div class="prevPosts">
    <h4>Your Previous Posts</h4>
        <?php
            if ($result_user_posts && mysqli_num_rows($result_user_posts) > 0) {
                // Iterate through user's posts and display them with a link
                echo "<ul class='user-posts'>";
                while ($row_user_posts = mysqli_fetch_assoc($result_user_posts)) {
                    echo "<li class='prev-post'><a href='postPage.php?postId=" . $row_user_posts['postId'] . "'>" . $row_user_posts['postTitle'] . "</a></li>";
                }
                echo "</ul>";
            } else {
                // If no posts are found, display a message
                echo "<p class='no-posts'>No posts found.</p>";
            }
            
        ?>
    </div>

    <!-- Comments Container -->
    <div class="comments">
    <h4>Your Previous Comments</h4>
    <?php
    // Assuming $result_user_comments contains the result of the query to fetch user's comments
    if ($result_user_comments && mysqli_num_rows($result_user_comments) > 0) {
        // Iterate through user's comments and display them with a link to the post
        echo "<ul class='user-comments'>";
        while ($row_user_comment = mysqli_fetch_assoc($result_user_comments)) {
            // Fetch post information based on postId
            $postId = $row_user_comment['postId'];
            $sql_post_info = "SELECT `postTitle` FROM Post WHERE `postId` = $postId";
            $result_post_info = mysqli_query($connection, $sql_post_info);
            if ($result_post_info && mysqli_num_rows($result_post_info) > 0) {
                $row_post_info = mysqli_fetch_assoc($result_post_info);
                $postTitle = $row_post_info['postTitle'];
            } else {
                $postTitle = "Unknown Post";
            }
            echo "<li class='user-comment'><a id='commentLink' href='postPage.php?postId=$postId'>" . $postTitle . "</a> </br> " . $row_user_comment['commentBody'] . "</li>";
        }
        echo "</ul>";
    } else {
        // If no comments are found, display a message
        echo "<p class='no-comments'>No previous comments found.</p>";
    }
    ?>
</div>

</body>

</html>