<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login/Register</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/login-register.css">

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
        <h1>Login</h1>
        <form onsubmit="return validateLoginForm()">
            <div class="form-group">
                <label for="login-email">Email:</label>
                <input type="email" id="login-email" name="login-email" required>
            </div>
            <div class="form-group">
                <label for="login-password">Password:</label>
                <input type="password" id="login-password" name="login-password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
        <a href="register.php" class="register-link">Don't have an account? Register here</a>
    </div>

    <script>
        function validateLoginForm() {
            var email = document.getElementById("login-email").value;
            var password = document.getElementById("login-password").value;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email == "") {
                alert("Email address must be filled out");
                return false;
            }

            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address");
                return false;
            }

            if (password == "") {
                alert("Password must be filled out");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
