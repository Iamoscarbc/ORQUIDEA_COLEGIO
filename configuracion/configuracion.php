<!DOCTYPE html>
<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$data=$obj->consultar("SELECT * FROM configuracion WHERE idconfig='1'");
foreach($data as $row){
   $razon_social=$row["razon_social"];
   $ruc=$row["ruc"];
   $selector_departamento=$row["departamento"];
   $selector_provincia=$row["provincia"];
   $selector_distrito=$row["distrito"];
   $direccion=$row["direccion"];
   $telefono=$row["telefono"];
   $moneda=$row["moneda"];
   $imagen_logo=$row["imagen_logo"];
   $imagen_fondo=$row["imagen_fondo"];
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
            <h3 class="box-title"><b>Configuracion</b></h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
         <label id="aviso"> </label>
            <form role="form"  action="procesar.php" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>R.U.C:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-edit"></i>
                           </div>
                           <input type="text" class="form-control habilitado numero" name="RUC" autocomplete="off" placeholder="Ejemplo, 12345678901" maxlength="11" value="<?php echo $ruc ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Departamento:</label>
                        <select class="form-control select2 ubigeo requerido habilitado requerido" style="width: 100%;" id="departamento" disabled>
                           <option value="">Seleccione un departamento</option>
                           <?php
                           $result=$obj->consultar("SELECT * FROM ubdepartamento");

                           foreach((array)$result as $row){
                              if($row['idDepa']==$selector_departamento){
                                 echo '<option value="'.$row['idDepa'].'" selected>'.$row['departamento'].'</option>';
                              }else{
                                 echo '<option value="'.$row['idDepa'].'">'.$row['departamento'].'</option>';
                              }
                           }
                           ?>
                        </select>
                        <input type="hidden" id="id_departamentoSeleccionado" name="departamento" value="<?php echo $selector_departamento; ?>" />
                     </div>
                     <div class="form-group">
                        <label>Provincia:</label>
                        <select class="form-control select2 ubigeo requerido habilitado requerido" style="width: 100%;" id="provincia" disabled>
                           <?php
                           $result=$obj->consultar("SELECT * FROM ubprovincia WHERE idDepa=$selector_departamento");

                           foreach((array)$result as $row){
                              if($row['idProv']==$selector_provincia){
                                 echo '<option value="'.$row['idProv'].'" selected>'.$row['provincia'].'</option>';
                              }else{
                                 echo '<option value="'.$row['idProv'].'">'.$row['provincia'].'</option>';
                              }
                           }
                           ?>
                        </select>                           
                        <input type="hidden" name="provincia" id="id_provinciaSeleccionada" value="<?php echo $selector_provincia; ?>" />
                     </div>
                     <div class="form-group">
                        <label>Distrito:</label>
                        <select class="form-control select2 requerido habilitado" style="width: 100%;" id="distrito" disabled>
                           <?php
                           $result=$obj->consultar("SELECT * FROM ubdistrito WHERE idProv=$selector_provincia");

                           foreach((array)$result as $row){
                              if($row['idDist']==$selector_distrito){
                                 echo '<option value="'.$row['idDist'].'" selected>'.$row['distrito'].'</option>';
                              }else{
                                 echo '<option value="'.$row['idDist'].'">'.$row['distrito'].'</option>';
                              }
                           }
                           ?>
                        </select>                           
                        <input type="hidden" name="distrito" id="id_distritoSeleccionado" value="<?php echo $selector_distrito; ?>" />
                     </div>
                     <div class="form-group">
                        <label>Direccion:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-home"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="direccion" autocomplete="off" placeholder="ingrese la direccion"  value="<?php echo $direccion ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Razon Social:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-pencil"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="razon_social" autocomplete="off" placeholder="ingrese la razon social" value="<?php echo $razon_social ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Telefono</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <!--esta wevada es lo que ace la imagen del cuandrado-->
                              <i class="fa fa-phone"></i>
                           </div>
                           <input type="text" class="form-control habilitado numero" name="telefono" autocomplete="off" placeholder="ingrese el telefono de la institucion"  value="<?php echo $telefono ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Simbolo Monetario:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                           </div>
                           <input type="text" class="form-control habilitado" name="moneda"  autocomplete="off" placeholder="ingrese el simbolo monetario" maxlength="5" value="<?php echo $moneda ?>" disabled>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Logo del Login:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-camera"></i>
                           </div>
                           <input type="file" name="imagen_logo" accept="image/*" class="form-control habilitado" value="<?php echo $imagen_logo?>" disabled>
                        </div>
                        <p class="help-block">Archivos Permitidos(.jpg y.png)</p>
                     </div>
                     <div class="form-group">
                        <center>
                        <img src="<?php echo $imagen_logo?>" width="160px" height="140px" border="1">
                        </center>
                        <input type="hidden" name="imagen_logo" value="">
                     </div>
                     <div class="form-group">
                        <label>Fondo de pantalla:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-camera"></i>
                           </div>
                           <input type="file" name="imagen_fondo" accept="image/*" class="form-control habilitado" value="<?php echo $imagen_fondo?>" disabled>
                        </div>
                        <p class="help-block">Archivos Permitidos(.jpg y.png)</p>
                     </div>
                     <div class="form-group">
                        <center>
                        <img src="<?php echo $imagen_fondo?>" width="160px" height="140px" border="1">
                        </center>
                        <input type="hidden" name="imagen_fondo" value="">
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
               <button type="submit" class="btn btn-info" id="Modificar" onclick="Actualizar()"><i class="fa fa-pencil"></i><span>Actualizar Configuracion</span></button>            
               <button id="Cancelar" class="btn btn-info hidden" onclick="Cancelar()">
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
$(document).ready(function(){
   $("#departamento").change(function(){
      $("#id_departamentoSeleccionado").val($("#departamento option:selected").val());
   });

   $("#provincia").change(function(){
      $("#id_provinciaSeleccionada").val($("#provincia option:selected").val());
   });

   $("#distrito").change(function(){
      $("#id_distritoSeleccionado").val($("#distrito option:selected").val());
   });

   $('.ubigeo').change(function(){
      if($(this).val() != '')
      {
         var action = $(this).attr("id");
         var query = $(this).val();
         var result = '';

         if(action == "departamento"){
            result = 'provincia';
         }else{
            result = 'distrito';
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
      $("#Cancelar").removeClass("hidden");
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

   function Cancelar() {
      // Recargo la página
      location.href="../configuracion/configuracion.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>