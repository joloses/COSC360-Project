<?php
session_start(); // Start the session

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["postId"]) && isset($_POST["comment"])) {
    require_once 'connectDB.php';

    // Check if userId is set in the session
    if(isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId']; // Retrieve userId from the session
    } else {
        die("User not logged in!");
    }

    $postId = $_POST["postId"];
    $postComment = $_POST["comment"];

    //insert form inputs into comments
    $sql = $connection->prepare("INSERT INTO Comments (`commentBody`, `postId`, `userId`) VALUES (?, ?, ?)");

    if (!$sql) {
        die("Error in SQL query: " . $connection->error);
    }

    $sql->bind_param("sss", $postComment, $postId, $userId);

    if ($sql->execute()) { 
        //if successful, redirect to post page to see added comment
        header("Location: /COSC360-Project/source_code/postPage.php?postId=" . $postId);
        exit();
    } else {
        echo "Unable to create comment.";
        echo "<br><br><a href='/COSC360-Project/source_code/postPage.php?postId=" . $postId . "'>Return to Post</a>";
    }

    $sql->close();
    mysqli_close($connection);
    die;
} else {
    die("Information is not complete!");
}
?>
