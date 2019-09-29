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

      if($proceso=="Registrar"){
         // $idcalificacion = trim($obj->real_escape_string(strip_tags($_POST['id_matri'],ENT_QUOTES)));
         $periodo=trim($obj->real_escape_string(strip_tags($_POST['periodo'],ENT_QUOTES)));
         $curso=trim($obj->real_escape_string(strip_tags($_POST['curso'],ENT_QUOTES)));      
         $pb=trim($obj->real_escape_string(strip_tags($_POST['pb'],ENT_QUOTES)));     
         $sb=trim($obj->real_escape_string(strip_tags($_POST['sb'],ENT_QUOTES)));     
         $tb=trim($obj->real_escape_string(strip_tags($_POST['tb'],ENT_QUOTES)));
         $cb=trim($obj->real_escape_string(strip_tags($_POST['cb'],ENT_QUOTES)));
         $pf=trim($obj->real_escape_string(strip_tags($_POST['pf'],ENT_QUOTES)));
         $alumno=trim($obj->real_escape_string(strip_tags($_POST['alumno'],ENT_QUOTES)));

         $sql="INSERT INTO calificaciones ( periodo, idcurso, pb, sb, tb, cb, pf, alumno) VALUES ($periodo, $curso, $pb, $sb, $tb, $cb, $pf, $alumno)";
         // var_dump($sql);exit;
         $obj->ejecutar($sql);

         echo"<script>
         alertify.alert('CALIFICACIONES', 'Se ingreso correctamente la calificacion !', function(){
          alertify.success('Realizado');
          self.location='calificaciones.php';
          });
         </script>";
      }

      if($proceso=="Modificar"){
          $idcalificacion=trim($obj->real_escape_string(strip_tags($_POST['idcalifica'],ENT_QUOTES)));
          $periodo=trim($obj->real_escape_string(strip_tags($_POST['periodo'],ENT_QUOTES)));
          $curso=trim($obj->real_escape_string(strip_tags($_POST['curso'],ENT_QUOTES)));
          $pb=trim($obj->real_escape_string(strip_tags($_POST['pb'],ENT_QUOTES)));
          $sb=trim($obj->real_escape_string(strip_tags($_POST['sb'],ENT_QUOTES)));
          $tb=trim($obj->real_escape_string(strip_tags($_POST['tb'],ENT_QUOTES)));
          $cb=trim($obj->real_escape_string(strip_tags($_POST['cb'],ENT_QUOTES)));
          $pf=trim($obj->real_escape_string(strip_tags($_POST['pf'],ENT_QUOTES)));
          $alumno=trim($obj->real_escape_string(strip_tags($_POST['alumno'],ENT_QUOTES)));

         $sql="update calificaciones set periodo=$periodo, idcurso=$curso, pb=$pb, sb=$sb, tb=$tb, cb=$cb, pf=$pf, alumno=$alumno where idcalificacion=$idcalificacion";
         // var_dump($sql);exit;
         
         $con =$obj->con;
         //  $obj->ejecutar($sql);
         
         mysqli_query($con,$sql);

         if(mysqli_affected_rows($con)<=0) {
            echo"<script>
            alertify.alert('CALIFICACIONES', 'No ha realizado ningún cambio', function(){
               alertify.success('OK');
               self.location='calificaciones_acciones.php?idcalificacion=$idcalificacion';
               });
            </script>";
         }else{
            echo"<script>
            alertify.alert('CALIFICACIONES', 'Se actualizo correctamente la calificacion !', function(){
            alertify.success('Realizado');
            self.location='calificaciones.php';
            });
            </script>";
         }
      }
   }

   if (isset($_GET['Eliminar'])) {

      $proceso_eliminar=$_GET['Eliminar'];

      if($proceso_eliminar=="Eliminar"){
         $id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idcalificacion'],ENT_QUOTES))));

         $sql="DELETE FROM calificaciones WHERE idcalificacion='".$obj->real_escape_string($id)."'";
         $obj->ejecutar($sql);

         echo"<script>
         alertify.alert('CALIFICACIONES', 'Se elimino correctamente la calificacion!', function(){
            alertify.success('Realizado');
            self.location='calificaciones.php';
            });
         </script>";
      }
   }
?>
</body>