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
            <input type="text" class="search-bar" placeholder="Search...">
            <a href="create-post.php" class="create-post-btn"><img src="images/createPost.png"></a>
            <a href="user-profile.php" class="user-profile-btn"><img src="images/profile-icon.png"></a>
            
            <?php if(isset($_SESSION['email'])): ?>
               
                <a href="logout.php" class="logout-btn">Logout</a>
            <?php else: ?>
                
                <a href="login.php" class="login-register-btn">Login/Register</a>
            <?php endif; ?>
            
        </nav>
    </header>

    <div class="container">
        <div class="main-content">
            <?php
             $host = "localhost";
             $database = "ddl360";
             $user = "webuser";
             $password = "P@ssw0rd";
             $connection = mysqli_connect($host, $user, $password, $database);

            // Check connection
            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $postId = $_GET['postId'];
            // Query to retrieve the post
            $sql = "SELECT * FROM Post WHERE postId = $postId";

            // Execute the query
            $result = mysqli_query($connection, $sql);

            // Check if the query was successful
            if ($result) {
                // Check if any rows were returned
                if (mysqli_num_rows($result) > 0) {
                    // Fetch the post data
                    $row = mysqli_fetch_assoc($result);
                    // Display the post content
                    echo "<h2>" . $row["postTitle"] . "</h2>";
                    echo "<p>" . $row["postContent"] . "</p>";
                } else {
                    echo "No post found";
                }
            } else {
                // Handle query execution error
                echo "Error executing query: " . mysqli_error($connection);
            }

            // Close the database connection
            mysqli_close($connection);

            ?>
            <hr>
            <div class="comments">
                <h3>Comments</h3>
                <!-- List comments here -->
            </div>
        </div>
    </div>
    
    <div class="container-2">
        <div class="secondary-content"> 
            <h4> Browse Our Topics!
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
