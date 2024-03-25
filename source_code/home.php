<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
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
            <h3>Posts</h3>
            
            <hr>
            <?php
            $host = "localhost";
            $database = "ddl360";
            $user = "webuser";
            $password = "P@ssw0rd";
            $connection = mysqli_connect($host, $user, $password, $database);

            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Query to retrieve all posts
            $sql = "SELECT `postId`, `postTitle`, `postContent` FROM Post";

            // Execute the query
            $result = mysqli_query($connection, $sql);

            // Check if there are posts
            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='post'>";
                    echo "<h2><a href='postPage.php?postId=" . $row['postId'] . "'>" . $row['postTitle'] . "</a></h2>";
                    echo "<p><small>" . date("Y-m-d") . "</small></p>";
                    echo "</div>";
                }
            } else {
                echo "No posts found.";
            }

            // Close database connection
            mysqli_close($connection);
            ?>
        </div>
    </div>
    
    <div class="container-2">
        <div class="secondary-content"> 
            <ul> 
                <li><a href="searchResult.php">Topic 1</a></li>
                <br>
                <li><a href="searchResult.php">Topic 2</a></li>
                <br>
                <li><a href="searchResult.php">Topic 3</a></li>
            </ul>
            <br>
            <h4>Resources</h4>
            <ul> 
                <li><a href="about-us.php">About Us!</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="TOS.php">Terms of Service</a></li>
            </ul>
        </div>
    </div>
</body>
</html>

