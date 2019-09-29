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
      $id_select_grado=trim($obj->real_escape_string(strip_tags($_POST['grado'],ENT_QUOTES)));
      $turno=trim($obj->real_escape_string(strip_tags($_POST['turno'],ENT_QUOTES)));
      $nivel=trim($obj->real_escape_string(strip_tags($_POST['nivel'],ENT_QUOTES)));
      $seccion=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['seccion'],ENT_QUOTES))));
      $vacantes=trim($obj->real_escape_string(strip_tags($_POST['vacantes'],ENT_QUOTES)));

      $sql="UPDATE `aula` SET `idgrado`='$id_select_grado', `idnivel`='$nivel', `seccion`='$seccion', `turno`='$turno', vacantes='$vacantes' WHERE idaula=$id";

      $con =$obj->con;
      //  $obj->ejecutar($sql);
      
      mysqli_query($con,$sql);

      if(mysqli_affected_rows($con)<=0) {
         echo"<script>
         alertify.alert('GRADO ACADEMICO', 'No ha realizado ningún cambio', function(){
            alertify.success('OK');
            self.location='aula_grado_acciones.php?idaula=$id';
            });
         </script>";
      }else{
         echo"<script>
         alertify.alert('GRADO ACADEMICO', 'Registro Actualizado!', function(){
         alertify.success('Ok');
         self.location='../aula_grado/aula_grado.php';
         });
         </script>";
      }
   }
   
   if($proceso=="Registrar"){
      $nivel=trim($obj->real_escape_string(strip_tags($_POST['nivel'],ENT_QUOTES)));
      $id_select_grado=trim($obj->real_escape_string(strip_tags($_POST['grado'],ENT_QUOTES)));
      $turno=trim($obj->real_escape_string(strip_tags($_POST['turno'],ENT_QUOTES)));
      $seccion=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['seccion'],ENT_QUOTES))));
      $vacantes=trim($obj->real_escape_string(strip_tags($_POST['vacantes'],ENT_QUOTES)));

      $sql="INSERT INTO `aula`(idgrado,idnivel,seccion,turno,vacantes) VALUES ('$id_select_grado','$nivel','$seccion','$turno','$vacantes')";

      $obj->ejecutar($sql);
      echo"<script>
      alertify.alert('GRADO ACADEMICO', 'Registro Grabado!', function(){
      alertify.success('OK');
      self.location='../aula_grado/aula_grado.php';
      });
      </script>";
   }
}
   if($proceso=="Eliminar"){
     $id=trim($obj->real_escape_string(strip_tags($_POST['id'],ENT_QUOTES)));

     $sql="DELETE  FROM aula WHERE idaula='".$obj->real_escape_string($id)."'";

     $obj->ejecutar($sql);
     echo"<script>
     alertify.alert('GRADO ACADEMICO', 'Se elimino el aula satisfacoriamente!', function(){
       alertify.success('Realizado');
       self.location='../aula_grado/aula_grado.php';
       });
     </script>";
   }
?>
</body>