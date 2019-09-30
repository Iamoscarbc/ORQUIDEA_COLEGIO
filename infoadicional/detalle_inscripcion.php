<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idalu'],ENT_QUOTES))));

$data=$obj->consultar("
    SELECT ap.idapo AS idapo, CONCAT(ap.nombre_apo, ' ', ap.apepat_apo, ' ', ap.apemat_apo) AS apoderado, CONCAT(al.nombres, ' ', al.apepat_alu, ' ', al.apemat_alu) AS alumno, al.idalu AS idalu, al.dni, g.descripcion FROM apoderado ap INNER JOIN alumno al ON al.idapo=ap.idapo INNER JOIN grado g INNER JOIN matricula m ON g.idgrado = m.idgrado WHERE al.idalu=$id GROUP BY ap.idapo
");
foreach($data as $row){
    $apoderado=$row['apoderado'];
    $alumno=$row['alumno'];
    $documentos=$row['dni'];
    $grado=$row['descripcion'];
    $idapoderado=$row['idapo'];
}
$ruta = "archivos/";

?>
    <div class="content-wrapper">
        <input type="hidden" class="form-control requerido numero" id="idalm" name="idalm" placeholder="Ejemplo, 8765345678" value="<?php echo $id;?>">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>DETALLE DE INSCRIPCION</b></h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="box-header">
                            <div class="box-body">
                                <h5 class="box-title"><b>INFORMACION DEL APODERADO</b></h5>
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr class="tableheader">
                                        <th>Apoderado</th>
                                        <th>Datos de Voucher</th>
                                        <th>Ficha de Apoderado</th>
                                        <th>Generar Clave</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <td><?php echo $apoderado; ?></td>
                                        <td><?php echo "<a href='../voucher_pago/verifica_voucher_pago.php?idapo=".$row['idapo']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o" onclick="EnviarAlumno();"></i> Ver Voucher</td>
                                        <td><?php echo "<a href='../apoderado/apoderado_acciones.php?idapo=".$row['idapo']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o";"></i> Mostrar Ficha</td>
                                        <td><?php echo "<a href='../infoadicional/generarclave.php?idapo=".$row['idapo']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o";"></i> Generar Clave</td>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-body">
                                <h5 class="box-title"><b>DETALLE DE DOCUMENTOS</b></h5>
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr class="tableheader">
                                        <th>Datos del Documento</th>
                                        <th>Estado</th>
                                        <th>Descarga</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <td><?php echo $documentos; ?></td>
                                    <td><?php echo "<a href='../inscripciones/archivos/".$row['dni']."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> Verificar Documento</td> <!--Crear Script para abrir docuemento pdf en nueva pestaña del navegador-->
                                    <td><?php echo "<a href='../inscripciones/archivos/".$row['dni']."' download='".$documentos."' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> Descargar Documento</td>
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-body">
                                <h5 class="box-title"><b>DETALLE DE MATRICULA</b></h5>
                                <table id="example2" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr class="tableheader">
                                        <th>Datos del Alumno</th>
                                        <th>Grado de Inscripcion</th>
                                        <th>Estado</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <td><?php echo $alumno; ?></td>
                                    <td><?php echo $grado; ?></td>
                                    <td><?php echo "<a href='../matricula/matricula_nuevo.php' id='btnmatricula' class='btn btn-default btn-sm btn-icon icon-left'>"?><i class="fa fa-pencil-square-o"></i> Matricular Alumno</td>
                                    </tbody>
                                </table>
                            </div>
                            <!--<a href="alumno_nuevo.php" class="btn btn-primary btn-flat"><i class="fa fa-user-plus"></i> Registrar Nuevo Estudiante</a>-->
                            <!--<a href="../reportes/EXCEL/reporteexcel.php?export" class="btn btn-success btn-flat"><i class="fa fa-file-excel-o"></i> Excel CSV</a>-->
                            <!--<a href="../reportes/rptalumnos.php" class="btn btn-danger btn-flat"><i class="fa fa-file-pdf-o"></i> PDF</a>-->
                        </div>
                        <!-- /.box-header -->

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
        </section>
        <!-- /.content -->
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
            jQuery('#btnmatricula').prop('disabled', true);
        });
    </script>
<?php include("../central/pie.php");?>