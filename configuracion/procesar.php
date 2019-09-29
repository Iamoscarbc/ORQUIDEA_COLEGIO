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
      $razon_social=trim($obj->real_escape_string(strip_tags($_POST['razon_social'],ENT_QUOTES)));
      $ruc=trim($obj->real_escape_string(strip_tags($_POST['RUC'],ENT_QUOTES)));
      $departamento=trim($obj->real_escape_string(strip_tags($_POST['departamento'],ENT_QUOTES)));
      $provincia=trim($obj->real_escape_string(strip_tags($_POST['provincia'],ENT_QUOTES)));
      $distrito=trim($obj->real_escape_string(strip_tags($_POST['distrito'],ENT_QUOTES)));
      $direccion=trim($obj->real_escape_string(strip_tags($_POST['direccion'],ENT_QUOTES)));
      $telefono=trim($obj->real_escape_string(strip_tags($_POST['telefono'],ENT_QUOTES)));
      $moneda=trim($obj->real_escape_string(strip_tags($_POST['moneda'],ENT_QUOTES)));

       $sql="   UPDATE configuracion
                SET razon_social='$razon_social',
                    ruc='$ruc',
                    departamento='$departamento',
                    provincia='$provincia',
                    distrito='$distrito',
                    direccion='$direccion',
                    telefono='$telefono',
                    moneda='$moneda'
                WHERE idconfig='1'";
       $obj->ejecutar($sql);

      //imagenes
      $formatosPermitidos=array("image/jpg","image/jpeg","image/png","image/gif");

      /*if(in_array($_FILES['imagen_logo']['type'],$formatosPermitidos)) {
         $ruta="imagenes/".$_FILES['imagen_logo']['name'];
         move_uploaded_file($_FILES['imagen_logo']['tmp_name'], $ruta);

         $sql_imagen_logo="UPDATE configuracion SET imagen_logo = '$ruta' ";
         $obj->ejecutar($sql_imagen_logo);
      }

      if(in_array($_FILES['imagen_fondo']['type'],$formatosPermitidos)) {
         $ruta="imagenes/".$_FILES['imagen_fondo']['name'];
         move_uploaded_file($_FILES['imagen_fondo']['tmp_name'], $ruta);

         $sql_imagen_logo="UPDATE configuracion SET imagen_fondo = '$ruta' ";
         $obj->ejecutar($sql_imagen_logo);
      }*/
      //$imagen_logo=$_POST["imagen_logo"];
       $imagen_logo=trim($obj->real_escape_string(strip_tags($_POST['imagen_logo'],ENT_QUOTES)));
       $imagen_fondo=trim($obj->real_escape_string(strip_tags($_POST['imagen_fondo'],ENT_QUOTES)));
      //$imagen_fondo=$_POST["imagen_fondo"];

      $formatosPermitidos=array(".jpg",".jpeg",".png",".gif");

      if (isset($imagen_logo)) {
         $nombreArchivo=$_FILES["imagen_logo"]["name"];
         $nombreTmpArchivo=$_FILES["imagen_logo"]["tmp_name"];
         $extensionArchivo=substr($nombreArchivo, strripos($nombreArchivo,'.'));
         $ruta="imagenes/";

         if (!file_exists($ruta)) {
            mkdir($ruta);
         }

         if(in_array($extensionArchivo, $formatosPermitidos)){
            $nombreArchivoRenombrado = str_replace($nombreArchivo, "imagen_logo".$extensionArchivo, "$nombreArchivo");
            if(move_uploaded_file($nombreTmpArchivo, $ruta.$nombreArchivoRenombrado)) {
               $destino_logo = $ruta.$nombreArchivoRenombrado;
            } else {
               echo "No se pudo mover";
            }
         } else {
            echo "formato no permitido";
         }

         $sql_imagen_logo="UPDATE configuracion SET imagen_logo = '$destino_logo' WHERE idconfig='1'";
         $obj->ejecutar($sql_imagen_logo);
      }else{
          $sql_imagen_logo="NULL";
      }

      if (isset($imagen_fondo)) {
         $nombreArchivo=$_FILES["imagen_fondo"]["name"];
         $nombreTmpArchivo=$_FILES["imagen_fondo"]["tmp_name"];
         $extensionArchivo=substr($nombreArchivo, strripos($nombreArchivo,'.'));
         $ruta="imagenes/";

         if (!file_exists($ruta)) {
            mkdir($ruta);
         }

         if(in_array($extensionArchivo, $formatosPermitidos)){
            $nombreArchivoRenombrado = str_replace($nombreArchivo, "imagen_fondo".$extensionArchivo, "$nombreArchivo");
            if(move_uploaded_file($nombreTmpArchivo, $ruta.$nombreArchivoRenombrado)) {
               $destino_fondo = $ruta.$nombreArchivoRenombrado;
            } else {
               echo "No se pudo mover";
            }
         } else {
            echo "formato no permitido";
         }

         $sql_imagen_fondo="UPDATE configuracion SET imagen_fondo='$destino_fondo' WHERE idconfig='1'";
         $obj->ejecutar($sql_imagen_fondo);
      }else{
          $sql_imagen_fondo="NULL";
      }

      echo"<script>
      alertify.alert('CONFIGURACION', 'Operacion Exitosa!', function(){
      alertify.success('Ok');
      self.location='../configuracion/configuracion.php';
      });
      </script>";
   }
   ?>
</body>