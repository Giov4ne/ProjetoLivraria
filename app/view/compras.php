<?php
    include('../conexao/conn.php');
    include('../classes/Usuario.php');
    include('../classes/Compra.php');

    if(!isset($_SESSION)){
        session_start();
    }
    if(!isset($_SESSION['user'])){
        header("location: ./login.php");
    }

    $id = explode('id', $_SESSION['user'])[1];
    $sql = "SELECT * FROM usuario WHERE id = $id";
    $result = $conn->query($sql)->fetch_object();
    $user = new Usuario($result->id, $result->nome, $result->genero, $result->dt_nasc, $result->email, $result->senha, $result->tipo);
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
                            $username = ($user->getTipo()==='admin') ? 'Admin' : explode(' ', $user->getNome())[0];
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
        <?php
            $sql = 'SELECT * FROM compra';
            $result = $conn->query($sql);
            if($result->num_rows > 0){

        ?>
        <h2 id="titulo-tabela">Compras</h2>
        <table>
            <tr>
                <th>Cód.</th>
                <th>Dt. Compra</th>
                <th>Hora da Compra</th>
                <th>Valor Total</th>
                <th>Forma de Pagamento</th>
                <th>Id Cliente</th>
                <th>Livros</th>
            </tr>
        <?php
                while($row = $result->fetch_object()){
                    $compra = new Compra($row->cod, $row->dt_comp, $row->hr_comp, $row->valor_total, $row->forma_pagamento, $row->id_usuario, '11111, 22222');
                    echo '
                        <tr>
                            <td>'.$compra->getCod().'</td>
                            <td>'.$compra->getDtComp().'</td>
                            <td>'.$compra->getHrComp().'</td>
                            <td>'.$compra->getValorTotal().'</td>
                            <td>'.$compra->getFormaPagamento().'</td>
                            <td>'.$compra->getIdUsuario().'</td>
                            <td>'.'11111, 22222'.'</td>
                        </tr>
                    ';
                }
                echo '</table>';
            } else{
                echo '<h2 id="titulo-tabela">Nenhuma compra foi realizada até o momento.</h2>';
            }
        ?>
    </body>
</html>