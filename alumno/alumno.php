<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$result=$obj->consultar("SELECT * from alumno");
?>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content">
      <div class="row">
         <div class="col-xs-12">
            <div class="box box-info">
               <div class="box-header with-border">
                  <h3 class="box-title"><b>ESTUDIANTE</b></h3>
                  <div class="box-tools pull-right">
                     <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
               </div>
               <div class="box-header">
                  <a href="alumno_nuevo.php" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i> Registrar Nuevo Estudiante</a>
                  <a href="../reportes/EXCEL/reporteexcel.php?export" class="btn btn-success btn-flat"><i class="fa fa-file-excel-o"></i> Excel CSV</a>
                  <a href="../reportes/rptalumnos.php" class="btn btn-danger btn-flat"><i class="fa fa-file-pdf-o"></i> PDF</a>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                  <table id="example1" class="table table-striped table-bordered table-hover">
                     <thead>
                        <tr class="tableheader">
                           <th>Codigo</th>
                           <th>Apellidos Paterno</th>
                           <th>Apellidos Materno</th>
                           <th>Nombres</th>
                           <th>Fecha de Nacimiento</th>
                           <th>Genero</th>
                           <th>Estado</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php foreach((array)$result as $row){
                        ?>
                        <tr>
                           <td><?php echo $row['codigo']; ?></td>
                           <td><?php echo $row['apepat_alu']; ?></td>
                           <td><?php echo $row['apemat_alu']; ?></td>
                           <td><?php echo $row['nombres']; ?></td>
                           <td><?php echo $row['fec_nacimiento']; ?></td>
                           <td><?php echo $row['genero']; ?></td>
                           <td><?php echo "<a href='alumno_acciones.php?idalu=".$row['idalu']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> Editar</td>
                        </tr>
                        <?php
                        };
                        ?>
                     </tbody>
                  </table>
               </div>
            </div>
            <!-- /.box -->
         </div>
         <!-- /.col-->
      </div>
      <!-- ./row -->
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
<script>
$(function () {
$('#example1').DataTable({
responsive: true,
autoWidth: false
});
});
</script>
<?php include("../central/pie.php");?>