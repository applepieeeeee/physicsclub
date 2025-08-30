<?php
session_start();

require_once('../config/config.php');

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    $sql = "SELECT username, password FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $input_username);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($db_username, $db_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0) {
        if (password_verify($input_password, $db_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $db_username;
            header("Location: admin_dashboard.php");
            exit;
        }
    }
    header("Location: login.php?error=1");
    exit;

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset = "utf-8">
        <meta name = "viewport" content = "width=device-width, initial-scale=1">
        <title> bua physics club </title>
        <link rel = "preconnect" href = "https://fonts.googleapis.com">
        <link rel = "preconnect" href = "https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Google+Sans+Code:wght@400&display=swap" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        
    </head>
    <body>
        <h1> welcome to the bua physics club page! </h1>

        <div class = "login">
            <h2> admin login </h2>
            <form action = "login.php" method = "post">
                <label for = "username"> username: </label>
                <input type = "text" id = "username" name = "username" required>
                <label for = "password"> password :</label>
                <input type = "password" id = "password" name = "password" required>
                <button type = "submit"> login </button>
            </form>
            <?php
                if (isset($_GET['error'])) {
                    echo '<p class = "error"> invalid username or password. </p>';
                }
            ?>
        </div>
    </body>
</html>