<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Ventas</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
<div class="container">
<style> h1{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 40px;
  text-transform: uppercase; } </style>
		 <h1 style="text-align: center;">Venta de productos</h1>
		 <div class="row">
		 	<div class="col-sm-12">
				 <br>
		 		<span class="btn btn-default" id="ventaProductosBtn">Vender producto</span>
		 		<span class="btn btn-default" id="ventasHechasBtn">Ventas hechas</span>
		 	</div>
		 </div>
		 <div class="row">
		 	<div class="col-sm-12">
		 		<div id="ventaProductos"></div>
		 		<div id="ventasHechas"></div>
		 	</div>
		 </div>
	</div>

</body>
</html>

<script type="text/javascript">
		$(document).ready(function(){
			$('#ventaProductosBtn').click(function(){
				esconderSeccionVenta();
				$('#ventaProductos').load('ventas/ventasDeProductos.php');
				$('#ventaProductos').show();
			});
			$('#ventasHechasBtn').click(function(){
				esconderSeccionVenta();
				$('#ventasHechas').load('ventas/ventasyReportes.php');
				$('#ventasHechas').show();
			});
		});

		function esconderSeccionVenta(){
			$('#ventaProductos').hide();
			$('#ventasHechas').hide();
		}

	</script>

<?php 
	}else{
		header("location:../index.php");
	}
 ?>