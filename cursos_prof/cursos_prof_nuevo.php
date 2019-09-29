<!DOCTYPE html>
<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$result=$obj->consultar("select a.idnivel as idnivel, n.descripcion as nivel from aula a inner join nivel n on a.idnivel=n.idnivel group by nivel");
?>
<head>
   <link rel="stylesheet" href="../plugins/jquery-ui.css">
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
            <h3 class="box-title"><b>REGISTRAR PROGRAMACION ACADEMICA DEL DOCENTE</b></h3>
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
                           foreach((array)$result as $row){
                              if($row['idnivel']==$selector_nivel){
                                 echo '<option value="'.$row['idnivel'].'" selected>'.$row['nivel'].'</option>';
                              }else{
                                 echo '<option value="'.$row['idnivel'].'">'.$row['nivel'].'</option>';
                              }
                           }
                           ?>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Grado:</label>
                        <select class="form-control select2 nivel_grado requerido" style="width: 100%;" id="grado">
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Aula:</label>
                        <select class="form-control select2 nivel_grado requerido" style="width: 100%;" id="aula">
                        </select>
                        <input type="hidden" id="nombre_aulaSeleccionado" name="aula" value="" />
                     </div>
                     <div class="form-group">
                        <label>Curso:</label>
                        <select class="form-control select2 nivel_grado requerido" style="width: 100%;" id="curso">
                        </select>
                        <input type="hidden" id="nombre_cursoSeleccionado" name="curso" value="" />
                     </div>
                     <div class="form-group">
                        <label>Docente:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" id="docente" class="form-control requerido" placeholder="busqueda por apellidos"/>
                           <input type="hidden" id="id_docenteSeleccionado" name="docente"/>
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
            <button type="submit" class="btn btn-info" id="Modificar" onclick="Registrar()"><i class="fa fa-pencil"></i><span>Registrar Nuevo Usuario</span></button>
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
<script src="../plugins/jquery-ui.js"></script>
<script type="text/javascript">
   let docente = document.getElementById("docente");

   docente.addEventListener("keyup",function() {
      console.log(docente.value);
   })
   $(function() {
      $("#docente").autocomplete({
         source: "busquedaprofesor.php",
         minLength: 2,
         select: function(event, ui) {
            event.preventDefault();
            $('#docente').val(ui.item.profesor);
            $('#id_docenteSeleccionado').val(ui.item.idprof);
            console.log(ui)
         }
      });
   });
</script>
<script>
$(document).ready(function() {

   $('.nivel_grado').change(function() {
      if($(this).val() != '')
      {
         var action = $(this).attr("id");
         var query = $(this).val();
         var result = '';

         if (action == "nivel"){
            result = 'grado';
         } else if (action == "grado") {
            result = 'aula';
         } else if (action == "aula") {
            result = 'curso';
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

      $("#aula").change(function(){
         $("#nombre_aulaSeleccionado").val($("#aula option:selected").val());
      });

      $("#curso").change(function(){
         $("#nombre_cursoSeleccionado").val($("#curso option:selected").val());
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
         $('#aviso').text(' ■ Se deben completar los campos obligatorios');
         $('#aviso').css({'color':'red','font-size':'12px'});
      } else {
         $("#proceso").attr("value","Registrar");
         $( "form" ).submit();
      }
   }

   function Cancelar() {
      // Recargo la página
      location.href="cursos_prof.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>