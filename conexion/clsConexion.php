<?php
class clsConexion {
	function __construct() {
		try {
	      //Datos de la conexion
			$host="localhost";
			$db_name="bdmatricula";
			$user="root";
			$pass="";
	      
	      //Cadena de conexion
			$this->con=mysqli_connect($host,$user,$pass) or die ("error en la conexion a la bd");
		   //Cadena de base de datos
		   mysqli_select_db($this->con,$db_name) or die("no se encontro la bd");

		   $this->con->set_charset("utf8");

		} catch(Exception $ex) {
			throw $ex;
		}
   }

	function consultar($sql) {
		$res=mysqli_query($this->con,$sql);
		$data=[];
		while($fila=mysqli_fetch_assoc($res)){
			$data[]=$fila;
		}

		return $data;

		mysqli_close($this->con,$sql);
	}

	function ejecutar($sql) {
		mysqli_query($this->con,$sql);

		if(mysqli_affected_rows($this->con)<=0) {
			("Error en: $sql: ".mysqli_error());
			echo "no se pudo realizar lo pedido";
		}
	}

   //seguridad mysqli_real_escape_string en poo
   public function real_escape_string($string) {
   	return $this->con->real_escape_string($string);
  	}
}
?>
