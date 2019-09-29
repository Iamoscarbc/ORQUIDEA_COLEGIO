<?php
//include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;

if (isset($_GET['term'])){
	$return_arr = array();

	/* Si la conexi�n a la base de datos , ejecuta instrucci�n SQL. */
	$data=$obj->consultar("
		SELECT idapo, 
		CONCAT(nombre_apo, ' ',apepat_apo, ' ',apemat_apo) AS apoderado 
		FROM apoderado
	    WHERE CONCAT(nombre_apo, ' ',apepat_apo, ' ',apemat_apo) like '%" .($_GET['term']) . "%' LIMIT 0 ,50");
	
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	foreach($data as $row) {
		$row_array['value']=$row['apoderado'].' | '.$row['idapo'];
		$row_array['id_apoderado']=$row['idapo'];
		$row_array['nombre_apoderado']=$row['apoderado'];

		array_push($return_arr,$row_array);
   }	
	/* Codifica el resultado del array en JSON. */
	echo json_encode($return_arr);
}
?>