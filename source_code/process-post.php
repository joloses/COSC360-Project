<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["post-title"]) && isset($_POST["post-content"])) {
        require_once 'connectDB.php';

        $postTitle = $_POST["post-title"];
        $postContent = $_POST["post-content"];
        
     
        $sql = $connection->prepare("INSERT INTO Post (`postTitle`, `postContent`) VALUES (?, ?)");
        if (!$sql) {
            die("Error in SQL query: " . $connection->error);
        }

       
        $sql->bind_param("ss", $postTitle, $postContent);

       
        if ($sql->execute()) {
            echo "Successfully added post!";
        } else {
            echo "Unable to create post.";
            echo "<br><br><a href='/COSC360-Project/home.php'>Return to Home</a>";
        }

        
        $sql->close();
        mysqli_close($connection);
        die;
    } else {
        die("Information is not complete!");
    }
?>
