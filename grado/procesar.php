<head>
   <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="../plugins/alert/alertify/alertify.css">
   <link rel="stylesheet" href="../plugins/alert/alertify/themes/default.css">
   <script src="../plugins/alert/alertify/alertify.js"></script>
</head>
<body>
<?php
   // include("../seguridad.php");
   include_once("../conexion/clsConexion.php");
   $obj= new clsConexion();

   if (isset($_POST["proceso"])) {

     $proceso=$_POST["proceso"];
     
     if($proceso=="Modificar"){
        $id=trim($obj->real_escape_string(strip_tags($_POST['id'],ENT_QUOTES)));
        $descripcion=trim($obj->real_escape_string(strip_tags($_POST['descripcion'],ENT_QUOTES)));
        $id_nivel=trim($obj->real_escape_string(strip_tags($_POST['id_nivel'],ENT_QUOTES)));

        $sql="UPDATE `grado` SET `descripcion`='$descripcion', `idnivel`='$id_nivel' WHERE idgrado=$id";
        
        $con =$obj->con;
			//  $obj->ejecutar($sql);
			
			mysqli_query($con,$sql);

			if(mysqli_affected_rows($con)<=0) {
				echo"<script>
				alertify.alert('GRADO ACADEMICO', 'No ha realizado ningún cambio', function(){
					alertify.success('OK');
					self.location='grado_acciones.php?idgrado=$id';
					});
				</script>";
			}else{
        echo"<script>
        alertify.alert('GRADO ACADEMICO', 'Registro Actualizado!', function(){
        alertify.success('Ok');
        self.location='grado.php';
        });
        </script>";
      }
     }
     
      if($proceso=="Registrar"){      
        $descripcion=trim($obj->real_escape_string(strip_tags($_POST['descripcion'],ENT_QUOTES)));
        $id_nivel=trim($obj->real_escape_string(strip_tags($_POST['id_nivel'],ENT_QUOTES)));

        $sql="INSERT INTO `grado`(descripcion, idnivel) VALUES ('$descripcion', '$id_nivel')";

        $obj->ejecutar($sql);
        echo"<script>
        alertify.alert('GRADO ACADEMICO', 'Registro Grabado!', function(){
        alertify.success('OK');
        self.location='grado.php';
        });
        </script>";
      }
   }

   if (isset($_GET['Eliminar'])) {
    $proceso_eliminar=$_GET['Eliminar'];

    if($proceso_eliminar=="Eliminar"){
      $id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idgrado'],ENT_QUOTES))));

      $sql= "DELETE  FROM grado WHERE idgrado='".$obj->real_escape_string($id)."'";
      $obj->ejecutar($sql);
      echo"<script>
            alertify.alert('GRADO ACADEMICO','Registro Eliminado.', function(){
              alertify.message('OK');
            self.location='grado.php';
              });
    </script>";
    }
  }
?>
</body>