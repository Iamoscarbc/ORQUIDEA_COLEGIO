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

   $proceso=$_POST["proceso"];

   if($proceso=="Modificar"){
      $id=trim($obj->real_escape_string(strip_tags($_POST['id'],ENT_QUOTES)));
      $aula=trim($obj->real_escape_string(strip_tags($_POST['aula'],ENT_QUOTES)));
      $curso=trim($obj->real_escape_string(strip_tags($_POST['curso'],ENT_QUOTES)));
      $profesor=trim($obj->real_escape_string(strip_tags($_POST['docente'],ENT_QUOTES)));
      
      $sql="UPDATE cursos_profesor SET idaula='$aula', idcurso='$curso', idprof='$profesor' WHERE idcurso_prof=$id";

      $con =$obj->con;
      //  $obj->ejecutar($sql);
      
      mysqli_query($con,$sql);
  
      if(mysqli_affected_rows($con)<=0) {
         echo"<script>
         alertify.alert('PROGRAMACION ACADEMICA POR DOCENTE', 'No ha realizado ningún cambio', function(){
           alertify.success('OK');
           self.location='cursos_prof_acciones.php?idcurso_prof=$id';
           });
         </script>";
      }else{
         echo"<script>
         alertify.alert('PROGRAMACION ACADEMICA POR DOCENTE', 'Registro Actualizado!', function(){
         alertify.success('Ok');
         self.location='cursos_prof.php';
         });
         </script>";
      }
   }
   
   if($proceso=="Registrar"){
      $aula=trim($obj->real_escape_string(strip_tags($_POST['aula'],ENT_QUOTES)));
      $curso=trim($obj->real_escape_string(strip_tags($_POST['curso'],ENT_QUOTES)));
      $profesor=trim($obj->real_escape_string(strip_tags($_POST['docente'],ENT_QUOTES)));

      $sql="INSERT INTO cursos_profesor(idaula,idcurso,idprof) VALUES ('$aula', '$curso', '$profesor')";

      $obj->ejecutar($sql);
      echo"<script>
      alertify.alert('PROGRAMACION ACADEMICA POR DOCENTE', 'Registro Grabado!', function(){
      alertify.success('OK');
      self.location='cursos_prof.php';
      });
      </script>";
   }

   if($proceso=="Eliminar"){
     $id=trim($obj->real_escape_string(strip_tags($_POST['id'],ENT_QUOTES)));

     $sql="DELETE  FROM cursos_profesor WHERE idcurso_prof='".$obj->real_escape_string($id)."'";

     $obj->ejecutar($sql);
     echo"<script>
     alertify.alert('PROGRAMACION ACADEMICA POR DOCENTE', 'Se elimino la programacion satisfacoriamente!', function(){
       alertify.success('Realizado');
       self.location='cursos_prof.php';
       });
     </script>";
   }
?>
</body>