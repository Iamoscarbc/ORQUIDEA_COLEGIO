<?php
   // include("../seguridad.php");
   include_once("../conexion/clsConexion.php");
   $obj= new clsConexion();
   if (isset($_GET['term'])){
      $return_arr = array();
      // Si la conexi�n a la base de datos , ejecuta instrucci�n SQL.
      $data=$obj->consultar("SELECT * FROM periodo WHERE año like '%" . ($_GET['term']) . "%'");
      //Recuperar y almacenar en conjunto los resultados de la consulta.*/
      foreach($data as $row) {
         $row_array['value'] =$row['año'];
         $row_array['pbfi']=$row['pri_bim_fec_inicio'];
         $row_array['pbff']=$row['pri_bim_fec_fin'];
         $row_array['sbfi']=$row['seg_bim_fec_inicio'];
         $row_array['sbff']=$row['seg_bim_fec_fin'];
         $row_array['tbfi']=$row['ter_bim_fec_inicio'];
         $row_array['tbff']=$row['ter_bim_fec_fin'];
         $row_array['cbfi']=$row['cua_bim_fec_inicio'];
         $row_array['cbff']=$row['cua_bim_fec_fin'];

         array_push($return_arr,$row_array);
      }
      /* Codifica el resultado del array en JSON. */
      echo json_encode($return_arr);
   }
?>