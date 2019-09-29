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
            $formatosPermitidos=array(".jpg",".jpeg",".png",".gif");
			$apoderado=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['apoderado'],ENT_QUOTES))));
			$numero_voucher=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['numero_voucher'],ENT_QUOTES))));
			$imagen_voucher=$_POST["imagen_voucher"];
			$fecha=trim($obj->real_escape_string(htmlentities(strip_tags($_POST['fecha'],ENT_QUOTES))));

            $destino_voucher="voucher/".$imagen_voucher;

            $sql="INSERT INTO voucherPago (idapoderado, numero_voucher, imagen_voucher, fecha) VALUES ('$apoderado', '$numero_voucher', '$destino_voucher', '$fecha')";
            $obj->ejecutar($sql);

            }

			echo"<script>
					alertify.alert('VOUCHER DE PAGO', 'Registro Grabado!', function(){
					alertify.success('OK');
					self.location='voucher_pago.php';
					});
				  </script>";
	}
?>
</body>