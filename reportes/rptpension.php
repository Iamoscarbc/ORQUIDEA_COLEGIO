<?php ob_start();
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$result=$obj->consultar("SELECT * FROM pension");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>lista de Pensiones</title>

<style type="text/css">
ne {
	font-weight: bold;
}
ne {
	font-weight: bold;
}
ta {
	font-size: 16px;
}
#n {
	text-align: center;
	font-weight: bold;
	font-size: 24px;
	font-family: Georgia, "Times New Roman", Times, serif;
	color: #000;
}
.g {
	font-family: Georgia, "Times New Roman", Times, serif;
}
#l {
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.n table tr td {
	text-align: center;
}
</style>
</head>

<body class="n">
<table width="350" height="65" border="1" align="center" cellspacing="0">
  <tr>
    <td width="241" bgcolor="#66CCCC" id="n">LISTA DE PENSIONES</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="500" border="1" align="center" cellspacing="0">
  <tr id="l">
     <th width="200" bgcolor="#66CCCC" scope="col">Concepto</th>
     <th width="90" bgcolor="#66CCCC" scope="col">Monto</th>
     <th width="74" bgcolor="#66CCCC" scope="col">F.Inicio</th>
     <th width="69" bgcolor="#66CCCC" scope="col">F.Vence</th>
     <th width="45" bgcolor="#66CCCC" scope="col">Mora</th>
     <th width="45" bgcolor="#66CCCC" scope="col">Desc.</th>
   </tr>
   <?php foreach((array) $result as $row){?>
   <tr>
     <td><?php echo $row['concepto']; ?></span></td>
     <td><?php echo $row['monto'];?></span></td>
	   <td><?php echo $row['fec_inicio'];?></span></td>
     <td><?php echo $row['fec_vence']; ?></span></td>
     <td><?php echo $row['mora']; ?></span></td>
     <td><?php echo $row['descuento']; ?></span></td>
   </tr>
  <?php };?>
 </table>
 <p>&nbsp;</p>
</body>
</html>
<?php
require_once("dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf=$dompdf->output();
$filename = 'rptpension.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>
