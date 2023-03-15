<?php
    include('../conexao/conn.php');
    if(!isset($_SESSION)){
        session_start();
    }
    if(!empty($_POST['nome']) && !empty($_POST['gen']) && !empty($_POST['dtnasc']) && !empty($_POST['email']) && !empty($_POST['senha'])){
        $sql = "INSERT INTO usuario(nome, genero, dt_nasc, email, senha, tipo) VALUES('$_POST[nome]', '$_POST[gen]', '$_POST[dtnasc]', '$_POST[email]', '$_POST[senha]', 'cliente')";
        $result = $conn->query($sql) or die('Não foi possível cadastrar');
        $sql = "SELECT id FROM usuario WHERE email = '$_POST[email]' AND senha = '$_POST[senha]'";
        $result = $conn->query($sql);
        $_SESSION['user'] = 'id'.$result->fetch_object()->id;
        header("location: ./home.php");
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
    <title>Cadastro</title>
</head>
<body>
    <form method="post" id="form-cadastro">
        <h1>Criar conta</h1>
        <div>
            <label for="nome">Nome completo</label>
            <input type="text" name="nome" id="nome" required>
        </div>
        <div>
            <label>Gênero</label>
            <section id="secao-gen">
                <div>
                    <input type="radio" name="gen" id="masc" value="masculino">
                    <label for="masc">Masculino</label>
                </div>
                <div>
                    <input type="radio" name="gen" id="fem" value="feminino">
                    <label for="masc">Feminino</label>
                </div>
                <div>
                    <input type="radio" name="gen" id="outro" value="outro">
                    <label for="masc">Outro</label>
                </div>
            </section>
        </div>
        <div>
            <label for="dtnasc">Data de Nascimento</label>
            <input type="date" name="dtnasc" id="dtnasc" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="senha" required>
        </div>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>