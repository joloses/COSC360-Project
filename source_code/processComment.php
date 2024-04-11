<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["postId"]) && isset($_POST["comment"])) {
        require_once 'connectDB.php';

        $postId = $_POST["postId"];
        $postComment = $_POST["comment"];
        $postDate = date("Y-m-d"); //Use the current date as the post date

        $sql = $connection->prepare("INSERT INTO Comments (`commentBody`, `postId`, `userId`) VALUES ( ?, ?, ?)");
        if (!$sql) {
            die("Error in SQL query: " . $connection->error);
        }
    
        $sql->bind_param("sss", $postComment, $postId, $userId);

        if ($sql->execute()) {
            header("Location: /COSC360-Project/source_code/postPage.php?postId=" . $postId);
             exit();
        } else {
            echo "Unable to create comment.";
            echo "<br><br><a href='/COSC360-Project/source_code/postPage.php?postId=" . $postId . ">Return to Post</a>";
        }

        $sql->close();
        mysqli_close($connection);
        die;
    } else {
        die("Information is not complete!");
    }
?>
