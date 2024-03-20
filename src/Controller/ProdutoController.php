<?php
namespace App\Controller;

use App\Model\Produto;
use PDO;
use App\Db\Connection;

class ProdutoController {
    private $db;

    public function __construct() {
        $this->db = Connection::make();
    }

    public function listarProdutos() {
        $query = "SELECT produtos.id, descricao, preco, cat.nome FROM produtos LEFT JOIN categorias cat ON produtos.categoria_id = cat.id";
        $stmt = $this->db->query($query);
        $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($produtos);
    }

    public function cadastrarProduto($descricao, $preco, $idCategoria) {
        $query = "INSERT INTO produtos (descricao, preco, categoria_id) VALUES (:descricao, :preco, :idCategoria)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':idCategoria', $idCategoria);
        return $stmt->execute();
    }

    public function editarProduto($id, $descricao, $preco, $idCategoria) {
        $query = "UPDATE produtos SET descricao = :descricao, preco = :preco, categoria_id = :idCategoria WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':idCategoria', $idCategoria);
        return $stmt->execute();
    }

    public function excluirProduto($id) {
        $query = "DELETE FROM produtos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
