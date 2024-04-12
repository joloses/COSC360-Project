<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["post-title"]) && isset($_POST["post-content"]) && isset($_POST["post-topic"])) {
        require_once 'connectDB.php';

        $postTitle = $_POST["post-title"];
        $postContent = $_POST["post-content"];
        $postTopic = $_POST["post-topic"];
        $userId = $_POST["userId"];
        $postDate = date("Y-m-d"); // Assuming you want to use the current date as the post date

        $sql = $connection->prepare("INSERT INTO Post (`postTitle`, `topic`, `postContent`, `postDate`, `userId`) VALUES (?, ?, ?, ?, ?)");
        if (!$sql) {
            die("Error in SQL query: " . $connection->error);
        }
    
        $sql->bind_param("sssss", $postTitle, $postTopic, $postContent, $postDate, $userId);

        if ($sql->execute()) {
            header("Location: home.php");
        } else {
            echo "Unable to create post.";
            echo "<br><br><a href='home.php'>Return to Home</a>";
        }

        $sql->close();
        mysqli_close($connection);
        die;
    } else {
        die("Information is not complete!");
    }
?>
