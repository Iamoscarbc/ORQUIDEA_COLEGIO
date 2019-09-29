<?php ob_start();
include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
  if(!empty($_GET['num_matricula'])){
   $NUNMA= trim($obj->real_escape_string(strip_tags($_GET['num_matricula'],ENT_QUOTES)));
  }

$result=$obj->consultar("SELECT configuracion.imagen_logo
     , matricula.idmatri
     , matricula.periodo
     , matricula.fec_matricula
     , grado.descripcion
     , apoderado.ocupacion
     , matricula.num_matricula
     , aula.seccion
     , matricula.usuario
     , matricula.observacion
     , CONCAT(alumno.apepat_alu, ' ',alumno.apemat_alu, ' ',alumno.nombres) AS nombres
     , CONCAT(apoderado.apepat_apo, ' ',apoderado.apemat_apo, ' ',apoderado.nombre_apo) AS nombre_apo
     , alumno.fec_nacimiento
     , alumno.direccion
     , alumno.codigo
FROM
  configuracion, matricula
INNER JOIN alumno
ON matricula.idalumno = alumno.idalu
INNER JOIN apoderado
ON alumno.idapo = apoderado.idapo
INNER JOIN aula
ON matricula.idaula = aula.idaula
INNER JOIN grado
ON matricula.idgrado = grado.idgrado
WHERE matricula.num_matricula ='$NUNMA'");
    foreach((array)$result as $row){
    $nm=$row['num_matricula'];
    $gr=$row['descripcion'];
    $se=$row['seccion'];
    $cod=$row['codigo'];
    $no=$row['nombres'];
    $di=$row['direccion'];
    $fec_na=$row['fec_nacimiento'];
    $apo=$row['nombre_apo'];
    $ob=$row['observacion'];
    $usu=$row['usuario'];
    $fecha=$row['fec_nacimiento'];
    $pe=$row['periodo'];
    $logo=$row['imagen_logo'];
    $ocu=$row['ocupacion'];
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ficha De matricula</title>
<style type="text/css">
.negrita {
}
.center {
	text-align: center;
}
.center {
	text-align: center;
	font-weight: bold;
	font-family: "Courier New", Courier, monospace;
	font-size: 20px;
	color: #666;
}
</style>
</head>

<body>
<table width="400" border="0" align="center" cellspacing="0">
  <tr>
    <th height="77" bgcolor="#FFFFFF" scope="col"><h1>
      <img src="../configuracion/<?php echo $logo?>" width="100" height="70" />
    </h1></th>
  </tr>
</table>
<table width="500" border="0" align="center" cellspacing="0">
  <tr>
    <td width="301" style="text-align: right; font-size: 20px; font-weight: bold; font-family: 'Lucida Sans Unicode', 'Lucida Grande', sans-serif;">FICHA DE MATRICULA N°</td>
    <td width="195" style="font-size: 20px"><?php echo $nm;?></td>
  </tr>
</table>
<table width="500" border="0" align="center">
  <tr>
    <td class="center">INFORMACION DEL ESTUDIANTE:</td>
  </tr>
</table>
<table width="500" border="1" align="center" cellspacing="0">
  <tr>
    <td>PERIODO ACADEMICO:</td>
    <td><?php echo $pe;?></td>
  </tr>
  <tr>
    <td>CODIGO DEL ALUMNO: </td>
    <td><?php echo $cod;?></td>
  </tr>
  <tr>
    <td>GRADO: </td>
    <td><?php echo $gr;?></td>
  </tr>
  <tr>
    <td>SECCION:</td>
    <td><?php echo $se;?></td>
  </tr>
</table>
<table width="500" border="0" align="center" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="500" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="203" style="font-weight: bold"><span class="negrita">Apellidos y Nombres:</span></td>
    <td width="291"><?php echo $no;?></td>
  </tr>
  <tr>
    <td style="font-weight: bold"><span class="negrita">Fecha de Nacimiento:</span></td>
    <td><?php echo $fec_na;?></td>
  </tr>
  <tr>
    <td style="font-weight: bold"><span class="negrita">Direccion de domicilio:</span></td>
    <td><?php echo $di;?></td>
  </tr>
</table>
<table width="500" border="0" align="center">
  <tr>
    <td class="center">INFORMACION DEL APODERADO:</td>
  </tr>
</table>
<table width="500" border="1" align="center" cellspacing="0">
  <tr>
    <td width="201" class="negrita" style="text-align: left; font-weight: bold;">Apellidos y Nombres:</td>
    <td width="289"><?php echo $apo;?></td>
  </tr>
  <tr>
    <td style="font-weight: bold">Ocupacion:</td>
    <td><?php echo $ocu;?></td>
  </tr>
</table>
<table width="500" border="0" align="center" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="500" border="1" align="center" cellspacing="0">
  <tr>
    <td width="200"><span class="negrita" style="font-weight: bold">Responsable de la matricula</span><span style="font-weight: bold">:</span></td>
    <td width="290"><?php echo $usu;?></td>
  </tr>
  <tr>
    <td class="negrita"><span style="font-weight: bold">Fecha de matricula:</span></td>
    <td class="negrita"><?php echo $fecha;?></td>
  </tr>
</table>
<p>&nbsp;</p>
<table width="500" border="0" align="center">
  <tr>
    <td width="91" class="negrita" style="font-weight: bold">OBSERVACION:</td>
    <td width="393"><?php echo $ob;?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
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
$filename = 'ficha.pdf';
file_put_contents($filename, $pdf);
$dompdf->stream($filename,array("Attachment"=>0));
?>
