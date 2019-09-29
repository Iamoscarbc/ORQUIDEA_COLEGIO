<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idcurso'],ENT_QUOTES))));

$data=$obj->consultar("SELECT c.idnivel AS idnivel, c.idgrado AS idgrado, g.descripcion AS grado, c.descripcion AS descripcion FROM cursos c INNER JOIN grado g ON c.idgrado=g.idgrado WHERE idcurso='".$obj->real_escape_string($id)."'");
      foreach($data as $row){
         $selector_grado=$row["idgrado"];
         $selector_nivel=$row["idnivel"];      
         $descripcion = $row['descripcion'];
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
            <h3 class="box-title"><b>ASIGNATURA</b></h3>
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
                           $result=$obj->consultar("SELECT c.idnivel AS id_nivel, n.descripcion AS nivel FROM cursos c INNER JOIN nivel n ON c.idnivel=n.idnivel GROUP BY nivel;");

                           foreach((array)$result as $row){
                              if($row['id_nivel']==$selector_nivel){
                                 echo '<option value="'.$row['id_nivel'].'" selected>'.$row['nivel'].'</option>';
                              }else{
                                 echo '<option value="'.$row['id_nivel'].'">'.$row['nivel'].'</option>';
                              }
                           }
                           ?>
                        </select>
                        <input type="hidden" id="nombre_nivelSeleccionado" name="id_nivel" value="<?php echo $selector_nivel; ?>" />
                     </div>
                     <div class="form-group">
                        <label>Grado:</label>
                        <select class="form-control select2 nivel_grado habilitado requerido" style="width: 100%;" id="grado" disabled>
                           <?php
                           $result=$obj->consultar("SELECT a.idgrado AS id_grado, g.descripcion AS grado FROM aula a INNER JOIN nivel n INNER JOIN grado g ON a.idnivel=n.idnivel AND a.idgrado=g.idgrado WHERE g.idnivel=$selector_nivel GROUP BY n.descripcion, g.descripcion");

                           foreach((array)$result as $row){
                              if($row['id_grado']==$selector_grado){
                                 echo '<option value="'.$row['id_grado'].'" selected>'.$row['grado'].'</option>';
                              }else{
                                 echo '<option value="'.$row['id_grado'].'">'.$row['grado'].'</option>';
                              }
                           }
                           ?>
                        </select>
                        <input type="hidden" id="nombre_gradoSeleccionado" name="id_grado" value="<?php echo $selector_grado; ?>" />
                     </div>
                     <div class="form-group">
                        <label>Descripcion:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-pencil"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="descripcion" required disabled placeholder="Ejemplo, MATEMATICA" maxlength="255" value="<?php echo $descripcion;?>">
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
            <button type="submit" class="btn btn-info" id="Modificar" onclick="Actualizar()"><i class="fa fa-pencil"></i><span>Actualizar Curso</span></button>            
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

   $("#grado").change(function(){
         $("#nombre_gradoSeleccionado").val($("#grado option:selected").val());
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
      location.href="cursos.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>