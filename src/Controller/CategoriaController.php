<?php
namespace App\Controller;

use App\Model\Categoria;
use PDO;
use App\Db\Connection;

class CategoriaController {
    private $db;

    public function __construct() {
        $this->db = Connection::make();
    }

    public function listarCategorias() {
        $query = "SELECT * FROM categorias";
        $stmt = $this->db->query($query);
        $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($categorias);
    }

    public function cadastrarCategoria($nome) {
        $query = "INSERT INTO categorias (nome) VALUES (:nome)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nome', $nome);
        return $stmt->execute();
    }

    public function editarCategoria($id, $nome) {
        $query = "UPDATE categorias SET nome = :nome WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        return $stmt->execute();
    }

    public function excluirCategoria($id) {
        $query = "DELETE FROM categorias WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
