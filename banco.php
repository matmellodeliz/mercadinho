<?php

function obterConexao() {
    return pg_connect("host=localhost port=5432 user=usr_progweb password=123456 dbname=mercadinho");
}
session_start();

function listarCategoria() {
    $sql = "select * from categoria order by id";
    $resultado = pg_query(obterConexao(), $sql);
    $dados = pg_fetch_all($resultado);
    return $dados;  
}

function inserirCategoria($nome){
    $sql = "insert into categoria(nome) 
    values ('$nome');";
    $resultado = pg_query(obterConexao(), $sql);
    return ['sucesso' => pg_affected_rows($resultado) > 0];
}

function excluirCategoria($id) {
    $sql = "delete from categoria where id = $id";
    $resultado = @pg_query(obterConexao(), $sql);
    
    return ['sucesso' => $resultado && pg_affected_rows($resultado) > 0];
}

function editarCategoria($id, $nome) {
    $sql = "update categoria
     set nome='$nome' 
     where id=$id";
     $resultado = pg_query(obterConexao(), $sql);
     return ['sucesso' => pg_affected_rows($resultado) > 0];
}

function listarProdutos(){
    $sqlProduto = <<<SQL
    select produto.id, produto.nome,produto.preco, produto.id_categoria, categoria.nome as nome_categoria
        from produto 
        left join categoria on categoria.id = produto.id_categoria  order by produto.id;
    SQL;
    $resultado = pg_query(obterConexao(), $sqlProduto);
    $dados = pg_fetch_all($resultado);
    return $dados;
}
function inserirProduto($nome, $preco, $categoria){
    $sql = <<<SQL
    insert into produto(nome, preco, id_categoria) values ('$nome', $preco, $categoria);
    SQL;
    $resultado = pg_query(obterConexao(), $sql);
    return ['sucesso' => pg_affected_rows($resultado) > 0];


}
function excluirProduto($id){
    $sql = "delete from produto where id = $id";
    $resultado = pg_query(obterConexao(), $sql);
    return ['sucesso' => pg_affected_rows($resultado) > 0];
}

function editarProduto($id, $nome, $preco, $categoria) {
    $sql = "update produto
    set(nome, preco, id_categoria) = ('$nome', $preco, $categoria)
    where id = $id;";
     $resultado = pg_query(obterConexao(), $sql);
     return ['sucesso' => pg_affected_rows($resultado) > 0];
}

function listarUsuarios(){
    $sql ="select * from usuario order by id;";
    $resultado = pg_query(obterConexao(), $sql);
    $dados = pg_fetch_all($resultado);
    return $dados;
}

function verificarUsuario($login, $senha){
    $sql = "select * from usuario where login = '$login' and senha = md5('$senha');";
    $resultado = pg_query(obterConexao(), $sql);
    $dados = pg_fetch_all($resultado);
    return $dados;
}

function inserirUsuario($nome, $funcao, $login, $senha){
    $sql = "insert into usuario(nome, funcao, login, senha) values ('$nome', '$funcao', '$login', md5('$senha'));";
    $resultado = pg_query(obterConexao(), $sql);
    return ['sucesso' => pg_affected_rows($resultado) > 0];
}

function excluirUsuario($id){
    $sql = "delete from usuario where id = $id";
    $resultado = pg_query(obterConexao(), $sql);
    return ['sucesso' => pg_affected_rows($resultado) > 0];
}

function editarUsuario($id, $nome, $funcao, $login, $senha) {
    $sql = "update usuario
    set(nome, funcao, login, senha) = ('$nome', '$funcao', '$login', md5('$senha'))
    where id = $id;";
     $resultado = pg_query(obterConexao(), $sql);
     return ['sucesso' => pg_affected_rows($resultado) > 0];
}

function adicionarAoCarrinho($id_produto, $id_venda, $quantidade, $preco){
    $sql = <<<SQL
    INSERT INTO produto_venda(id_produto, id_venda, quantidade, preco) VALUES ($id_produto, $id_venda, $quantidade, $preco);
    SQL;
    $resultado = pg_query(obterConexao(), $sql);
    return ['sucesso' => pg_affected_rows($resultado) > 0];
}

function relatorioDia(){
    $sql ="SELECT sum(quantidade) as total_vendas, to_char(data_venda, 'DD/MM/YYYY') as dia
    FROM venda_produto inner join venda on venda_produto.id_venda = venda.id WHERE data_venda > (CURRENT_DATE - 30)
    group by dia;";
    $resultado = pg_query(obterConexao(), $sql);
    if(pg_affected_rows($resultado) > 0){
        $arr = [];
        while($row = pg_fetch_assoc($resultado)){
            $arr = array (
                'name' => $row['dia'],
                'data' => 
                array_map('intval', explode(',', $row['total_vendas']))
            );
            $series_array[] = $arr;
        }
    }
    return json_encode($series_array);
}

function relatorioMes(){
    $sql = "SELECT sum(quantidade) as total_vendas, to_char(data_venda, 'MM/YYYY') as mes
        FROM public.venda_produto inner join venda on venda_produto.id_venda = venda.id WHERE data_venda > (CURRENT_DATE - 360)
        group by mes, to_char(data_venda, 'YYYY') order by to_char(data_venda, 'YYYY'), mes;";
    $resultado = pg_query(obterConexao(), $sql);
    if(pg_affected_rows($resultado) > 0){
        while($row = pg_fetch_assoc($resultado)){
            $arr = array (
                'name' => $row['mes'],
                'data' => array_map('intval', explode(',', $row['total_vendas']))
            );
            $series_array[] = $arr;
        }
    }
    return $series_array;
}

function relatorioAno(){
    $sql = "SELECT sum(quantidade) as total_vendas, to_char(data_venda, 'YYYY') as ano
        FROM public.venda_produto inner join venda on venda_produto.id_venda = venda.id group by ano order by ano;";
    $resultado = pg_query(obterConexao(), $sql);
    if(pg_affected_rows($resultado) > 0){
        while($row = pg_fetch_assoc($resultado)){
            $arr = array (
                'name' => $row['ano'],
                'data' => array_map('intval', explode(',', $row['total_vendas']))
            );
        $series_array[] = $arr;
        }
    }
    return json_encode($series_array);
}

function relatorioMesProduto(){
    $sql = "SELECT quantidade, to_char(data_venda, 'MM/YYYY') as mes, produto.nome as nome_produto
    FROM public.venda_produto inner join venda on venda_produto.id_venda = venda.id
    inner join produto on venda_produto.id_produto = produto.id
    WHERE data_venda > (CURRENT_DATE - 360) and produto.nome = 'picanha'
    group by  quantidade, mes, to_char(data_venda, 'YYYY'), nome_produto order by to_char(data_venda, 'YYYY'), mes;";
    $resultado = pg_query(obterConexao(), $sql);
    if(pg_affected_rows($resultado) > 0){
        while($row = pg_fetch_assoc($resultado)){
            $arr = array (
                'name' => $row['mes'],
                'data' => array_map('intval', explode(',', $row['quantidade']))
            );
            $series_array[] = $arr;
        }
    }
    return $series_array;
}
