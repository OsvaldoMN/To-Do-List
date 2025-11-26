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
        <h1>Registre-se</h1>

        <form action="register2.php" method="POST">
            <h2>Usuário:</h2>
            <input type="text" placeholder="Nome" id="user" name="user">

            <h2>Senha:</h2>
            <input type="password" placeholder="********" id="pass" name="pass">

            <input type="submit" class="btn" value="Enviar" name="submit">
        </form>

        <p><a href="login.php">Já possui uma conta?</a></p>
    </div>
</body>
</html>
