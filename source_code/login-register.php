<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login/Register</title>
    <link rel="stylesheet" href="css/home.css">
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
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .register-link {
            display: block;
            text-align: center;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        .register-link:hover {
            color: #0056b3;
        }
    </style>
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
