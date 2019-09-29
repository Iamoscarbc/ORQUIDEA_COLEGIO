<head>
	<link rel="stylesheet" href="../plugins/alert/alertify/alertify.css">
	<link rel="stylesheet" href="../plugins/alert/alertify/themes/default.css">
	<script src="../plugins/alert/alertify/alertify.js"></script>
</head>
<body>
<?php
	include_once("../conexion/clsConexion.php");
	$obj= new clsConexion();	

   if (isset($_POST["proceso"])) {
		$proceso=$_POST["proceso"];

		if($proceso=="Modificar"){
			$id=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['id'],ENT_QUOTES))));
			$nivel=trim($obj->real_escape_string(strip_tags($_POST['id_nivel'],ENT_QUOTES)));
			$grado=trim($obj->real_escape_string(strip_tags($_POST['id_grado'],ENT_QUOTES)));
			$descripcion=strtoupper(trim($obj->real_escape_string(htmlentities(strip_tags($_POST['descripcion'],ENT_QUOTES)))));

			$sql="UPDATE cursos SET idnivel='$nivel', idgrado='$grado', descripcion='$descripcion' WHERE idcurso=$id";			
			
			$con =$obj->con;
			//  $obj->ejecutar($sql);
			
			mysqli_query($con,$sql);
	  
			if(mysqli_affected_rows($con)<=0) {
			   echo"<script>
			   alertify.alert('ASIGNATURA', 'No ha realizado ningún cambio', function(){
				  alertify.success('OK');
				  self.location='cursos_acciones.php?idcurso=$id';
				  });
			   </script>";
			}else{
			echo"<script>
					alertify.alert('ASIGNATURA', 'Registro Actualizado!', function(){
					alertify.success('Ok');
					self.location='cursos.php';
					});
				 </script>";
			}
		}

		if($proceso=="Registrar"){			
			$nivel=trim($obj->real_escape_string(strip_tags($_POST['id_nivel'],ENT_QUOTES)));
			$grado=trim($obj->real_escape_string(strip_tags($_POST['id_grado'],ENT_QUOTES)));
			$descripcion=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['descripcion'],ENT_QUOTES))));

			$sql="INSERT INTO cursos(idnivel, idgrado, descripcion) VALUES ('$nivel', '$grado', '$descripcion')";
			$obj->ejecutar($sql);
			echo"<script>
					alertify.alert('ASIGNATURAS', 'Registro Grabado!', function(){
					alertify.success('OK');
					self.location='cursos.php';
					});
				  </script>";
		}
	}

	if (isset($_GET['Eliminar'])) {

		$proceso_eliminar=$_GET['Eliminar'];

		if($proceso_eliminar=="Eliminar"){
			$id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idcurso'],ENT_QUOTES))));

			$sql= "DELETE  FROM cursos WHERE idcurso='".$obj->real_escape_string($id)."'";
			$obj->ejecutar($sql);
			echo"<script>
			   		alertify.alert('ASIGNATURA','Registro Eliminado.', function(){
			  			alertify.message('OK');
						self.location='cursos.php';
		  		  	});
		</script>";
		}
	}
?>
</body>