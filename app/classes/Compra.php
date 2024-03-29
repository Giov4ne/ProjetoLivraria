<?php

    class Compra{

        private $cod;
        private $dtComp;
        private $hrComp;
        private $valorTotal;
        private $formaPagamento;
        private $idUsuario;
        private $livros;

        public function __construct($cod, $dtComp, $hrComp, $formaPagamento, $idUsuario, $livros){
            $this->cod = $cod;
            $this->dtComp = $dtComp;
            $this->hrComp = $hrComp;
            $this->formaPagamento = $formaPagamento;
            $this->idUsuario = $idUsuario;
            $this->livros = $livros;
            $this->valorTotal = $this->calcularValorTotal();
        }

        private function calcularValorTotal(){
            $valorTotal = 0;
            foreach($this->livros as $livro){
                $valorTotal += $livro->preco;
            }
            return $valorTotal;
        }

        public function getCod(){
            return $this->cod;
        }

        public function getDtComp(){
            return $this->dtComp;
        }

        public function getHrComp(){
            return $this->hrComp;
        }

        public function getValorTotal(){
            return 'R$ ' . number_format($this->valorTotal,2,',','.');
        }

        public function getFormaPagamento(){
            return $this->formaPagamento;
        }

        public function setFormaPagamento($formaPagamento){
            $this->formaPagamento = $formaPagamento;
        }

        public function getIdUsuario(){
            return $this->idUsuario;
        }

        public function getLivros(){
            return $this->livros;
        }

    }

?>