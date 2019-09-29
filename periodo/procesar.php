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
     $año=trim($obj->real_escape_string(strip_tags($_POST['ano'],ENT_QUOTES)));
     $pi=trim($obj->real_escape_string(strip_tags($_POST['pbfi'],ENT_QUOTES)));
     $pf=trim($obj->real_escape_string(strip_tags($_POST['pbff'],ENT_QUOTES)));
     $si=trim($obj->real_escape_string(strip_tags($_POST['sbfi'],ENT_QUOTES)));
     $sf=trim($obj->real_escape_string(strip_tags($_POST['sbff'],ENT_QUOTES)));
     $ti=trim($obj->real_escape_string(strip_tags($_POST['tbfi'],ENT_QUOTES)));
     $tf=trim($obj->real_escape_string(strip_tags($_POST['tbff'],ENT_QUOTES)));
     $ci=trim($obj->real_escape_string(strip_tags($_POST['cbfi'],ENT_QUOTES)));
     $cf=trim($obj->real_escape_string(strip_tags($_POST['cbff'],ENT_QUOTES)));

     $sql="INSERT INTO periodo (año, pri_bim_fec_inicio, pri_bim_fec_fin, seg_bim_fec_inicio, seg_bim_fec_fin, ter_bim_fec_inicio, ter_bim_fec_fin, cua_bim_fec_inicio, cua_bim_fec_fin) VALUES ($año, '$pi', '$pf', '$si', '$sf', '$ti', '$tf', '$ci', '$cf')";
     $obj->ejecutar($sql);

     echo"<script>
     alertify.alert('PERIODO ACADEMICO', 'Se ingreso el perido academico correctamente!', function(){
       alertify.success('Realizado');
       self.location='periodo.php';
       });
     </script>";
   }

   if($proceso=="Modificar"){
     $año=trim($obj->real_escape_string(strip_tags($_POST['ano'],ENT_QUOTES)));
     $pi=trim($obj->real_escape_string(strip_tags($_POST['pbfi'],ENT_QUOTES)));
     $pf=trim($obj->real_escape_string(strip_tags($_POST['pbff'],ENT_QUOTES)));
     $si=trim($obj->real_escape_string(strip_tags($_POST['sbfi'],ENT_QUOTES)));
     $sf=trim($obj->real_escape_string(strip_tags($_POST['sbff'],ENT_QUOTES)));
     $ti=trim($obj->real_escape_string(strip_tags($_POST['tbfi'],ENT_QUOTES)));
     $tf=trim($obj->real_escape_string(strip_tags($_POST['tbff'],ENT_QUOTES)));
     $ci=trim($obj->real_escape_string(strip_tags($_POST['cbfi'],ENT_QUOTES)));
     $cf=trim($obj->real_escape_string(strip_tags($_POST['cbff'],ENT_QUOTES)));

     $sql="UPDATE periodo SET pri_bim_fec_inicio='$pi', pri_bim_fec_fin='$pf', seg_bim_fec_inicio='$si', seg_bim_fec_fin='$sf', ter_bim_fec_inicio='$ti', ter_bim_fec_fin='$tf', cua_bim_fec_inicio='$ci', cua_bim_fec_fin='$cf' WHERE año=$año";     
    //  var_dump($sql);exit;
    $con =$obj->con;
    //  $obj->ejecutar($sql);
    
		mysqli_query($con,$sql);

		if(mysqli_affected_rows($con)<=0) {
      echo"<script>
      alertify.alert('PERIODO ACADEMICO', 'No ha realizado ningún cambio', function(){
        alertify.success('OK');
        self.location='periodo.php';
        });
      </script>";
		}else{
      echo"<script>
      alertify.alert('PERIODO ACADEMICO', 'Se actualizo el perido academico correctamente!', function(){
        alertify.success('Realizado');
        self.location='periodo.php';
        });
      </script>";
    }
   }

   if($proceso=="Eliminar"){
     $año=trim($obj->real_escape_string(strip_tags($_POST['ano'],ENT_QUOTES)));

     $sql="DELETE  FROM periodo WHERE año='".$obj->real_escape_string($año)."'";
     $obj->ejecutar($sql);

     echo"<script>
     alertify.alert('PERIODO ACADEMICO', 'Se elimino el perido academico correctamente!', function(){
       alertify.success('Realizado');
       self.location='periodo.php';
       });
     </script>";
   }
?>
</body>