<!DOCTYPE html>
<html lang = en>
    <head>
        <title> Home </title>
        <link rel="stylesheet" href="css/home.css">
    </head>
    <header>
        <nav> <!-- Nav bar: Logo (home), search, create post, profile -->
            <a href="home.html" class="logo"><img src = "images/logo.png"></a>
            <input type="text" class="search-bar" placeholder="Search...">
            <a href="create-post.html" class="create-post-btn"><img src = "images/createPost.png"></a>
           
            <a href="user-profile.html" class="user-profile-btn"><img src = "images/profile-icon.png"></a>
            <a href="login-register.html" class="login-register-btn">Login/Register</a>
        </nav>

        </nav>
    </header>
    
    <body> 
        <div class = "container">
            <div class = "main-content"> <!-- Post Section --> 
                <hr>
                <div class = "post">
                    <h2> Post Title </h2>
                    <p><small> POST TEXT GOES HERE </small> </p>
                </div>
                <hr>
                <div class = "comments">
                    <h3> Comments </h3>
                    <!-- list comments here -->
                </div>
            </div>
        </div>
            
        <div class = "container-2">
            <div class = "secondary-content"> <!-- Side Column: Topics, About us, Contact, Terms of Service-->
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

</html>