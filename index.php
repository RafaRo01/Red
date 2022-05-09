<?php 
	
	require_once "clases/Conexion.php";
	$obj= new conectar();
	$conexion=$obj->conexion();

	$sql="SELECT * from usuarios where email='admin'";
	$result=mysqli_query($conexion,$sql);
	$validar=0;
	if(mysqli_num_rows($result) > 0){
		$validar=1;
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login de usuario</title>
	<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
	<script src="librerias/jquery-3.2.1.min.js"></script>
	<script src="js/funciones.js"></script>
	<link rel="stylesheet" type="text/css" href="ind.css">
</head>
<body >
	<br><br><br>
	<div class="bod">
    <div class="box">
        <h2>R1</h2>
    </div>


	<div class="container">
		
		<div class="row">
		
		<div class="col-sm-3">
		
		</div>
			<div class="col-sm-4">
				<div class="panel panel-primary">
					<div class="panel panel-heading">Ventas R1</div>
					<div class="panel panel-body">
						
						<form id="frmLogin">
							
							<input type="text" class="form-control input-sm" name="usuario" id="usuario" placeholder="Nombre De Usuario">
							<br>
							
							<input type="password" name="password" id="password" class="form-control input-sm" placeholder="Contraseña">
							<p></p>
							<br>
							<span class="btn btn-primary btn-sm" id="entrarSistema">Entrar</span>
							<?php  if(!$validar): ?>
							<a href="registro.php" class="btn btn-danger btn-sm">Registrar</a>
							<?php endif; ?>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#entrarSistema').click(function(){

		vacios=validarFormVacio('frmLogin');

			if(vacios > 0){
				alert("Debes llenar todos los campos!!");
				return false;
			}

		datos=$('#frmLogin').serialize();
		$.ajax({
			type:"POST",
			data:datos,
			url:"procesos/regLogin/login.php",
			success:function(r){

				if(r==1){
					window.location="vistas/inicio.php";
				}else{
					alert("No se pudo acceder :(");
				}
			}
		});
	});
	});
</script>