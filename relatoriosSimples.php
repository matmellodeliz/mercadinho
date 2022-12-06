<?php
require_once 'banco.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  
  <title>Relatórios</title>
</head>

<body>
  <nav style="margin: 10px">
    <ul class="pagination">
      <li class="page-item"><a style="font-size: 25px;" class="page-link" href="relatorios.php">Voltar</a></li>
    </ul>
  </nav>

  <div class="container-fluid">
    <h1 style="text-align: center">Relatório de hoje</h1>
    <div class="row">
      <div class="col-lg-6">
        <h4>Por produto</h4>
        <table class="table table-striped" id="tabelaProdutosDia">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Quantidade</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="col-lg-6">
        <h4>Por categoria</h4>
        <table class="table table-striped" id="tabelaCategoriasDia">
          <thead>
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Quantidade</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <h1 style="text-align: center">Relatório do mês</h1>
    <div class="row">
      <div class="col-lg-6">
        <h4>Por produto</h4>
        <table class="table table-striped" id="tabelaProdutosMes">
          <thead>
            <tr>
              <th th scope="col">Dia</th>
              <th scope="col">Nome</th>
              <th scope="col">Quantidade</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="col-lg-6">
        <h4>Por categoria</h4>
        <table class="table table-striped" id="tabelaCategoriasMes">
          <thead>
            <tr>
              <th scope="col">Dia</th>
              <th scope="col">Nome</th>
              <th scope="col">Quantidade</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <h1 style="text-align: center">Relatório do ano</h1>
    <div class="row">
      <div class="col-lg-6">
        <h4>Por produto</h4>
        <table class="table table-striped" id="tabelaProdutosAno">
          <thead>
            <tr>
              <th th scope="col">Mês</th>
              <th scope="col">Nome</th>
              <th scope="col">Quantidade</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="col-lg-6">
        <h4>Por categoria</h4>
        <table class="table table-striped" id="tabelaCategoriasAno">
          <thead>
            <tr>
              <th scope="col">Mês</th>
              <th scope="col">Nome</th>
              <th scope="col">Quantidade</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

</html>
<?php
foreach (relatorioDeProdutosDoDia() as $produto) {
  $nome = $produto['nome_produto'];
  $quantidade = $produto['vendidos'];
  $p1 = "<script>document.querySelector('#tabelaProdutosDia > tbody').innerHTML += '<tr><td>";
  $p2 = "</td><td>";
  $p3 = "</td></tr>'</script>";
  echo $p1 . $nome . $p2 . $quantidade . $p3;
}
foreach (relatorioDeCategoriasDoDia() as $categoria) {
  $nome = $categoria['nome_categoria'];
  $quantidade = $categoria['vendidos'];
  $p1 = "<script>document.querySelector('#tabelaCategoriasDia > tbody').innerHTML += '<tr><td>";
  $p2 = "</td><td>";
  $p3 = "</td></tr>'</script>";
  echo $p1 . $nome . $p2 . $quantidade . $p3;
}

foreach (relatorioDeProdutosDoMes() as $produto) {
  $nome = $produto['nome_produto'];
  $quantidade = $produto['vendidos'];
  $dia = $produto['dia'];
  $p1 = "<script>document.querySelector('#tabelaProdutosMes > tbody').innerHTML += '<tr><td>";
  $p2 = "</td><td>";
  $p3 = "</td><td>";
  $p4 = "</td></tr>'</script>";
  echo $p1 . $dia . $p2 . $nome . $p3 . $quantidade . $p4;
}
foreach (relatorioDeCategoriasDoMes() as $categoria) {
  $nome = $categoria['nome_categoria'];
  $quantidade = $categoria['vendidos'];
  $dia = $categoria['dia'];
  $p1 = "<script>document.querySelector('#tabelaCategoriasMes > tbody').innerHTML += '<tr><td>";
  $p2 = "</td><td>";
  $p3 = "</td><td>";
  $p4 = "</td></tr>'</script>";
  echo $p1 . $dia . $p2 . $nome . $p3 . $quantidade . $p4;
}

foreach (relatorioDeProdutosDoAno() as $produto) {
  $nome = $produto['nome_produto'];
  $quantidade = $produto['vendidos'];
  $mes = $produto['mes'];
  $p1 = "<script>document.querySelector('#tabelaProdutosAno > tbody').innerHTML += '<tr><td>";
  $p2 = "</td><td>";
  $p3 = "</td><td>";
  $p4 = "</td></tr>'</script>";
  echo $p1 . $mes . $p2 . $nome . $p3 . $quantidade . $p4;
}
foreach (relatorioDeCategoriasDoAno() as $categoria) {
  $nome = $categoria['nome_categoria'];
  $quantidade = $categoria['vendidos'];
  $mes = $categoria['mes'];
  $p1 = "<script>document.querySelector('#tabelaCategoriasAno > tbody').innerHTML += '<tr><td>";
  $p2 = "</td><td>";
  $p3 = "</td><td>";
  $p4 = "</td></tr>'</script>";
  echo $p1 . $mes . $p2 . $nome . $p3 . $quantidade . $p4;
}

?>