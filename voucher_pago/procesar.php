<head>
	<link rel="stylesheet" href="../plugins/alert/alertify/alertify.css">
	<link rel="stylesheet" href="../plugins/alert/alertify/themes/default.css">
	<script src="../plugins/alert/alertify/alertify.js"></script>
</head>
<body>
<?php
	include_once("../conexion/clsConexion.php");
	$obj= new clsConexion();

	if (isset($_GET['Eliminar'])) {
		$proceso_eliminar=$_GET['Eliminar'];

		if($proceso_eliminar=="Eliminar"){
			$id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idvoucher'],ENT_QUOTES))));

			$sql= "DELETE FROM voucherPago WHERE idvoucher='".$obj->real_escape_string($id)."'";
			$obj->ejecutar($sql);
			echo"<script>
					alertify.alert('VOUCHER DE PAGO','Registro Eliminado.', function(){
						alertify.message('OK');
						self.location='voucher_pago.php';
					});
		</script>";
		}
	}

	if (isset($_POST["proceso"])) {
		$proceso=$_POST["proceso"];

		if($proceso=="Modificar"){
			$id=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['id'],ENT_QUOTES))));
			$descripcion=strtoupper(trim($obj->real_escape_string(htmlentities(strip_tags($_POST['descripcion'],ENT_QUOTES)))));

			$sql="UPDATE nivel SET `descripcion`='$descripcion' WHERE idnivel=$id";
			$obj->ejecutar($sql);
			echo"<script>
					alertify.alert('VOUCHER DE PAGO', 'Registro Actualizado!', function(){
					alertify.success('Ok');
					self.location='voucher_pago.php';
					});
				  </script>";
		}

		if($proceso=="Registrar"){
			$nombre_img = $_FILES['imagen_voucher']['name'];
			$tipo = $_FILES['imagen_voucher']['type'];
			$tamano = $_FILES['imagen_voucher']['size'];
			if ($nombre_img == !NULL){
				//indicamos los formatos que permitimos subir a nuestro servidor
				if (($_FILES["imagen_voucher"]["type"] == "image/gif")
				|| ($_FILES["imagen_voucher"]["type"] == "image/jpeg")
				|| ($_FILES["imagen_voucher"]["type"] == "image/jpg")
				|| ($_FILES["imagen_voucher"]["type"] == "image/png")){
					// Ruta donde se guardarán las imágenes que subamos
					$directorio = $_SERVER['DOCUMENT_ROOT'].'/voucher_pago/voucher/';
					// Muevo la imagen desde el directorio temporal a nuestra ruta indicada anteriormente
					move_uploaded_file($_FILES['imagen_voucher']['tmp_name'],$directorio.$nombre_img);
				}
				else{
					//si no cumple con el formato
					echo "No se puede subir una imagen con ese formato ";
				}
			}else{
				//si existe la variable pero se pasa del tamaño permitido
				if($nombre_img == !NULL) echo "La imagen es demasiado grande ";
			}
			$apoderado=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['apoderado'],ENT_QUOTES))));
			$numero_voucher=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['numero_voucher'],ENT_QUOTES))));
			// $imagen_voucher=$_POST["imagen_voucher"];
			$fecha=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['fecha'],ENT_QUOTES))));

			$sql="INSERT INTO voucherPago (idapoderado, numero_voucher, imagen_voucher, fecha) VALUES ('$apoderado', '$numero_voucher', 'voucher/$nombre_img', '$fecha')";
			// var_dump($sql);exit;
            $obj->ejecutar($sql);
			echo"<script>
					alertify.alert('VOUCHER DE PAGO', 'Registro Grabado!', function(){
					alertify.success('OK');
					self.location='voucher_pago.php';
					});
				</script>";
            }
	}
?>
</body>