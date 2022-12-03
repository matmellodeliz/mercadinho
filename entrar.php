<?php 
session_start();
echo "<h1 style='padding-bottom: 40px'>Bem vindo ao mercadinho, {$_SESSION['usuario']['nome']}</h1>";
if(isset($_SESSION['carrinho'])){
    unset($_SESSION['carrinho']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Entrada</title>
</head>
<body style='padding: 40px'>

    <form action="caixa.php"><input type="submit" value="Caixa" class="btn btn-primary mb-3"></form>
    <form action="categoria.html"><input type="submit" value="Categorias" class="btn btn-primary mb-3"></form>
    <form action="produto.html"><input type="submit" value="Produtos" class="btn btn-primary mb-3"></form>
    <form action="usuario.html"><input type="submit" value="Usuários" class="btn btn-primary mb-3"></form>
    <form action="relatorios.php"><input type="submit" value="Relatórios" class="btn btn-warning mb-3"></form>
    <form action="index.html?acao=deslogar"><input type="submit" value="Deslogar" class="btn btn-danger mb-3"></form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
      crossorigin="anonymous"></script>
</html>