<?php

require_once __DIR__ . '/vendor/autoload.php';
use App\Controller\CategoriaController;
use App\Controller\ProdutoController;


    function listarCategoriasController() {
        $controller = new CategoriaController();
        return $controller->listarCategorias();
    }
    
    function cadastrarCategoriaController($nome) {
        $controller = new CategoriaController();
        return $controller->cadastrarCategoria($nome);
    }

    function listarProdutosController() {
        $controller = new ProdutoController();
        return $controller->listarProdutos();
    }

    function cadastrarProdutosController($descricao, $preco, $idCategoria) {
        $controller = new ProdutoController();
        return $controller->cadastrarProduto($descricao, $preco, $idCategoria);
    }

    function editarProdutosController($id, $descricao, $preco, $idCategoria) {
        $controller = new ProdutoController();
        return $controller->editarProduto($id, $descricao, $preco, $idCategoria);
    }

    function excluirProdutoController($id) {
        $controller = new ProdutoController();
        return $controller->excluirProduto($id);
    }


    $funcao = $_POST['funcao'];

    switch ($funcao) {
        case 'listarCategorias':
            echo listarCategoriasController();
            break;
        case 'addCategoria':
            echo cadastrarCategoriaController($_POST['nome']);
            break;
        case 'listarProdutos':
            echo listarProdutosController();
            break;
        case 'addProduto':
            echo cadastrarProdutosController($_POST['descricao'], $_POST['preco'], $_POST['id_categoria']);
            break;
        case 'editarProduto':
            echo editarProdutosController($_POST['id'], $_POST['descricao'], $_POST['preco'], $_POST['id_categoria']);
            break;
        case 'apagarProduto':
            echo excluirProdutoController($_POST['id']);
            break;
        default:
            return ['error' => 'Ação inválida'];
            break;
    }

?>
