<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Categorias.php";
	$id=$_POST['idcategoria'];

	$o= new categorias();
	echo $o->eliminaCategoria($id);

 ?>