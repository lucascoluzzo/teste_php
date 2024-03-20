<?php
namespace App\Model;

class Produto {
    private $id;
    private $descricao;
    private $preco;
    private $idCategoria;

    public function __construct($descricao, $preco, $idCategoria) {
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->idCategoria = $idCategoria;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getDescricao() {
        return $this->descricao;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getIdCategoria() {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }
}
