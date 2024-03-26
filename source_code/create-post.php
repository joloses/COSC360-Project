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
            <a href="create-post.php" class="create-post-btn"><img src="images/createPost.png"></a>
            <a href="user-profile.php" class="user-profile-btn"><img src="images/profile-icon.png"></a>
            <a href="login.php" class="login-register-btn">Login/Register</a> 
        </nav>
    </header>
    
    <div class="container">
        <div class="main-content"> 
            <h2>Create Post</h2>
            <form action="process-post.php" method="post">
                <div class="form-group">
                    <label for="post-title">Title:</label>
                    <input type="text" id="post-title" name="post-title" maxlength="100" required>
                </div>
                <div class="form-group">
                    <label for="post-content">Content:</label>
                    <textarea id="post-content" name="post-content" rows="6" required></textarea>
                </div>
                <button type="submit">Post</button>
            </form>
        </div>
    </div>

    
    <div class="container-2">
        <div class="secondary-content"> 
            <h4>Your Posts</h4>
            <?php
            
            $past_posts = array("Past Post 1", "Past Post 2", "Past Post 3");

            foreach ($past_posts as $post) {
                echo "<p><a href='post.php'>$post</a></p>";
            }
            ?>
        </div>
    </div>

</body>
</html>
