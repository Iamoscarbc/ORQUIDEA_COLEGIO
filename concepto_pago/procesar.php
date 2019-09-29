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

   if (isset($_GET['Eliminar'])) {
      $proceso_eliminar=$_GET['Eliminar'];

      if($proceso_eliminar=="Eliminar"){
         $id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idconcepto'],ENT_QUOTES))));

         $sql= "DELETE  FROM conceptoPago WHERE idconcepto='".$obj->real_escape_string($id)."'";
         $obj->ejecutar($sql);
         echo"<script>
                  alertify.alert('CONCEPTO DE PAGO','Registro Eliminado.', function(){
                  alertify.message('OK');
                  self.location='concepto_pago.php';
               });
      </script>";
      }
   }

   if (isset($_POST["proceso"])) {
      $proceso=$_POST["proceso"];

      if($proceso=="Modificar"){
         $id=trim($obj->real_escape_string(strip_tags($_POST['id'],ENT_QUOTES)));
         $idnivel=trim($obj->real_escape_string(strip_tags($_POST['id_nivel'],ENT_QUOTES)));
         $concepto=trim($obj->real_escape_string(strip_tags($_POST['concepto'],ENT_QUOTES)));
         $monto=trim($obj->real_escape_string(strip_tags($_POST['monto'],ENT_QUOTES)));
         $fec_inicio=trim($obj->real_escape_string(strip_tags($_POST['fec_inicio'],ENT_QUOTES)));
         $fec_vencimiento=trim($obj->real_escape_string(strip_tags($_POST['fec_vencimiento'],ENT_QUOTES)));
         $descuento=trim($obj->real_escape_string(strip_tags($_POST['descuento'],ENT_QUOTES)));
         $mora=trim($obj->real_escape_string(strip_tags($_POST['mora'],ENT_QUOTES)));

         if($fec_inicio != ''){
            $fec_inicio= $fec_inicio;
         } else {
            $fec_inicio= "NULL";
         }

         if($fec_vencimiento != ''){
            $fec_vencimiento= $fec_vencimiento;
         } else {
            $fec_vencimiento= "NULL";
         }

         /*echo $idnivel."<br>";
         echo $concepto."<br>";
         echo $monto."<br>";         
         echo $fec_inicio."<br>";
         echo $fec_vencimiento."<br>";
         echo $descuento."<br>";
         echo $mora."<br>";*/

         if ($fec_inicio == "NULL" && $fec_vencimiento == "NULL") {
            $sql="UPDATE conceptoPago SET idnivel='$idnivel', concepto='$concepto', monto='$monto', fec_inicio=$fec_inicio, fec_vencimiento=$fec_vencimiento, mora='$mora', descuento='$descuento' WHERE idconcepto=$id";
         } else {
            $sql="UPDATE conceptoPago SET idnivel='$idnivel', concepto='$concepto', monto='$monto', fec_inicio='$fec_inicio', fec_vencimiento='$fec_vencimiento', mora='$mora', descuento='$descuento' WHERE idconcepto=$id";
         }

         $obj->ejecutar($sql);
            echo"<script>
             alertify.alert('CONCEPTO DE PAGO', 'Registro Actualizado!', function(){
            alertify.success('Ok');
            self.location='concepto_pago.php';
            });
         </script>";
      }

      if($proceso=="Registrar"){
         $idnivel=trim($obj->real_escape_string(strip_tags($_POST['id_nivel'],ENT_QUOTES)));
         $concepto=trim($obj->real_escape_string(strip_tags($_POST['concepto'],ENT_QUOTES)));
         $monto=trim($obj->real_escape_string(strip_tags($_POST['monto'],ENT_QUOTES)));
         $fec_inicio=trim($obj->real_escape_string(strip_tags($_POST['fec_inicio'],ENT_QUOTES)));
         $fec_vencimiento=trim($obj->real_escape_string(strip_tags($_POST['fec_vencimiento'],ENT_QUOTES)));
         $descuento=trim($obj->real_escape_string(strip_tags($_POST['descuento'],ENT_QUOTES)));
         $mora=trim($obj->real_escape_string(strip_tags($_POST['mora'],ENT_QUOTES)));

         if($fec_inicio != ''){
            $fec_inicio= $fec_inicio;
         } else {
            $fec_inicio= "NULL";
         }

         if($fec_vencimiento != ''){
            $fec_vencimiento = $fec_vencimiento;
         } else {
            $fec_vencimiento = "NULL";
         }

         if ($fec_inicio == "NULL" && $fec_vencimiento == "NULL") {
            $sql="INSERT INTO conceptoPago (idnivel, concepto, monto, fec_inicio, fec_vencimiento, mora, descuento) VALUES ('$idnivel', '$concepto', '$monto', $fec_inicio, $fec_vencimiento, '$mora', '$descuento')";
         } else {
            $sql="INSERT INTO conceptoPago (idnivel, concepto, monto, fec_inicio, fec_vencimiento, mora, descuento) VALUES ('$idnivel', '$concepto', '$monto', '$fec_inicio', '$fec_vencimiento', '$mora', '$descuento')";
         }
         

         $obj->ejecutar($sql);
         echo"<script>
            alertify.alert('CONCEPTO DE PAGO', 'Registro Grabado!', function(){
            alertify.success('OK');
            self.location='concepto_pago.php';
            });
         </script>";
      }

      if($proceso=="Eliminar"){
         $cod= trim($obj->real_escape_string(htmlentities(strip_tags($_GET['cod'],ENT_QUOTES))));
         $sql= "DELETE  FROM conceptoPago WHERE idconcepto='".$obj->real_escape_string($cod)."'";
         $obj->ejecutar($sql);
         echo"<script>
         alertify.alert('ALUMNO','Registro Eliminado.', function(){
         alertify.message('OK');
         self.location='alumno.php';
         });
         </script>";
      }
   }
?>
</body>