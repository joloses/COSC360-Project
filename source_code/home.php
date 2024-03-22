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
            <a href="login-register.php" class="login-register-btn">Login/Register</a>
        </nav>
    </header>
    
    <div class="container">
        <div class="main-content"> 
            <h3>Posts</h3>
            
            <hr>
            <div class="post">
                <h2><a href="postPage.php">Post Title</a></h2>
                <p><small><?php echo date("Y-m-d"); ?></small></p>
            </div>    
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
