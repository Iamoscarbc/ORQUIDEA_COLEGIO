<?php
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;

if(isset($_POST["action"]))
{
	$output = '';
	if($_POST["action"] == "departamento")
	{
		$result=$obj->consultar("SELECT idProv,provincia FROM ubprovincia WHERE idDepa = '".$_POST["query"]."' GROUP BY provincia");

		$output .= '<option value="">Seleccione una provincia</option>';
		foreach((array)$result as $row){
		$output .='<option value="'.$row['idProv'].'">'.$row['provincia'].'</option>';
		//$row['idaula'] es el id que se va evaluar y $row['seccion'] es donde se va mostrar en el select con las secciones
	}
}

if($_POST["action"] == "provincia")
{
	$result=$obj->consultar("SELECT idDist,distrito FROM ubdistrito WHERE idProv ='".$_POST["query"]."' GROUP BY distrito");

	$output .= '<option value="">Seleccione un distrito</option>';
	foreach((array)$result as $row){
		$output .='<option value="'.$row['idDist'].'">'.$row['distrito'].'</option>';
	}
}

	echo $output;

}
?>