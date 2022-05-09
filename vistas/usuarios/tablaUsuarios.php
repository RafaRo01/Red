<?php 
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();

	$sql="SELECT id_usuario,
					nombre,
					apellido,
					email
			from usuarios";
	$result=mysqli_query($conexion,$sql);

 ?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<br><br><br>
	<style> .la{color: #6c2eb9;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 17px;
  text-transform: uppercase; 

  } </style>
	<tr class="la">
		<td>Nombre</td>
		<td>Apellido</td>
		<td>Usuario</td>
		<td>Editar</td>
		<td>Eliminar</td>
	</tr>

	<?php while($ver=mysqli_fetch_row($result)): ?>
		<style> .ma{color: #008000;
		font-family: "Times New Roman", Times, serif;
  font-weight: normal;
  font-size: 15px;
   

  } </style>

	<tr>
		<td class="ma"><?php echo $ver[1]; ?></td>
		<td class="ma"><?php echo $ver[2]; ?></td>
		<td class="ma"><?php echo $ver[3]; ?></td>
		<td>
			<span data-toggle="modal" data-target="#actualizaUsuarioModal" class="btn btn-warning btn-xs" onclick="agregaDatosUsuario('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarUsuario('<?php echo $ver[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>