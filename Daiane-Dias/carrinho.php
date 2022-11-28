<?php
$conexao = mysqli_connect("localhost","root","","loja");
session_start();
if(!isset($_SESSION['carrinho'])){
	$_SESSION['carrinho'] = array();
} 
//adiciona produto
if(!isset($GET['acao'])){
//adiciona ao carrinho	
if($_GET['acao'] == 'add'){
	$id = intval($_GET['id']);
	if(!isset($_SESSION['carrinho'][$id])){
		$_SESSION['carrinho'][$id] = 1;
		}else{
			$_SESSION['carrinho'][$id] += 1;
		}
     }
}
//remove carrinho
if($_GET['acao'] == 'del'){
	$id = intval($_GET['id']);
	if(isset($_SESSION['carrinho'][$id])){
		unset($_SESSION['carrinho'][$id]);
	}	
}
//Altera quantidade
if($_GET['acao'] == 'up'){
	if(is_array($_POST['prod'])){
		foreach($_POST['prod'] as $id => $qtd){
			$id = intval($id);
			$qtd =  intval($qtd);
			if(!empty($qtd) || $qtd != 0){
				$_SESSION['carrinho'][$id]= $qtd;
			}else{
				unset($_SESSION['carrinho'][$id]);
			}
		}
	}
}
?>
<html>
<head>
<meta http-equiv="content-type" content ="text/html;charset=utf-8"/>
<title>Carrinho</title>
<link rel="stylesheet" href="css/estilo.css">
</head>
</body>
<style>
        html{
            color: #8B0000;
			font:arial;
			background-color: #b4e2c5;
        }
        p{
            font-size: large;
            color: #8B0000;
        }
        .color{
            color:rgb(196, 181, 43);
        }
    </style>
<script language=javascript type="text/javascript">
dayName = new Array ("domingo", "segunda", "terça", "quarta", "quinta", "sexta", "sábado")
monName = new Array ("janeiro", "fevereiro", "março", "abril", "maio", "junho","julho", "agosto", "setembro","outubro", "novembro", "dezembro")
now = new Date
</script>
</head>
<body>
<script language=javascript type="text/javascript">
document.write ("<h1> Hoje é " + dayName[now.getDay() ] + ", " + now.getDate () + " de " + monName [now.getMonth() ]   +  " de "  +     now.getFullYear () + ". </h1>")
</script>
<table border = 1>
<caption>Carrinho de Compras</caption>
<thread>
<tr>
<th width = "244">Produto</th>
<th width = "79">Quantidade</th>
<th width = "89">Preço</th>
<th width = "100">Subtotal</th>
<th width = "64">Remover</th>
</tr>
</thread>
<form action="?acao=up" method="POST">
<tfoot>
<tr>
<td colspan = "5"><input type="submit" value="Atualizar pagina"/></td>
</tr>
<tr>
<td><a href = "index.php">Continuar Comprando</a></td>
</tr>
</tfoot>
<tbody>
<?php
if(count($_SESSION['carrinho']) == 0){
	echo "<tr><td colspan = '5'>Não há produtos no carrinho</td></tr>";
}else{
	require("conexao.php");
	$total = 0;

foreach($_SESSION['carrinho'] as $id => $qtd){
	$resultado = mysqli_query($conexao,"select * from produto where id = '$id'")
or die ("Erro ao realizar busca.".mysqli_error());
while ($ln = mysqli_fetch_array($resultado)){
	 $nome =$ln['nome'];
	 $preco = number_format($ln['preco'],2,',','.');
	 $sub = number_format($ln['preco'] *  $qtd,2,',','.');
	 @$total += $sub;
	 echo '<tr><td>'.$nome.'</td><td><input type="text" size ="3"
	 name="prod['.$id.']" value="'.$qtd.'"></td><td>'.$preco.'</td>
	 <td>'.$sub.'</td><td><a href="?acao=del&id='.$id.'">Remover</a></td></tr>';
}	
}
$total = number_format($total,2,',','.');
echo "<tr>
<td colspan=4>Total</td>
<td>R$".$total."</td></tr>";
}
?>
</tbody>
</form>
</table>
</body>
</html>