<?php
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$estado=null;
$result=$obj->consultar("select count(codigo) as cuenta ,Max(codigo) as maximo from alumno");
foreach((array)$result as $row){
    $count=$row["cuenta"];
    $max=$row["maximo"];
    if($count==0){
        $codigo="AL000001";
    }else{
        //substr($max,2) quita dos caracteres a la isquierda en este caso AL (substr($max,2)+1000001),1)agrupando otro substr quitando un numero a la izquierda
        $codigo='AL'.substr((substr($max,2)+1000001),1);
    }
}

?>
<!DOCTYPE html>
<style type="text/css">
body,td,th {
	font-family: Calibri;
	font-size: 12px;
}
</style>
<html>
    <body>
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, charset=UTF-8" name="viewport">
      <!--<META http-equiv=Content-Type content="text/html; charset=ISO-8859-1">-->
      <!-- Bootstrap 3.3.6 -->
      <link rel="stylesheet" href="/plugins/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
      <link rel="stylesheet" href="/plugins/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="/plugins/plugins/datatables/dataTables.bootstrap.css">
      <link rel="stylesheet" href="/plugins/plugins/daterangepicker/daterangepicker.css">
      <!-- bootstrap datepicker -->
      <link rel="stylesheet" href="/plugins/plugins/datepicker/datepicker3.css">
      <!-- iCheck for checkboxes and radio inputs -->
      <link rel="stylesheet" href="/plugins/plugins/iCheck/all.css">
      <!-- Bootstrap Color Picker -->
      <link rel="stylesheet" href="/plugins/plugins/colorpicker/bootstrap-colorpicker.min.css">
      <!-- Bootstrap time Picker -->
      <link rel="stylesheet" href="/plugins/plugins/timepicker/bootstrap-timepicker.min.css">
      <!-- Select2 -->
      <link rel="stylesheet" href="/plugins/plugins/select2/select2.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="/plugins/dist/css/AdminLTE.min.css">
      <script src="/plugins/plugins/select2/select2.full.min.js"></script>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="/plugins/dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="/plugins/dist/css/skins/_all-skins.min.css">
      <!-- iCheck -->
      <link rel="stylesheet" href="/plugins/plugins/iCheck/flat/blue.css">
      <!-- Morris chart -->
      <link rel="stylesheet" href="/plugins/plugins/morris/morris.css">
      <!-- jvectormap -->
      <link rel="stylesheet" href="/plugins/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
      <!-- Date Picker -->
      <link rel="stylesheet" href="/plugins/plugins/datepicker/datepicker3.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="/plugins/plugins/daterangepicker/daterangepicker.css">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="/plugins/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
      
      <script src="/plugins/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script src="/plugins/plugins/select2/select2.full.min.js"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
          $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.6 -->
        <script src="/plugins/bootstrap/js/bootstrap.min.js"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="/plugins/plugins/morris/morris.min.js"></script>

        <!-- Sparkline -->
        <script src="/plugins/plugins/sparkline/jquery.sparkline.min.js"></script>
        <!-- jvectormap -->
        <script src="/plugins/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="/plugins/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <!-- jQuery Knob Chart -->
        <script src="/plugins/plugins/knob/jquery.knob.js"></script>
        <!-- daterangepicker -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="/plugins/plugins/daterangepicker/daterangepicker.js"></script>
        <!-- datepicker -->
        <script src="/plugins/plugins/datepicker/bootstrap-datepicker.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="/plugins/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <!-- Slimscroll -->
        <script src="/plugins/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="/plugins/plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="/plugins/dist/js/app.min.js"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="/plugins/dist/js/pages/dashboard.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="/plugins/dist/js/demo.js"></script>
    </body>
</html>
<head>
   <link rel="stylesheet" href="../plugins/jquery-ui.css">
   <style>
      input[type="text"] {
         text-transform:uppercase;
      }
   </style>
