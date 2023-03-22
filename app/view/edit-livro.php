<?php
    include('../conexao/conn.php');
    include('../classes/Livro.php');

    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['user'])){
        header("location: ./login.php");
    }
    if(!empty($_SESSION['cod']) && !empty($_POST['titulo']) && !empty($_POST['autor']) && !empty($_POST['genero']) && isset($_POST['imagem']) && !empty($_POST['preco']) && isset($_POST['qtd'])){
        if(empty($_POST['imagem'])){
            $img = $_SESSION['img'];
        } else{
            $img = $_POST['imagem'];
        }
        $sql = "UPDATE livro SET titulo = '$_POST[titulo]', autor = '$_POST[autor]', genero = '$_POST[genero]', imagem = '$img', preco = $_POST[preco], qtd_estoque = $_POST[qtd] WHERE cod = $_SESSION[cod]";
        $result = $conn->query($sql) or die('Não foi possível editar o livro');
        unset($_SESSION['cod']);
        unset($_SESSION['img']);
        header("location: ./home.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="../icons/logo-title.png">
        <script src="../js/script.js" defer></script>
        <title>Magic World Bookstore</title>
    </head>
    <body>
        <?php
            if(!empty($_REQUEST['action']) && $_REQUEST['action']==='edit' && !empty($_GET['cod'])){
                $sql = "SELECT * FROM livro WHERE cod = '$_GET[cod]'";
                $result = $conn->query($sql);
                $livro = $result->fetch_object();
        ?>
        <form method="post" id="form-edit-livro">
            <h1>Editar livro</h1>
            <div>
                <label for="cod">Código</label>
                <input type="number" name="codigo" id="cod" value="<?=$livro->cod?>" disabled>
            </div>
            <div>
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" value="<?=$livro->titulo?>" required>
            </div>
            <div>
                <label for="autor">Autor</label>
                <input type="text" name="autor" id="autor" value="<?=$livro->autor?>" required>
            </div>
            <div>
                <label for="genero">Gênero</label>
                <input type="text" name="genero" id="genero" value="<?=$livro->genero?>" required>
            </div>
            <div>
                <label for="imagem">Imagem</label>
                <input type="file" name="imagem" id="imagem" accept="image/*">
            </div>
            <div>
                <label for="preco">Preço</label>
                <input type="number" name="preco" id="preco" value="<?=$livro->preco?>" required>
            </div>
            <div>
                <label for="qtd">Quantidade em estoque</label>
                <input type="number" name="qtd" id="qtd" min="0" value="<?=$livro->qtd_estoque?>" required>
            </div>
            <div id="edit-cancel">
                <input type="submit" value="Editar">
                <button onclick="location.href='./home.php'">Cancelar</button>
            </div>
        </form>
        <?php
                $_SESSION['cod'] = $_GET['cod'];
                $_SESSION['img'] = $livro->imagem;
            } else{
                header("location: ./home.php");
            }
        ?>
    </body>
</html>