<?php
if(isset($_GET["export"])) {
include_once("../../conexion/clsConexion.php");
$obj=new clsConexion;
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');
$output = fopen("php://output", "w");
fputcsv($output, array('Codigo', 'Nombres', 'Dni', 'Fecha nacimiento', 'Genero', 'Direccion', 'Telefono', 'Email', 'Apoderado'));
$result=$obj->consultar("SELECT alumno.codigo
     , alumno.nombres
     , alumno.dni
     , alumno.fec_nacimiento
     , alumno.genero
     , alumno.direccion
     , alumno.telefono
     , alumno.email
     , apoderado.nombre_apo
FROM
  alumno
INNER JOIN apoderado
ON alumno.idapo = apoderado.idapo ORDER BY codigo DESC");
      foreach((array)$result as $row){
        fputcsv($output, $row);
        }
        fclose($output);
  }
?>
