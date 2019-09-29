<!DOCTYPE html>
<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
?>
<head>
   <style>
      input[name="seccion"] {
         text-transform:uppercase;
      }
   </style>
</head>
<div class="content-wrapper">
   <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
      <label id="aviso"></label>
         <div class="box-header with-border">
            <h3 class="box-title"><b>REGISTRAR AULA</b></h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
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
                        <input type="hidden" id="nombre_nivelSeleccionado" name="nivel" value="" />
                     </div>
                     <div class="form-group">
                        <label>Grado:</label>
                        <select class="form-control select2 nivel_grado requerido" style="width: 100%;" id="grado">
                        </select>
                        <input type="hidden" id="nombre_gradoSeleccionado" name="grado" value="" />
                     </div>
                     <div class="form-group">
                        <label>Turno:</label>
                        <select class="form-control select2 requerido" style="width: 100%;" name="turno">
                           <option selected="selected">MAÑANA</option>
                           <option>TARDE</option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Seccion:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-sort-alpha-desc"></i>
                           </div>
                           <input type="text" name="seccion" class="form-control requerido" placeholder="ingrese el nombre de la seccion" maxlength="50">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Numero de Vacantes:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                           <i class="fa fa-sort-numeric-desc"></i>
                           </div>
                           <input type="number" name="vacantes" class="form-control requerido" placeholder="ingrese el numero de vacantes, por ejemplo 20" >
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
            <button type="submit" class="btn btn-info" id="Modificar" onclick="Registrar()"><i class="fa fa-pencil"></i><span>Registrar Nueva Aula</span></button>
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
      location.href="aula_grado.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>