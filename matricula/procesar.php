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

   if($proceso=="Registrar"){
      $periodo=trim($obj->real_escape_string(strip_tags($_POST['periodo'],ENT_QUOTES)));
      $numero_matricula=trim($obj->real_escape_string(strip_tags($_POST['matricula'],ENT_QUOTES)));
      $fecha_matricula=trim($obj->real_escape_string(strip_tags($_POST['fecha_matricula'],ENT_QUOTES)));
      $usuario=trim($obj->real_escape_string(strip_tags($_POST['usuario'],ENT_QUOTES)));
      $alumno=trim($obj->real_escape_string(strip_tags($_POST['alumno'],ENT_QUOTES)));
      $grado=trim($obj->real_escape_string(strip_tags($_POST['grado'],ENT_QUOTES)));
      $aula=trim($obj->real_escape_string(strip_tags($_POST['seccion'],ENT_QUOTES)));
      $observacion=trim($obj->real_escape_string(strip_tags($_POST['observacion'],ENT_QUOTES)));

      $query="SELECT idalumno From matricula WHERE idalumno=$alumno AND periodo='$periodo'";

      $result=$obj->consultar($query);
      foreach ((array)$result as $row) {
         $verficarMatricula=$row['idalumno'];
      }

      $result=$obj->consultar("SELECT vacantes From aula WHERE idaula='$aula'");
      foreach ((array)$result as $row) {
         $verficarVacantes=$row['vacantes'];
      }

      
      if($alumno==isset($verficarMatricula)){
         echo"<script>
         alertify.alert('MATRICULA', 'El estudiante ya se encuentra matriculado en el periodo actual', function(){
         alertify.success('Ok');
         self.location='matricula.php';
         });
         </script>";
      } elseif ($verficarVacantes <= 0) {
         echo"<script>
         alertify.alert('MATRICULA', 'No hay vacantes disponibles, por favor asigne otra aula', function(){
         alertify.success('Ok');
         self.location='matricula_nuevo.php';
         });
         </script>";
      } else {
         $matricular="INSERT INTO matricula (periodo, num_matricula, fec_matricula, usuario, idalumno, idgrado, idaula, observacion) 
         VALUES ('$periodo','$numero_matricula','$fecha_matricula','$usuario', $alumno,$grado,$aula,'$observacion')";

         $actualizarVacantes ="UPDATE aula SET vacantes=vacantes-1 where idaula='$aula'";

         // $actualizaInscripcion = "UPDATE alumno SET inscripcion='0' where idalu='$alumno'";

         $obj->ejecutar($matricular);
         $obj->ejecutar($actualizarVacantes);
         // $obj->ejecutar($actualizaInscripcion);
         echo"<script>
         alertify.alert('MATRICULA', 'La matricula se realizo correctamente', function(){
         alertify.success('Ok');
         self.location='matricula.php';
         });
         </script>";
      }
   }
   ?>
</body>