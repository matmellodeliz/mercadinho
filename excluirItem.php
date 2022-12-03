<?php 
session_start();

$id = $_REQUEST['id'];

excluirItem($id);

function excluirItem($id){
    unset($_SESSION['carrinho'][$id]);
    header("Location: http://localhost/mercadinho/caixa.php");
}
?>