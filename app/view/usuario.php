<?php
    include('../conexao/conn.php');
    include('../classes/Usuario.php');
    
    if(!isset($_SESSION)){
        session_start();
    }
    if(!empty($_REQUEST['action']) && $_REQUEST['action']==='logoff'){
        unset($_SESSION['user']);
    }
    if(!isset($_SESSION['user'])){
        header("location: ./login.php");
    }

    $id = explode('id', $_SESSION['user'])[1];
    $sql = "SELECT * FROM usuario WHERE id = $id";
    $result = $conn->query($sql)->fetch_object();
    $user = new Usuario($result->id, $result->nome, $result->genero, $result->dt_nasc, $result->email, $result->senha, $result->tipo);

    if(!empty($_GET['search'])){
        header("location: ./home.php?search=$_GET[search]#produtos");
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
            <script src="../js/script.js" defer></script>
            <title>Magic World Bookstore</title>
    </head>
<body>
    <header>
        <img src="../img/logo.png" alt="logo" id="logo" onclick="location.href='./home.php'">
        <form id="pesquisa">
            <input type="text" name="search" placeholder="Pesquisar em Magic World Bookstore..." id="barra-pesquisa">
            <img src="../icons/lupa.svg" alt="lupa" class="icones" id="lupa">
        </form>
        <div id="conta-carrinho">
            <div id="conta">
                <img src="../icons/conta.svg" alt="perfil" class="icones" id="perfil" onclick="location.href='./usuario.php'">
                <div>
                    <?php
                        if($user->getGenero() === 'masculino'){
                            $msgBoasVindas = 'Bem-vindo';
                        } else if($user->getGenero() === 'feminino'){
                            $msgBoasVindas = 'Bem-vinda';
                        } else{
                            $msgBoasVindas = 'Bem-vindo(a)';
                        }
                        $username = explode(' ', $user->getNome())[0];
                        echo '<span class="boas-vindas">'.$msgBoasVindas.',</span>';
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
                            <span onclick="abrirFecharMenu();location.href=\'./home.php#produtos\'">< Continuar comprando</span>
                        </div>
                    ';
                }
            ?>
            </div>
        </aside>
        <section id="usuario-info">
            <div>
                <h2>Seus dados</h2>
                <div>
                    <p>Nome: <?=$user->getNome()?></p>
                    <p>Gênero: <?=$user->getGenero()?></p>
                    <p>Data de nascimento: <span id="dt-nasc"></span></p>
                    <p>Idade: <span id="idade"></span></p>
                    <p>Email: <?=$user->getEmail()?></p>
                </div>
                <div class="center-btn">
                    <button onclick="location.href='?action=logoff'">Sair</button>
                </div>
            </div>
        </section>
        <script>
            const dtAtual = new Date();
            const dtNasc = new Date('<?=$user->getDtNasc()?>');
            let idade = dtAtual.getFullYear() - dtNasc.getFullYear();
            
            if(dtAtual.getMonth()+1 < dtNasc.getMonth()+1 || dtAtual.getMonth()+1 === dtNasc.getMonth()+1 && dtAtual.getDate() < dtNasc.getDate()){
                idade--;
            }

            document.querySelector('#dt-nasc').innerText = formatarData(dtNasc);
            document.querySelector('#idade').innerText = idade;

            function formatarData(dt){
                const dia = (dt.getDate()+1 < 10) ? '0'+(dt.getDate()+1) : dt.getDate()+1;
                const mes = (dt.getMonth()+1 < 10) ? '0'+(dt.getMonth()+1) : dt.getMonth()+1;
                const ano = dt.getFullYear();
                return dia + '/' + mes + '/' + ano;
            }
        </script>
</body>
</html>