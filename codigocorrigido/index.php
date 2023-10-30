<?php 
include 'config.php';

$conn = mysqli_connect('localhost', 'root', '', 'shop_db') or die('Connection failed: ' . mysqli_connect_error());

session_start();


$user_id = $_SESSION['user_id'];


if(!isset($user_id)){
    header ('location:login.php');
    };
    if(isset($_GET['logout'])){
        unset($user_id);
        session_destroy();
        header ('location:login.php');
    };
    
    if(isset($_POST['add_to_cart'])){
        $menu_name = $_POST['menu_name'];
        $menu_price = $_POST['menu_price'];
        $menu_image = $_POST['menu_image'];
        $menu_quantity = $_POST['menu_quantity'];
    

        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$menu_name' AND user_id = '$user_id'") or die('query failed');
		
    
        if(mysqli_num_rows($select_cart) > 0){
            $message[] = 'Item já encontra-se no carrinho.';
        } else {
			mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$menu_name', '$menu_price', '$menu_image', '$menu_quantity')") 
		  or die('query failed');
          $message[] = 'Adicionado ao carrinho.';
            
        }
	};
        if(isset($_POST['update_cart'])){
            $update_quantity = $_POST['cart_quantity'];
            $update_id = $_POST['cart_id'];
            mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
            $message[] = 'Carrinho atualizado';
        }
        
        if(isset($_GET['remove'])){
            $remove_id = $_GET['remove'];
            mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
            header('location:index.php');
        }
        if(isset($_GET['delete_all'])){
            mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
            header('location:index.php');
        }
        
			
?>


<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>shopping cart</title>

<link rel="stylesheet" href="css/style.css">


</head>
<body>


<?php

if (isset($message)) {
    foreach ($message as $message) {
        echo '<div class="message" onclick="this.remove();">' . $message . '</div>';
    }
}

?>

<div class="container">

<div class="user-profile">

	<?php 
	
	$select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
	if(mysqli_num_rows($select_user) > 0) {
	    $fetch_user = mysqli_fetch_assoc($select_user);   
	};
	
	?>
	
	<p style="font-size: 30px; font-weight: bold; color:#5C4033; padding-bottom: 20px;" >Cafeteria Bom Sucesso</p>
	<p style="font-size: 20px; font-weight: bold; padding-bottom: 20px;">Bem-vindo(a), <span><?php echo $fetch_user['name']; ?></span>.</p>
	<div class="flex">
		<a href="index.php?logout=<?php echo $user_id; ?>"  class="btn-disc" onclick="return confirm('Deseja sair?');">Desconectar</a>
		
		<a href="shopcart.php" class="btn-wipe");>Carrinho 🛒</a>
		
	</div>
</div>

<div class ="menu">
	<h1 class="heading">Menu</h1>
<div class="box-container">

<?php 

$select_menu = mysqli_query($conn, "SELECT * FROM `menu`") or die('query failed');
if(mysqli_num_rows($select_menu) > 0) {
    while($fetch_menu = mysqli_fetch_assoc($select_menu)){

?>
	
	<form method="post" class="box" action="">
	
	
		<img src="images/<?php echo $fetch_menu['image']; ?>" alt="">
		<div class="menu_item"><?php echo $fetch_menu['name']; ?></div>
		<div class="menu_desc"><?php echo $fetch_menu['description']; ?></div>
		<div class="menu_warn"><?php echo $fetch_menu['foodwarning']; ?></div>
		<div class="price">R$ <?php echo $fetch_menu['price']; ?></div>
		<input type="hidden" name="menu_quantity" value="1">
		<input type="hidden" name="menu_image" value="<?php echo $fetch_menu['image']; ?> ">
		<input type="hidden" name="menu_name" value="<?php echo $fetch_menu['name']; ?> ">
		<input type="hidden" name="menu_price" value="<?php echo $fetch_menu['price']; ?> ">
		<input type="submit" value="Adicionar ao carrinho" name="add_to_cart" class="btn">
		
	
	</form>
	<?php
		}
}
?>


</div>

</div>

</div>

<div class="container">
<div class="user-profile" style="text-align: left">

<a href="sobre.php" style="font-size: 20px; margin-right: 10px">Sobre a cafeteria &nbsp&nbsp&nbsp&nbsp|</a>
<a href="faleconosco.php" style="font-size: 20px; margin-right: 10px">Fale conosco &nbsp&nbsp&nbsp&nbsp|</a>
<a href="termos.php" style="font-size: 20px; margin-right: 10px">Termos de uso &nbsp&nbsp&nbsp&nbsp|</a>
<a href="privacidade.php" style="font-size: 20px; margin-right: 10px">Privacidade &nbsp&nbsp&nbsp&nbsp|</a>
<p style="padding-top: 30px">Todos direitos reservados</p>
<p style="padding-top: 5px">© Copyright ............</p>
</div>
</div>


</body>
</html>