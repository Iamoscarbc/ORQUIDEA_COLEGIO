<?php
//include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
if (isset($_GET['term'])){
	//rrecorrer la tabla  de 

	$return_arr = array();
	/* Si la conexi�n a la base de datos , ejecuta instrucci�n SQL. */
		$data=$obj->consultar("
		SELECT
		    a.idalu,
			a.codigo,
			m.idmatri AS idmatri,
            CONCAT(a.nombres, ' ',a.apepat_alu, ' ',a.apemat_alu) AS alumno,
            g.descripcion AS grado,
            au.seccion AS seccion
		FROM
			alumno a
		INNER JOIN matricula m ON a.idalu = m.idmatri
		INNER JOIN grado g ON m.idgrado = g.idgrado
        INNER JOIN aula au ON au.idaula = m.idaula
		WHERE CONCAT(a.nombres, ' ',a.apepat_alu, ' ',a.apemat_alu) like '%" .($_GET['term']) . "%' LIMIT 0 ,50");
		/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
		foreach($data as $row) {
			$row_array['value'] =$row['alumno']." | ".$row['codigo'];
			$row_array['idalumno']=$row['idalu'];
			$row_array['idmatri']=$row['idmatri'];
			$row_array['nombres']=$row['alumno'];
            $row_array['grado_alu']=$row['grado'];
            $row_array['seccion_alu']=$row['seccion'];
			array_push($return_arr,$row_array);
		}
	/* Codifica el resultado del array en JSON. */
	echo json_encode($return_arr);
}
?>