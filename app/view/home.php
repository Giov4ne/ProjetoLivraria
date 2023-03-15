<?php
    include('../conexao/conn.php');
    include('../classes/Livro.php');
    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['user'])){
        header("location: ./login.php");
    }
    if(!isset($_SESSION['prod'])){
        $_SESSION['prod'] = array();
    }
    if(!empty($_REQUEST['action']) && $_REQUEST['action']==='buy' && !empty($_GET['cod']) && !empty($_GET['qtd'])){
        echo "<script>
            setTimeout(()=>{
                document.querySelector('#carrinho').classList.add('carrinho-on');
                menuAberto = true;
            }, 100);
        </script>";
        $_SESSION['prod']["cod$_GET[cod]"] = "$_GET[cod], $_GET[qtd]";
    }
    if(!empty($_REQUEST['action']) && $_REQUEST['action']==='erase' && !empty($_GET['cod'])){
        unset($_SESSION['prod']["cod$_GET[cod]"]);
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="../icons/logo-title.png">
        <script src="../js/script.js" defer></script>
        <title>Magic World Bookstore</title>
    </head>
    <body>
        <header>
            <img src="../img/logo.png" alt="logo" id="logo">
            <form id="pesquisa">
                <input type="text" name="search" placeholder="Pesquisar em Magic World Bookstore..." id="barra-pesquisa">
                <img src="../icons/lupa.svg" alt="lupa" class="icones" id="lupa">
            </form>
            <div id="conta-carrinho">
                <div id="conta">
                    <img src="../icons/conta.svg" alt="perfil" class="icones" id="perfil">
                    <div>
                        <?php
                            $id = explode('id', $_SESSION['user'])[1];
                            $sql = "SELECT nome, genero FROM usuario WHERE id = $id";
                            $result = $conn->query($sql)->fetch_object();
                            if($result->genero === 'masculino'){
                                $msgBoasVindas = 'Bem-vindo';
                            } else if($result->genero === 'feminino'){
                                $msgBoasVindas = 'Bem-vinda';
                            } else{
                                $msgBoasVindas = 'Bem-vindo(a)';
                            }
                            $username = explode(' ', $result->nome)[0];
                            echo '<span class="boas-vindas">'.$msgBoasVindas.'</span>';
                            echo '<span class="boas-vindas">'.$username.'</span>';
                        ?>
                    </div>
                </div>
                <div id="carrinho-icon">
                    <span id="qtd-itens-car"><?=count($_SESSION['prod'])?></span>
                    <img src="../icons/carrinho.svg" alt="carrinho" class="icones" id="carrinho-icon-img">
                </div>
            </div>
        </header>
        <aside id="carrinho" class="carrinho-off">
            <div id="c1">
                <h2 id="titulo-carrinho">Meu Carrinho</h2>
                <button id="fecha-carrinho">X</button>
            </div>
            <div id="c2">
            <?php
                if(empty($_SESSION['prod'])){
                    echo '<div id="vazio">
                            <h3>Seu carrinho está vazio!</h3>
                            <p>Quando você escolher algum dos nossos <br>produtos, o mostraremos aqui :)</p>
                          </div>
                    ';
                } else{
                    echo '<ul>';
                    $subtotal = 0;
                    foreach($_SESSION['prod'] as $key => $value){
                        $cod = explode(', ', $_SESSION['prod'][$key])[0];
                        $qtd = explode(', ', $_SESSION['prod'][$key])[1];
                        $sql = "SELECT cod, titulo, preco, imagem FROM livro WHERE cod = $cod";
                        $result = $conn->query($sql);
                        $livro = $result->fetch_object();
                        $subtotal += $livro->preco * $qtd;
                        echo '
                            <li>
                                <div class="item">
                                    <img src="../img/livros/'.$livro->imagem.'" alt="'.$livro->titulo.'">
                                    <h3>'.$livro->titulo.'</h3>
                                    <p>'.$qtd.' unidades</p>
                                    <h4>R$ '.number_format($livro->preco,2,',','.').'</h4>
                                    <span onclick="location.href=\'./home.php?action=erase&cod='.$cod.'\'">Excluir</span>
                                </div>
                            </li>
                        ';
                    }
                    echo '</ul>';
                    echo '
                        <div id="compra">
                            <p>Subtotal: <strong>R$ '.number_format($subtotal,2,',','.').'</strong></p>
                            <button id="finalizar-comp-btn">Finalizar Compra</button>
                            <span onclick="abrirFecharMenu()">< Continuar comprando</span>
                        </div>
                    ';
                }
            ?>
            </div>
        </aside>
        <section id="banner">
            <img src="../img/banner.jpg" alt="banner" id="hero">
        </section>
        <section id="produtos">
            <section id="filtros">
                <div>
                    <p>Filtrar por:</p>
                    <ul>
                    <?php

                        $sql = 'SELECT DISTINCT genero, count(*) as qtd FROM livro GROUP BY genero';
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_object()){
                                if(!empty($_GET['generos']) && preg_match("/{$row->genero}/i", $_GET['generos'])){
                                    $atributo = 'checked';
                                } else{
                                    $atributo = '';
                                }
                                echo '
                                    <li>
                                        <input type="checkbox" class="genero" name="'.$row->genero.'" id="'.$row->genero.'" '.$atributo.'>
                                        <label for="'.$row->genero.'">'.$row->genero.' ('.$row->qtd.')</label>
                                    </li>
                                ';
                            }
                        } else{
                            echo '<li>Não há registros.</li>';
                        }

                    ?>
                    </ul>
                    <div id="valor-min-max">
                        <label for="valor-min">De:</label>
                        <input type="number" name="valor-min" id="valor-min" <?php if(!empty($_GET['min']) && !empty($_GET['max'])) echo "value='$_GET[min]'" ?> placeholder="R$ 00,00">
                        <label for="valor-max">Até:</label>
                        <input type="number" name="valor-max" id="valor-max" <?php if(!empty($_GET['max']) && !empty($_GET['min'])) echo "value='$_GET[max]'" ?> placeholder="R$ 00,00">
                    </div>
                    <button id="filtrar-btn">Filtrar</button>
                </div>
            </section>
            <section id="catalogo">
            <?php
            
                if(!empty($_REQUEST['action']) && $_REQUEST['action']==='filter' && (!empty($_GET['generos']) || !empty($_GET['min']) && !empty($_GET['max']))){
                    $complementoSql = '';
                    if(!empty($_GET['generos'])){
                        $generos = explode(',', $_GET['generos']);
                        $complementoSql = 'WHERE genero IN (';
                        foreach($generos as $key => $gen){
                            $complementoSql .= "'$gen'";
                            if($key < count($generos)-1){
                                $complementoSql .= ',';
                            } else{
                                $complementoSql .= ')';
                            }
                        }
                    }
                    if(!empty($_GET['min']) && !empty($_GET['max'])){
                        $complementoSql .= (!empty($_GET['generos'])) ?
                        " AND preco BETWEEN $_GET[min] AND $_GET[max]" :
                        "WHERE preco BETWEEN $_GET[min] AND $_GET[max]";
                    }
                    $sql = "SELECT * FROM livro $complementoSql";
                } else{
                    $sql = 'SELECT * FROM livro' . (!empty($_GET['search']) ? " WHERE titulo LIKE '%$_GET[search]%'" : '');
                }

                $result = $conn->query($sql);
                
                if($result->num_rows > 0){
                    while($row = $result->fetch_object()){
                        $livro = new Livro($row->cod, $row->titulo, $row->autor, $row->genero, $row->imagem, $row->preco, $row->qtd_estoque);
                        echo '
                            <div class="livro">
                                <img src="../img/livros/'.$livro->getImagem().'" class="img-livro" alt="livro">
                                <div class="info-livro">
                                    <h3 class="titulo-livro">'.$livro->getTitulo().'</h3>
                                    <p class="autor-livro">Por: '.$livro->getAutor().'</p>
                                    <h2 class="valor-livro">'.$livro->getPreco().'</h2>
                                </div>
                            ';
                        if($row->qtd_estoque > 0){
                            echo '
                                <div class="qtd-comp">
                                    <input type="number" name="qtd-livros" class="qtd-livros" value="1" min="1" max="'.$row->qtd_estoque.'" data-c="cod'.$livro->getCod().'">
                                    <button class="comprar-btn" data-c="cod'.$livro->getCod().'">Comprar</button>
                                </div>
                            </div>
                            ';
                        } else{
                            echo '
                                <div class="esgotado">
                                    <p>Esgotado</p>
                                </div>
                            </div>
                            ';
                        }
                    }
                } else{
                    echo (!empty($_GET['search'])) ? "Não há registros referentes a \"$_GET[search]\"" : 'Não há livros disponíveis';
                }
            
            ?>
                <!-- <div class="livro">
                    <img src="../img/livro.png" class="img-livro" alt="livro">
                    <div class="info-livro">
                        <h3 class="titulo-livro">Titulo do Livro</h3>
                        <p class="autor-livro">Por: Autor</p>
                        <h2 class="valor-livro">R$ 99,99</h2>
                    </div>
                    <div class="qtd-comp">
                        <input type="number" name="qtd-livros" class="qtd-livros" value="1" min="1">
                        <button class="comprar-btn">Comprar</button>
                    </div>
                </div> -->
            </section>
        </section>
        <button id="voltar">Voltar ao início</button>
        <footer>Magic World Bookstore © 2023 - Todos os direitos reservados.</footer>
    </body>
</html>