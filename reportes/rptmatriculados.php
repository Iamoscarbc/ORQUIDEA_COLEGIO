<?php ob_start();
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$result=$obj->consultar("SELECT matricula.num_matricula
     , alumno.nombres
     , grado.descripcion
     , aula.seccion
     , apoderado.nombre_apo
FROM
  matricula
INNER JOIN alumno
INNER JOIN aula
INNER JOIN apoderado
INNER JOIN grado
ON alumno.idapo = apoderado.idapo AND matricula.idaula = aula.idaula AND matricula.idgrado = grado.idgrado AND matricula.idalumno = alumno.idalu");
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
    <td width="241" bgcolor="#66CCCC" id="n">LISTA DE MATRICULADOS</td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="550" border="1" align="center" cellspacing="0">
  <tr id="l">
     <th width="69" bgcolor="#66CCCC" scope="col">Num.Mat</th>
     <th width="189" bgcolor="#66CCCC" scope="col">Alumno</th>
     <th width="116" bgcolor="#66CCCC" scope="col">Grado</th>
     <th width="65" bgcolor="#66CCCC" scope="col">Seccion</th>
     <th width="39" bgcolor="#66CCCC" scope="col">Apoderado</th>
   </tr>
   <?php foreach((array) $result as $row){?>
   <tr>
     <td><?php echo $row['num_matricula']; ?></span></td>
     <td><?php echo $row['nombres'];?></span></td>
	   <td><?php echo $row['descripcion'];?></span></td>
     <td><?php echo $row['seccion']; ?></span></td>
     <td><?php echo $row['nombre_apo']; ?></span></td>
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
$filename = 'rptmatriculados.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename);
?>
