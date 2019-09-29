<head>
   <link rel="stylesheet" href="../plugins/alert/alertify/alertify.css">
   <link rel="stylesheet" href="../plugins/alert/alertify/themes/default.css">
   <script src="../plugins/alert/alertify/alertify.js"></script>
</head>
<body>
   <?php
   //  include("../seguridad.php");
   include_once("../conexion/clsConexion.php");
   $obj= new clsConexion();
   $proceso=$_POST["proceso"];

   if($proceso=="Modificar"){
      $id=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['id'],ENT_QUOTES))));
      $codigo=trim($obj->real_escape_string(strip_tags($_POST['codigo'],ENT_QUOTES)));
      $nombres=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['nombres'],ENT_QUOTES))));
      $apepat=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['apepat'],ENT_QUOTES))));
      $apemat=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['apemat'],ENT_QUOTES))));
      $genero=trim($obj->real_escape_string(strip_tags($_POST['genero'],ENT_QUOTES)));
      $email=trim($obj->real_escape_string(strip_tags($_POST['email'],ENT_QUOTES)));
      $apoderado=trim($obj->real_escape_string(strip_tags($_POST['idapoderado'],ENT_QUOTES)));
      $dni=trim($obj->real_escape_string(strip_tags($_POST['DNI'],ENT_QUOTES)));      
      $fec_nac=trim($obj->real_escape_string(strip_tags($_POST['fec_nac'],ENT_QUOTES)));
      $departamento=trim($obj->real_escape_string(strip_tags($_POST['departamento'],ENT_QUOTES)));
      $provincia=trim($obj->real_escape_string(strip_tags($_POST['provincia'],ENT_QUOTES)));
      $distrito=trim($obj->real_escape_string(strip_tags($_POST['distrito'],ENT_QUOTES)));
      $direccion=trim($obj->real_escape_string(strip_tags($_POST['direccion'],ENT_QUOTES)));
      $telefono=trim($obj->real_escape_string(strip_tags($_POST['tel'],ENT_QUOTES)));
      $religion=trim($obj->real_escape_string(strip_tags($_POST['religion'],ENT_QUOTES)));      
      $parentesco=trim($obj->real_escape_string(strip_tags($_POST['parentesco'],ENT_QUOTES)));

      $sql="UPDATE alumno SET idapo='$apoderado', parentesco='$parentesco', nombres='$nombres', apepat_alu='$apepat', apemat_alu='$apemat', dni='$dni', fec_nacimiento='$fec_nac', genero='$genero', religion='$religion', direccion='$direccion', telefono='$telefono', email='$email', codigo='$codigo' where idalu=$id";

      
      $con =$obj->con;
      //  $obj->ejecutar($sql);
      
      mysqli_query($con,$sql);

      if(mysqli_affected_rows($con)<=0) {
         echo"<script>
         alertify.alert('ALUMNO', 'No ha realizado ningún cambio', function(){
            alertify.success('OK');
            self.location='alumno_acciones.php?idalu=$id';
            });
         </script>";
      }else{
         echo"<script>
         alertify.alert('ALUMNO', 'Registro Actualizado!', function(){
         alertify.success('Ok');
         self.location='alumno.php';
         });
         </script>";
      }
   }
   
   if($proceso=="Registrar"){
      $codigo=trim($obj->real_escape_string(strip_tags($_POST['codigo'],ENT_QUOTES)));
      $nombres=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['nombres'],ENT_QUOTES))));
      $apepat=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['apepat'],ENT_QUOTES))));
      $apemat=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['apemat'],ENT_QUOTES))));
      $genero=trim($obj->real_escape_string(strip_tags($_POST['genero'],ENT_QUOTES)));
      $email=trim($obj->real_escape_string(strip_tags($_POST['email'],ENT_QUOTES)));
      $apoderado=trim($obj->real_escape_string(strip_tags($_POST['idapoderado'],ENT_QUOTES)));
      $dni=trim($obj->real_escape_string(strip_tags($_POST['DNI'],ENT_QUOTES)));      
      $fec_nac=trim($obj->real_escape_string(strip_tags($_POST['fec_nac'],ENT_QUOTES)));
      $departamento=trim($obj->real_escape_string(strip_tags($_POST['departamento'],ENT_QUOTES)));
      $provincia=trim($obj->real_escape_string(strip_tags($_POST['provincia'],ENT_QUOTES)));
      $distrito=trim($obj->real_escape_string(strip_tags($_POST['distrito'],ENT_QUOTES)));
      $direccion=trim($obj->real_escape_string(strip_tags($_POST['direccion'],ENT_QUOTES)));
      $telefono=trim($obj->real_escape_string(strip_tags($_POST['tel'],ENT_QUOTES)));      
      $religion=trim($obj->real_escape_string(strip_tags($_POST['religion'],ENT_QUOTES)));      
      $parentesco=trim($obj->real_escape_string(strip_tags($_POST['parentesco'],ENT_QUOTES)));
      
      $sql="INSERT INTO alumno(idapo, parentesco, nombres, apepat_alu, apemat_alu, dni, fec_nacimiento, genero, religion, departamento, provincia, distrito, direccion, telefono, email, codigo) VALUES ('$apoderado', '$parentesco', '$nombres', '$apepat', '$apemat', '$dni', '$fec_nac', '$genero', '$religion', '$departamento', '$provincia', '$distrito','$direccion', '$telefono', '$email', '$codigo')";

      $obj->ejecutar($sql);
      echo"<script>
      alertify.alert('ALUMNO', 'Registro Grabado!', function(){
      alertify.success('Ok');
      self.location='../matricula/matricula_nuevo.php';
      });
      </script>";
   }

   if($proceso=="Eliminar"){
   $id=trim($obj->real_escape_string(strip_tags($_POST['id'],ENT_QUOTES)));
   $sql= "DELETE FROM alumno WHERE idalu='".$obj->real_escape_string($id)."'";
   $obj->ejecutar($sql);
   echo"<script>
   alertify.alert('ALUMNO','Registro Eliminado.', function(){
   alertify.message('OK');
   self.location='../alumno/alumno.php';
   });
   </script>";
   }
   ?>
</body>