<?php
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;

if(isset($_POST["action"]))
{
	$output = '';
	if($_POST["action"] == "nivel")
	{
		$result=$obj->consultar("SELECT a.idgrado AS idgrado, g.descripcion AS grado FROM aula a INNER JOIN grado g ON a.idgrado=g.idgrado WHERE a.idnivel = '".$_POST["query"]."' group by grado");

		$output .= '<option value="">Seleccione un grado</option>';
		foreach((array)$result as $row){
		$output .='<option value="'.$row['idgrado'].'">'.$row['grado'].'</option>';
		//$row['idaula'] es el id que se va evaluar y $row['seccion'] es donde se va mostrar en el select con las secciones
		}
	}

	if($_POST["action"] == "grado")
	{
		$result=$obj->consultar("SELECT idaula, seccion FROM aula WHERE idgrado = '".$_POST["query"]."'");

		$output .= '<option value="">Seleccione un aula</option>';
		foreach((array)$result as $row){
		$output .='<option value="'.$row['idaula'].'">'.$row['seccion'].'</option>';
		//$row['idaula'] es el id que se va evaluar y $row['seccion'] es donde se va mostrar en el select con las secciones
		}
	}

	if($_POST["action"] == "aula")
	{
		$result=$obj->consultar("SELECT c.idcurso as idcurso, c.descripcion as descripcion FROM cursos c INNER JOIN aula a ON c.idgrado=a.idgrado WHERE a.idaula ='".$_POST["query"]."'");

		$output .= '<option value="">Seleccione una asignatura</option>';
		foreach((array)$result as $row){
			$output .='<option value="'.$row['idcurso'].'">'.$row['descripcion'].'</option>';
		}
	}

	echo $output;
	
}
?>