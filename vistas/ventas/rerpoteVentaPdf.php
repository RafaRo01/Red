<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$objv= new ventas();


	$c=new conectar();
	$conexion= $c->conexion();	
	$idventa=$_GET['idventa'];

 $sql="SELECT ve.id_venta,
		ve.fechaCompra,
		ve.id_cliente,
		art.nombre,
        art.precio,
        art.descripcion
	from ventas  as ve 
	inner join articulos as art
	on ve.id_producto=art.id_producto
	and ve.id_venta='$idventa'";

$result=mysqli_query($conexion,$sql);

	$ver=mysqli_fetch_row($result);

	$folio=$ver[0];
	$fecha=$ver[1];
	$idcliente=$ver[2];

 ?>	

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Reporte</title>
 	<link rel="stylesheet" type="text/css" href="../../librerias/bootstrap/css/bootstrap.css">
 </head>
 <body>
 <style> .la{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 11px;
  text-transform: uppercase; } </style>

 		<br>
		 <table  style="border-collapse: collapse;" border="1">
 		<tr>
 				<td class="la">Folio: </td>
				 <td class="la">Fecha: </td>
				 <td class="la">Cliente: </td>
				 
			</tr>	
			<style> .ma{color: #008000;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 15px;
     } </style>
			<tr class="ma">
 		<td class="ma"><?php echo $folio ?></td>
 		<td class="ma"><?php echo $fecha; ?></td>
 		<td class="ma"><?php echo $objv->nombreCliente($idcliente); ?></td>
		
 </tr>
 		</table>
		 <style> .la2{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 11px;
 } </style>
<br>
<table  style="border-collapse: collapse;" border="1">
 			<tr>
 				<td class="la2">Producto</td>
 				<td class="la2">Precio</td>
 					<td class="la2">Descripcion</td>
					 <td class="la2">Cantidad</td>
 			</tr>

 			<?php 
 			$sql="SELECT ve.id_venta,
						ve.fechaCompra,
						ve.id_cliente,
						art.nombre,
				        art.precio,
				        art.descripcion
					from ventas  as ve 
					inner join articulos as art
					on ve.id_producto=art.id_producto
					and ve.id_venta='$idventa'";

			$result=mysqli_query($conexion,$sql);
			$total=0;
			while($mostrar=mysqli_fetch_row($result)):
 			 ?>

 			<tr>
 				<td class="ma"><?php echo $ver[3]; ?></td>
 				<td class="ma"><?php echo $ver[4]; ?></td>
 				<td class="ma"><?php echo $ver[5]; ?></td>
				 <td class="ma">1</td>
 			</tr>
 			<?php 
 				$total=$total + $ver[4];
 			endwhile;
 			 ?>
 			 <tr>
 			 	<td class="ma">Total=  <?php echo "$".$total; ?></td>
 			 </tr>
 		</table>
 </body>
 </html>