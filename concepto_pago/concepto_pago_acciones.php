<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idconcepto'],ENT_QUOTES))));

$data=$obj->consultar("SELECT * FROM conceptoPago WHERE idconcepto='".$obj->real_escape_string($id)."'");
      foreach($data as $row){
         $selector_nivel = $row['idnivel'];
         $concepto = $row['concepto'];
         $monto = $row['monto'];
         $fec_inicio = $row['fec_inicio'];
         $fec_vencimiento = $row['fec_vencimiento'];
         $mora = $row['mora'];
         $descuento = $row['descuento'];
      }
?>
<head>
   <style>
      input[type="text"] {
         text-transform:uppercase;
      }
   </style>
</head>
<div class="content-wrapper">
   <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
         <div class="box-header with-border">
            <h3 class="box-title"><b>CONCEPTO DE PAGO</b></h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
         <label id="aviso"></label>
            <form action="procesar.php" method="post">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Concepto:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-pencil"></i>
                           </div>
                           <input type="text" class="form-control requerido habilitado" placeholder="Ejemplo, Matricula" name="concepto" value="<?php echo $concepto; ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Monto:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                           </div>
                           <input type="text" class="form-control moneda numero requerido habilitado" placeholder="Ingrese el monto " name="monto" min="0.00" value="<?php echo $monto; ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Fecha de Inicio:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="date" class="form-control habilitado" name="fec_inicio" value="<?php echo $fec_inicio; ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Descuento:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                           </div>
                           <input type="text" class="form-control moneda numero habilitado" placeholder="Ingrese el descuento" name="descuento" min="0.00" value="<?php echo $descuento; ?>" disabled>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Nivel:</label>
                        <select class="form-control select2 requerido habilitado" style="width: 100%;" id="nivel" disabled>
                           <option value="" selected>seleccione un nivel academico</option>
                           <?php 
                              $result=$obj->consultar("SELECT * FROM nivel");
                              foreach((array)$result as $row){
                                 if($row['idnivel']==$selector_nivel){
                                    echo '<option value="'.$row['idnivel'].'" selected>'.$row['descripcion'].'</option>';
                                 } else {
                                    echo '<option value="'.$row['idnivel'].'">'.$row['descripcion'].'</option>';
                                 }
                              }
                           ?>
                        </select>
                        <input type="hidden" id="id_nivelSeleccionado" name="id_nivel" value="<?php echo $selector_nivel; ?>"/>
                     </div>
                     <div class="form-group">
                        <label>Fecha de Vencimiento:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="date" class="form-control habilitado" name="fec_vencimiento" value="<?php echo $fec_vencimiento; ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Mora por dia:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                           </div>
                           <input type="text" class="form-control numero moneda habilitado" placeholder="Ingrese la mora diaria" name="mora" min="0.00" value="<?php echo $mora; ?>" disabled>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.row -->
               <input type="hidden" name="proceso" id="proceso" value=""/>
               <input type="hidden" name="id" value="<?php echo $id;?>"/>
            </form>
         </div>
         <!-- /.body-->
         <div class="box-footer">
            <center>
            <button type="submit" class="btn btn-info" id="Modificar" onclick="Actualizar()"><i class="fa fa-pencil"></i><span>Actualizar Concepto</span></button>
            <button id="Cancelar" class="btn btn-info" onclick="Cancelar()">
            <i class="fa fa-close">Cancelar</i>
            </button>
            </center>
         </div>
         <!-- /.footer-->
      </div>
      <!-- /.box-->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="../plugins/jquery-1.10.2.js"></script>
<script>
$(document).ready(function(){
   $("#nivel").change(function(){
      $("#id_nivelSeleccionado").val($("#nivel option:selected").val());
   });
});
</script>
<script type="text/javascript">

   function Actualizar(){
      $(".habilitado").prop( "disabled", false );
      $("#Modificar span").text("Actualizar Registro");
      $("#Modificar").click(function(){

      var error = 0;

      $('.requerido').each(function(i, elem){
         if($(elem).val() == ''){
            $(elem).css({'background-color':'#FFEDFF','border':'1px solid red'});
            error++;
            }
         });

         if(error > 0) {
            event.preventDefault();
            $('#aviso').text(' ■ Se deben completar los campos obligatorios <br />');
            $('#aviso').css({'color':'red','font-size':'12px'});
         } else {
            $("#proceso").attr("value","Modificar");
            $( "form" ).submit();
         }
      });
   }

   function Eliminar(){
      $("#proceso").attr("value","Eliminar");
      $("form").submit();
   }

   function Cancelar() {
      // Recargo la página
      location.href="concepto_pago.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>