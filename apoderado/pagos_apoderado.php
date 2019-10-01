<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$objcliente=new clsConexion;
$id = $_SESSION["id"];
$result=$objcliente->consultar("SELECT pago.numero
     , pago.fecha
     , pago.periodo
     , CONCAT(alumno.nombres, ' ',alumno.apepat_alu, ' ',alumno.apemat_alu) AS alumno
     , pago.pagante
FROM pago
INNER JOIN matricula m ON m.idmatri = pago.idmatri
INNER JOIN alumno ON alumno.idalu = m.idalumno
WHERE alumno.idapo = $id");
?>
<div class="content-wrapper">
<!-- Main content -->
<section class="content">
      <div class="row">
         <div class="col-xs-12">
            <div class="box box-info">
                 <div class="box-header with-border">
                    <h3 class="box-title"><b>Historial de Pagos</b></h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                 </div>
         <div class="box-header">
            <a href="../voucher_pago/voucher_pago_nuevo.php" class="btn btn-primary btn-flat"><i class="fa fa-level-up"></i> Registrar Nuevo Voucher </a>
         </div>
			<div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
                <thead>
                <tr class="tableheader">
                  <th>Codigo</th>
                  <th>Fecha</th>
                  <th>Periodo</th>
                  <th>Alumno</th>
                  <th>Apoderado</th>
                  <th>Accion</th>
                </tr>
                </thead>
                <tbody>
				<?php foreach((array)$result as $row){ ?>
				    <tr>
						<td><?php echo $row['numero']; ?></td>
				        <td><?php echo $row['fecha']; ?></td>
						<td><?php echo $row['periodo']; ?></td>
                        <td><?php echo $row['alumno']; ?></td>
                        <td><?php echo $row['pagante']; ?></td>
                        <td><?php echo "<a href='../reportes/comprobanteparam.php?num=".$row['numero']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-print"></i>  Imprimir</td>
					</tr>
				<?php
					};
				?>
			    </tbody>
            </table>
            <!-- /.box-body -->
          </div>
           </div>
          </section>
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
