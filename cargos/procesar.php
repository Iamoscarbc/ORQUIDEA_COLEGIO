<head>
	<link rel="stylesheet" href="../plugins/alert/alertify/alertify.css">
	<link rel="stylesheet" href="../plugins/alert/alertify/themes/default.css">
	<script src="../plugins/alert/alertify/alertify.js"></script>
</head>
<body>
<?php
	include_once("../conexion/clsConexion.php");
	$obj= new clsConexion();

	if (isset($_GET['Eliminar'])) {
		$proceso_eliminar=$_GET['Eliminar'];

		if($proceso_eliminar=="Eliminar"){
			$id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idtipo'],ENT_QUOTES))));

			$sql= "DELETE  FROM tipo WHERE idtipo='".$obj->real_escape_string($id)."'";
			$obj->ejecutar($sql);
			echo"<script>
			   		alertify.alert('CARGOS','Registro Eliminado.', function(){
			  			alertify.message('OK');
						self.location='cargos.php';
		  		  	});
		</script>";
		}
	}

   if (isset($_POST["proceso"])) {
		$proceso=$_POST["proceso"];

		if($proceso=="Modificar"){
			$id=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['id'],ENT_QUOTES))));
			$descripcion=strtoupper(trim($obj->real_escape_string(htmlentities(strip_tags($_POST['descripcion'],ENT_QUOTES)))));

			$sql="UPDATE `tipo` SET `descripcion`='$descripcion' WHERE idtipo=$id";			
			$con =$obj->con;
			//  $obj->ejecutar($sql);
			
			mysqli_query($con,$sql);

			if(mysqli_affected_rows($con)<=0) {
				echo"<script>
				alertify.alert('TIPOS DE USUARIOS', 'No ha realizado ningún cambio', function(){
					alertify.success('OK');
					self.location='cargos_acciones.php?idtipo=$id';
					});
				</script>";
			}else{
			echo"<script>
					alertify.alert('TIPOS DE USUARIOS', 'Registro Actualizado!', function(){
					alertify.success('Ok');
					self.location='cargos.php';
					});
				  </script>";
			}
		}

		if($proceso=="Registrar"){
			$idtipo=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['idtipo'],ENT_QUOTES))));
			$descripcion=strtoupper(trim($obj->real_escape_string(htmlentities(strip_tags($_POST['descripcion'],ENT_QUOTES)))));
			
			$sql="INSERT INTO tipo(idtipo, descripcion) VALUES ('$idtipo', '$descripcion')";
			$obj->ejecutar($sql);
			echo"<script>
					alertify.alert('CARGOS', 'Registro Grabado!', function(){
					alertify.success('OK');
					self.location='cargos.php';
					});
				  </script>";
		}
	}
?>
</body>