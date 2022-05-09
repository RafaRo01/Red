<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>categorias</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>

		<div class="container">
			<style> h1{color: #6c2eb9;
  font-weight: normal;
  font-size: 50px;
  font-family: "Times New Roman", Times, serif;
  text-transform: uppercase; } </style>
			<h1 style="text-align: center;">Categorías</h1>
			<div class="row">
			<div class="col-sm-7">
					<div id="tablaCategoriaLoad"></div>
				</div>

				<div class="col-sm-4">
					<form id="frmCategorias">
						<br><br>
						
						<input type="text" class="form-control input-sm" name="categoria" id="categoria" placeholder="Categoría">
						<br> <br>
						<span class="btn btn-primary" id="btnAgregaCategoria">Agregar</span>
					</form>
				</div>
				
			</div>
		</div>

		<!-- Button trigger modal -->

		<!-- Modal -->
		<div class="modal fade" id="actualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<style> h4{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 18.5px;
  text-transform: uppercase; } </style>
						<h4 class="modal-title" id="myModalLabel">Actualizar Categorias</h4>
					</div>
					<div class="modal-body">
						<form id="frmCategoriaU">
							<input type="text" hidden="" id="idcategoria" name="idcategoria">
							<style> .la{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 15px;
  text-transform: uppercase; } </style>
							<label class="la">Categoría</label>
							<input type="text" id="categoriaU" name="categoriaU" class="form-control input-sm" placeholder="Categoría">
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" id="btnActualizaCategoria" class="btn btn-warning" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");

			$('#btnAgregaCategoria').click(function(){

				vacios=validarFormVacio('frmCategorias');

				if(vacios > 0){
					alertify.alert("Completa todos los campos.");
					return false;
				}

				datos=$('#frmCategorias').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/categorias/agregaCategoria.php",
					success:function(r){
						if(r==1){
					//esta linea nos permite limpiar el formulario al insetar un registro
					$('#frmCategorias')[0].reset();

					$('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
					alertify.success("Categoria Añadida.");
				}else{
					alertify.error("Categoría No Añadida.");
				}
			}
		});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaCategoria').click(function(){

				datos=$('#frmCategoriaU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/categorias/actualizaCategoria.php",
					success:function(r){
						if(r==1){
							$('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
							alertify.success("Categoría Actualizada.");
						}else{
							alertify.error("Categoría No Actualizada.");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		function agregaDato(idCategoria,categoria){
			$('#idcategoria').val(idCategoria);
			$('#categoriaU').val(categoria);
		}

		function eliminaCategoria(idcategoria){
			alertify.confirm('¿Quieres borrar esta categoría?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcategoria=" + idcategoria,
					url:"../procesos/categorias/eliminarCategoria.php",
					success:function(r){
						if(r==1){
							$('#tablaCategoriaLoad').load("categorias/tablaCategorias.php");
							alertify.success("Categoría Borrada.");
						}else{
							alertify.error("Categoría No Eliminada.");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo.')
			});
		}
	</script>
	<?php 
}else{
	header("location:../index.php");
}
?>