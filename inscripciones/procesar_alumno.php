<head>
   <link rel="stylesheet" href="../plugins/alert/alertify/alertify.css">
   <link rel="stylesheet" href="../plugins/alert/alertify/themes/default.css">
   <script src="../plugins/alert/alertify/alertify.js"></script>
</head>
<body>
   <?php
   include_once("../conexion/clsConexion.php");
   $obj= new clsConexion();
   $proceso=$_POST["proceso"];

   if($proceso=="Modificar"){
      $id=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['id'],ENT_QUOTES))));
      $codigo=trim($obj->real_escape_string(strip_tags($_POST['codigo'],ENT_QUOTES)));
      $nombres=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['nombres'],ENT_QUOTES))));
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

      $sql="UPDATE alumno SET idapo='$apoderado', parentesco='$parentesco', nombres='$nombres', dni='$dni', fec_nacimiento='$fec_nac', genero='$genero', religion='$religion', direccion='$direccion', telefono='$telefono', email='$email', codigo='$codigo' where idalu=$id";

      $obj->ejecutar($sql);
      echo"<script>
      alertify.alert('ALUMNO', 'Registro Actualizado!', function(){
      alertify.success('Ok');
      self.location='alumno.php';
      });
      </script>";
   }
   
   if($proceso=="Registrar"){
      $codigo=trim($obj->real_escape_string(strip_tags($_POST['codigo'],ENT_QUOTES)));
      $nombres=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['nombres'],ENT_QUOTES))));
	  $apepaterno=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['apepat_alum'],ENT_QUOTES))));
	  $apematerno=strtoupper(trim($obj->real_escape_string(strip_tags($_POST['apemat_alum'],ENT_QUOTES))));
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
      $grado=trim($obj->real_escape_string(strip_tags($_POST['grado'],ENT_QUOTES)));
      $seccion=trim($obj->real_escape_string(strip_tags($_POST['seccion'],ENT_QUOTES)));
      
      $sql="INSERT INTO alumno(idapo, parentesco, nombres, apepat_alu, apemat_alu, dni, fec_nacimiento, genero, religion, departamento, provincia, distrito, direccion, telefono, email, codigo, inscripcion, idgrado, seccion) VALUES ('$apoderado', '$parentesco', '$nombres', '$apepaterno', '$apematerno', '$dni', '$fec_nac', '$genero', '$religion', '$departamento', '$provincia', '$distrito','$direccion', '$telefono', '$email', '$codigo', '1', '$grado', '$seccion')";

      $obj->ejecutar($sql);

       //if (isset($_POST['documentos'])) {
           if(is_uploaded_file($_FILES['documentos']['tmp_name'])) {


               // creamos las variables para subir a la db
               $ruta = "archivos/";
               $nombrefinal= trim ($_FILES['documentos']['name']); //Eliminamos los espacios en blanco
               //$nombrefinal= ereg_replace (" ", "", $nombrefinal);//Sustituye una expresión regular
               $upload= $ruta . $nombrefinal;

               if(move_uploaded_file($_FILES['documentos']['tmp_name'], $upload)) { //movemos el archivo a su ubicacion

                   $query = "UPDATE alumno SET documentos='".$nombrefinal."' WHERE codigo='$codigo'";
                   $obj->ejecutar($query);
               }
           }

      echo"<script>
      alertify.alert('ALUMNO', 'Registro Grabado!', function(){
      alertify.success('Ok');
      self.location='../voucher_pago/nuevo_voucher.php';
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
   self.location='alumno.php';
   });
   </script>";
   }
   ?>
</body>