<?php

session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true){
    header("Location: login.php");
    exit;
}

echo "<h1> welcome to the admin dashboard!</h1>";
echo "<p> you are logged in as " . htmlspecialchars($_SESSION['username']) . "</p>";
echo '<a href = "logout.php">logout </a>';

?>