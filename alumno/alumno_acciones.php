<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
    $id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idalu'],ENT_QUOTES))));

$data=$obj->consultar("SELECT
      apoderado.nombre_apo As nombre_apo,
        apoderado.apepat_apo As apepat_apo,
        apoderado.apemat_apo As apemat_apo,
        alumno.idapo,
        alumno.idalu As idalu,
        alumno.parentesco,
        alumno.nombres,
        alumno.apepat_alu,
        alumno.apemat_alu,
        alumno.dni,
        alumno.fec_nacimiento,
        alumno.genero,
        alumno.religion,
        alumno.departamento,
        alumno.provincia,
        alumno.distrito,
        alumno.direccion,
        alumno.telefono,
        alumno.email,
        alumno.codigo 
   FROM alumno 
   LEFT JOIN apoderado ON apoderado.idapo=alumno.idapo
   WHERE alumno.idalu = $id");

foreach($data as $row){
   $idapoderado=$row['idapo'];
   $apoderado=$row['apepat_apo'].' '.$row['apemat_apo'].' '.$row['nombre_apo'];
   $parentesco=$row['parentesco'];
   $nombres=$row['nombres'];
   $apepat=$row['apepat_alu'];
   $apemat=$row['apemat_alu'];
   $dni=$row['dni'];
   $fec_nac=$row['fec_nacimiento'];
   $selector_genero=$row['genero'];
   $selector_0religion=$row['religion'];
   $selector_departamento=$row["departamento"];
   $selector_provincia=$row["provincia"];
   $selector_distrito=$row["distrito"];
   $direccion=$row['direccion'];
   $tel=$row['telefono'];
   $email=$row['email'];
   $codigo=$row['codigo'];
   $religion=$row['religion'];
}
?>
<!DOCTYPE html>
<head>
   <link rel="stylesheet" href="../plugins/jquery-ui.css">
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
         <label id="aviso"></label>
            <form action="procesar.php" method="post" enctype="multipart/form-data">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Codigo:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-ellipsis-h"></i>
                           </div>
                           <input type="text" name="codigo" class="form-control habilitado" value="<?php echo $codigo;?>" readonly>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Apellidos Paterno:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="apepat"  disabled placeholder="Por ejemplo, BRAVO" value="<?php echo $apepat;?>">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Apellido Materno:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="apemat"  disabled placeholder="Por ejemplo,SERNA" value="<?php echo $apemat;?>">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Nombres:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" name="nombres"  disabled placeholder="Por ejemplo, JORGE" value="<?php echo $nombres;?>">
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
                        <label>Email</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-envelope-o"></i>
                           </div>
                           <input type="email" class="form-control habilitado requerido" placeholder="Ejemplo,sistemasinfor@ejemplo.com" name="email" disabled value="<?php echo $email;?>">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Apoderado:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-users"></i>
                           </div>
                           <input type="text" name="apoderado" id="apoderado" class="form-control habilitado requerido" value="<?php echo $apoderado;?>" readonly />
                           <input type="hidden"  name="idapoderado" id="idapoderado" value="<?php echo $idapoderado;?>"/>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Documento Nacional de Identidad N°:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-pencil"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" placeholder="Por ejemplo, 12345678" maxlength="8" name="DNI"  disabled value="<?php echo $dni;?>">
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
                           <input type="date" class="form-control habilitado requerido" name="fec_nac"  disabled value="<?php echo $fec_nac;?>">
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
                           <input type="text" class="form-control habilitado requerido" placeholder="Nombre y número de calle" name="direccion"  disabled value="<?php echo $direccion;?>">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Telefono:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-phone"></i>
                           </div>
                           <input type="text" class="form-control habilitado" placeholder="Numero de telefono o celular" name="tel" value="<?php echo $tel;?>" disabled>
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Parentesco:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-users"></i>
                           </div>
                           <input type="text" class="form-control habilitado requerido" placeholder="Por ejemplo,padre" name="parentesco"  disabled value="<?php echo $parentesco;?>">
                        </div>
                     </div>
                     <div class="form-group">
                        <label>Religion:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-bell"></i>
                           </div>
                           <input type="text" class="form-control habilitado" placeholder="Por ejemplo,Catolica" name="religion"  disabled value="<?php echo $religion;?>">
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
      this.value =this.value.replace(/[^0-9]/g,'');
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
      if($(this).val() !='')
      {
         var action =$(this).attr("id");
         var query =$(this).val();
         var result ='';

         if(action =="departamento"){
            result ='provincia';
         }else{
            result ='distrito';
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
         
         var valor_email =$("#email").val();
         if (validarEmail(valor_email)) {
            $("#resultado_validarEmail").text("Se ingreso el email correctamente");
            $('#resultado_validarEmail').css({'color':'blue','font-size':'12px'});
         } else {
            $("#resultado_validarEmail").text("El email ingresaddo es incorrecto");
            $('#resultado_validarEmail').css({'color':'red','font-size':'12px'});
         }
      });

      function validarEmail(valor_email) {
          var regex =/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
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

      var error =0;

      $('.requerido').each(function(i, elem){
         if($(elem).val() ==''){
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
      location.href="../alumno/alumno.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>