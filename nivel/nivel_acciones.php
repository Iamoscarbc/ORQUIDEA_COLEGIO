<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
   $obj=new clsConexion;
   $id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idnivel'],ENT_QUOTES))));

   $data=$obj->consultar("SELECT * FROM nivel WHERE idnivel='".$obj->real_escape_string($id)."'");
   foreach($data as $row){
      $descripcion= $row['descripcion'];
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
            <h3 class="box-title"><b>NIVEL EDUCATIVO</b></h3>
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
                        <label>Descripcion:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-pencil"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="descripcion" required disabled placeholder="Ejemplo,PRIMARIA" maxlength="255" value="<?php echo $descripcion;?>">
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
            <button type="submit" class="btn btn-info" id="Modificar" onclick="Actualizar()"><i class="fa fa-pencil"></i><span>Actualizar Nivel Educativo</span></button>
            <button type="submit" class="btn btn-danger" id="Eliminar" onclick="Eliminar()"><i class="fa fa-pencil"></i><span>Eliminar Nivel Educativo</span></button>
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
<script type="text/javascript">

   function Actualizar(){
      $(".habilitado").prop( "disabled", false );
      $("#Eliminar").hide();
      $("#Modificar span").text("Actualizar Registro");
      $("#Modificar").click(function(){
         var error = 0;

         $('.requerido').each(function(i, elem){
            if($(elem).val() == '') {
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
      location.href="nivel.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>