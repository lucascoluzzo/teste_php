<?php

use PHPUnit\Framework\TestCase;
use App\Controller\CategoriaController;

class CategoriaControllerTest extends TestCase {
    public function testCadastrarCategoria() {
        $controller = new CategoriaController();
        $result = $controller->cadastrarCategoria("Nova Categoria 2");
        $this->assertTrue($result);
    }

    public function testListarCategorias() {
        $controller = new CategoriaController();
        $result = $controller->listarCategorias();
        $this->assertIsArray($result);
    }

    public function testAtualizarCategoria() {
        $controller = new CategoriaController();
        $result = $controller->editarCategoria(1, "Nova Categoria Atualizada");
        $this->assertTrue($result);
    }

    public function testExcluirCategoria() {
        $controller = new CategoriaController();
        $result = $controller->excluirCategoria(1);
        $this->assertTrue($result);
    }
}
