<?php
// include("../seguridad.php");
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idcurso_prof'],ENT_QUOTES))));

$data=$obj->consultar("SELECT g.idnivel AS idnivel, g.idgrado AS idgrado, a.idaula AS idaula, a.seccion AS aula, cp.idcurso AS idcurso, p.idprof AS idprof, p.nombre_prof AS profesor FROM cursos_profesor cp INNER JOIN aula a INNER JOIN profesores p INNER JOIN cursos c INNER JOIN grado g INNER JOIN nivel n ON cp.idaula=a.idaula AND cp.idprof=p.idprof AND cp.idcurso=c.idcurso AND c.idgrado=g.idgrado AND g.idnivel=n.idnivel WHERE idcurso_prof='".$obj->real_escape_string($id)."'");
	foreach($data as $row) {
      $selector_nivel=$row['idnivel'];
      $selector_grado=$row['idgrado'];
      $selector_aula=$row['idaula'];
      $selector_curso=$row['idcurso'];
      $selector_prof=$row['idprof'];
      $profesor=$row['profesor'];
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
            <h3 class="box-title"><b>PROGRAMACION ACADEMICA POR DOCENTE</b></h3>
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
                        <select class="form-control select2 nivel_grado habilitado requerido" style="width: 100%;" id="nivel" disabled>                          
                           <?php
                           $result=$obj->consultar("SELECT a.idnivel AS id_nivel, n.descripcion AS nivel FROM aula a INNER JOIN nivel n ON a.idnivel=n.idnivel GROUP BY n.descripcion");
                           
                           foreach((array)$result as $row){
                              if($row['id_nivel']==$selector_nivel){
                                 echo '<option value="'.$row['id_nivel'].'" selected>'.$row['nivel'].'</option>';
                              } else {
                                 echo '<option value="'.$row['id_nivel'].'">'.$row['nivel'].'</option>';
                              }
                           }
                           ?>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Grado:</label>
                        <select class="form-control select2 nivel_grado habilitado requerido" style="width: 100%;" id="grado" disabled>
                           <?php
                           $result=$obj->consultar("SELECT g.idgrado AS id_grado, g.descripcion AS grado FROM cursos c INNER JOIN grado g ON c.idnivel=g.idnivel WHERE c.idnivel=$selector_nivel GROUP BY grado;");

                           foreach((array)$result as $row){
                              if($row['id_grado']==$selector_grado){
                                 echo '<option value="'.$row['id_grado'].'" selected>'.$row['grado'].'</option>';
                              }else{
                                 echo '<option value="'.$row['id_grado'].'">'.$row['grado'].'</option>';
                              }
                           }
                           ?>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Aula:</label>
                        <select class="form-control select2 nivel_grado habilitado requerido" style="width: 100%;" id="aula" disabled>
                           <?php
                           $result=$obj->consultar("SELECT a.idaula AS id_aula, a.seccion AS aula FROM aula a INNER JOIN nivel n INNER JOIN grado g ON a.idnivel=n.idnivel AND a.idgrado=g.idgrado WHERE a.idnivel=$selector_nivel AND a.idgrado=$selector_grado GROUP BY n.descripcion, g.descripcion, a.seccion");
                           foreach((array)$result as $row){
                              if($row['id_aula']==$selector_aula){
                                 echo '<option value="'.$row['id_aula'].'" selected>'.$row['aula'].'</option>';
                              }else{
                                 echo '<option value="'.$row['id_aula'].'">'.$row['aula'].'</option>';
                              }
                           }
                           ?>
                        </select>
                        <input type="hidden" id="nombre_aulaSeleccionado" name="aula" value="<?php echo $selector_aula; ?>" />
                     </div>
                     <div class="form-group">
                        <label>Curso:</label>
                        <select class="form-control select2 nivel_grado habilitado requerido" style="width: 100%;" id="curso" disabled>
                           <?php
                           $result=$obj->consultar("SELECT c.idcurso AS id_curso, c.descripcion AS curso FROM aula a INNER JOIN cursos c ON a.idgrado=c.idgrado WHERE a.idgrado=$selector_grado GROUP BY descripcion");
                           
                           foreach((array)$result as $row){
                              if($row['id_curso']==$selector_curso){
                                 echo '<option value="'.$row['id_curso'].'" selected>'.$row['curso'].'</option>';
                              }else{
                                 echo '<option value="'.$row['id_curso'].'">'.$row['curso'].'</option>';
                              }
                           }
                           ?>
                        </select>
                        <input type="hidden" id="nombre_cursoSeleccionado" name="curso" value="<?php echo $selector_curso; ?>" />
                     </div>
                     <div class="form-group">
                        <label>Docente:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" id="docente" class="form-control habilitado requerido" placeholder="busqueda por apellidos" value="<?php echo $profesor; ?>" disabled />
                           <input type="hidden" id="id_docenteSeleccionado" name="docente" value="<?php echo $selector_prof; ?>" />
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.row -->
               <input type="hidden" name="proceso" id="proceso" value=""/>
               <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            </form>
         </div>
         <!-- /.body-->
         <div class="box-footer">
            <center>
               <button type="submit" class="btn btn-info" id="Modificar" onclick="Actualizar()"><i class="fa fa-pencil"></i><span>Actualizar Informacion</span></button>
               <button type="submit" class="btn btn-danger" id="Eliminar" onclick="Eliminar()"><i class="fa fa-pencil"></i><span>Eliminar Informacion</span></button>
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
$(function() {
   $("#docente").autocomplete({
      source: "busquedaprofesor.php",
      minLength: 2,
      select: function(event, ui) {
         event.preventDefault();
         $('#docente').val(ui.item.profesor);
         $('#id_docenteSeleccionado').val(ui.item.idprof);
      }
   });
});
</script>
<script>
$(document).ready(function() {
   $("#curso").change(function(){
      $("#nombre_cursoSeleccionado").val($("#curso option:selected").val());
   });
   $('.nivel_grado').change(function() {
      if($(this).val() != '')
      {
         var action = $(this).attr("id");
         var query = $(this).val();
         var result = '';

         if (action == "nivel") {
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
            $('#aviso').text(' ■ Se deben completar los campos obligatorios');
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
      location.href="cursos_prof.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>