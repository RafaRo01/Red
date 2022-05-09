<?php 

	class conectar{
		private $servidor="localhost:3307";
		private $usuario="root";
		private $password="12345";
		private $bd="venta";

		public function conexion(){
			$conexion=mysqli_connect($this->servidor,
									 $this->usuario,
									 $this->password,
									 $this->bd);
			return $conexion;
		}
	}


 ?>