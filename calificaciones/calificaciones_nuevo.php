<!DOCTYPE html>
<?php
// trae todo el codigo de otra pagina el include asi aiga error lo muestra como sea y lo muestram en tu pagina actual
//el required ase lo mismo pero lo trae obligatorio si esta mal el codigo no muestra nada
   include("../central/cabecera.php");
   include("../central/sidebar.php");
   include_once("../conexion/clsConexion.php");
   $obj=new clsConexion;
   $result=$obj->consultar("select a.idnivel as idnivel, n.descripcion as nivel from aula a inner join nivel n on a.idnivel=n.idnivel group by nivel");

   $periodo=$obj->consultar("SELECT año FROM periodo WHERE año=(SELECT YEAR(NOW()))");
   foreach ((array)$periodo as $row) {
      $periodo=$row['año'];
   }   
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
            <h3 class="box-title"><b>REGISTRAR NOTAS DEL CURSO</b></h3> 
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
                        <label>Fecha:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" class="form-control" readonly name="periodo" value="<?php echo $periodo; ?>" />
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Estudiante:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" id="alumno" class="form-control requerido nivel_grado" placeholder="busqueda por apellidos"/>
                           <input type="hidden" id="id_alumnoSeleccionado" class="nivel_grado" name="alumno"/>
                           <input type="hidden" id="id_matri" name="id_matri">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Nivel:</label>
                        <input type="text" id="nivel" class="form-control requerido deshabilitado" readonly>
                        <!-- <select class="form-control select2 nivel_grado requerido" style="width: 100%;" id="nivel">
                           <option value="" selected>seleccione un nivel academico</option>
                           <?php
                           foreach((array)$result as $row){
                              if($row['idnivel'] == $selector_nivel){
                                 echo '<option value="'.$row['idnivel'].'" selected>'.$row['nivel'].'</option>';
                              }else{
                                 echo '<option value="'.$row['idnivel'].'">'.$row['nivel'].'</option>';
                              }
                           }
                           ?>
                        </select> -->
                     </div>
                     <div class="form-group">
                        <label>Grado:</label>
                        <input type="text" id="grado" class="form-control requerido deshabilitado" readonly>
                        <!-- <select class="form-control select2 nivel_grado requerido" style="width: 100%;" id="grado">
                        </select> -->
                     </div>
                     <div class="form-group">
                        <label>Aula:</label>
                        <input type="text" id="aula" class="form-control requerido deshabilitado" readonly>
                        <input type="hidden" id="id_aula">
                        <!-- <select class="form-control select2 nivel_grado requerido" style="width: 100%;" id="aula">
                        </select> -->
                        <!-- <input type="hidden" id="nombre_aulaSeleccionado" name="aula" value="" /> -->
                     </div>
                     <div class="form-group">
                        <label>Curso:</label>
                        <select class="form-control select2 nivel_grado requerido" style="width: 100%;" id="curso">
                        </select>
                        <input type="hidden" id="nombre_cursoSeleccionado" name="curso" value="" />
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>PRIMER BIMESTRE:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" name="pb" id="pb" class="form-control habilitado amt numero" required value="" >
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>SEGUNDO BIMESTRE:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" name="sb" id="sb" class="form-control habilitado amt numero" required value="" >
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>TERCER BIMESTRE:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" name="tb" id="tb" class="form-control habilitado amt numero" required value="" >
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>CUARTO BIMESTRE:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" name="cb" id="cb" class="form-control habilitado amt numero" required value="" >
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>PROMEDIO FINAL:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" name="pf" id="inputTotal" class="form-control habilitado" required value="" readonly>
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
<script>
$(function() {
   $("#alumno").autocomplete({
      source: "busquedaalumno.php",
      minLength: 2,
      select: function(event, ui) {
         event.preventDefault();
         $('#alumno').val(ui.item.nombre_alumno);
         $('#id_alumnoSeleccionado').val(ui.item.id_alumno);
         $('#grado').val(ui.item.grado);
         $('#nivel').val(ui.item.nivel);
         $('#aula').val(ui.item.aula);
         $('#id_aula').val(ui.item.id_aula);
         $('#id_matri').val(ui.item.id_matri);
      }
   });
});
</script>
<script type="text/javascript">
   $('.numero').on('input', function () { 
      this.value = this.value.replace(/[^0-9]/g,'');
   });
</script>
<script>
   $('.amt').keyup(function() {
      var importe_total = 0
      $(".amt").each(
         function(index, value) {
            if ( $.isNumeric( $(this).val() ) ){
            importe_total = importe_total + eval($(this).val());
      }
    }
  );
      $("#inputTotal").val(Math.round(importe_total/4));
});
</script>
<script>
$(document).ready(function() {

   $('#ui-id-1').click(function() {
      $.ajax({
         url:"selectdependientes.php",
         method:"POST",
         data:{action:'aula', query:$('#id_aula').val()},
         success:function(data){
            $('#curso').html(data);
         }
      })

      // $("#aula").change(function(){
      //    $("#nombre_aulaSeleccionado").val($("#aula option:selected").val());
      // });

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
      location.href="calificaciones.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>