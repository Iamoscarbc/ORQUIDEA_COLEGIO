<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$objcliente=new clsConexion;
$result=$objcliente->consultar("select g.idgrado as idgrado, n.descripcion as nivel, g.descripcion grado from grado g inner join nivel n on n.idnivel = g.idnivel");
?>
<div class="content-wrapper">
   <section class="content">
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title"><b>GRADO ACADEMICO</b></h3>
            <div class="box-tools pull-right">
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-header">
            <a href="grado_nuevo.php" class="btn btn-primary btn-flat"><i class="fa fa-level-up"></i> Registrar Nuevo Grado</a>
         </div>
         <div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr class="tableheader">
                     <th>Nivel Academico</th>
                     <th>Grado Academico</th>
                     <th>Editar</th>
                     <th>ELiminar</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach((array)$result as $row){ ?>
                     <tr>
                        <td><?php echo $row['nivel']; ?></td>
                        <td><?php echo $row['grado']; ?></td>
                        <td><?php echo "<a href='grado_acciones.php?idgrado=".$row['idgrado']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> Editar </td>
                        <td><?php echo "<a href='procesar.php?idgrado=".$row['idgrado']."&Eliminar=Eliminar' class='btn btn-danger btn-sm btn-icon icon-left'>"?><i class="fa fa-trash-o"></i> Eliminar </td>
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