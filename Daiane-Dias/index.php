<html>
<head><title>Pagina Principal</title>
<meta http-equiv="content=text/html;charset=utf-8">
<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
<style>
        html{
            color:  #8B0000;
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
monName = new Array ("janeiro", "fevereiro", "março", "abril", "maio", "junho","julho", "agosto","setembro", "outubro", "novembro", "dezembro")
now = new Date
</script>
</head>
<body>
<script language=javascript type="text/javascript">
document.write ("<h1> Hoje é " + dayName[now.getDay() ] + ", " + now.getDate () + " de " + monName [now.getMonth() ]   +  " de "  +     now.getFullYear () + ". </h1>")
</script>
<?php
require("conexao.php");
$resultado = mysqli_query($conexao,"select * from produto")
or die(mysqli_error());
while($ln = mysqli_fetch_array($resultado)){
	echo '<br/><hr>';
	echo '<h2>'.$ln['nome'].'</h2></br>';
	echo "Preço: R$".number_format($ln['preco'],2,',','.')."<br>";
	echo '<img src = "image/'.$ln['imagem'].'"/><br>';
	echo '<a href = "carrinho.php?acao=add&id='.$ln['id'].'">Comprar</a>';
	echo '<br/><hr>';
}
?>
</body>
</html>
