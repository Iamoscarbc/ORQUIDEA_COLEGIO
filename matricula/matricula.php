<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$objcliente=new clsConexion;
$result=$objcliente->consultar("SELECT matricula.num_matricula, alumno.nombres, grado.descripcion, matricula.periodo, aula.seccion, apoderado.nombre_apo FROM matricula INNER JOIN alumno INNER JOIN apoderado INNER JOIN grado INNER JOIN aula ON matricula.idalumno = alumno.idalu AND alumno.idapo = apoderado.idapo AND matricula.idgrado=grado.idgrado AND matricula.idaula=aula.idaula");
?>
<head>
   <style>
      input[type="text"] {
         text-transform:uppercase;
      }
   </style>
</head>
<div class="content-wrapper">
   <section class="content">
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title"><b>MATRICULA</b></h3>
            <div class="box-tools pull-right">
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-header">
            <a href="../matricula/matricula_nuevo.php" class="btn btn-primary btn-flat"><i class="fa fa-pencil"></i> Registrar Nueva Matricula </a>
            <a href="../reportes/rptmatriculados.php" class="btn btn-danger btn-flat"><i class="fa fa-file-pdf-o"></i> PDF</a>
         </div>
         <div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr class="tableheader">
                     <th>Numero Matricula</th>
                     <th>Alumno</th>
                     <th>Grado</th>
                     <th>Seccion</th>
                     <th>Apoderado</th>
                     <th>Periodo</th>
                     <th>Accion</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach((array)$result as $row){ ?>
                  <tr>
                     <td><?php echo $row['num_matricula']; ?></td>
                     <td><?php echo $row['nombres']; ?></td>
                     <td><?php echo $row['descripcion']; ?></td>
                     <td><?php echo $row['seccion']; ?></td>
                     <td><?php echo $row['nombre_apo']; ?></td>
                     <td><?php echo $row['periodo']; ?></td>
                     <td><?php echo "<a href='../reportes/fichaparam.php?num_matricula=".$row['num_matricula']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-print"></i>  Imprimir</td>
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