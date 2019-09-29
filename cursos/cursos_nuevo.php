<!DOCTYPE html>
<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
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
            <h3 class="box-title"><b>REGISTRAR ASIGNATURA</b></h3>
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
                        <label>Nivel:</label>
                        <select class="form-control select2 nivel_grado requerido" style="width: 100%;" id="nivel">
                           <option value="" selected>seleccione un nivel academico</option>
                           <?php
                           $result=$obj->consultar("select * from nivel");

                           foreach((array)$result as $row){
                              if($row['idnivel']==$selector_nivel){
                                 echo '<option value="'.$row['idnivel'].'" selected>'.$row['descripcion'].'</option>';
                              }else{
                                 echo '<option value="'.$row['idnivel'].'">'.$row['descripcion'].'</option>';
                              }
                           }
                           ?>
                        </select>
                        <input type="hidden" id="nombre_nivelSeleccionado" name="id_nivel" value="" />
                     </div>
                     <div class="form-group">
                        <label>Grado:</label>
                        <select class="form-control select2 nivel_grado requerido" style="width: 100%;" id="grado">
                        </select>
                        <input type="hidden" id="nombre_gradoSeleccionado" name="id_grado" value="" />
                     </div>
                     <div class="form-group">
                        <label>Descripcion:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-pencil"></i>
                           </div>
                           <input type="text" class="form-control requerido" name="descripcion" placeholder="Ejemplo, MATEMATICA" maxlength="255">
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
               <button type="submit" class="btn btn-info" onclick="Registrar()"><i class="fa fa-pencil"></i><span>Registrar Nueva Asignatura</span></button>
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
$(document).ready(function() {
   $("#nivel").change(function() {
      $("#nombre_nivelSeleccionado").val($("#nivel option:selected").val());
   });

   $('.nivel_grado').change(function() {
      if($(this).val() != '')
      {
         var action = $(this).attr("id");
         var query = $(this).val();
         var result = '';

         if(action == "nivel"){
            result = 'grado';
         }

         $.ajax({
            url:"selectdependientes.php",
            method:"POST",
            data:{action:action, query:query},
            success:function(data){
               $('#'+result).html(data);
            }
         })
      }

      $("#grado").change(function(){
         $("#nombre_gradoSeleccionado").val($("#grado option:selected").val());
      });
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
      location.href="cursos.php";
   }
</script>
<?php include("../central/pie2.php");?>
<?php include("../central/pie.php");?>