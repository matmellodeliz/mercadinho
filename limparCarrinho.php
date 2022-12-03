<?php 
session_start();

limparCarrinho();

function limparCarrinho(){
    unset($_SESSION['carrinho']);
    header("Location: http://localhost/mercadinho/caixa.php");
}
?>