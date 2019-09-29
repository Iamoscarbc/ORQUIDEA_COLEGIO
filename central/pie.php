<?php
	include_once("../conexion/clsConexion.php");
	$obj=new clsConexion;
	$data=$obj->consultar("SELECT * FROM configuracion WHERE idconfig='1'");
	foreach($data as $row){
   	$razon_social=$row["razon_social"];
   }
 ?>

<footer class='main-footer'>
	<div class="pull-right hidden-xs">
		<b>Version</b> 1.0.0
	</div>

	<strong>Copyright &copy;INSTITUCION EDUCATIVA PRIVADA </span> <a href="#"><?php echo $razon_social; ?></a></strong> Todos los derechos reservados.
</footer>
</body>
</html>