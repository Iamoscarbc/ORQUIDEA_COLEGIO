<?php
//include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
if (isset($_GET['term'])){
	$return_arr = array();
	/* Si la conexi�n a la base de datos , ejecuta instrucci�n SQL. */
		$data=$obj->consultar("
		SELECT
	        m.idalumno,
			al.codigo,
			gr.descripcion AS grado,
			ni.descripcion AS nivel,
			au.idaula AS id_aula,
			au.seccion AS aula,
			m.idmatri AS id_matri,
            CONCAT(al.nombres, ' ',al.apepat_alu, ' ',al.apemat_alu) AS nombres
        FROM
	        matricula m
        INNER JOIN
			alumno al ON m.idalumno=al.idalu
		INNER JOIN
			grado gr ON gr.idgrado = m.idgrado
		INNER JOIN 
			nivel ni ON ni.idnivel = gr.idnivel
		INNER JOIN 
			aula au ON au.idaula = m.idaula
        WHERE CONCAT(al.nombres, ' ',al.apepat_alu, ' ',al.apemat_alu) like '%" .($_GET['term']) . "%' LIMIT 0 ,50");
		/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
		foreach($data as $row) {
			$row_array['value'] =$row['nombres']."|".$row['codigo'];
			$row_array['id_alumno']=$row['idalumno'];
			$row_array['nombre_alumno']=$row['nombres'];
			$row_array['grado']=$row['grado'];
			$row_array['nivel']=$row['nivel'];
			$row_array['aula']=$row['aula'];
			$row_array['id_aula']=$row['id_aula'];
			$row_array['id_matri']=$row['id_matri'];
			array_push($return_arr,$row_array);
		}
	/* Codifica el resultado del array en JSON. */
	echo json_encode($return_arr);
}
?>