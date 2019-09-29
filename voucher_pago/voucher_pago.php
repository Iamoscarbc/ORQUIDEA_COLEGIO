<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$objcliente=new clsConexion;
$result=$objcliente->consultar("
    SELECT
        vp.idvoucher AS idvoucher,
        a.dni AS dni,
        CONCAT(a.nombre_apo, ' ',a.apepat_apo, ' ',a.apemat_apo) AS apoderado,
        vp.numero_voucher AS numero_voucher,
        vp.imagen_voucher AS imagen_voucher,
        vp.fecha AS fecha
    FROM voucherPago vp
    LEFT JOIN apoderado a ON vp.idapoderado=a.idapo");
?>

<div class="content-wrapper">
   <section class="content">
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title"><b>VOUCHER DE PAGO</b></h3>
            <div class="box-tools pull-right">
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-header">
            <a href="voucher_pago_nuevo.php" class="btn btn-primary btn-flat"><i class="fa fa-level-up"></i> Registrar Nuevo Voucher </a>
         </div>
         <div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr class="tableheader">
                     <th>DNI</th>
                     <th>Apoderado</th>
                     <th>Numero de Operacion</th>
                     <th>Imagen de Voucher</th>
                     <th>Fecha</th>
                     <th>Eliminar</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach((array)$result as $row){ ?>
                  <tr>
                     <td><?php echo $row['dni']; ?></td>
                     <td><?php echo $row['apoderado']; ?></td>
                     <td><?php echo $row['numero_voucher']; ?></td>
                     <td>
                        <div class="form-group">
                           <center>
                              <img src="<?php echo $row['imagen_voucher']; ?>" onmouseover="this.width=500;this.height=500;" onmouseout="this.width=160;this.height=140;" width="160px" height="140px" border="1">
                           </center>
                        </div>
                     </td>
                     <td><?php echo $row['fecha']; ?></td>
                     <!--<td><?php //echo "<a href='voucher_pago_acciones.php?idvoucher=".$row['idvoucher']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> Editar</td>-->
                     <td><?php echo "<a href='procesar.php?idvoucher=".$row['idvoucher']."&Eliminar=Eliminar' class='btn btn-danger btn-sm btn-icon icon-left'>"?><i class="fa fa-trash-o"></i> Eliminar</td>
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