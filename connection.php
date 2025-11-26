<?php
$servername = "127.0.0.1:3307"; 
$username = "root";
$password = "";
$db_name = "todo";

$conn = new mysqli($servername, $username, $password, $db_name);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
?>
