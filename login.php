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

?>