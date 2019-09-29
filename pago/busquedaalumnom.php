<?php
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$data=$obj->consultar("SELECT año FROM periodo");
foreach($data as $row) {
	$dia=$row['año'];
}
?>
<?php
//include("../seguridad.php");
if (isset($_GET['term'])){
	# conectare la base de datos
	

$return_arr = array();
/* Si la conexi�n a la base de datos , ejecuta instrucci�n SQL. */
	$data=$obj->consultar("SELECT matricula.idmatri, alumno.nombres, alumno.idalu, apoderado.nombre_apo, alumno.codigo, matricula.idgrado, matricula.periodo FROM alumno INNER JOIN apoderado ON alumno.idapo = apoderado.idapo INNER JOIN matricula ON matricula.idalumno = alumno.idalu WHERE alumno.nombres like '%" .($_GET['term']) . "%' LIMIT 0 ,50");
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	foreach($data as $row) {
		$id_alumno=$row['idalu'];
		$row_array['value'] =$row['nombres']."|".$row['codigo'];
		$row_array['idalu']=$row['idalu'];
		$row_array['nombre_apo']=$row['nombre_apo'];
		$row_array['nombres']=$row['nombres'];
		$row_array['grado']=$row['grado'];
		$row_array['seccion']=$row['seccion'];
		$row_array['idmatri']=$row['idmatri'];

		array_push($return_arr,$row_array);
    }
/* Codifica el resultado del array en JSON. */
echo json_encode($return_arr);
}
?>
