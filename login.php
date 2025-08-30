<?php
session_start();

$servername = "localhost";
$username = "admin";
$password = "password";
$dbname = "physicsclub";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn -> connect_error){
    die("connected cailed: " . $conn -> connect_error);
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


?>