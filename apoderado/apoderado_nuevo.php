<!DOCTYPE html>
<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;

$result=$obj->consultar("select count(codigo) as cuenta ,Max(codigo) as maximo from apoderado");
foreach((array)$result as $row){
   $count=$row["cuenta"];
   $max=$row["maximo"];
   if($count==0){
      $codigo="AP000001";
   }else{
      $codigo='AP'.substr((substr($max,2)+1000001),1);
   }
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
            <h3 class="box-title"><b>REGISTRAR APODERADO</b></h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <form action="procesar.php" method="post">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>CODIGO:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-pencil"></i>
                           </div>
                           <input type="text" class="form-control" name="codigo" readonly value="<?php echo $codigo;?>">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Nombres:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="nombres_apo" placeholder="Por ejemplo, Jorge">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Apellido Paterno:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="apepat_apo" placeholder="Por ejemplo, Bravo">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Apellido Materno:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="apemat_apo" placeholder="Serna">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Fecha de Nacimiento:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="date" class="form-control" name="fec_nac">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Documento Nacional de Identidad N°:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-taxi"></i>
                           </div>
                           <input type="text" class="form-control numero requerido" placeholder="Por ejemplo, 45678952" maxlength="8" name="DNI" id="DNI" autocomplete="off" onKeyDown="validarDNI()" onKeyUp="validarDNI()" value="">
                        </div>
                        <div class="text-center">
                           <label id="resultado_validarDNI" class="hidden"></label>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Genero:</label>
                        <select class="form-control select2" style="width: 100%;" name="genero">
                           <option selected="selected">MASCULINO</option>
                           <option>FEMENINO</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Ocupacion:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-taxi"></i>
                           </div>
                           <input type="text" class="form-control" name="ocupacion" placeholder="Ejem: Ingeniero de sistemas" value="">
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Departamento:</label>
                        <select class="form-control select2 ubigeo requerido" style="width: 100%;" id="departamento">
                           <option value="">Seleccione un departamento</option>
                           <?php
                           $result=$obj->consultar("SELECT idDepa, departamento FROM  ubdepartamento");

                           foreach((array)$result as $row){
                              if($row['idDepa']==$selector_departamento){
                                 echo '<option value="'.$row['idDepa'].'" selected>'.$row['departamento'].'</option>';
                              }else{
                                 echo '<option value="'.$row['idDepa'].'">'.$row['departamento'].'</option>';
                              }
                           }
                           ?>
                        </select>
                        <input type="hidden" id="id_departamentoSeleccionado" name="departamento" value="" />
                     </div>
                     <div class="form-group">
                        <label>Provincia:</label>
                        <select class="form-control select2 ubigeo requerido" style="width: 100%;" id="provincia">
                           <option value="" selected></option>
                        </select>                           
                        <input type="hidden" name="provincia" id="id_provinciaSeleccionada" value="" />
                     </div>
                     <div class="form-group">
                        <label>Distrito:</label>
                        <select class="form-control select2 requerido" style="width: 100%;" id="distrito">
                           <option value="" selected></option>
                        </select>                           
                        <input type="hidden" name="distrito" id="id_distritoSeleccionado" value=""/>
                     </div>
                     <div class="form-group">
                        <label>Direccion</label>
                        <div class="form-group">
                           <div class="input-group">
                              <div class="input-group-addon">
                                 <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" class="form-control habilitado requerido" name="direccion" value="">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Telefono:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-phone"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido numero" name="tel" placeholder="Numero de telefono o celular" value="">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-envelope-o"></i>
                           </div>
                           <input type="email" class="form-control" placeholder="Ejemplo, direccion@santamaria.com.pe" name="email" id="email" autocomplete="off" value="">
                        </div>
                        <div class="text-center" >
                           <label id="resultado_validarEmail" class="hidden"></label>
                        </div>
                     </div>                 
                     <div class=" clave form-group">
                        <label>Clave:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-unlock"></i>
                           </div>
                           <input type="password" autocomplete="off" class="form-control requerido" name="clave" placeholder="ingrese una clave segura min.de 6 digitos" value="">
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
               <button type="submit" class="btn btn-info" id="Modificar" onclick="Registrar()"><i class="fa fa-pencil"></i><span>Registrar Nuevo Apoderado</span></button>
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
      location.href="../apoderado/apoderado.php";
   }
</script>
<?php include("../central/pie2.php");?>
<?php include("../central/pie.php");?>