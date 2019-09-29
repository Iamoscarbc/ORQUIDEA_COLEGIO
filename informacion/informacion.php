<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Documento sin título</title>
    <style type="text/css">
        #apDiv1 {
            position: absolute;
            left: 120px;
            top: 220px;
            width: 390px;
            height: 521px;
            z-index: 1;
        }
        #apDiv2 {
            position: absolute;
            left: 600px;
            top: 216px;
            width: 770px;
            height: 355px;
            z-index: 2;
        }
        #apDiv3 {
            position: absolute;
            left: 600px;
            top: 620px;
            width: 767px;
            height: 83px;
            z-index: 3;
        }
        #apDiv4 {
            position: absolute;
            left: 1070px;
            top: 698px;
            width: 600px;
            height: 24px;
            z-index: 4;
        }

        body {
            background-color: #FC0;
        }
    </style>
</head>
<?php
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;

$data=$obj->consultar("SELECT * FROM informacion");
foreach($data as $row){
    $objetivos = $row['objetivos'];
    $requisitos = $row['requisitos'];
    $infoadicional = $row['infoadicional'];
}
?>
<body>
<div id="apDiv1"><div align="justify" style="font-size:20px; font-family:Calibri"><?php echo $objetivos; ?></div></div>
<div id="apDiv2"><div align="justify" style="font-size:20px; font-family:Calibri"><?php echo $requisitos; ?></div></div>
<div id="apDiv3"><div align="justify" style="font-size:20px; font-family:Calibri"><?php echo $infoadicional; ?></div></div>
<div id="apDiv4" style="font-size:18px; font-family:Calibri"></span><strong>Para inscripciones pulse</strong> <a href="../inscripciones/registrar_apoderado.php"><strong>Aqui</strong></a><strong> o </strong> <a href="../index.php"><strong>Cancelar</strong></a></p></td></div>
<div align="center" id="imagen"><img src="Información.png" alt="" width="1366" height="768" /></div>
</body>
</html>
