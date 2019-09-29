<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$codigo=$_SESSION["codigo"];
date_default_timezone_set('america/lima');
$dia= date("Y-m-d");
//$hora=date("g:i-a");
$rec=$obj->consultar("select MAX(numero) as num from pago");
 foreach($rec as $row){
     if($row['num']==NULL){
       $numrec='0000000001';
     }else{
       $ultimo=$row['num']+1;
       $numrec=str_pad((int) $ultimo,10,"0",STR_PAD_LEFT);
     }
   }
$usuu=$obj->consultar("SELECT * FROM usuario WHERE codigo='$codigo'");
foreach ((array)$usuu as $row) {
     $usuario=$row['nombres'];
}
$periodo=$obj->consultar("select * from periodo");
 foreach ((array)$periodo as $row) {
      $periodo=$row['año'];
 }
?>
<head>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> -->
<link rel="stylesheet" href="../plugins/jquery-ui.css">
</head>
<div class="content-wrapper">
   <section class="content">
     <!-- SELECT2 EXAMPLE -->
     <div class="box box-primary">
       <div class="box-header with-border">
         <h3 class="box-title"><b>Registrar Pago</b></h3>
         <div class="box-tools pull-right">
           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
           <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
         </div>
       </div>
       <!-- /.box-header -->
       <div class="box-body">
         <form action="capturar.php" method="post" >
         <div class="row">
           <div class="col-md-2">
             <div class="form-group">
               <label>Periodo Academico:</label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-calendar"></i>
                 </div>
                 <input type="text" class="form-control" name="periodo" readonly="true" value="<?php echo $periodo?>">
               </div>
               </div>
              </div>
           <div class="col-md-2">
             <div class="form-group">
               <label>Numero de Recibo:</label>
               <div class="input-group">
                 <div class="input-group-addon">
                   <i class="fa fa-ellipsis-h"></i>
                 </div>
                 <input type="text" class="form-control"  name="num" required maxlength="50" value="<?php echo $numrec;?>" readonly="true">
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
                <input type="text" class="form-control" readonly="true" name="fecha" value="<?php echo $dia;?>" required>
              </div>
            </div>
          </div>

        <div class="col-md-5">
         <div class="form-group">
          <label>Alumno:</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-user"></i>
            </div>
            <input type="text" required name="alu" id="alu" class="form-control" placeholder="buscar por nombre de alumno"/>
            <input type="hidden"  name="idmatri" id="idmatri"/>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="form-group">
          <label>Pagante:</label>
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-users"></i>
            </div>
            <input type="text" required name="pagante" id="pagante" class="form-control" placeholder="buscar por nombre de apoderado"/>
			<input type="hidden"  name="idpagante" id="idpagante"/>
          </div>
          </div>
      </div>

    <div class="col-md-3">
      <div class="form-group">
        <label>Grado:</label>
        <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-sort-up"></i>
          </div>
          <input type="text" class="form-control" readonly="true" name="grado" id="grado"required>
        </div>
        </div>
    </div>

                 <div class="col-md-2">
                   <div class="form-group">
                     <label>Seccion:</label>
                     <div class="input-group">
                       <div class="input-group-addon">
                         <i class="fa fa-sort-up"></i>
                       </div>
                       <input type="text" class="form-control" readonly="true" name="seccion" id="seccion" required >
                     </div>
                     </div>
                 </div>
                 <div class="col-md-3">
                   <div class="form-group">
                     <label>Usuario:</label>
                     <div class="input-group">
                       <div class="input-group-addon">
                         <i class="fa fa-users"></i>
                       </div>
                       <input type="text" class="form-control" readonly="true" name="usu" value="<?php echo $usuario?>" >
                     </div>
                     </div>
                 </div>

             <div class="col-md-5">
                 <div class="form-group">
                     <label>Concepto Pago:</label>
                     <div class="input-group">
                         <div class="input-group-addon">
                             <i class="fa fa-user"></i>
                         </div>
                         <input type="text" required name="conceptopago" id="conceptopago" class="form-control" placeholder="buscar por concepto de pago"/>
                         <input type="hidden"  name="idconcepto" id="idconcepto"/>
                     </div>
                 </div>
             </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label>Mora x dia:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-dollar"></i>
                    </div>
                   <input type="number" id="mora" name="morasxdias" min="0.00" class="form-control" required readonly="true">
                     </div>
                   </div>
                </div>

              <div class="col-md-2">
                <div class="form-group">
                  <label>Descuento:</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-dollar"></i>
                    </div>
                    <input type="number" name="descuento" id="descuento" min="0.00" class="form-control" readonly="true" required >
                     </div>
                   </div>
                </div>
                      <div class="col-md-2">
                        <div class="form-group">
                          <label>Subtotal:</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-dollar"></i>
                            </div>
                            <input type="number" name="subtotal" id="monto" min="0.00" class="form-control" readonly="true" required >
                             </div>
                           </div>
                        </div>


                    <div class="col-md-2">
                      <div class="form-group">
                        <label>total:</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-dollar"></i>
                          </div>
                          <input type="number" name="total" id="total" min="0.00" class="form-control"  readonly="true" required >
                        </div>
                        </div>
                    </div>

         </div>
         <!-- <p ><b><i>*El descuento se aplica solo si el pago es antes de la fecha de Inicio</b></p>
         <p><b>*El no pago oportuno acarreará interés por mora</i></b></p> -->
         <!-- /.row -->
       </div>
       <!-- /.box-body -->
       <div class="box-footer">
        <center><button type="submit" name="funcion" value="registrar" class="btn btn-info"><i class="fa fa-save"></i> Registrar </button>
            <a href="pago.php" class="btn btn-default"><i class="fa fa-close"></i> Cancelar </a></button>
        </center>
       </div>
     </form>
     </div>
   </section>
   <!-- /.content -->
  </div>

    <script src="../plugins/plugins/jQuery/jQuery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../plugins/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <script src="../plugins/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <!-- SlimScroll -->
    <script src="../plugins/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../plugins/plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../plugins/dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../plugins/dist/js/demo.js"></script>
    <!-- page script -->
    <!-- <script src="../plugins/jquery-1.10.2.js"></script> -->
    <script src="../plugins/jquery-ui.js"></script>

