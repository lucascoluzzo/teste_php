<?php

use PHPUnit\Framework\TestCase;
use App\Controller\ProdutoController;

class ProdutoControllerTest extends TestCase {
    
    public function testCadastrarProduto() {
        $controller = new ProdutoController();
        $result = $controller->cadastrarProduto("Novo Produto", 10.99, 1);
        $this->assertTrue($result);
    }

    public function testListarProdutos() {
        $controller = new ProdutoController();
        $result = $controller->listarProdutos();
        $this->assertIsArray($result);
    }

    public function testAtualizarProduto() {
        $controller = new ProdutoController();
        $result = $controller->editarProduto(1, "Nova Descrição", 15.99, 2);
        $this->assertTrue($result);
    }

    public function testExcluirProduto() {
        $controller = new ProdutoController();
        $result = $controller->excluirProduto(1);
        $this->assertTrue($result);
    }
}
