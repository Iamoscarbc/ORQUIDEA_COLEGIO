<?php
//include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
if (isset($_GET['term'])){
	$return_arr = array();
	/* Si la conexi�n a la base de datos , ejecuta instrucci�n SQL. */
		$data=$obj->consultar("SELECT p.idprof AS idprof, u.codigo AS cod_prof, p.nombre_prof AS profesor FROM profesores p INNER JOIN usuario u ON p.idprof = u.idusu WHERE p.nombre_prof like '%" . ($_GET['term']) . "%' LIMIT 0 ,50");
		/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
		foreach($data as $row) {
			$row_array['value'] =$row['profesor']."|".$row['cod_prof'];
			$row_array['idprof']=$row['idprof'];
			$row_array['profesor']=$row['profesor'];
			
			array_push($return_arr,$row_array);
		}
	/* Codifica el resultado del array en JSON. */
	echo json_encode($return_arr);
}
?>