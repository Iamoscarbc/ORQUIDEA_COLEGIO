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
      $codigo=trim($obj->real_escape_string(strip_tags($_POST['codigo'],ENT_QUOTES)));
      $nombres=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['nombres_apo'],ENT_QUOTES))));
      $apepat=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['apepat_apo'],ENT_QUOTES))));
      $apemat=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['apemat_apo'],ENT_QUOTES))));
      $dni=trim($obj->real_escape_string(strip_tags($_POST['DNI'],ENT_QUOTES)));
      $fec_nac=trim($obj->real_escape_string(strip_tags($_POST['fec_nac'],ENT_QUOTES)));
      $genero=trim($obj->real_escape_string(strip_tags($_POST['genero'],ENT_QUOTES)));
      $departamento=trim($obj->real_escape_string(strip_tags($_POST['departamento'],ENT_QUOTES)));
      $provincia=trim($obj->real_escape_string(strip_tags($_POST['provincia'],ENT_QUOTES)));
      $distrito=trim($obj->real_escape_string(strip_tags($_POST['distrito'],ENT_QUOTES)));
      $direccion=trim($obj->real_escape_string(strip_tags($_POST['direccion'],ENT_QUOTES)));
      $tel=trim($obj->real_escape_string(strip_tags($_POST['tel'],ENT_QUOTES)));
      $email=trim($obj->real_escape_string(strip_tags($_POST['email'],ENT_QUOTES)));
      $ocupacion=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['ocupacion'],ENT_QUOTES))));

      $sql="UPDATE apoderado SET codigo='$codigo', nombres_apo='$nombres', apepat_apo='$apepat', apemat_apo='$apemat', dni='$dni', fec_nacimiento='$fec_nac', genero='$genero', departamento='$departamento', provincia='$provincia', distrito='$distrito', direccion='$direccion', telefono ='$tel', email='$email', ocupacion='$ocupacion' WHERE idapo=$id";

         $obj->ejecutar($sql);
         echo"<script>
         alertify.alert('APODERADO', 'Se actualizo la informacion!', function(){
         alertify.success('Ok');
         self.location='apoderado.php';
         });
         </script>";
   }

   if($proceso=="Registrar"){
      $codigo=trim($obj->real_escape_string(strip_tags($_POST['codigo'],ENT_QUOTES)));
      $nombres=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['nombres_apo'],ENT_QUOTES))));
      $apepat=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['apepat_apo'],ENT_QUOTES))));
      $apemat=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['apemat_apo'],ENT_QUOTES))));
      $dni=trim($obj->real_escape_string(strip_tags($_POST['DNI'],ENT_QUOTES)));
      $genero=trim($obj->real_escape_string(strip_tags($_POST['genero'],ENT_QUOTES)));
      $departamento=trim($obj->real_escape_string(strip_tags($_POST['departamento'],ENT_QUOTES)));
      $provincia=trim($obj->real_escape_string(strip_tags($_POST['provincia'],ENT_QUOTES)));
      $distrito=trim($obj->real_escape_string(strip_tags($_POST['distrito'],ENT_QUOTES)));
      $direccion=trim($obj->real_escape_string(strip_tags($_POST['direccion'],ENT_QUOTES)));
      $fec_nac=trim($obj->real_escape_string(strip_tags($_POST['fec_nac'],ENT_QUOTES)));
      $tel=trim($obj->real_escape_string(strip_tags($_POST['tel'],ENT_QUOTES)));
      $email=trim($obj->real_escape_string(strip_tags($_POST['email'],ENT_QUOTES)));
      $ocupacion=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['ocupacion'],ENT_QUOTES))));

      $sql="INSERT INTO apoderado (codigo, nombre_apo, apepat_apo, apemat_apo, dni, genero, departamento, provincia, distrito, direccion, fec_nacimiento, telefono, email, ocupacion) VALUES ('$codigo', '$nombres', '$apepat', '$apemat', '$dni', '$genero', '$departamento', '$provincia', '$distrito', '$direccion', '$fec_nac','$tel','$email','$ocupacion')";

      $obj->ejecutar($sql);
         echo"
            <script>
                alertify.alert('APODERADO', 'Se ingreso nuevo apoderado satisfacoriamente!', function(){
                alertify.success('OK');
                self.location='../inscripciones/registrar_alumno.php';
                });
            </script>";
   }

   if($proceso=="Eliminar"){
     $id=trim($obj->real_escape_string(strip_tags($_POST['id'],ENT_QUOTES)));

     $sql="DELETE FROM apoderado WHERE idapo='".$obj->real_escape_string($id)."'";

     $obj->ejecutar($sql);
     echo"<script>
     alertify.alert('APODERADO', 'Se elimino los datos del apoderado satisfacoriamente!', function(){
       alertify.success('Realizado');
       self.location='apoderado.php';
       });
     </script>";
   }
?>
</body>