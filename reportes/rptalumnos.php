<?php ob_start();
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$result=$obj->consultar("SELECT * FROM alumno");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>lista de productos</title>

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
<table width="266" height="65" border="1" align="center" cellspacing="0">
  <tr>
    <td width="241" bgcolor="#66CCCC" id="n">LISTA DE ALUMNOS</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="500" border="1" align="center" cellspacing="0">
  <tr id="l">
     <th width="69" bgcolor="#66CCCC" scope="col">Codigo</th>
     <th width="189" bgcolor="#66CCCC" scope="col">Ap.y Nombres</th>
     <th width="116" bgcolor="#66CCCC" scope="col">F.Nacimiento</th>
     <th width="65" bgcolor="#66CCCC" scope="col">Genero</th>
     <th width="39" bgcolor="#66CCCC" scope="col">Dni</th>
   </tr>
   <?php foreach((array) $result as $row){?>
   <tr>
     <td><?php echo $row['codigo']; ?></span></td>
     <td><?php echo $row['nombres'].$row['apepat_alu'].$row["apemat_alu"];?></span></td>
	   <td><?php echo $row['fec_nacimiento'];?></span></td>
     <td><?php echo $row['genero']; ?></span></td>
     <td><?php echo $row['dni']; ?></span></td>
   </tr>
  <?php };?>
 </table>
 <p>&nbsp;</p>
</body>
</html>
<?php
require_once("../dompdf/dompdf_config.inc.php");
$dompdf = new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$pdf=$dompdf->output();
$filename = 'rptalumnos.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>