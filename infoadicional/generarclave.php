<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$objcliente=new clsConexion;
$id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idapo'],ENT_QUOTES))));

$result=$objcliente->consultar("
    SELECT
	    ap.idapo AS idapo,
	    CONCAT(ap.nombre_apo, ' ',ap.apepat_apo, ' ',ap.apemat_apo) AS apoderado,
        al.idalu AS idalu,
        CONCAT(al.nombres, ' ',al.apepat_alu, ' ',al.apemat_alu) AS alumno,
        al.idalu AS idacceso
    FROM apoderado ap
    INNER JOIN alumno al ON al.idapo = ap.idapo
    WHERE ap.idapo=$id");
?>
    <div class="content-wrapper">
        <section class="content">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>MODULO PARA GENERAR CLAVE DE ACCESO</b></h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <div class="box-header">
                </div>
                <div class="box-body">
                    <table  class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="tableheader">
                            <th>Apoderado</th>
                            <th>Estudiante</th>
                            <th>Contraseña</th>
                            <th>Confirmar</th>
                            <th>Mostrar / Ocultar Contraseña</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach((array)$result as $row){ ?>
                            <tr>
                                <td><?php echo $row['apoderado']; ?></td>
                                <td><?php echo $row['alumno']; ?></td>
                                <td><input type="password" id="contrasena" value="<?php echo $row['idacceso']; ?>"></td>
                                <td><?php echo "<a href='../infoadicional/procesarcontraseña.php?idalu=".$row['idalu']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> Confirmar Contraseña</td>
                                <td><button id="btnmostrar" class="btn btn-primary" type="button" onmouseup="ocultarcontrasena()" onmousedown="mostrarcontrasena()">☼</button></td>
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
    <script type="text/javascript">
        function mostrarcontrasena(){
            $show = document.getElementById("contrasena");
            $show.type="text";
        }
        function ocultarcontrasena(){
            $show = document.getElementById("contrasena");
            $show.type="password";
        }
    </script>
<?php include("../central/pie.php");?>