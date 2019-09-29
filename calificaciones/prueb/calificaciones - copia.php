<!DOCTYPE html>
<?php
// include("../seguridad.php");
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;

$data=$obj->consultar("SELECT cal.periodo AS periodo, a.nombres AS alumno, c.descripcion AS curso, cal.pb AS pb, cal.sb AS sb, cal.tb AS tb, cal.cb AS cb, cal.pf AS pf, cal.idcalificacion AS calificacion FROM calificaciones cal INNER JOIN alumno a INNER JOIN cursos c ON a.idalu = cal.alumno AND cal.idcurso = c.idcurso WHERE periodo=(SELECT año FROM periodo WHERE año=(SELECT YEAR(NOW())))");
// $data=$obj->consultar("SELECT cal.periodo AS periodo, a.nombres AS alumno, c.descripcion AS curso, cal.pb AS pb, cal.sb AS sb, cal.tb AS tb, cal.cb AS cb, cal.pf AS pf, cal.idcalificacion AS calificacion FROM calificaciones cal INNER JOIN alumno a INNER JOIN cursos c ON a.idalu = cal.alumno AND cal.idcurso = c.idcurso WHERE periodo=(SELECT año FROM periodo WHERE año=(SELECT YEAR(NOW())))");
?>

<div class="content-wrapper">
   <section class="content">
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title"><b>CALIFICACIONES</b></h3>
            <div class="box-tools pull-right">
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-header">
            <a href="calificaciones_nuevo.php" class="btn btn-primary btn-flat"><i class="fa fa-level-up"></i> Registrar Nueva Califcacion </a>
         </div>
         <div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr class="tableheader">
                     <th>Periodo</th>
                     <th>Estudiante</th>
                     <th>Asignatura</th>
                     <th>Primer Bimestre</th>
                     <th>Segundo Bimestre</th>
                     <th>Tercer Bimestre</th>
                     <th>Cuarto Bimestre</th>
                     <th>Promedio Final</th>
                     <th>Acciones</th>
                     <th>Eliminar</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach((array)$data as $row){ ?> <!-- muestra todas las filas -->
                  <tr>
                     <td><?php echo $row['periodo']; ?></td>
                     <td><?php echo $row['alumno']; ?></td>
                     <td><?php echo $row['curso']; ?></td>
                     <td><?php echo $row['pb']; ?></td>
                     <td><?php echo $row['sb']; ?></td>
                     <td><?php echo $row['tb']; ?></td>
                     <td><?php echo $row['cb']; ?></td>
                     <td><?php echo $row['pf']; ?></td>
                     <td><?php echo "<a href='calificaciones_acciones.php?idcalificacion=".$row['calificacion']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> Editar</td>
                     <td><?php echo "<a href='procesar.php?idcalificacion=".$row['calificacion']."&Eliminar=Eliminar' class='btn btn-danger btn-sm btn-icon icon-left'>"?><i class="fa fa-trash-o"></i> Eliminar</td>
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