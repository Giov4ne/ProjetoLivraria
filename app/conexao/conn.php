<?php

    define('host', 'localhost');
    define('user', 'root');
    define('password', '');
    define('db_name', 'magic_world_bookstore');

    $conn = new mysqli(host, user, password, db_name);
    if($conn->connect_errno){
        echo "Falha ao conectar: ($conn->connect_errno) $conn->connect_error";
    }

?>