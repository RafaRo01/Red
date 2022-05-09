
<?php 

require_once "../clases/Conexion.php";
 
require_once "../clases/Ventas.php";


$c= new conectar();
$conexion=$c->conexion();

$obj= new ventas();

$sql="SELECT id_venta,
			fechaCompra,
			id_cliente 
		from ventas group by id_venta";
$result=mysqli_query($conexion,$sql); 
?>

<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>
<!DOCTYPE html>
	<html>
	<head>
	<link rel="stylesheet" type="text/css" href="vistas/ho.css">
		<title>articulos</title>
		<?php require_once "menu.php"; ?>
		
	</head>
	<body>
	<div class="container">
			<style> h1{color: #6c2eb9;
  font-weight: normal;
  font-size: 40px;
  font-family: "Times New Roman", Times, serif;
  text-transform: uppercase; } </style>

<h1 style="text-align: center;">Reportes y ventas</h4>

<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
			<br><br><br>
			<style> .la{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 17px;
  text-transform: uppercase; 

  } </style>
				<tr class="la">
					<td>Núm. De Folio</td>
					<td>Fecha</td>
					<td>Total A Pagar</td>
					<td>Datos Del Cliente</td>
					<td>Reporte PDF</td>
					<td>Ticket PDF</td>
					
				</tr>
                <style> 
				 
				.ma{color: #008000;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 15px;
   

  } </style>
				<?php while($ver=mysqli_fetch_row($result)): ?>
				<tr>
					<td class="ma"><?php echo $ver[0] ?></td>
					<td class="ma"><?php echo $ver[1] ?></td>
					<td class="ma">
						<?php 
							echo "$".$obj->obtenerTotal($ver[0]);
						 ?>
					</td>
					<td class="ma">
						<?php
							if($obj->nombreCliente($ver[2])==" "){
								echo "S/C";
							}else{
								echo $obj->nombreCliente($ver[2]);
							}
						 ?>
					</td>
					
					
					<td class="ma">
						<a href="../procesos/ventas/crearReportePdf.php?idventa=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
							Reporte <span class="glyphicon glyphicon-file"></span>
						</a>	
					</td>
					<td class="ma">
						<a href="../procesos/ventas/crearTicketPdf.php?idventa=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
							Ticket <span class="glyphicon glyphicon-list-alt"></span>
						</a>
					</td>
				</tr>
		<?php endwhile; ?>
			</table>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>


<?php 
}else{
	header("location:../index.php");
}
?>