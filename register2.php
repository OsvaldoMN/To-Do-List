<?php
include("connection.php");

if (isset($_POST['submit'])) {

    $username = $_POST['user'];
    $password = $_POST['pass'];

    
    if (empty($username) || empty($password)) {
        echo "<script>
                alert('Preencha todos os campos.');
                window.location.href = 'register.php';
              </script>";
        exit();
    }

    //verificação de 2 usuario com o mesmo nick
    $check = "SELECT * FROM login WHERE username='$username'";
    $result = mysqli_query($conn, $check);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>
                alert('Este nome de usuário já existe!');
                window.location.href = 'register.php';
              </script>";
        exit();
    }





    
    $sql = "INSERT INTO login (username, password) VALUES ('$username', '$password')";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Conta criada com sucesso!');
                window.location.href = 'login.php';
              </script>";
    } else {
        echo "<script>
                alert('Erro ao registrar. Tente novamente.');
                window.location.href = 'register.php';
              </script>";
    }
}
?>
