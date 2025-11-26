<?php
include("connection.php");
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
        <h1>Login</h1>
        <form name="form" action="login2.php" onsubmit="return isvalid()" method="POST">
            <h2>Usuário:</h2>
            <input type="text" placeholder="Nome" id="user" name="user">
            <h2>Senha:</h2>
            <input type="password" placeholder="********" id="pass" name="pass">
            <input type="submit" class="btn" value="Login" name="submit">
        </form>
        <p><a href="register.php">Registre-se</a></p>




    </div>
</body>

<script>
    function isvalid(){
        var user = document.form.user.value;
        var pass = document.form.pass.value;

        if (user.lenght===0 && pass.lenght===0 ){
            alert("Campos nome e senha estão vazios");
            return false;
        }
        else{
            if (user.lenght===0){
                alert("Campo nome está vazio");
                return false;
            }
            if (pass.lenght===0){
                alert("Campo senha está vazio");
                return false;
            }
         }
    }
</script>


</html>