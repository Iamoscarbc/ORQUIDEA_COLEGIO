<?php
//include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;

if (isset($_GET['term'])){
	$return_arr = array();

	/* Si la conexi�n a la base de datos , ejecuta instrucci�n SQL. */
	$data=$obj->consultar("SELECT * FROM apoderado WHERE CONCAT(apepat_apo,' ',apemat_apo, ' ',nombre_apo) like '%" .($_GET['term']) . "%' LIMIT 0 ,50");
	
	/* Recuperar y almacenar en conjunto los resultados de la consulta.*/
	foreach($data as $row) {
		$row_array['value']=$row['apepat_apo'].' '.$row['apemat_apo'].' '.$row['nombre_apo'];
		$row_array['id_apoderado']=$row['idapo'];
		$row_array['nombre_apoderado']=$row['apepat_apo'].' '.$row['apemat_apo'].', '.$row['nombre_apo'];
        $row_array['dpto_apoderado']=$row['departamento'];
        $row_array['prov_apoderado']=$row['provincia'];
        $row_array['dist_apoderado']=$row['distrito'];
        $row_array['direc_apoderado']=$row['direccion'];
        $row_array['email_apoderado']=$row['email'];
        $row_array['telf_apoderado']=$row['telefono'];

		array_push($return_arr,$row_array);
   }	
	/* Codifica el resultado del array en JSON. */
	echo json_encode($return_arr);
}
?>