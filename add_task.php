<?php
session_start();
include("connection.php");
if (!isset($_SESSION['user_id'])) {
    exit("Not logged");
}
$user_id = $_SESSION['user_id'];
$task = $_POST['task'];

$sql = "INSERT INTO tasks (user_id, task) VALUES ('$user_id', '$task')";
mysqli_query($conn, $sql);
echo "OK";
?>
