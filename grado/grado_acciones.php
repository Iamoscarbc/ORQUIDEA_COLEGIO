<?php
// include("../seguridad.php");
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idgrado'],ENT_QUOTES))));

$data=$obj->consultar("SELECT n.idnivel AS id_nivel, n.descripcion AS nivel, g.descripcion AS grado FROM grado g INNER JOIN nivel n ON g.idnivel=n.idnivel WHERE g.idgrado='".$obj->real_escape_string($id)."'");

	foreach($data as $row){
      $selector_nivel=$row['id_nivel'];
      $nivel= $row['nivel'];
      $grado= $row['grado'];
	}
?>
<div class="content-wrapper">
   <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
         <div class="box-header with-border">
            <h3 class="box-title"><b>GRADO ACADEMICO</b></h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
         <label id="aviso"> </label>         
            <form action="procesar.php" method="post">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Nivel:</label>
                        <select class="form-control select2 requerido" style="width: 100%;" id="nivel">
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
                        <input type="hidden" id="id_nivelSeleccionado" name="id_nivel" value="<?php echo $selector_nivel;?>" />
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Grado:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-sort-alpha-desc"></i>
                           </div>
                           <input type="text" name="descripcion" class="form-control requerido" placeholder="Por ejemplo, " maxlength="50" value="<?php echo $grado;?>">
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
               <button type="submit" class="btn btn-info" id="Modificar" onclick="Actualizar()"><i class="fa fa-pencil"></i><span>Actualizar Informacion</span></button>
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
   }

   function Cancelar() {
      // Recargo la página
      location.href="grado.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>