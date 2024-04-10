<?php
session_start();
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
            // CONNECT TO LOCAL DATABASE
             /*
            $host = "localhost";
            $database = "DDL360";
            $user = "webuser";
            $password = "P@ssw0rd";
            $connection = mysqli_connect($host, $user, $password, $database);
             */
            
            // CONNECT TO JOLO'S WEBSERVER DATABASE 
           // /*
           $host = "localhost";
           $database = "db_85456473";
           $user = "85456473";
           $password = "85456473";
           $connection = mysqli_connect($host, $user, $password, $database);
           // */

            if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }


            $sql = "SELECT `postId`, `postTitle`, `postContent` FROM Post";


            $result = mysqli_query($connection, $sql);


            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='post'>";
                    echo "<h2><a href='postPage.php?postId=" . $row['postId'] . "'>" . $row['postTitle'] . "</a></h2>";
                    echo "<p><small>" . date("Y-m-d") . "</small></p>";
                    echo "</div>";
                }
            } else {
                echo "No posts found.";
            }

            mysqli_close($connection);
            ?>
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