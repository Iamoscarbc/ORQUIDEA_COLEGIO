<!DOCTYPE html>
<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idapo'],ENT_QUOTES))));

$data=$obj->consultar("SELECT * FROM apoderado WHERE idapo='".$obj->real_escape_string($id)."'");
foreach($data as $row){
   $codigo= $row['codigo'];
   $nombres= $row['nombre_apo'];
   $apepat= $row['apepat_apo'];
   $apemat= $row['apemat_apo'];   
   $dni=$row['dni'];
   $selector_departamento=$row["departamento"];
   $selector_provincia=$row["provincia"];
   $selector_distrito=$row["distrito"];
   $direccion= $row['direccion'];
   $fec_nac=$row["fec_nacimiento"];
   $selector_genero=$row['genero'];
   $tel= $row['telefono'];
   $email= $row['email'];
   $ocupacion= $row['ocupacion'];
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
            <h3 class="box-title"><b>APODERADO</b></h3>
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
                        <label>CODIGO:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-pencil"></i>
                           </div>
                           <input type="text" class="form-control" name="codigo" readonly value="<?php echo $codigo; ?>">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Nombres:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="nombres_apo" placeholder="Por ejemplo, Jorge" value="<?php echo $nombres; ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Apellido Paterno:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="apepat_apo" placeholder="Por ejemplo, Bravo Serna" value="<?php echo $apepat; ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Apellido Materno:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="apemat_apo" placeholder="Por ejemplo, Bravo Serna" value="<?php echo $apemat; ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Documento Nacional de Identidad N°:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-taxi"></i>
                           </div>
                           <input type="text" class="form-control numero habilitado requerido" placeholder="Por ejemplo, 45678952" maxlength="8" name="DNI" id="DNI" autocomplete="off" onKeyDown="validarDNI()" onKeyUp="validarDNI()" value="<?php echo $dni ?>" disabled>
                        </div>
                        <div class="text-center">
                           <label id="resultado_validarDNI" class="hidden"></label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Fecha de Nacimiento:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="date" class="form-control habilitado requerido" name="fec_nac" value="<?php echo $fec_nac; ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Genero:</label>
                        <select class="form-control select2 habilitado requerido" style="width: 100%;" name="genero" disabled>
                           <option value="MASCULINO" <?php if($selector_genero=='MASCULINO'){ echo 'selected'; } ?>>MASCULINO</option>
                           <option value="FEMENINO" <?php if($selector_genero=='FEMENINO'){ echo 'selected'; } ?>>FEMENINO</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Ocupacion:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-taxi"></i>
                           </div>
                           <input type="text" class="form-control habilitado" name="ocupacion" placeholder="Ejem: Ingeniero de sistemas" value="<?php echo $ocupacion; ?> " disabled>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
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
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="direccion" value="<?php echo $direccion; ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Telefono:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-phone"></i>
                           </div>
                           <input type="text" class="form-control habilitado numero" name="tel" placeholder="Numero de telefono o celular" value="<?php echo $tel; ?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-envelope-o"></i>
                           </div>
                           <input type="email" class="form-control habilitado" placeholder="Ejemplo, direccion@santamaria.com.pe" name="email" id="email" autocomplete="off" value="<?php echo $email; ?>" disabled>
                        </div>
                        <div class="text-center">
                           <label id="resultado_validarEmail" class="hidden"></label>
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
   $(document).ready(function(e) {
      $("#email").keyup(function() {
         if ($("#email").val().length < 1) {
            $("#resultado_validarEmail").addClass("hidden");
         } else {
            $("#resultado_validarEmail").removeClass("hidden");
         }
         
         var valor_email = $("#email").val();
         if (validarEmail(valor_email)) {
            $("#resultado_validarEmail").text("Se ingreso el email correctamente");
            $('#resultado_validarEmail').css({'color':'blue','font-size':'12px'});
         } else {
            $("#resultado_validarEmail").text("El email ingresaddo es incorrecto");
            $('#resultado_validarEmail').css({'color':'red','font-size':'12px'});
         }
      });

      function validarEmail(valor_email) {
          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          if (regex.test(valor_email)) {
              return true;
          }
          else {
              return false;
          }
      }
   });
</script>
<script type="text/javascript">
   $(document).ready(function(e) {
      $("#DNI").keyup(function() {
         if ($("#DNI").val().length < 1) {
            $("#resultado_validarDNI").addClass("hidden");
         } else {
            $("#resultado_validarDNI").removeClass("hidden");
         }
      });      
   });

   //Creamos la Funcion
   function validarDNI() {
      if ($("#DNI").val().length==1) {
         $("#resultado_validarDNI").text("Se ha ingresado " + $("#DNI").val().length + " digito, el numero de DNI debe tener 8 digitos"); //Detectamos los Caracteres del Input
      } else {
         $("#resultado_validarDNI").text("Se han ingresado " + $("#DNI").val().length + " digitos, el numero de DNI debe tener 8 digitos"); //Detectamos los Caracteres del Input
      }
      
      if ($("#DNI").val().length < 8) {
         $('#resultado_validarDNI').css({'color':'red','font-size':'12px'});
      }else{
         $('#resultado_validarDNI').css({'color':'blue','font-size':'12px'});
         $('#resultado_validarDNI').text("El numero de DNI que se ha ingresado es correcto");
      }
   } //Aqui termina la Funcion
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
      location.href="apoderado.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>