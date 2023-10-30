<?php
include 'config.php';

$conn = mysqli_connect('localhost', 'root', '', 'shop_db') or die('Connection failed: ' . mysqli_connect_error());

session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM `user_form` WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['id'];
		header('location:index.php');
    } else {
        $message[] = 'Senha ou E-mail inválidos';
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>login</title>

<link rel="stylesheet" href="css/style.css">


</head>
<body>

<?php

if (isset($message)) {
    foreach ($message as $message) {
     echo '<div class="message" onclick="this.remove();">' .$message. '</div>';
    }
}

?>
<div class="form-container">

		<form action="" method="post">
			<h3>Fazer Login</h3>
			<h4>Não coloque dados reais</h4>
			<input type="email" name="email" required placeholder="E-mail" class="box"> 
			<input type="password" name="password" required placeholder="Senha" class="box">
			<input type="submit" name="submit" class="btn" value="Entrar"> 
			<a href="register.php" class="btn">Criar conta</a>
		</form>
	</div>
</body>
</html>