<!DOCTYPE html>
<html>
<?php
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["post-title"]) && isset($_POST["post-content"])) {
        $host = "localhost";
        $database = "ddl360";
        $user = "webuser";
        $password = "P@ssw0rd";

        $connection = mysqli_connect($host, $user, $password, $database);
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $postTitle = $_POST["post-title"];
        $postContent = $_POST["post-content"];
        
        // Prepare the SQL statement
        $sql = $connection->prepare("INSERT INTO Post (`postTitle`, `postContent`) VALUES (?, ?)");
        if (!$sql) {
            die("Error in SQL query: " . $connection->error);
        }

        // Bind parameters
        $sql->bind_param("ss", $postTitle, $postContent);

        // Execute the statement
        if ($sql->execute()) {
            echo "Successfully added post!";
        } else {
            echo "Unable to create post.";
            echo "<br><br><a href='/COSC360-Project/home.php'>Return to Home</a>";
        }

        // Close statement and connection
        $sql->close();
        mysqli_close($connection);
        die;
    } else {
        die("Information is not complete!");
    }
?>
</html>
