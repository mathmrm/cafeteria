<?php
include 'config.php';
ob_start();
include 'index.php';
ob_end_clean();
ob_start();
include'shopcart.php';
ob_end_clean();


?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>delivery</title>

<link rel="stylesheet" href="css/style.css">


</head>
<body>


<div class="form-container">


		<form action="" method="post">
			<h3>Fale conosco</h3>
			<h4>Não coloque dados reais</h4>
			<input type="text" name="name" required placeholder="Nome" class="box"> 
			<input type="email" name="email" required placeholder="Insira e-mail" class="box"> 
			<input type="text" name="telephone" required placeholder="Telefone" class="box">
			<input type="checkbox" id="policy" name="policy" />
			<label for="policy">Aceito a política de privacidade.</label><br><br>
			<input type="submit" name="submit" class="btn" value="Enviar e-mail">
			<a href="index.php" class="btn-green">Voltar</a>
		</form>
	</div>

</body>
</html>