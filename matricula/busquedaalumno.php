<?php
//include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
if (isset($_GET['term'])){
	//rrecorrer la tabla  de 

	$return_arr = array();
	/* Si la conexi�n a la base de datos , ejecuta instrucci�n SQL. */
		$data=$obj->consultar("SELECT alumno.idalu
		, alumno.codigo
		, CONCAT(alumno.nombres, ' ', alumno.apepat_alu, ' ', alumno.apemat_alu) As nombres
		, CONCAT(apoderado.nombre_apo, ' ', apoderado.apepat_apo, ' ', apoderado.apemat_apo) As nombre_apo
		FROM
		alumno
		INNER JOIN apoderado
		ON alumno.idapo = apoderado.idapo WHERE nombres like '%" .($_GET['term']) . "%' LIMIT 0 ,50");
		/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
		foreach($data as $row) {
			$row_array['value'] =$row['nombres']."|".$row['codigo'];
			$row_array['idalumno']=$row['idalu'];
			$row_array['nombre_apo']=$row['nombre_apo'];
			$row_array['nombres']=$row['nombres'];
			array_push($return_arr,$row_array);
		}
	/* Codifica el resultado del array en JSON. */
	echo json_encode($return_arr);
}
?>