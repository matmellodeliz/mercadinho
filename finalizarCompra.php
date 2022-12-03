<?php
    require_once 'banco.php';
    echo '<pre>';
    $id_usuario = $_SESSION['usuario']['id'];
    $sql = <<<SQL
     select nextval('seq_venda') as id;
    SQL;
    $resultado = pg_query(obterConexao(), $sql);
    $id_venda = pg_fetch_row($resultado)[0];
    $sql = <<<SQL
     insert into venda(id,id_usuario) values ($id_venda, $id_usuario);
    SQL;
    $resultado = pg_query(obterConexao(), $sql);

    foreach($_SESSION['carrinho'] as $produto){
        $id_produto = $produto['idProduto'];
        $quantidade = $produto['quantidade'];
        $preco = $produto['precoUni'];
        $sql = <<<SQL
        insert into venda_produto(id_produto, id_venda, quantidade, preco) 
        values($id_produto, $id_venda, $quantidade, $preco);
        SQL;
        $resultado = pg_query(obterConexao(), $sql);
    };
    unset($_SESSION['carrinho']);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Final da compra</title>
</head>
<body>
    <h1>Venda finalizada!</h1>
    <nav style="margin: 10px">
        <ul class="pagination">
          <li class="page-item"><a  style="font-size: 25px;" class="page-link" href="entrar.php">Voltar</a></li>
        </ul>
      </nav>
</body>
</html>