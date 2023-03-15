<?php
    include('../conexao/conn.php');
    if(!isset($_SESSION)){
        session_start();
    }
    if(!empty($_POST['email']) && !empty($_POST['senha'])){
        $sql = "SELECT * FROM usuario WHERE email = '$_POST[email]' AND senha = '$_POST[senha]'";
        $result = $conn->query($sql);
        if($result && $result->num_rows === 1){
            $_SESSION['user'] = 'id'.$result->fetch_object()->id;
            header("location: ./home.php");
        } else{
            echo '<script>alert("Email ou senha incorretos.")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../icons/logo-title.png">
    <title>Login</title>
</head>
<body>
    <form method="post" id="form-login">
        <h1>Acessar conta</h1>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>
        </div>
        <input type="submit" value="Entrar">
        <div>
            <p>Não possui conta? <a href="./cadastro.php">Cadastre-se</a></p>
        </div>
    </form>
</body>
</html>