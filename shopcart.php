<?php

include 'config.php';

ob_start();
include 'index.php';
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>shopcart</title>

<link rel="stylesheet" href="css/style.css">



<body>
<div class="container">
<div class="shopping_cart">
	<h1 class="heading" style="padding: 20px">Carrinho de compras</h1>
	
	<table>

	
	
	<tbody>
	
		<?php 
		$grand_total = 0;
		$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($select_menu) > 0) {
    while($fetch_cart = mysqli_fetch_assoc($cart_query)){

?>




        
        <tr>
		<div class="box">
        	<td><img src="images/<?php echo $fetch_cart['image']; ?>" height="90" width="100%" alt=""></td>
			</div>
			<div class="box">
        	<td style="font-weight: bold"><?php echo $fetch_cart['name']; ?></td>
			</div>
        	<td>R$ <?php echo $fetch_cart['price']; ?></td>
        	<td>
        		<form action="" method="post">
				<div class="box">
        			<input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id'] ?>"> Quantidade: 
					<input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
        			<input type="submit" name="update_cart" value="Atualizar" class="btn-green">
					</div>
        		</form>
        		</td>
        		<td>Subtotal: R$ <?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity'])?></td>
        		<td><a href="index.php?remove=<?php echo $fetch_cart['id']; ?>" class="btn-green" 
        		onclick="return confirm('Remover item do carrinho?');">Remover</a></td>
        	</tr>
        
		
	<?php
         $grand_total += $sub_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
		
     <tr class="table-bottom">
    
    <td colspan="4" style="font-weight: bold">Total da compra: R$ <?php echo $grand_total; ?></td>
	<td>
	<div>
	<a href="delivery.php" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Ir para pagamento</a></div></td>
    <td><a href="index.php?delete_all" onclick="return confirm('Remover todos do carrinho?');" 
	class="btn-wipe" <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>>Remover todos</a></td>
	<td><a href="index.php" class="btn-green");>Voltar</a></td>
	</tr>

		
    </tbody>
	</table>
	
	
	
</div>
</div>
</body>
</head>
</html>