</head>
   <section class="content">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-default">
         <div class="box-header with-border">
            <h3 class="box-title"><b>REGISTRAR ESTUDIANTE</b></h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
         <label id="aviso"> </label>
            <form action="procesar_alumno.php" method="post" enctype="multipart/form-data">
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
                          <label>Apoderado:</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-users"></i>
                              </div>
                              <input type="text" id="apoderado" class="form-control requerido " placeholder="Por ejemplo, Ever Lazaro"/>
                              <input type="hidden"  name="idapoderado" id="idapoderado"/>
                          </div>
                     </div>
                     <div class="form-group">
                          <label>Parentesco:</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-users"></i>
                              </div>
                              <input type="text" class="form-control requerido" placeholder="Por ejemplo, padre" name="parentesco">
                          </div>
                     </div>
                     <div class="form-group">
                        <label>Apellidos Paterno:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control requerido" name="apepat_alum" placeholder="Por ejemplo, Bravo">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Apellidos Materno:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control requerido" name="apemat_alum" placeholder="Por ejemplo, Serna">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Nombres:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control requerido" name="nombres" placeholder="Por ejemplo, Jorge">
                        </div>
                     </div>
                     <div class="form-group">
                          <label>Documento Nacional de Identidad Nro:</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-pencil"></i>
                              </div>
                              <input type="text" class="form-control numero requerido" placeholder="Por ejemplo, 45678952" maxlength="8" name="DNI" id="DNI" autocomplete="off" onKeyDown="validarDNI()" onKeyUp="validarDNI()">
                          </div>
                          <div class="text-center">
                              <label id="resultado_validarDNI"></label>
                          </div>
                     </div>
                     <div class="form-group">
                        <label>Genero:</label>
                        <select class="form-control select2 requerido" style="width: 100%;" name="genero">
                           <option selected="selected">MASCULINO</option>
                           <option>FEMENINO</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label>Email</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-envelope-o"></i>
                           </div>
                           <input type="email" class="form-control" placeholder="Ejemplo, direccion@santamaria.com.pe" name="email" id="email" autocomplete="off">
                        </div>
                        <div class="text-center" >
                           <label id="resultado_validarEmail" class="hidden"></label>
                        </div>
                     </div>
                     <div class="form-group">
                          <label>Adjuntar Documentos:</label>
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-camera"></i>
                              </div>
                              <input type="file" name="documentos" class="form-control requerido" value="">
                          </div>
                          <p class="help-block">Archivos Permitidos(.pdf)</p>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Fecha de Nacimiento:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="date" class="form-control requerido" name="fec_nac">
                        </div>
                     </div>
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
                        <label>Direccion:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-home"></i>
                           </div>
                           <input type="text" class="form-control requerido" placeholder="Nombre y numero de calle" name="direccion" id="direccion">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Telefono:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-phone"></i>
                           </div>
                           <input type="text" class="form-control numero" placeholder="Numero de telefono o celular" name="tel" id="telefono">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Religion:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-bell"></i>
                           </div>
                           <input type="text" class="form-control" placeholder="Por ejemplo, Catolica" name="religion">
                        </div>
                     </div>
                     <div class="form-group">
                          <label>Nivel de Inscripcion:</label>
                          <select class="form-control select2 datosSeccion requerido" style="width: 100%;" id="nivel">
                              <option value="" selected>seleccione un nivel academico</option>
                              <?php
                              $result=$obj->consultar("select * from nivel");

                              foreach((array)$result as $row){
                                  if($row['idnivel']==$selector_nivel){
                                      echo '<option value="'.$row['idnivel'].'" selected>'.$row['descripcion'].'</option>';
                                  }else{
                                      echo '<option value="'.$row['idnivel'].'">'.$row['descripcion'].'</option>';
                                  }
                              }
                              ?>
                          </select>
                     </div>
                     <div class="form-group">
                          <label>Grado de Inscripcion:</label>
                          <select style="width: 100%;" id="grado" class="form-control datosSeccion requerido" >
                              <option value="">Seleccione un grado</option>
                          </select>
                          <input type="hidden" name="grado" id="id_gradoSeleccionada" value="" />
                     </div>
                     <div class="form-group">
                          <label>Seccion de Inscripcion:</label>
                          <select style="width: 100%;" id="seccion" class="form-control datosSeccion requerido" >
                              <option value="">Seleccione</option>
                          </select>
                          <input type="hidden" name="seccion" id="id_seccionSeleccionada" value="" />
                     </div>
                      <div class="form-group">
                          <label>Vacantes Totales:</label>
                          <select  style="width: 100%;" name="vacantes" id="vacantes" class="form-control datosSeccion" disabled>
                          </select>
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
               <button type="submit" class="btn btn-info" name="subir" onclick="Registrar()"><i class="fa fa-pencil"></i><span>Registrar Nuevo Estudiante</span></button>
               <button id="Cancelar" class="btn btn-info" onclick="Cancelar()">
               <i class="fa fa-close">Cancelar</i>
               </button>
            </center>
         </div>
         <!-- /.footer-->
      </div>
      <!-- /.box-->
   </section>
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
<script>
    $(document).ready(function(){
        $('.datosSeccion').change(function(){
            if($(this).val() != '')
            {
                var action = $(this).attr("id");
                var query = $(this).val();
                var result = '';

                if (action == "nivel"){
                    result = 'grado';
                } else if (action == "grado") {
                    result = 'seccion';
                } else if (action == "seccion") {
                    result = 'vacantes';
                }

                $.ajax({
                    url:"selectgrado.php",
                    method:"POST",
                    data:{action:action, query:query},
                    success:function(data){
                        $('#'+result).html(data);
                    }
                })
            }

            $("#grado").change(function(){
                $("#id_gradoSeleccionada").val($("#grado option:selected").val());
            });

            $("#seccion").change(function(){
                $("#id_seccionSeleccionada").val($("#seccion option:selected").val());
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
         source: "../inscripciones/busquedaapoderado.php",
         minLength: 2,
         select: function(event, ui) {
            $(function(){
                $("#departamento").val(ui.item.dpto_apoderado);
                $('#id_departamentoSeleccionado').val(ui.item.dpto_apoderado);
                var action = "departamento";
                var query = $("#id_departamentoSeleccionado").val();
                var resultd = '';

                if(action == "departamento"){
                    resultd = 'provincia';
                }else{
                    resultd = 'distrito';
                }

                $.ajax({
                    url:"selectdependientes.php",
                    method:"POST",
                    data:{action:action, query:query},
                    success:function(data){
                        $('#'+resultd).html(data);

                        $("#provincia").val(ui.item.prov_apoderado);
                        $('#id_provinciaSeleccionada').val(ui.item.prov_apoderado);
                        var action = "provincia";
                        var queryp = $("#id_provinciaSeleccionada").val();
                        var resultp = '';

                        if(action == "departamento"){
                            resultp = 'provincia';
                        }else{
                            resultp = 'distrito';
                        }

                        $.ajax({
                            url:"selectdependientes.php",
                            method:"POST",
                            data:{action:action, query:queryp},
                            success:function(data){
                                $('#'+resultp).html(data);

                                $("#distrito").val(ui.item.dist_apoderado);
                                $('#id_distritoSeleccionado').val(ui.item.dist_apoderado);
                            }
                        })
                    }
                })
                //alert(query);
            });
            event.preventDefault();
            $('#apoderado').val(ui.item.nombre_apoderado);
            $('#idapoderado').val(ui.item.id_apoderado);

            //$("#id_departamentoSeleccionado").val($("#departamento option:selected").val());
            //$('#departamento option:selected').val(ui.item.dpto_apoderado);
            $('#direccion').val(ui.item.direc_apoderado);
            $('#telefono').val(ui.item.telf_apoderado);
            $('#email').val(ui.item.email_apoderado);
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
      location.href="../informacion/informacion.php";
   }
</script>
<!-- /.content-wrapper -->