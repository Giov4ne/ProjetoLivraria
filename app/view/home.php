<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/style.css">
        <title>Magic World Bookstore</title>
    </head>
    <body>
        <header>
            <img src="../img/logo.png" alt="logo" id="logo">
            <div id="pesquisa">
                <input type="text" name="search" id="barra-pesquisa">
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
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
                <p>Produto</p>
            </section>
        </section>
        <button id="voltar" onclick="window.scroll({top: 0, behavior: 'smooth'})">Voltar ao início</button>
        <footer>Magic World Bookstore © 2023 - Todos os direitos reservados.</footer>
    </body>
</html>