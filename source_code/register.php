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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
    <h1>Register</h1>
    <div class="container">
        <form onsubmit="return validateForm()">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <button type="submit">Register</button>
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
            window.location.href = "home.php";
        }
    </script>
</body>
</html>
