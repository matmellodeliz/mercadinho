<?php
require_once 'banco.php';

$acao = $_REQUEST['acao'];

$resultado = '';

switch ($acao) {
    case 'verificarUsuario':
        $resultado = verificarUsuario($login, $senha);
    break;
    case 'listarCategoria':
        $resultado = listarCategoria();
    break;
    case 'inserirCategoria':
        if ($_SESSION['usuario']['funcao'] != 'gerente'){
            header('HTTP/1.0 401 Unauthorized');
        } else {
            $texto =  file_get_contents('php://input') ;
            $categoria = json_decode($texto, JSON_FORCE_OBJECT);
            $nome = $categoria['nome'];
            $resultado = inserirCategoria($nome);    
        }
    break;
    case 'excluirCategoria':
        if ($_SESSION['usuario']['funcao'] != 'gerente'){
            header('HTTP/1.0 401 Unauthorized');
        } else {
            $id = $_REQUEST['id'];
            $resultado = excluirCategoria($id);
        }
        
    break;
    case 'editarCategoria':
        if ($_SESSION['usuario']['funcao'] != 'gerente'){
            header('HTTP/1.0 401 Unauthorized');
        } else {
            $id = $_REQUEST['id'];
            $texto =  file_get_contents('php://input') ;
            $categoria = json_decode($texto, JSON_FORCE_OBJECT);
            $nome = $categoria['nome'];
            $resultado = editarCategoria($id, $nome);
        }
    break;  
    case 'listarProdutos':
        $resultado = listarProdutos();
    break;
    case 'inserirProduto':
        if ($_SESSION['usuario']['funcao'] != 'gerente'){
            header('HTTP/1.0 401 Unauthorized');
        } else {
            $texto =  file_get_contents('php://input') ;
            $produto = json_decode($texto, JSON_FORCE_OBJECT);
            $nome = $produto['nome'];
            $preco = $produto['preco'];
            $categoria = $produto['categoria'];
            $resultado = inserirProduto($nome, $preco, $categoria); 
        }
    break;
    case 'excluirProduto':
        if ($_SESSION['usuario']['funcao'] != 'gerente'){
            header('HTTP/1.0 401 Unauthorized');
        } else {
            $id = $_REQUEST['id'];
            $resultado = excluirProduto($id);
        }
    break;
    case 'editarProduto':
        if ($_SESSION['usuario']['funcao'] != 'gerente'){
            header('HTTP/1.0 401 Unauthorized');
        } else {
            $id = $_REQUEST['id'];
            $texto =  file_get_contents('php://input') ;
            $produto = json_decode($texto, JSON_FORCE_OBJECT);
            $nome = $produto['nome'];
            $preco = $produto['preco'];
            $categoria = $produto['categoria'];
            $resultado = editarProduto($id, $nome, $preco, $categoria);
        }
    break;
    case 'listarUsuarios':
        $resultado = listarUsuarios();
    break;
    case 'inserirUsuario':
        if ($_SESSION['usuario']['funcao'] != 'gerente'){
            header('HTTP/1.0 401 Unauthorized');
        } else {
            $texto =  file_get_contents('php://input') ;
            $usuario = json_decode($texto, JSON_FORCE_OBJECT);
            $nome = $usuario['nome'];
            $funcao = $usuario['funcao'];
            $login = $usuario['login'];
            $senha = $usuario['senha'];
            $resultado = inserirUsuario($nome, $funcao, $login, $senha); 
        }
    break;
    case 'excluirUsuario':
        if ($_SESSION['usuario']['funcao'] != 'gerente'){
            header('HTTP/1.0 401 Unauthorized');
        } else {
            $id = $_REQUEST['id'];
            $resultado = excluirUsuario($id);
        }
    break;
    case 'editarUsuario':
        if ($_SESSION['usuario']['funcao'] != 'gerente'){
            header('HTTP/1.0 401 Unauthorized');
        } else {
            $id = $_REQUEST['id'];
            $texto =  file_get_contents('php://input') ;
            $usuario = json_decode($texto, JSON_FORCE_OBJECT);
            $nome = $usuario['nome'];
            $funcao = $usuario['funcao'];
            $login = $usuario['login'];
            $senha = $usuario['senha'];
            $resultado = editarUsuario($id, $nome, $funcao, $login, $senha);
        }
    break;
    case 'relatorioDia':
        $resultado = relatorioDia();
    break;
    case 'relatorioMes':
        $resultado = relatorioMes();
    break;
    case 'relatorioAno':
        $resultado = relatorioAno();
    break;
}

echo json_encode($resultado);

?>