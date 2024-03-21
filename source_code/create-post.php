<!DOCTYPE html>
<html lang="en">
<style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 50px auto;
            width: 600px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        
        
    </style>
<head>
    <title>Create Post</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body> 
    <header>
        <nav> 
            <a href="home.html" class="logo"><img src="images/logo.png"></a>
            <input type="text" class="search-bar" placeholder="Search...">
            <a href="create-post.php" class="create-post-btn"><img src="images/createPost.png"></a>
            <a href="user-profile.php" class="user-profile-btn"><img src="images/profile-icon.png"></a>
            <a href="login-register.php" class="login-register-btn">Login/Register</a> 
        </nav>
    </header>
    
    <div class="container">
        <div class="main-content"> 
            <h2>Create Post</h2>
            <form action="post_process.php" method="post">
                <div class="form-group">
                    <label for="post-title">Title:</label>
                    <input type="text" id="post-title" name="post-title" required>
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
