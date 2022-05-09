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
 	<title>Ticket</title>
 	<style type="text/css">
		
@page {
            margin-top: 0.3em;
            margin-left: 0.6em;
        }
    body{
    	font-size: xx-small;
    }
	</style>

 </head>
 <body>
 <style> 
 .la{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 12px;
   } 
 .ma{color: blue;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 10px;
     } </style>
 		
 		<p class="ma"> Núm De Folio: <?php echo $folio ?></p>
 		<p class="ma">Cliente: <?php echo $objv->nombreCliente($idcliente); ?>  		</p>
 		<p class="ma">Fecha: <?php echo $fecha; ?> 		</p>
 		<table  style="border-collapse: collapse;" border="1">
 			<tr class="la">
 				<td>Nombre</td>
 				<td>Precio</td>
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
				while($mostrar=mysqli_fetch_row($result)){
 			 ?>
			  
 			<tr>
 				<td class="ma"><?php echo $mostrar[3]; ?></td>
 				<td class="ma"><?php echo $mostrar[4] ?></td>
 			</tr>
 			<?php
 				$total=$total + $mostrar[4];
 				} 
 			 ?>
 			 <tr>
 			 	<td class="ma">Total: <?php echo "$".$total ?></td>
 			 </tr>
 		</table>

 		
 </body>
 </html>
 