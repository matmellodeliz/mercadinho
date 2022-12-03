<?php
require_once 'banco.php';
$login = $_POST['login'];
$senha = $_POST['senha'];

$funcionario = "select * from usuario where login = '$login' and senha = md5('$senha')";
$consulta = pg_query(obterConexao(), $funcionario);
$resultado = pg_fetch_all($consulta);
var_dump($resultado);
if(pg_num_rows($consulta) > 0){
    $_SESSION['usuario'] = array(
        'id' => $resultado[0]['id'],
        'nome' => $resultado[0]['nome'],
        'funcao' => $resultado[0]['funcao']
        
    );
    header("Location: entrar.php");
}
if(pg_num_rows($consulta) == 0){
    echo "Dados inválidos!";
    session_destroy();
}

//session_destroy();
?>