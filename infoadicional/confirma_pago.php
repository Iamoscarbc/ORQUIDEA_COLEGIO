<head>
    <link rel="stylesheet" href="../plugins/alert/alertify/alertify.css">
    <link rel="stylesheet" href="../plugins/alert/alertify/themes/default.css">
    <script src="../plugins/alert/alertify/alertify.js"></script>
</head>
<body>
<?php
include_once("../conexion/clsConexion.php");
$obj= new clsConexion();

//if (isset($_POST["proceso"])) {
    //$proceso=$_POST["proceso"];

    //if($proceso=="Modificar"){
        $id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idvoucher'],ENT_QUOTES))));

        $sql="UPDATE voucherpago SET confirmapago='1' WHERE idvoucher=$id";
        $obj->ejecutar($sql);
        echo"
            <script>
                alertify.alert('VOUCHER DE PAGO CONFIRMADO', 'Registro Actualizado!', function(){
                alertify.success('Ok');
                self.location='../infoadicional/detalle_inscripcion.php?idalu=12';
                });
            </script>";
    //}
//}
?>
</body>