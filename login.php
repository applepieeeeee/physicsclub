<?php
session_start();

$servername = "localhost";
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$dbname = "physicsclub";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn -> connect_error){
    die("connection failed: " . $conn -> connect_error);
}

$input_username = $_POST['username'];
$input_password = $_POST['password'];

$sql = "SELECT username, password FROM admins WHERE username = ?";
$stmt = $conn -> prepare($sql);
$stmt -> bind_param("s", $input_username);

$stmt -> execute();
$stmt -> store_result();
$stmt -> bind_result($db_username, $db_password);
$stmt -> fetch();


if ($stmt -> num_rows > 0){
    if (password_verify($input_password, $db_password)){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $db_username;
        header("Location: admin_dashboard.php");
        exit;
    } else {
        header("Location: login.html?error=1");
        exit;
    }
} else {
    header("Location: login.html?error=1");
    exit;
}

$stmt->close();
$conn->close();

?>