<?php 
session_start();
if(isset($_SESSION['usuario']) and $_SESSION['usuario']=='admin'){
	?>


<!DOCTYPE html>
<html>
<head>
	<title>Usuarios</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
<div class="container">
<style> h1{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 40px;
  text-transform: uppercase; } </style>
			<h1 style="text-align: center;">Administrar usuarios</h1>
			<div class="row">

            <div class="col-sm-7">
					<div id="tablaUsuariosLoad"></div>
				</div>

				<div class="col-sm-4">
					<form id="frmRegistro">

				     	<br> <br> <br>
						<input type="text" class="form-control input-sm" name="nombre" id="nombre" placeholder="Nombre">
						<br>
						<input type="text" class="form-control input-sm" name="apellido" id="apellido" placeholder="Apellidos">
						<br>
						<input type="text" class="form-control input-sm" name="usuario" id="usuario" placeholder="Usuario">
						<br>
						<input type="text" class="form-control input-sm" name="password" id="password" placeholder="Contraseña">
						<br>
						<span class="btn btn-primary" id="registro">Registrar</span>

					</form>
				</div>

				
			</div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="actualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<style> h4{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 20px;
  text-transform: uppercase; } </style>

						<h4 class="modal-title" id="myModalLabel">Actualizar Usuarios</h4>
					</div>
					<div class="modal-body">
						<form id="frmRegistroU">
							<input type="text" hidden="" id="idUsuario" name="idUsuario">
							<style> .la{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 15px;
  text-transform: uppercase; } </style>
							<label class="la">Nombre</label>
							<input type="text" class="form-control input-sm" name="nombreU" id="nombreU" placeholder="Nombre">
							<label class="la">Apellido</label>
							<input type="text" class="form-control input-sm" name="apellidoU" id="apellidoU" placeholder="Apellido">
							<label class="la">Usuario</label>
							<input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU" placeholder="Usuario">

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnActualizaUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

</body>
</html>

<script type="text/javascript">
		function agregaDatosUsuario(idusuario){

			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario,
				url:"../procesos/usuarios/obtenDatosUsuario.php",
				success:function(r){
					dato=jQuery.parseJSON(r);

					$('#idUsuario').val(dato['id_usuario']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#usuarioU').val(dato['email']);
				}
			});
		}

		function eliminarUsuario(idusuario){
			alertify.confirm('¿Quieres eliminar este usuario?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario,
					url:"../procesos/usuarios/eliminarUsuario.php",
					success:function(r){
						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Usuario Eliminado");
						}else{
							alertify.error("Fallo al eliminar");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo !')
			});
		}


	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaUsuario').click(function(){

				datos=$('#frmRegistroU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/usuarios/actualizaUsuario.php",
					success:function(r){

						if(r==1){
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Usuario Actualizado");
						}else{
							alertify.error("No se pudo actualizar");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');

			$('#registro').click(function(){

				vacios=validarFormVacio('frmRegistro');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmRegistro').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/regLogin/registrarUsuario.php",
					success:function(r){
						//alert(r);

						if(r==1){
							$('#frmRegistro')[0].reset();
							$('#tablaUsuariosLoad').load('usuarios/tablaUsuarios.php');
							alertify.success("Usuario Añadido.");
						}else{
							alertify.error("No se pudo agregar.");
						}
					}
				});
			});
		});
	</script>

	<?php 
}else{
	header("location:../index.php");
}
?>