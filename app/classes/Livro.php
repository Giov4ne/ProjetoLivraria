<?php

    class Livro{

        private $cod;
        private $titulo;
        private $autor;
        private $genero;
        private $imagem;
        private $preco;
        private $qtdEstoque;

        public function __construct($cod, $titulo, $autor, $genero, $imagem, $preco, $qtdEstoque){
            $this->cod = $cod;
            $this->titulo = $titulo;
            $this->autor = $autor;
            $this->genero = $genero;
            $this->imagem = $imagem;
            $this->preco = $preco;
            $this->$qtdEstoque = $qtdEstoque;
        }

        public function getCod(){
            return $this->cod;
        }

        public function getTitulo(){
            return $this->titulo;
        }

        public function setTitulo($titulo){
            $this->titulo = $titulo;
        }

        public function getAutor(){
            return $this->autor;
        }

        public function setAutor($autor){
            $this->autor = $autor;
        }

        public function getGenero(){
            return $this->genero;
        }

        public function setGenero($genero){
            $this->genero = $genero;
        }

        public function getImagem(){
            return $this->imagem;
        }

        public function setImagem($imagem){
            $this->imagem = $imagem;
        }

        public function getPreco(){
            return 'R$ ' . number_format($this->preco,2,',','.');
        }

        public function setPreco($preco){
            $this->preco = $preco;
        }

        public function getQtdEstoque(){
            return $this->qtdEstoque;
        }

        public function setQtdEstoque($qtdEstoque){
            $this->qtdEstoque = $qtdEstoque;
        }

    }

?>