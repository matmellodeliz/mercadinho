<?php 
require_once 'banco.php';
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

    <nav style="margin: 10px">
        <ul class="pagination">
          <li class="page-item"><a  style="font-size: 25px;" class="page-link" href="entrar.php">Voltar</a></li>
        </ul>
      </nav>
      <?php 
      if ($_SESSION['usuario']['funcao'] != 'gerente'){
        echo 'Permissão não concedida, procure um gerente';
      }
      else{
        echo '
        <div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
        <h2>Relatórios simples</h2>
        <form action="relatoriosSimples.php"><input type="submit" value="Relatórios simples" class="btn btn-primary mb-3"></form>
        </div>
        <div class="col-lg-6">
        <h2>Relatórios Highcharts</h2>
        <form action="relatorioDia.php"><input type="submit" value="Relatório por dia" class="btn btn-primary mb-3"></form>
        <form action="relatorioMes.php"><input type="submit" value="Relatório por mês" class="btn btn-primary mb-3"></form>
        <form action="relatorioAno.php"><input type="submit" value="Relatório por ano" class="btn btn-primary mb-3"></form>
        </div>
    </div>
</div>
        
        ';
      };
      ?>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
      crossorigin="anonymous"></script>
</html>