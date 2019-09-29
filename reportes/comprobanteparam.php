<?php ob_start();
include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
	if(!empty($_GET['num'])){
	 $NUM= trim($obj->real_escape_string(strip_tags($_GET['num'],ENT_QUOTES)));
	}
$result=$obj->consultar("SELECT configuracion.logo
     , configuracion.moneda
     , pago.idpago
     , pago.periodo
     , pago.numero
     , pago.fecha
     , pago.idpension
     , pago.moraxdias
     , pago.descuento
     , pago.subtotal
     , pago.total
	   , pago.pagante
     , pension.concepto
		 , pension.monto
		 , pension.fec_vence
     , matricula.idmatri
	 , matricula.grado
	 , matricula.seccion
     , alumno.nombres
		 , alumno.codigo
     , apoderado.nombre_apo
     , pago.usuario
FROM
  configuracion, pago
INNER JOIN matricula
ON pago.idmatri = matricula.idmatri
INNER JOIN pension
ON pago.idpension = pension.idpension
INNER JOIN alumno
ON matricula.idalu = alumno.idalu
INNER JOIN apoderado
ON alumno.idapo = apoderado.idapo
WHERE pago.numero ='$NUM'");
		foreach((array)$result as $row){
		$aln=$row['nombres'];
		$fec=$row['fecha'];
		$fec_vence=$row['fec_vence'];
		$codigo=$row['codigo'];
		$n=$row['numero'];
		$mon=$row['moneda'];
		$con=$row['concepto'];
		$monto=$row['monto'];
		$moraxdias=$row['moraxdias'];
		$descuento=$row['descuento'];
		$total=$row['total'];
		$logo=$row['logo'];
		$usu=$row['usuario'];
		$pagante=$row['pagante'];
		$grado=$row['grado'];
		$seccion=$row['seccion'];
		}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Recibo de Pago</title>
</head>

<body>
<table width="400" border="0" align="center" cellspacing="0">
  <tr>
    <th height="77" bgcolor="#FFFFFF" scope="col"><h1> <img src="../configuracion/foto/<?php echo $logo?>" alt="" width="335" height="55" /> </h1></th>
  </tr>
</table>
<table width="497" border="0" align="center" cellspacing="0">
  <tr>
    <td width="408" style="text-align: right; font-weight: bold;">&nbsp;</td>
    <td width="79" style="text-align: left; font-weight: bold;">&nbsp;</td>
  </tr>
  <tr>
    <td style="text-align: right; font-weight: bold;">RECIBO N° </td>
    <td style="text-align: left; font-weight: bold;"><?php echo "$n"; ?></td>
  </tr>
</table>
<table width="500" border="0" align="center">
  <tr>
    <td width="152" style="font-weight: bold">Fecha De Pago:</td>
    <td width="332"><?php echo "$fec"; ?></td>
  </tr>
  <tr>
    <td style="font-weight: bold">Grado y Seccion:</td>
    <td><?php echo $grado." ".$seccion; ?></td>
  </tr>
  <tr>
    <td style="font-weight: bold">Pagante:</td>
    <td><?php echo "$pagante"; ?></td>
  </tr>
  <tr>
    <td style="font-weight: bold">Alumno(a):</td>
    <td><?php echo "$aln"; ?></td>
  </tr>
</table>
<table width="500" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#CCCCCC" style="text-align: center; font-weight: bold; font-size: 14;">Concepto</td>
    <td width="76" bgcolor="#CCCCCC" style="text-align: center; font-weight: bold;">Subtotal</td>
  </tr>
  <tr>
    <td><?php echo "$con"; ?></td>
    <td style="text-align: center"><?php echo "$monto"; ?></td>
  </tr>
  <tr>
    <td>Descuento</td>
    <td style="text-align: center"><?php echo "$descuento"; ?></td>
  </tr>
  <tr>
    <td>Mora x Día</td>
    <td style="text-align: center"><?php echo "$moraxdias"; ?></td>
  </tr>
  <tr>
    <td style="font-weight: bold">Total:</td>
    <td style="text-align: center"><span style="text-align: right"></span><span style="font-weight: bold"> <?php echo "$mon"; ?></span><?php echo "$total"; ?></td>
  </tr>
</table>
<table width="500" border="0" align="center">
  <tr>
    <td width="295" style="text-align: right; font-weight: bold;">Vence:</td>
    <td width="189" style="font-weight: bold"><?php echo "$fec_vence"; ?></td>
  </tr>
</table>
<table width="500" border="0" align="center">
  <tr>
    <td style="text-align: center; font-style: italic; font-weight: bold;">El no pago oportuno acarreará interés por mora</td>
  </tr>
</table>
<table width="500" border="0" align="center">
  <tr>
    <td width="296" style="text-align: right; font-weight: bold;">COD:</td>
    <td width="188" style="text-align: left; font-weight: bold;"><?php echo "$codigo"; ?></td>
  </tr>
</table>
<table width="500" border="0" align="center">
  <tr>
    <td width="92" style="text-align: right; font-weight: bold;">Usuario:</td>
    <td width="398" style="text-align: left; font-weight: bold;"><?php echo "$usu"; ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>

<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf=$dompdf->output();
$filename = 'Comprobante.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename,array("Attachment"=>0));
?>
