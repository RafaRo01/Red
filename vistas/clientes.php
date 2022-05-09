<?php 
	session_start();
	if(isset($_SESSION['usuario'])){
		
 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Clientes</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
<div class="container">
<style> h1{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 50px;
  text-transform: uppercase; } </style>
			<h1 style="text-align: center;">Clientes</h1>
			<div class="row">

			<div class="col-sm-8">
					<div id="tablaClientesLoad"></div>
				</div>

				<div class="col-sm-4">
					<form id="frmClientes">
					<br> <br> <br>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre" placeholder="Nombre">
						<br>
						<input type="text" class="form-control input-sm" id="apellidos" name="apellidos" placeholder="Apellidos">
						<br>
						<input type="text" class="form-control input-sm" id="direccion" name="direccion" placeholder="Dirección">
						<br>
						<input type="text" class="form-control input-sm" id="email" name="email" placeholder="Email">
						<br>
						<input type="text" class="form-control input-sm" id="telefono" name="telefono" placeholder="Telefono">
						<br>
						<input type="text" class="form-control input-sm" id="rfc" name="rfc" placeholder="RFC">
						<br>
						<span class="btn btn-primary" id="btnAgregarCliente">Agregar</span>
					</form>
				</div>
				
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalClientesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<style> h4{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 20px;
  text-transform: uppercase; } </style>
						<h4 class="modal-title" id="myModalLabel">Actualizar cliente</h4>
					</div>
					<div class="modal-body">
						<form id="frmClientesU">
							<input type="text" hidden="" id="idclienteU" name="idclienteU">
							<style> .la{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 15px;
  text-transform: uppercase; } </style>
							<label class="la">Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
							<label class="la">Apellidos</label>
							<input type="text" class="form-control input-sm" id="apellidosU" name="apellidosU">
							<label class="la">Direccion</label>
							<input type="text" class="form-control input-sm" id="direccionU" name="direccionU">
							<label class="la">Email</label>
							<input type="text" class="form-control input-sm" id="emailU" name="emailU">
							<label class="la">Telefono</label>
							<input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU">
							<label class="la">RFC</label>
							<input type="text" class="form-control input-sm" id="rfcU" name="rfcU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAgregarClienteU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>


</body>
</html>

<script type="text/javascript">
		function agregaDatosCliente(idcliente){

			$.ajax({
				type:"POST",
				data:"idcliente=" + idcliente,
				url:"../procesos/clientes/obtenDatosCliente.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idclienteU').val(dato['id_cliente']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidosU').val(dato['apellido']);
					$('#direccionU').val(dato['direccion']);
					$('#emailU').val(dato['email']);
					$('#telefonoU').val(dato['telefono']);
					$('#rfcU').val(dato['rfc']);

				}
			});
		}

		function eliminarCliente(idcliente){
			alertify.confirm('¿Quieres borrar este cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcliente=" + idcliente,
					url:"../procesos/clientes/eliminarCliente.php",
					success:function(r){
						if(r==1){
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente Eliminado.");
						}else{
							alertify.error("Cliente no eliminado.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaClientesLoad').load("clientes/tablaClientes.php");

			$('#btnAgregarCliente').click(function(){

				vacios=validarFormVacio('frmClientes');

				if(vacios > 0){
					alertify.alert("Completa todos los Campos.");
					return false;
				}

				datos=$('#frmClientes').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/agregaCliente.php",
					success:function(r){

						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente Añadido.");
						}else{
							alertify.error("Cliente No Añadido.");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarClienteU').click(function(){
				datos=$('#frmClientesU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/actualizaCliente.php",
					success:function(r){

						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente Actualizado.");
						}else{
							alertify.error("Cliente No Actualizado.");
						}
					}
				});
			})
		})
	</script>


	<?php 
}else{
	header("location:../index.php");
}
?>