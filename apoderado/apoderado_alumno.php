<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$estado=null;
$id = $_SESSION["id"];
$result=$obj->consultar("select * from alumno a 
INNER JOIN ubdepartamento d ON d.idDepa = a.departamento 
INNER JOIN ubprovincia p ON p.idProv = a.provincia 
INNER JOIN ubdistrito dis ON dis.idDist = a.distrito 
WHERE idapo = $id");
$alumno = $result[0];
$codigo = $alumno["codigo"];
?>
<!DOCTYPE html>
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
            <h3 class="box-title"><b>ESTUDIANTE</b></h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
         <label id="aviso"> </label>
            <form action="procesar.php" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Codigo:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-ellipsis-h"></i>
                           </div>
                           <input type="text" name="codigo" class="form-control" value="<?php echo $codigo;?>" readonly>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Apellidos Paterno:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control requerido" name="apepat" placeholder="Por ejemplo, Bravo" value="<?php echo $alumno["apepat_alu"];?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Apellidos Materno:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control requerido" name="apemat" placeholder="Por ejemplo, Serna" value="<?php echo $alumno["apemat_alu"];?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Nombres:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control requerido" name="nombres" placeholder="Por ejemplo, Jorge" value="<?php echo $alumno["nombres"];?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Genero:</label>
                        <select class="form-control select2" style="width: 100%;" name="genero" disabled>
                           <option selected="selected"><?php echo $alumno["genero"];?></option>
                           <!-- <option>FEMENINO</option> -->
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-envelope-o"></i>
                           </div>
                           <input type="email" class="form-control" placeholder="Ejemplo, direccion@santamaria.com.pe" name="email" id="email" autocomplete="off" value="<?php echo $alumno["email"];?>" disabled>
                        </div>
                        <div class="text-center" >
                           <label id="resultado_validarEmail" class="hidden"></label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Apoderado:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-users"></i>
                           </div>
                           <input type="text" id="apoderado" class="form-control requerido " placeholder="Por ejemplo, Ever Lazaro" value="<?php echo $_SESSION["nombres"];?>" disabled/>
                           <input type="hidden"  name="idapoderado" id="idapoderado"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Documento Nacional de Identidad N°:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-pencil"></i>
                           </div>
                           <input type="text" class="form-control numero requerido" placeholder="Por ejemplo, 45678952" maxlength="8" name="DNI" id="DNI" autocomplete="off" onKeyDown="validarDNI()" onKeyUp="validarDNI()" value="<?php echo $alumno["dni"];?>" disabled>
                        </div>
                        <div class="text-center">
                           <label id="resultado_validarDNI"></label>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Fecha de Nacimiento:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="date" class="form-control requerido" name="fec_nac" value="<?php echo $alumno["fec_nacimiento"];?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Departamento:</label>
                        <select class="form-control select2 ubigeo requerido" style="width: 100%;" id="departamento" disabled>
                           <option selected="selected"><?php echo $alumno["departamento"];?></option>
                        </select>
                        <input type="hidden" id="id_departamentoSeleccionado" name="departamento" value="" />
                     </div>
                     <div class="form-group">
                        <label>Provincia:</label>
                        <select class="form-control select2 ubigeo requerido" style="width: 100%;" id="provincia" disabled>
                        <option selected="selected"><?php echo $alumno["departamento"];?></option>
                        </select>                           
                        <input type="hidden" name="provincia" id="id_provinciaSeleccionada" value="" />
                     </div>
                     <div class="form-group">
                        <label>Distrito:</label>
                        <select class="form-control select2 requerido" style="width: 100%;" id="distrito" disabled>
                        <option selected="selected"><?php echo $alumno["departamento"];?></option>
                        </select>                           
                        <input type="hidden" name="distrito" id="id_distritoSeleccionado" value=""/>
                     </div>
                     <div class="form-group">
                        <label>Direccion:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-home"></i>
                           </div>
                           <input type="text" class="form-control requerido" placeholder="Nombre y número de calle" name="direccion" value="<?php echo $alumno["direccion"];?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Telefono:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-phone"></i>
                           </div>
                           <input type="text" class="form-control numero" placeholder="Numero de telefono o celular" name="tel" id="telefono"  value="<?php echo $alumno["telefono"];?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Religión:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-bell"></i>
                           </div>
                           <input type="text" class="form-control" placeholder="Por ejemplo, Catolica" name="religion"  value="<?php echo $alumno["religion"];?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Parentesco:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-users"></i>
                           </div>
                           <input type="text" class="form-control requerido" placeholder="Por ejemplo, padre" name="parentesco"  value="<?php echo $alumno["parentesco"];?>" disabled>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.row -->
               <input type="hidden" name="proceso" id="proceso" value=""/>
            </form>
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
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.js"></script>-->

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

      $("#provincia").change(function(){
         $("#id_provinciaSeleccionada").val($("#provincia option:selected").val());
        });

      $("#distrito").change(function(){
         $("#id_distritoSeleccionado").val($("#distrito option:selected").val());
        });
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
<!--<script type="text/javascript">
   $(document).ready(function($){
      //$("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
      $("#telefono").mask("999-999-999",{placeholder:"xxx-xxx-xxx"});
      //$("#tin").mask("99-9999999");
      //$("#ssn").mask("999-99-9999");
   });
</script>-->
<script type="text/javascript">
   $(function() {
      $("#apoderado").autocomplete({
         source: "busquedaapoderado.php",
         minLength: 2,
         select: function(event, ui) {
            event.preventDefault();
            $('#apoderado').val(ui.item.nombre_apoderado);
            $('#idapoderado').val(ui.item.id_apoderado);
         }
      });
   });
</script>
<script type="text/javascript">

   function Registrar(){

      var error = 0;

      $('.requerido').each(function(i, elem){
         if($(elem).val() == ''){
            $(elem).css({'background-color':'#FFEDFF','border':'1px solid red'});
            //$(elem).css({'border':'2px solid red'});
            error++;
            }
         });
      if(error > 0){
         event.preventDefault();
         $('#aviso').html(' ■ Se deben completar los campos obligatorios <br />');
         $('#aviso').css({'color':'red','font-size':'12px'});
      } else if($("#DNI").val().length < 8) {
         event.preventDefault();
      } else {
         $("#proceso").attr("value","Registrar");
         $( "form" ).submit();
      }
   }

   function Cancelar() {
      // Recargo la página
      location.href="../alumno/alumno.php";
   }
</script>
<!-- /.content-wrapper -->
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>