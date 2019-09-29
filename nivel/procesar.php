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
			$id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idnivel'],ENT_QUOTES))));

			$sql= "DELETE  FROM nivel WHERE idnivel='".$obj->real_escape_string($id)."'";
			$obj->ejecutar($sql);
			echo"<script>
			   		alertify.alert('NIVEL EDUCATIVO','Registro Eliminado.', function(){
			  			alertify.message('OK');
						self.location='nivel.php';
		  		  	});
		</script>";
		}
	}

	if (isset($_POST["proceso"])) {
		$proceso=$_POST["proceso"];

		if($proceso=="Modificar"){
			$id=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['id'],ENT_QUOTES))));
			$descripcion=strtoupper(trim($obj->real_escape_string(htmlentities(strip_tags($_POST['descripcion'],ENT_QUOTES)))));

			$sql="UPDATE `nivel` SET `descripcion`='$descripcion' WHERE idnivel=$id";
			$con =$obj->con;
			//  $obj->ejecutar($sql);
			
			mysqli_query($con,$sql);

			if(mysqli_affected_rows($con)<=0) {
				echo"<script>
				alertify.alert('NIVEL EDUCATIVO', 'No ha realizado ningún cambio', function(){
					alertify.success('OK');
					self.location='nivel_acciones.php?idnivel=$id';
					});
				</script>";
			}else{
				echo"<script>
						alertify.alert('NIVEL EDUCATIVO', 'Registro Actualizado!', function(){
						alertify.success('Ok');
						self.location='nivel.php';
						});
					</script>";
			}
		}

		if($proceso=="Registrar"){
			$descripcion=strtoupper(trim($obj->real_escape_string(htmlentities(strip_tags($_POST['descripcion'],ENT_QUOTES)))));

			$sql="INSERT INTO `nivel`(`descripcion`)VALUES ('$descripcion')";
			$obj->ejecutar($sql);
			echo"<script>
					alertify.alert('NIVEL EDUCATIVO', 'Registro Grabado!', function(){
					alertify.success('OK');
					self.location='nivel.php';
					});
				  </script>";
		}
	}
?>
</body>