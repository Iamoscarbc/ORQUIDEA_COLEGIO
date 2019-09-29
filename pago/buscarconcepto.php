<?php
//include("../seguridad.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;

if (isset($_GET['term'])){
    $return_arr = array();

    $result=$obj->consultar("
            SELECT
                cp.idconcepto AS idconcepto,
                cp.idnivel AS idnivel,
                CONCAT(cp.concepto, ' ',n.descripcion) AS concepto,
                cp.monto AS monto,
                cp.fec_inicio AS fec_inicio,
                cp.fec_vencimiento AS fec_vencimiento,
                cp.mora AS mora,
                cp.descuento AS descuento
            FROM conceptopago cp
            INNER JOIN nivel n ON n.idnivel=cp.idnivel
            WHERE CONCAT(cp.concepto, ' ',n.descripcion) like '%" .($_GET['term']) . "%' LIMIT 0 ,50");

        foreach((array)$result as $row){
            $row_array['value']=$row['concepto'];
            $row_array['id_concepto']=$row['idconcepto'];
            $row_array['concepto_pago']=$row['concepto'];
            $row_array['mora_pago']=$row['mora'];
            $row_array['descuento_pago']=$row['descuento'];
            $row_array['subtotal_pago']=$row['monto'];
            $row_array['total_pago']=$row['monto'] + $row['mora'] - $row['descuento'];

            array_push($return_arr,$row_array);
    }
    echo json_encode($return_arr);
}
?>