<?php
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;

if(isset($_POST["action"]))
{
	$output = '';
	if($_POST["action"] == "nivel")
	{
		$result=$obj->consultar("SELECT idgrado, descripcion FROM grado WHERE idnivel = '".$_POST["query"]."'");

		$output .= '<option value="">Seleccione un grado</option>';
		foreach((array)$result as $row){
		$output .='<option value="'.$row['idgrado'].'">'.$row['descripcion'].'</option>';
		//$row['idaula'] es el id que se va evaluar y $row['seccion'] es donde se va mostrar en el select con las secciones
		}
	}

	echo $output;
	
}
?>