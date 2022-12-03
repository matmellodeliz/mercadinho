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
    <link rel="stylesheet" href="CssRelatorios.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
        
    <title>Relatórios</title>
</head>
<body>
<nav style="margin: 10px">
        <ul class="pagination">
          <li class="page-item"><a  style="font-size: 25px;" class="page-link" href="relatorios.php">Voltar</a></li>
        </ul>
      </nav>
      
    <figure class="highcharts-figure">
        <div id="container"></div>
        
    </figure>
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
      crossorigin="anonymous"></script>
</html>
<script>
function relatorioAno() {
    fetch('http://localhost/mercadinho/backend.php?acao=relatorioAno')
    .then((response) => response.json())
    .then((dado) => {
        
    });
}

Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Relatório de Vendas'
    },
    subtitle: {
        text: 'Fonte: Mercadinho Ltda.'
    },
    xAxis: {
        categories: [
            ''
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Vendas'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} produtos</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: <?=relatorioAno()?>
});

</script>