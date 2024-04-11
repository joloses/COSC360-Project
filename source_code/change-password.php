<?php
session_start();
require_once 'connectDB.php';

if (empty($_SESSION["email"])) { // If user hard-codes link into URL
    header("Location: login.php");
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $_SESSION['error_current_password'] = '';
    $_SESSION['error_new_password'] = '';
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = ($_POST['current_password']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch the current password from the database
    $stmt = $connection->prepare("SELECT userPassword FROM User WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($current_password !== $user['userPassword']) {
        $_SESSION['error_current_password'] = "Current password is incorrect.";
    } else {
        $new_hashed_password = ($new_password);
        $update_stmt = $connection->prepare("UPDATE User SET userPassword = ? WHERE email = ?");
        $update_stmt->bind_param("ss", $new_hashed_password, $email);
        $update_stmt->execute();

        // Clear error message
        $_SESSION['error_current_password'] = '';
        header("Location: user-profile.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="css/header.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/edit-profile.css?v=<?php echo time(); ?>">

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

    <div class="edit-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"
            enctype="multipart/form-data">
            <input type="password" class="input-field" name="current_password" placeholder="Current Password">
            <?php if (!empty($_SESSION['error_current_password']))
                echo "<p style='color:red'>" . $_SESSION['error_current_password'] . "</p>"; ?>

            <input type="password" class="input-field" name="new_password" id="new_password" placeholder="New Password">
            <input type="password" class="input-field" name="confirm_password" id="new_pass-check"
                placeholder="Confirm New Password">
            <button type="submit" class="edit-profile-btn">Save Changes</button>
        </form>
    </div>

    <script> // From lab 9
        function makeRed(inputDiv) {
            inputDiv.style.borderColor = "#AA0000";
        }

        function removeErrorMessage() {
            let existingError = document.getElementById('passwordError');
            if (existingError) {
                existingError.remove();
            }
        }

        document.addEventListener("DOMContentLoaded", function () {
            const form = document.querySelector("form");
            form.addEventListener("submit", function (event) {
                const newPassword = document.getElementById('new_password');
                const confirmPassword = document.getElementById('new_pass-check');

                removeErrorMessage();
                if (newPassword.value !== confirmPassword.value) { // If passwords don't match
                    makeRed(newPassword);
                    makeRed(confirmPassword);

                    let errorMsg = document.createElement("p");
                    errorMsg.id = 'passwordError';
                    errorMsg.textContent = "Passwords need to match!";
                    errorMsg.style.color = 'red';

                    // Insert the error message after the confirm password field
                    confirmPassword.parentNode.insertBefore(errorMsg, confirmPassword.nextSibling);

                    event.preventDefault(); // Prevent form submission
                }
            });
        });
    </script>
</body>

</html>