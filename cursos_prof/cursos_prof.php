<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$objcliente=new clsConexion;
$result=$objcliente->consultar("SELECT cp.idcurso_prof AS idcurso_prof, g.descripcion AS grado, a.seccion AS seccion, c.descripcion AS curso, p.nombre_prof AS profesor FROM cursos_profesor cp INNER JOIN aula a INNER JOIN profesores p INNER JOIN cursos c INNER JOIN grado g ON cp.idaula=a.idaula AND cp.idprof=p.idprof AND cp.idcurso=c.idcurso AND c.idgrado=g.idgrado;");
?>
<div class="content-wrapper">
   <section class="content">
      <div class="box box-info">
         <div class="box-header with-border">
            <h3 class="box-title"><b>PROGRAMACION ACADEMICA DEL DOCENTE</b></h3>
            <div class="box-tools pull-right">
               <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-header">
            <a href="cursos_prof_nuevo.php" class="btn btn-primary btn-flat"><i class="fa fa-level-up"></i> Registrar Nueva Programacion</a>
         </div>
         <div class="box-body">
            <table id="example1" class="table table-striped table-bordered table-hover">
               <thead>
                  <tr class="tableheader">
                     <th>Grado</th>
                     <th>Seccion</th>
                     <th>Curso</th>                     
                     <th>Profesor</th>
                     <th>Editar</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach((array)$result as $row){ ?>
                  <tr>
                     <!--los que estan entre parentesis son colummnas 
                        llamadas desde la base de datos que an sido renombradas
                        al iniciar este problema
                        estan iniciando mas arriba
                        de ahi las llama ya renombradas y son renombradas para que
                        las pueda leer del mysql-->
                     <td><?php echo $row['grado']; ?></td>
                     <td><?php echo $row['seccion']; ?></td>
                     <td><?php echo $row['curso']; ?></td>
                     <td><?php echo $row['profesor']; ?></td>

                     <td><?php echo "<a href='cursos_prof_acciones.php?idcurso_prof=".$row['idcurso_prof']."' 

                     class='btn btn-default btn-sm btn-icon icon-left'>"?>

                     <i class="fa fa-pencil-square-o"

                     ></i> Editar</td>
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