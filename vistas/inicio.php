<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
	<?php require_once "menu.php"; ?>
	<link rel="stylesheet" type="text/css" href="../ind.css">
</head>
<body>
<style>
		p{
			text-align: center;
			color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 30px;
 
		}
		</style>
<p>Bienvenidos a R1, somos una empresa dedicada a las ventas. </p>


    <div class="box">
        <h2>R1</h2>
    </div>
	<br>



</body>
</html>
<?php 
	}else{
		header("location:../index.php");
	}
 ?>