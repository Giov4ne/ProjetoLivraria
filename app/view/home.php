<?php include('../conexao/conn.php') ?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
        <link rel="icon" href="../icons/logo-title.png">
        <title>Magic World Bookstore</title>
    </head>
    <body>
        <header>
            <img src="../img/logo.png" alt="logo" id="logo">
            <div id="pesquisa">
                <input type="text" name="search" placeholder="Pesquisar em Magic World Bookstore..." id="barra-pesquisa">
                <img src="../icons/lupa.svg" alt="lupa" class="icones" id="lupa">
            </div>
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
                        <li>
                            <input type="checkbox" name="romance" id="romance">
                            <label for="romance">Romance</label>
                        </li>
                        <li>
                            <input type="checkbox" name="suspense" id="suspense">
                            <label for="suspense">Suspense</label>
                        </li>
                        <li>
                            <input type="checkbox" name="terror" id="terror">
                            <label for="terror">Terror</label>
                        </li>
                        <li>
                            <input type="checkbox" name="acao" id="acao">
                            <label for="acao">Ação</label>
                        </li>
                        <li>
                            <input type="checkbox" name="comedia" id="comedia">
                            <label for="comedia">Comédia</label>
                        </li>
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

                $sql = 'SELECT * FROM livro';
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    while($row = $result->fetch_object()){
            ?>
                <div class="livro">
                    <img src="../img/livros/<?=$row->imagem?>" class="img-livro" alt="livro">
                    <div class="info-livro">
                        <h3 class="titulo-livro"><?=$row->titulo?></h3>
                        <p class="autor-livro">De: <?=$row->autor?></p>
                        <h2 class="valor-livro">R$ <?=number_format($row->preco,2,",",".")?></h2>
                    </div>
                    <div class="qtd-comp">
                        <input type="number" name="qtd-livros" class="qtd-livros" value="1" min="1" max="<?=$row->qtd_estoque?>">
                        <button class="comprar-btn">Comprar</button>
                    </div>
                </div>
            <?php
                    }
                } else{
                    echo '<p>Não há livros disponíveis no momento.</p>';
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
        <button id="voltar" onclick="window.scroll({top: 0, behavior: 'smooth'})">Voltar ao início</button>
        <footer>Magic World Bookstore © 2023 - Todos os direitos reservados.</footer>
    </body>
</html>