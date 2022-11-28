<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$dbname = "loja";
$conexao = mysqli_connect($servidor,$usuario,$senha,$dbname);
if(!$conexao){
	die("Houve um erro na conexão: " .mysqli_connect_error());
}
?>