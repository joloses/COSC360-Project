<?php
session_start();

$host = "localhost";
$database = "DDL360";
$user = "webuser";
$password = "P@ssw0rd";

$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    $sql = "SELECT * FROM User WHERE email='$email' AND userPassword='$password'";
    $result = $connection->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the username from the query result
        $row = $result->fetch_assoc();
        $username = $row['username'];

        // Set session variables
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;

        // Redirect to home page
        header("Location: home.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login/Register</title>
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
        
        <?php if(isset($_SESSION['email'])): ?>
            <a href="logout.php" class="logout-btn">Logout</a>
        <?php else: ?>
            <a href="login.php" class="login-register-btn">Login/Register</a>
        <?php endif; ?>
        
    </nav>
</header>

<div class="container">
    <h1>Login</h1>
    <form method="post">
        <div class="form-group">
            <label for="login-email">Email:</label>
            <input type="email" id="login-email" name="login-email" placeholder="Type Email here." required>
        </div>
        <div class="form-group">
            <label for="login-password">Password:</label>
            <input type="password" id="login-password" name="login-password" placeholder="Type Password here." required>
        </div>
        <div class="form-group">
            <button type="submit">Login</button>
        </div>
    </form>
    <a href="register.php" class="register-link">Don't have an account? Register here</a>
</div>
</body>
</html>

<?php
$connection->close();
?>
