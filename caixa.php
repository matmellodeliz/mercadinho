
<?php 

require_once 'banco.php';
$categorias = listarCategoria();
$produtos = listarProdutos();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Caixa</title>
</head>
<body>
<nav style="margin: 10px">
        <ul class="pagination">
          <li class="page-item"><a  style="font-size: 25px;" class="page-link" href="entrar.php">Voltar</a></li>
        </ul>
      </nav>
    <h1>Este é o caixa</h1>
    <?php
            
            $preco = [];
            for($x=0; $x < sizeof($categorias) ; $x++) {
                echo "<form action='' method='post' id='FormCaixa'>";
                echo "<legend name='id[{$categorias[$x]['id']}]'> {$categorias[$x]['nome']}</legend>";
                echo "<select class='form-select mb-3' name='produto'>";
                foreach($produtos as $id => $produto){
                    if($categorias[$x]['nome'] == $produto['nome_categoria']){
                        echo "<option name='{$produto['id']}' value='{$produto['id']}'>{$produto['nome']} - R$ {$produto['preco']} a unidade</option>";
                        $preco[$produto['id']] = $produto['preco'];
                        $nome[$produto['id']] = $produto ['nome'];
                    }
                } 
                $y = $x + 1;
                echo "</select><input type='hidden' name='categoria' value='$y'>
                <label for='quantidade'>Quantidade</label>
                <input type='number' name='quantidade' id='quantidade' value='1' min='1'>
                <input type='submit' value='Adicionar ao carrinho' class='btn btn-primary mb-3'></form>";
                
            }
            
            if(isset($_SESSION['carrinho']) && (!empty($_POST))){
                $venda = array(
                    'idProduto' => $_POST['produto'],
                    'nomeProduto' => $nome[$_POST['produto']],
                    'quantidade' => $_POST['quantidade'],
                    'precoUni' => $preco[$_POST['produto']],
                    'idCategoria' => $_POST['categoria']
                );
                header("Location: http://localhost/mercadinho/caixa.php"); //limpar $_POST
                $encontrou = false;
                foreach($_SESSION['carrinho'] as $chave => $produto){
                    if($produto['idProduto'] == $venda['idProduto']){
                        $encontrou = true;
                        $_SESSION['carrinho'][$chave]['quantidade'] += $venda['quantidade'];
                    }
                    
                }
                if(!$encontrou){
                    array_push($_SESSION['carrinho'], $venda);
                }
                echo "<h3>Compras:</h3>";
                echo '<table class="table table-striped" id="tabela">';
                echo '<thead>';
                echo "<tr><th>Nome do Produto</th><th>Quantidade</th><th>Preço total</th><th>Ações</th></tr>";
                foreach($_SESSION['carrinho'] as $id => $compra){
                    $precoQnt = $compra['quantidade']*$compra['precoUni'];
                    echo "<tr><td>{$compra['nomeProduto']}</td><td>{$compra['quantidade']}</td><td>{$precoQnt}</td>
                    <td><form method='post' action='excluirItem.php?id=$id'><button type='submit' class='btn btn-danger'>excluir</button>
                    </form></td></tr>";
                }
                echo '</table><form action="limparCarrinho.php">
                <button type="submit" class="btn btn-danger mb-3">Limpar Carrinho</button>
                </form>
                <form action="finalizarCompra.php">
                <button type="submit" class="btn btn-danger mb-3">Finalizar compra</button>
                </form>';
            }
            elseif(isset($_SESSION['carrinho']) && sizeof($_SESSION['carrinho']) != 0 && (empty($_POST))){
                echo "<h3>Compras:</h3>";
                echo '<table class="table table-striped" id="tabela">';
                echo '<thead>';
                echo "<tr><th>Nome do Produto</th><th>Quantidade</th><th>Preço total</th><th>Ações</th></tr>";
                foreach($_SESSION['carrinho'] as $id => $compra){
                    $precoQnt = $compra['quantidade']*$compra['precoUni'];
                    echo "<tr><td>{$compra['nomeProduto']}</td><td>{$compra['quantidade']}</td><td>{$precoQnt}</td>
                    <td><form method='post' action='excluirItem.php?id=$id'><button type='submit' class='btn btn-danger'>excluir</button>
                    </form></td></tr>";
                }
                echo '</table><form action="limparCarrinho.php">
                <button type="submit" class="btn btn-danger mb-3">Limpar Carrinho</button>
                </form>
                <form action="finalizarCompra.php">
                <button type="submit" class="btn btn-danger mb-3">Finalizar compra</button>
                </form>';
            }
            else{
                $_SESSION['carrinho'] = [];
            }
        ?>
        
            
        
        
            
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</html>