<?php
	$idpension = $_POST['idpension'];
  include_once("../conexion/clsConexion.php");
  $obj=new clsConexion;
  $data=$obj->consultar("SELECT * FROM pension WHERE idpension='".$obj->real_escape_string($idpension)."'");
	$info = array();

  foreach((array)$data as $row){
  $idpension=$row['idpension'];
  $co=$row['concepto'];
  $de= $row['descuento'];
  $mora= $row['mora'];
  $monto= $row['monto'];
  }
  // calculo del descuento
   $desc=$obj->consultar("SELECT DATEDIFF(CURDATE(),fec_inicio) AS diasqfalta FROM pension WHERE idpension = '$idpension' ORDER BY idpension ASC");
    foreach ((array)$desc as $row) {
         $descuentoo=$row['diasqfalta'];
    }
    if ($descuentoo<0) {
      $descuentoantes=$de;
    } else {
      $descuentoantes=0;
    }
  //fin calculo de descuento

  //calculo de la mora
    $d=$obj->consultar("SELECT DATEDIFF(CURDATE(),fec_vence) AS diasqpaso FROM pension WHERE idpension = '$idpension' ORDER BY idpension ASC");
     foreach ((array)$d as $row) {
          $diaa=$row['diasqpaso'];
     }
  if ($diaa<0) {
    $morasxdias=0;
  } else {
    $morasxdias=$mora* $diaa;
  }
  //fin del calculo de mora

   $total=$morasxdias+$monto-$descuentoantes;

	$info['idpension'] = $idpension;
	$info['concepto'] = $co;
	$info['mora'] = $morasxdias;
  $info['descuento'] = number_format($descuentoantes,2);
	$info['monto'] = $monto;
  $info['total'] = $total;

	echo json_encode($info);
 ?>
