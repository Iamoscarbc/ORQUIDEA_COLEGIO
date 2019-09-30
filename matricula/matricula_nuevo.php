<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
//$codigo=$_SESSION["codigo"];
date_default_timezone_set('america/lima');
$fecha_matricula= date("Y-m-d");
//$hora=date("g:i-a");

$nombre_usuario=$obj->consultar("SELECT nombres FROM usuario WHERE codigo='$codigo'");
foreach ((array)$nombre_usuario as $row) {
   $usuario=$row['nombres'];
}

$periodo=$obj->consultar("SELECT año FROM periodo WHERE año=(SELECT YEAR(NOW()))");
foreach ((array)$periodo as $row) {
   $periodo=$row['año'];
}


$matricula=$obj->consultar("select MAX(num_matricula) as numero from matricula");
foreach($matricula as $row){
   if($row['numero']==NULL){
      $numero_matricula='0000000001';
   }else{
      $ultimo=$row['numero']+1;
      $numero_matricula=str_pad((int) $ultimo,10,"0",STR_PAD_LEFT);
   }
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
            <h3 class="box-title"><b>REGISTRAR MATRICULA</b></h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <form action="procesar.php" method="post">
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Periodo Academico:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-ellipsis-h"></i>
                           </div>
                           <input type="text" class="form-control" name="periodo" readonly value="<?php echo $periodo?>"/>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Numero de Matricula:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-ellipsis-h"></i>
                           </div>
                           <input type="text" class="form-control"  name="matricula" readonly value="<?php  echo $numero_matricula?>" />
                        </div>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <label>Fecha:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                           </div>
                           <input type="text" class="form-control" readonly name="fecha_matricula" value="<?php echo "$fecha_matricula";?>" />
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4">
                     <div class="form-group">
                        <label>Usuario:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-users"></i>
                           </div>
                           <input type="text" class="form-control" readonly name="usuario" value="<?php echo $usuario?>" />
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Estudiante:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                           </div>
                           <input type="text" id="alumno" class="form-control" placeholder="busqueda por nombres"/>
                           <input type="hidden" name="alumno" id="id_alumno"/>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Apoderado:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-users"></i>
                           </div>
                           <input type="text" name="apoderado" id="apoderado" class="form-control" readonly />
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Nivel:</label>
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
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Grado:</label>
                        <select style="width: 100%;" id="grado" class="form-control datosSeccion" >
                           <option value="">Seleccione</option>
                        </select>
                        <input type="hidden" name="grado" id="id_gradoSeleccionada" value="" />
                     </div>
                  </div>
                  <div class="col-md-2">
                     <div class="form-group">
                        <label>Seccion:</label>
                        <select style="width: 100%;" id="seccion" class="form-control datosSeccion" >
                           <option value="">Seleccione</option>
                        </select>
                        <input type="hidden" name="seccion" id="id_seccionSeleccionada" value="" />
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-group">
                        <label>Vacantes Libres:</label>
                        <select  style="width: 100%;" name="vacantes" id="vacantes" class="form-control datosSeccion" disabled>
                        </select>
                     </div>
                  </div>                  
                  <div class="col-md-7">
                     <div class="form-group">
                        <label>Observacion:</label>
                        <div class="input-group">
                           <div class="input-group-addon">
                              <i class="fa fa-edit"></i>
                           </div>
                           <input type="text" class="form-control" name="observacion" />
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
            <button type="submit" class="btn btn-info" id="Modificar" onclick="Registrar()"><i class="fa fa-pencil"></i><span>Registrar Matricula</span></button>
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
   $("#alumno").autocomplete({
      source: "busquedaalumno.php",
      minLength: 2,
      select: function(event, ui) {
         event.preventDefault();
         $('#alumno').val(ui.item.nombres);
         $('#id_alumno').val(ui.item.idalumno);
         $('#apoderado').val(ui.item.nombre_apo);
      }
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
            url:"selectdependientes.php",
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

   function Registrar(){      
      $("#proceso").attr("value","Registrar");
      $( "form" ).submit();
   }

   function Cancelar() {
      // Recargo la página
      location.href="matricula.php";
   }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>