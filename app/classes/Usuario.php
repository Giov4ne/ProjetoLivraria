<?php

    class Usuario{

        private $id;
        private $nome;
        private $genero;
        private $dtNasc;
        private $email;
        private $senha;
        private $tipo;

        public function __construct($id, $nome, $genero, $dtNasc, $email, $senha, $tipo){
            $this->id = $id;
            $this->nome = $nome;
            $this->genero = $genero;
            $this->dtNasc = $dtNasc;
            $this->email = $email;
            $this->senha = $senha;
            $this->tipo = $tipo;
        }

        public function getId(){
            return $this->id;
        }

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = nome;
        }

        public function getGenero(){
            return $this->genero;
        }

        public function setGenero($genero){
            $this->genero = $genero;
        }

        public function getDtNasc(){
            return $this->dtNasc;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function setSenha($senha){
            $this->senha = $senha;
        }

        public function getTipo(){
            return $this->tipo;
        }

        public function setTipo($tipo){
            $this->tipo = $tipo;
        }

    }

?>