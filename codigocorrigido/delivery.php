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


<div class="container">

<div class="user-profile" style="font-size: 20px;">
Sucesso, sua compra em <?php echo $_POST["Payment"]; ?> no valor de R$ <?php echo $double_total; ?> foi realizada com sucesso, e será entregue.
<div style="padding-top: 40px;">
<a href="index.php" class="btn-disc";>Retornar</a>
</div>

</div>
</div>

</body>
</html>