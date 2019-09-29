<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
   <link rel="stylesheet" href="../plugins/alert/alertify/alertify.css">
   <link rel="stylesheet" href="../plugins/alert/alertify/themes/default.css">
   <script src="../plugins/alert/alertify/alertify.js"></script>
</head>
<body>
<?php
$idalu=" ";
// include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();
$funcion=$_POST["funcion"];
if($funcion=="registrar"){
  $periodo=trim($obj->real_escape_string(strip_tags($_POST['periodo'],ENT_QUOTES)));
  $numero=trim($obj->real_escape_string(strip_tags($_POST['num'],ENT_QUOTES)));
  $fecha=trim($obj->real_escape_string(strip_tags($_POST['fecha'],ENT_QUOTES)));
  $idmatri=trim($obj->real_escape_string(strip_tags($_POST['idmatri'],ENT_QUOTES)));
  $idconcepto=trim($obj->real_escape_string(strip_tags($_POST['idconcepto'],ENT_QUOTES)));
  $pagante=trim($obj->real_escape_string(strip_tags($_POST['pagante'],ENT_QUOTES)));
  $moraxdias=trim($obj->real_escape_string(strip_tags($_POST['morasxdias'],ENT_QUOTES)));
  $descuento=trim($obj->real_escape_string(strip_tags($_POST['descuento'],ENT_QUOTES)));
  $subtotal=trim($obj->real_escape_string(strip_tags($_POST['subtotal'],ENT_QUOTES)));
  $total=trim($obj->real_escape_string(strip_tags($_POST['total'],ENT_QUOTES)));
  $usuario=trim($obj->real_escape_string(strip_tags($_POST['usu'],ENT_QUOTES)));

      $sql="INSERT INTO pago (`periodo`, `numero`, `fecha`,`idmatri`,`idconcepto`, `moraxdias`,`descuento`, `subtotal`, `total`, `usuario`, `pagante`)
      VALUES ('$periodo','$numero','$fecha','$idmatri','$idconcepto','$moraxdias','$descuento','$subtotal','$total','$usuario','$pagante')";
      // var_dump($sql);exit;
      $con = $obj->con;
      mysqli_query($con,$sql);

      if(mysqli_affected_rows($con)<=0) {
        echo "Error en: $sql: ".mysqli_error();
      }else{        
        echo"<script>
          alertify.alert('pago', 'Registro Exitoso!', function(){
        alertify.success('Ok');
        self.location='pago.php';
        });
        </script>";
      }

   }
?>
</body>
