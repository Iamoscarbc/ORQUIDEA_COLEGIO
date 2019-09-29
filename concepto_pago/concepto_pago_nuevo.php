<!DOCTYPE html>
<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
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
            <h3 class="box-title"><b>REGISTRAR CONCEPTO DE PAGO</b></h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <form action="procesar.php" method="post">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Concepto:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-pencil"></i>
                           </div>
                           <input type="text" class="form-control requerido" placeholder="Ejemplo, Matricula" name="concepto">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Monto:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                           </div>
                           <input type="text" class="form-control moneda numero requerido" placeholder="Ingrese el monto " name="monto" min="0.00" >
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Fecha de Inicio:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="date" class="form-control" name="fec_inicio">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Descuento:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                           </div>
                           <input type="text" class="form-control moneda numero" placeholder="Ingrese el descuento" name="descuento" min="0.00" >
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Nivel:</label>
                        <select class="form-control select2 requerido" style="width: 100%;" id="nivel">
                           <option value="" selected>seleccione un nivel academico</option>
                           <?php
                           $result=$obj->consultar("select * from nivel");

                           foreach((array)$result as $row){
                              if($row['idnivel']==$nivel){
                                 echo '<option value="'.$row['idnivel'].'">'.$row['descripcion'].'</option>';
                              }else{
                                 echo '<option value="'.$row['idnivel'].'">'.$row['descripcion'].'</option>';
                              }
                           }
                           ?>
                        </select>
                        <input type="hidden" id="id_nivelSeleccionado" name="id_nivel" value="" />
                     </div>
                     <div class="form-group">
                        <label>Fecha de Vencimiento:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="date" class="form-control" name="fec_vencimiento">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Mora por dia:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                           </div>
                           <input type="text" class="form-control numero moneda" placeholder="Ingrese la mora diaria" name="mora" min="0.00" >
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.row -->
               <input type="hidden" name="proceso" id="proceso" value=""/>
            </form>
         </div>
         <!-- /.body-->
         <div class="box-footer">
            <center>
               <button type="submit" class="btn btn-info" id="Modificar" onclick="Registrar()"><i class="fa fa-pencil"></i><span>Registrar Nuevo Concepto</span></button>
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
<script type="text/javascript">
   $('.numero').on('input', function () { 
      this.value = this.value.replace(/[^0-9]/g,'');
   });
</script>
<script type="text/javascript">   
   $('.moneda').on({
       "focus": function (event) {
           $(event.target).select();
       },
       "keyup": function (event) {
           $(event.target).val(function (index, value ) {
               return value.replace(/\D/g, "")
                           .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                           .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
           });
       }
   });
</script>
<script type="text/javascript">
$(document).ready(function() {
   $("#nivel").change(function() {
      $("#id_nivelSeleccionado").val($("#nivel option:selected").val());
   });
});
</script>
<script type="text/javascript">
   function Registrar(){

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
         $("#proceso").attr("value","Registrar");
         $( "form" ).submit();
      }
   }

   function Cancelar() {
      // Recargo la página
      location.href="../concepto_pago/concepto_pago.php";
   }
</script>
<?php include("../central/pie2.php");?>
<?php include("../central/pie.php");?>