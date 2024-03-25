<!-- <!DOCTYPE html>
<html lang = en>
    <head>
        <title> Home </title>
        <link rel="stylesheet" href="css/header.css">
    </head>
    <header>
        <nav> 
            <a href="home.html" class="logo"><img src = "images/logo.png"></a>
            <input type="text" class="search-bar" placeholder="Search...">
            <a href="create-post.html" class="create-post-btn"><img src = "images/createPost.png"></a>
            <a href="user-profile.html" class="user-profile-btn"><img src = "images/profile-icon.png"></a>
            <a href="login.html" class="login-register-btn">Login/Register</a>
        </nav>

        </nav>
    </header>
    
    <body> 
        <div class = "container">
            <div class = "main-content"> 
                <hr>
                <div class = "post">
                    <h2> Post Title </h2>
                    <p><small> POST TEXT GOES HERE </small> </p>
                </div>
                <hr>
                <div class = "comments">
                    <h3> Comments </h3>
         
                </div>
            </div>
        </div>
            
        <div class = "container-2">
            <div class = "secondary-content"> 
                <h4> Topics </h4>
                <ul> 
                    <p> <a href = "topic1.html"> Topic 1 </a> </li> </p>
                    <p> <a href = "topic2.html"> Topic 2 </a> </li> </p>
                    <p> <a href = "topic3.html"> Topic 3 </a> </li> </p>
                </ul>
                <h4> Resources </h4>
                <ul> 
                    <p> <a href = "about-us.html"> About Us! </a> </li> </p>
                    <p> <a href = "contact.html"> Contact </a> </li> </p>
                    <p> <a href = "TOS.html"> Terms of Service </a> </li> </p>
                </ul>
            </div>
        </div>
    
    </body>

</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
    <link rel="stylesheet" href="css/header.css">
</head>
<body>
    <header>
        <nav> 
            <a href="home.php" class="logo"><img src="images/logo.png"></a>
            <input type="text" class="search-bar" placeholder="Search...">
            <a href="create-post.html" class="create-post-btn"><img src="images/createPost.png"></a>
            <a href="user-profile.html" class="user-profile-btn"><img src="images/profile-icon.png"></a>
            <a href="login.html" class="login-register-btn">Login/Register</a>
        </nav>
    </header>

    <div class="container">
        <div class="main-content">
            <hr>
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
            <h4>Topics</h4>
            <ul> 
                <li><a href="topic1.html">Topic 1</a></li>
                <li><a href="topic2.html">Topic 2</a></li>
                <li><a href="topic3.html">Topic 3</a></li>
            </ul>
            <h4>Resources</h4>
            <ul> 
                <li><a href="about-us.html">About Us!</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="TOS.html">Terms of Service</a></li>
            </ul>
        </div>
    </div>
</body>
</html>
