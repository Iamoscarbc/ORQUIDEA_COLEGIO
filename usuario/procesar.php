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
      $nombres=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['nombres'],ENT_QUOTES))));
      $fec_nac=trim($obj->real_escape_string(strip_tags($_POST['fec_nac'],ENT_QUOTES)));
      $dni=trim($obj->real_escape_string(strip_tags($_POST['DNI'],ENT_QUOTES)));
      $estado=trim($obj->real_escape_string(strip_tags($_POST['estado'],ENT_QUOTES)));
      $departamento=trim($obj->real_escape_string(strip_tags($_POST['departamento'],ENT_QUOTES)));
      $provincia=trim($obj->real_escape_string(strip_tags($_POST['provincia'],ENT_QUOTES)));
      $distrito=trim($obj->real_escape_string(strip_tags($_POST['distrito'],ENT_QUOTES)));
      $direccion=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['direccion'],ENT_QUOTES))));      
      $clave=trim($obj->real_escape_string(strip_tags($_POST['clave'],ENT_QUOTES)));
      $email=trim($obj->real_escape_string(strip_tags($_POST['email'],ENT_QUOTES)));
      $fec_ing=trim($obj->real_escape_string(strip_tags($_POST['fec_ing'],ENT_QUOTES)));      
      $cargo=trim($obj->real_escape_string(strip_tags($_POST['cargo'],ENT_QUOTES)));
      $tel=trim($obj->real_escape_string(strip_tags($_POST['tel'],ENT_QUOTES)));

      $data=$obj->consultar("SELECT clave From usuario WHERE idusu='$id'");
      foreach ($data as $row) {
          $clave_bd=$row['clave'];
      }

      if ($clave!=$clave_bd) {
         $clavemd5 = md5($clave);

         $sql="UPDATE `usuario` SET `codigo`='$codigo',`nombres`='$nombres',fec_nacimiento='$fec_nac',`dni`='$dni', `estado`='$estado',`departamento`='$departamento',`provincia`='$provincia',`distrito`='$distrito',`direccion`='$direccion', `clave`='$clavemd5',`email`='$email',`fec_ingreso`='$fec_ing',`idcargo`='$cargo',`telefono`='$tel' WHERE idusu=$id";

         $obj->ejecutar($sql);
      } else {
        $sql="UPDATE `usuario` SET `codigo`='$codigo',`nombres`='$nombres',`dni`='$dni', fec_nacimiento='$fec_nac',`departamento`='$departamento',`provincia`='$provincia',`distrito`='$distrito',`direccion`='$direccion',`estado`='$estado',`email`='$email',`fec_ingreso`='$fec_ing',`idcargo`='$cargo',`telefono`='$tel' WHERE idusu=$id";

        $obj->ejecutar($sql);
      }

      

      $cargos_usuario=$obj->consultar("SELECT u.idusu AS idusu, c.descripcion AS cargo, u.nombres AS nombres FROM usuario u INNER JOIN cargos c ON u.idcargo = c.idcargo");
      foreach ($cargos_usuario as $row) {
         $id_usu=$row['idusu'];
         $cargo_usu=$row['cargo'];
         $nombres=$row['nombres'];
      }

      if ($cargo_usu == 'DOCENTE' AND $id_prof!=$id_usu) {
         $usuario_docentes=$obj->consultar("SELECT * FROM profesores");
         foreach ($usuario_docentes as $row) {
            $id_prof=$row['idprof'];
         }

         
            $sql_prof="INSERT INTO `profesores`(`idprof`,`nombre_prof`) VALUES ('$id_usu','$nombres')";
            $obj->ejecutar($sql_prof);
      }
      
      echo"<script>
         alertify.alert('USUARIO', 'Se actualizo la informacion!', function(){
         alertify.success('Ok');
         self.location='usuario.php';
         });
         </script>";
   }

   if($proceso=="Registrar"){
      $codigo=trim($obj->real_escape_string(strip_tags($_POST['codigo'],ENT_QUOTES)));
      $nombres=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['nombres'],ENT_QUOTES))));
      $dni=trim($obj->real_escape_string(strip_tags($_POST['DNI'],ENT_QUOTES)));
      $fec_nac=trim($obj->real_escape_string(strip_tags($_POST['fec_nac'],ENT_QUOTES)));
      $departamento=trim($obj->real_escape_string(strip_tags($_POST['departamento'],ENT_QUOTES)));
      $provincia=trim($obj->real_escape_string(strip_tags($_POST['provincia'],ENT_QUOTES)));
      $distrito=trim($obj->real_escape_string(strip_tags($_POST['distrito'],ENT_QUOTES)));
      $direccion=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['direccion'],ENT_QUOTES))));
      $estado=trim($obj->real_escape_string(strip_tags($_POST['estado'],ENT_QUOTES)));
      $clave=trim($obj->real_escape_string(strip_tags($_POST['clave'],ENT_QUOTES)));
      $email=trim($obj->real_escape_string(strip_tags($_POST['email'],ENT_QUOTES)));
      $fec_ing=trim($obj->real_escape_string(strip_tags($_POST['fec_ing'],ENT_QUOTES)));
      $cargo=trim($obj->real_escape_string(strip_tags($_POST['cargo'],ENT_QUOTES)));
      $tel=trim($obj->real_escape_string(strip_tags($_POST['tel'],ENT_QUOTES)));

      $clavemd5=md5($clave);
      $sql="INSERT INTO usuario (codigo, nombres, dni, fec_nacimiento, departamento, provincia, distrito, direccion, clave, email, fec_ingreso, idcargo, telefono , estado) VALUES ('$codigo','$nombres','$dni', '$fec_nac','$departamento','$provincia','$distrito','$direccion','$clavemd5','$email','$fec_ing','$cargo','$tel','$estado')";

      $obj->ejecutar($sql);

      $usu_prof=$obj->consultar("SELECT u.idusu AS idusu, c.descripcion AS cargo, u.nombres AS nombres FROM usuario u INNER JOIN cargos c ON u.idcargo = c.idcargo");
      foreach ($usu_prof as $row) {
          $id_usu=$row['idusu'];
          $cargo_usu=$row['cargo'];
          $nombres=$row['nombres'];
        }

      if ($cargo_usu == 'DOCENTE') {
        $sql_prof="INSERT INTO `profesores`(`idprof`,`nombre_prof`) VALUES ('$id_usu','$nombres')";
        $obj->ejecutar($sql_prof);
      }

      echo"<script>
         alertify.alert('USUARIO', 'Se ingreso nuevo usuario satisfacoriamente!', function(){
         alertify.success('OK');
         self.location='usuario.php';
         });
         </script>";
   }

   if($proceso=="Eliminar"){
     $id=trim($obj->real_escape_string(strip_tags($_POST['id'],ENT_QUOTES)));

     $sql="DELETE  FROM usuario WHERE idusu='".$obj->real_escape_string($id)."'";
     $obj->ejecutar($sql);

     echo"<script>
     alertify.alert('USUARIO', 'Se elimino al usuario satisfacoriamente!', function(){
       alertify.success('Realizado');
       self.location='usuario.php';
       });
     </script>";
   }
?>
</body>