<?php
    include('../conexao/conn.php');
    include('../classes/Livro.php');
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
                        <span class="boas-vindas">Bem-vindo(a)</span>
                        <span class="boas-vindas">Username</span>
                    </div>
                </div>
                <img src="../icons/carrinho.svg" alt="carrinho" class="icones" id="carrinho">
            </div>
        </header>
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
                                echo '
                                    <li>
                                        <input type="checkbox" name="'.$row->genero.'" id="'.$row->genero.'">
                                        <label for="'.$row->genero.'">'.$row->genero.' ('.$row->qtd.')</label>
                                    </li>
                                ';
                            }
                        } else{
                            echo '<li>Não há registros.</li>';
                        }

                    ?>
                        <!-- <li>
                            <input type="checkbox" name="romance" id="romance">
                            <label for="romance">Romance</label>
                        </li> -->
                    </ul>
                    <div id="valor-min-max">
                        <label for="valor-min">De:</label>
                        <input type="number" name="valor-min" id="valor-min" placeholder="R$ 00,00">
                        <label for="valor-max">Até:</label>
                        <input type="number" name="valor-max" id="valor-max" placeholder="R$ 00,00">
                    </div>
                </div>
            </section>
            <section id="catalogo">
            <?php
            
                $sql = 'SELECT * FROM livro' . (!empty($_GET['search']) ? " WHERE titulo LIKE '%$_GET[search]%'" : '');
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
                                <div class="qtd-comp">
                                    <input type="number" name="qtd-livros" class="qtd-livros" value="1" min="1" max="'.$livro->getQtdEstoque().'">
                                    <button class="comprar-btn">Comprar</button>
                                </div>
                            </div>
                        ';
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