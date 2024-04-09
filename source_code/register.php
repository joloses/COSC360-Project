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

$errors = array();
$firstNameValue = isset($_POST['first-name']) ? $_POST['first-name'] : '';
$lastNameValue = isset($_POST['last-name']) ? $_POST['last-name'] : '';
$emailValue = isset($_POST['register-email']) ? $_POST['register-email'] : '';
$usernameValue = isset($_POST['username']) ? $_POST['username'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $email = $_POST['register-email'];
    $password = $_POST['register-password'];
    $confirmPassword = $_POST['confirm-password'];
    $username = $_POST['username'];

    $uppercase = preg_match('@[A-Z]@', $password);
    $number = preg_match('@[0-9]@', $password);
    $symbol = preg_match('@[^\w]@', $password);

    if (strlen($password) < 6 || strlen($password) > 15 || !$uppercase || !$number || !$symbol) {
        $errors[] = "Password must be between 6 and 15 characters long and contain at least one uppercase letter, one number, and one symbol.";
    }

    if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    }

    $sql = "SELECT * FROM User WHERE email='$email' OR username='$username'";
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {
        $errors[] = "Email or username already registered. Please choose a different email or username.";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO User (firstName, lastName, email, userPassword, username) VALUES ('$firstName', '$lastName', '$email', '$password', '$username')";

        if ($connection->query($sql) === TRUE) {
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $connection->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login/Register</title>
    <link rel="stylesheet" href="css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/login-register.css?v=<?php echo time(); ?>">
    <style>
        .error-message {
            color: red;
            margin-top: 5px;
            font-size: 14px;
        }
    </style>
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
        <h1>Register</h1>
        <form method="post">
            <div class="form-group">
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first-name" placeholder="Enter First Name" required
                    value="<?php echo $firstNameValue; ?>">
            </div>
            <div class="form-group">
                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last-name" placeholder="Enter Last Name" required
                    value="<?php echo $lastNameValue; ?>">
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter Username" required
                    value="<?php echo $usernameValue; ?>">
            </div>
            <div class="form-group">
                <label for="register-email">Email:</label>
                <input type="email" id="register-email" name="register-email" placeholder="Enter Email" required
                    value="<?php echo $emailValue; ?>">
            </div>
            <div class="form-group">
                <label for="register-password">Password:</label>
                <input type="password" id="register-password" name="register-password" placeholder="Enter Password"
                    required>
                <div class="error-message">Password must be between 6 and 15 characters long and contain at least one
                    uppercase letter, one number, and one symbol.</div>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password"
                    required>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
            <?php
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    echo "<div class='error-message'>$error</div>";
                }
            }
            ?>
        </form>
        <a href="login.php" class="login-link">Already have an account? Login here</a>
    </div>
</body>

</html>

<?php
mysqli_close($connection);
?>