<script>
  $(function () {
  $('#example1').DataTable({
                        responsive: true,
                        autoWidth: false
                    });
  });
</script>
<script>
 $(function() {
      $("#alu").autocomplete({
        //busqueda de alumnos matriculados para el pago de pensiones y matricula
          source: "busquedaalumno.php",
          minLength: 2,
          select: function(event, ui) {
          event.preventDefault();
          $('#alu').val(ui.item.nombres);
          $('#idalu').val(ui.item.idalumno);
          $('#grado').val(ui.item.grado_alu);
          $('#seccion').val(ui.item.seccion_alu);
          $('#idmatri').val(ui.item.idmatri);
          }
      });
    });
 </script>
<script>
    $(function() {
        $("#pagante").autocomplete({
            //busqueda de alumnos matriculados para el pago de pensiones y matricula
            source: "busquedaapoderado.php",
            minLength: 2,
            select: function(event, ui) {
                event.preventDefault();
                $('#idpagante').val(ui.item.id_apoderado);
                $('#pagante').val(ui.item.nombre_apoderado);
            }
        });
    });
</script>
<script>
    $(function() {
        $("#conceptopago").autocomplete({
            //busqueda de alumnos matriculados para el pago de pensiones y matricula
            source: "buscarconcepto.php",
            minLength: 2,
            select: function(event, ui) {
                event.preventDefault();
                $('#idconcepto').val(ui.item.id_concepto)
                $('#conceptopago').val(ui.item.concepto_pago)
                $('#mora').val(ui.item.mora_pago);
                $('#descuento').val(ui.item.descuento_pago);
                $('#monto').val(ui.item.subtotal_pago);
                $('#total').val(ui.item.total_pago);
            }
        });
    });
</script>
<?php include("../central/pie.php");?>
