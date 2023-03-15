<?php

    if(!isset($_SESSION)){
        session_start();
    }

    $pagina = (empty($_SESSION['user'])) ? 'login.php' : 'home.php';

    header("location: ./$pagina");

?>