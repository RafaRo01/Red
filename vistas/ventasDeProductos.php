<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>

<?php 

require_once "../clases/Conexion.php";
$c= new conectar();
$conexion=$c->conexion();
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

<h1 style="text-align: center;">Vender Producto</h4>
<div class="row">

<div class="col-sm-7">
		<div id="tablaVentasTempLoad"></div>
	</div>

	<div class="col-sm-4">
		<form id="frmVentasProductos">
			<br> <br> <br>
			<select class="form-control input-sm" id="clienteVenta" name="clienteVenta" >
				<option value="A">Selecciona Cliente</option>
				<option value="0">Sin cliente</option>
				<?php
				$sql="SELECT id_cliente,nombre,apellido 
				from clientes";
				$result=mysqli_query($conexion,$sql);
				while ($cliente=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $cliente[0] ?>"><?php echo $cliente[2]." ".$cliente[1] ?></option>
				<?php endwhile; ?>

			</select>
			<br> <br>
			<select class="form-control input-sm" id="productoVenta" name="productoVenta">
				<option value="A">Selecciona Producto</option>
					<?php
				$sql="SELECT id_producto,
				nombre
				from articulos";
				$result=mysqli_query($conexion,$sql);

				while ($producto=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $producto[0] ?>"><?php echo $producto[1] ?></option>
				<?php endwhile; ?>
			</select>
			<br> <br>
			<textarea readonly="" id="descripcionV" name="descripcionV" class="form-control input-sm" placeholder="Descripción"></textarea>
			<br>
			<input readonly="" type="text" class="form-control input-sm" id="cantidadV" name="cantidadV" placeholder="Cantidad">
			<br>
			<input readonly="" type="text" class="form-control input-sm" id="precioV" name="precioV" placeholder="Precio">
			<br>
			<span class="btn btn-primary" id="btnAgregaVenta">Añadir</span>
			<span class="btn btn-danger" id="btnVaciarVentas">Eliminar</span>
		</form>
	</div>
	<div class="col-sm-3">
		<div id="imgProducto"></div>
	</div>
	
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");

		$('#productoVenta').change(function(){
			$.ajax({
				type:"POST",
				data:"idproducto=" + $('#productoVenta').val(),
				url: "../procesos/ventas/llenarFormProducto.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#descripcionV').val(dato['descripcion']);
					$('#cantidadV').val(dato['cantidad']);
					$('#precioV').val(dato['precio']);

					$('#imgProducto').prepend('<img class="img-thumbnail" id="imgp" src="' + dato['ruta'] + '" />');
				}
			});
		});

		$('#btnAgregaVenta').click(function(){
			vacios=validarFormVacio('frmVentasProductos');

			if(vacios > 0){
				alertify.alert("Completa todos los campos.");
				return false;
			}

			datos=$('#frmVentasProductos').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/ventas/agregaProductoTemp.php",
								success:function(r){
					$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
				}
			});
		});

		$('#btnVaciarVentas').click(function(){

		$.ajax({
			url: "../procesos/ventas/vaciarTemp.php",
						success:function(r){
				$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
			}
		});
	});

	});
</script>

<script type="text/javascript">
	function quitarP(index){
		$.ajax({
			type:"POST",
			data:"ind=" + index,
			url: "../procesos/ventas/quitarproducto.php",
							success:function(r){
				$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
				alertify.success("Producto Eliminado.");
			}
		});
	}

	function crearVenta(){
		$.ajax({
					url:"../procesos/ventas/crearVenta.php",
			success:function(r){
				if(r > 0){
					$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
					$('#frmVentasProductos')[0].reset();
					alertify.alert("Venta Efectuada, ir a la seccion de Ventas Hechas.");
				}else if(r==0){
					alertify.alert("No Hay Ninguna Venta.");
				}else{
					alertify.error("Venta No Efectuada.");
				}
			}
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#clienteVenta').select2();
		$('#productoVenta').select2();

	});
</script>


<?php 
}else{
	header("location:../index.php");
}
?>