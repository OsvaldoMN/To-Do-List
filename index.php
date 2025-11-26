<?php
session_start();
include("connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];


if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}



$sql = "SELECT * FROM tasks WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

$tasks = [];
while ($row = mysqli_fetch_assoc($result)) {
    $tasks[] = [
    "id" => $row['id'],
    "task" => $row['task']
];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tarefas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <a href="?logout=1" class="logout-btn">⬅</a>
        <h1>To Do</h1>

        <p>Olá, <?php echo $_SESSION['username']; ?>!</p>

        <input type="text" placeholder="Adicione uma tarefa..." id="taskInput">
        <button onclick="addTask()">+</button>

        <ul id="taskList"></ul>
    </div>

    <script>
        
        const tasksFromDB = <?php echo json_encode($tasks); ?>;
    </script>
    <script src="script.js"></script>

</body>
</html>
