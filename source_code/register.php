<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/login-register.css?v=<?php echo time(); ?>">
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
        <h1>Register</h1>
        <form onsubmit="return validateForm()">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Type Email here." required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="text" name="text" placeholder="Type Username here."  required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Type Password here." required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Type Password here." required>
            </div>
            <div class="form-group">
            <button type="submit">Register</button>
            </div>
        </form>
    </div>


    <script>
        function validateRegisterForm() {
            var email = document.getElementById("register-email").value;
            var password = document.getElementById("register-password").value;
            var confirmPassword = document.getElementById("confirm-password").value;
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (email == "") {
                alert("Email address must be filled out");
                event.preventDefault();
                return false;
            }

            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address");
                event.preventDefault();
                return false;
            }

            if (password == "") {
                alert("Password must be filled out");
                event.preventDefault();
                return false;
            }

            if (password.length < 6) {
                alert("Password must be at least 6 characters long");
                event.preventDefault();
                return false;
            }

            if (confirmPassword == "") {
                alert("Please confirm your password");
                event.preventDefault();
                return false;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match");
                event.preventDefault();
                return false;
            }

            return true;
        }

        function exitRegister() {
            window.location.href = "edit-profile.php";
        }
    </script>
</body>

</html>