<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$objcliente=new clsConexion;
$result=$objcliente->consultar("SELECT * FROM apoderado");
?>
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title"><b>APODERADO</b></h3>
            <div class="box-tools pull-right">
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-header">
            <a href="apoderado_nuevo.php" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i>Registrar Nuevo Apoderado </a>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr class="tableheader">
                     <th>Codigo</th>
                     <th>Apellido Paterno</th>
                     <th>Apellido Materno</th>
                     <th>Nombres</th>
                     <th>E-Mail</th>
                     <th>Direccion</th>
                     <th>Telefono</th>
                     <th>Editar</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach((array)$result as $row){ ?>
                  <tr>
                     <td><?php echo $row['codigo']; ?></td>
                     <td><?php echo $row['apepat_apo']; ?></td>
                     <td><?php echo $row['apemat_apo']; ?></td>
                     <td><?php echo $row['nombre_apo']; ?></td>                     
                     <td><?php echo $row['email']; ?></td>
                     <td><?php echo $row['direccion']; ?></td>
                     <td><?php echo $row['telefono']; ?></td>
                     <td><?php echo "<a href='apoderado_acciones.php?idapo=".$row['idapo']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> Acciones</td>
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