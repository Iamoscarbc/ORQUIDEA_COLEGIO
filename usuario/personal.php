<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$objcliente=new clsConexion;
$result=$objcliente->consultar("select * from usuario u inner join tipo c on u.idcargo=c.idtipo WHERE idtipo!=4");
?>
<div class="content-wrapper">
   <section class="content">
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title"><b>PERSONAL</b></h3>
            <div class="box-tools pull-right">
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
         </div>
         <div class="box-header">
            <a href="usuario_nuevo.php" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i> Registrar Nuevo usuario </a>
         </div>
         <div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr class="tableheader">
                     <th>Codigo</th>
                     <th>Nombres</th>
                     <th>E-Mail</th>
                     <th>Cargo</th>
                     <th>Estado</th>
                     <th>Consultar</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach((array)$result as $row){ ?>
                     <tr>
                        <td><?php echo $row['codigo']; ?></td>
                        <td><?php echo $row['nombres']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['descripcion']; ?></td>
                        <td><?php echo $row['estado']; ?></td>
                        <td>
                           <?php echo "<a href='usuario_acciones.php?idusu=".$row['idusu']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> Acciones
                        </td>
                     </tr>
                  <?php  };   ?>
               </tbody>
            </table>
         </div>
         <!-- /.box-body -->
      </div>
      <!-- /.box -->
   </section>
   <!-- Main content -->
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
<!-- pag1e script -->

<script>
   function Registrar(){
      $(".clave").removeClass("hidden");
      $(".habilitado").prop( "disabled", false );
      $("#Eliminar").hide();      
      $("#Modificar span").text("Actualizar Registro");      
      $("#Modificar").click(function(){
         $("#proceso").attr("value","Modificar");
         $( "form" ).submit();
      });
   }
</script>
<script>
$(function () {
$('#example1').DataTable({
responsive: true,
autoWidth: false
});
});
</script>
<?php include("../central/pie.php");?>