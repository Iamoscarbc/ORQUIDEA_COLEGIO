<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$objcliente=new clsConexion;
$result=$objcliente->consultar("SELECT conceptoPago.idconcepto
     , conceptoPago.concepto
     , conceptoPago.monto
     , conceptoPago.fec_inicio
     , conceptoPago.fec_vencimiento
     , conceptoPago.descuento
     , conceptoPago.mora
     , nivel.descripcion
FROM
  conceptoPago
INNER JOIN nivel
ON conceptoPago.idnivel = nivel.idnivel");
?>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title"><b>CONCEPTO DE PAGO</b></h3>
            <div class="box-tools pull-right">
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-header">
            <a href="concepto_pago_nuevo.php" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i>Registrar Nuevo Concepto</a>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr class="tableheader">
                     <th>Nivel</th>
                     <th>Concepto</th>
                     <th>Monto</th>
                     <th>Mora x dia</th>
                     <th>Fecha de Inicio</th>
                     <th>Fecha de Vencimiento</th>
                     <th>Editar</th>
                     <th>Eliminar</th>
                  </tr>
                </thead>
               <tbody>
                  <?php foreach((array)$result as $row){ ?>
                  <tr>
                     <td><?php echo $row['descripcion']; ?></td>
                     <td><?php echo $row['concepto']; ?></td>
                     <td><?php echo $row['monto']; ?></td>
                     <td><?php echo $row['mora']; ?></td>
                     <td><?php echo $row['fec_inicio']; ?></td>
                     <td><?php echo $row['fec_vencimiento']; ?></td>
                     <td><?php echo "<a href='concepto_pago_acciones.php?idconcepto=".$row['idconcepto']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> Editar</td>
                     <td><?php echo "<a href='procesar.php?idconcepto=".$row['idconcepto']."&Eliminar=Eliminar' class='btn btn-danger btn-sm btn-icon icon-left'>"?><i class="fa fa-trash-o"></i> Eliminar</td>
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