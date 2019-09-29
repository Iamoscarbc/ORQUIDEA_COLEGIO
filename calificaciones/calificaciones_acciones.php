<!DOCTYPE html>
<?php
include("../central/cabecera.php");
include("../central/sidebar.php");
include_once("../conexion/clsConexion.php");
$obj=new clsConexion;
$id=trim($obj->real_escape_string(htmlentities(strip_tags($_GET['idcalificacion'],ENT_QUOTES))));

$result=$obj->consultar("
    SELECT 
    ca.idcalificacion AS idcalificacion, 
    ca.periodo AS periodo, 
    ca.alumno AS idalu, 
    CONCAT(al.nombres, ' ',al.apepat_alu, ' ',al.apemat_alu) AS alumno, 
    au.idnivel AS idnivel, 
    g.idgrado AS idgrado, 
    au.seccion AS seccion, 
    ca.idcurso AS idcurso, 
    cu.descripcion AS descripcion, 
    ca.pb AS pb, 
    ca.sb AS sb, 
    ca.tb AS tb, 
    ca.cb AS cb, 
    ca.pf AS pf 
    FROM calificaciones ca 
    INNER JOIN matricula m ON m.idalumno = ca.alumno 
    INNER JOIN cursos cu ON cu.idcurso = ca.idcurso 
    INNER JOIN alumno al ON al.idalu = ca.alumno 
    INNER JOIN grado g ON g.idgrado = m.idgrado 
    INNER JOIN aula au ON au.idgrado = g.idgrado 
    WHERE ca.idcalificacion='".$obj->real_escape_string($id)."'");

foreach($result as $row){
    $idcalificacion = $row['idcalificacion'];
    $periodo = $row['periodo'];
    $idalumno = $row['idalu'];
    $alumno = $row['alumno'];
    $selector_nivel = $row['idnivel'];
    $idgrado = $row['idgrado'];
    $seccion = $row['seccion'];
    $idcurso = $row['idcurso'];
    $asignatura = $row['descripcion'];
    $pb = $row['pb'];
    $sb = $row['sb'];
    $tb = $row['tb'];
    $cb = $row['cb'];
    $pf = $row['pf'];
}
?>
<head>
    <link rel="stylesheet" href="../plugins/jquery-ui.css">
    <style>
        input[type="text"] {
            text-transform:uppercase;
        }
    </style>
</head>
<div class="content-wrapper">
    <section class="content">
        <!-- SELECT2 EXAMPLE -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h3 class="box-title"><b>REGISTRAR NOTAS DEL CURSO</b></h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <label id="aviso"></label>
                <form action="procesar.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fecha:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" readonly name="periodo" value="<?php echo $periodo; ?>" />
                                    <input type="hidden" class="form-control" readonly name="idcalifica" value="<?php echo $idcalificacion; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Nivel:</label>
                                <select readonly class="form-control select2 nivel_grado requerido" style="width: 100%;" id="nivel">
                                    <?php
                                    $result=$obj->consultar("SELECT * FROM nivel");
                                    foreach((array)$result as $row){
                                        if($row['idnivel']==$selector_nivel){
                                            echo '<option value="'.$row['idnivel'].'" selected>'.$row['descripcion'].'</option>';
                                        } else {
                                            echo '<option value="'.$row['idnivel'].'">'.$row['descripcion'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" id="id_nivelSeleccionado" name="id_nivel" value="<?php echo $selector_nivel;?>" />
                            </div>
                            <div class="form-group">
                                <label>Grado:</label>
                                <select readonly class="form-control select2 nivel_grado requerido" style="width: 100%;" id="grado">
                                    <?php
                                    $result=$obj->consultar("SELECT * FROM grado WHERE idgrado='".$idgrado."'");
                                    foreach((array)$result as $row){
                                        if($row['idgrado']==$selector_grado){
                                            echo '<option value="'.$row['idgrado'].'" selected>'.$row['descripcion'].'</option>';
                                        } else {
                                            echo '<option value="'.$row['idgrado'].'">'.$row['descripcion'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Aula:</label>
                                <select readonly class="form-control select2 nivel_grado requerido" style="width: 100%;" id="aula">
                                    <?php
                                    $result=$obj->consultar("SELECT idaula, seccion FROM aula WHERE idgrado='".$idgrado."'");
                                    foreach((array)$result as $row){
                                        $idaula = $row['idaula'];
                                        if($row['idaula']==$selector_aula){
                                            echo '<option value="'.$row['idaula'].'" selected>'.$row['seccion'].'</option>';
                                        } else {
                                            echo '<option value="'.$row['idaula'].'">'.$row['seccion'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" id="nombre_aulaSeleccionado" name="aula" value="<?php echo $idaula; ?>" />
                            </div>
                            <div class="form-group">
                                <label>Curso:</label>
                                <select class="form-control select2 nivel_grado requerido" style="width: 100%;" id="curso">
                                    <?php
                                    $result=$obj->consultar("SELECT * FROM cursos WHERE idgrado='".$idgrado."'");
                                    foreach((array)$result as $row){
                                        if($row['idcurso']==$selector_curso){
                                            echo '<option value="'.$row['idcurso'].'" selected>'.$row['descripcion'].'</option>';
                                        } else {
                                            echo '<option value="'.$row['idcurso'].'">'.$row['descripcion'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="hidden" id="nombre_cursoSeleccionado" name="curso" value="<?php echo $idcurso; ?>" />
                            </div>
                            <div class="form-group">
                                <label>Estudiante:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" id="alumno" class="form-control requerido nivel_grado" placeholder="busqueda por apellidos" value="<?php echo $alumno; ?>"/>
                                    <input type="hidden" id="id_alumnoSeleccionado" class="nivel_grado" name="alumno" value="<?php echo $idalumno; ?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>PRIMER BIMESTRE:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="pb" id="pb" class="form-control habilitado amt numero" required value="<?php echo $pb; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>SEGUNDO BIMESTRE:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="sb" id="sb" class="form-control habilitado amt numero" required value="<?php echo $sb; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>TERCER BIMESTRE:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="tb" id="tb" class="form-control habilitado amt numero" required value="<?php echo $tb; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>CUARTO BIMESTRE:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="cb" id="cb" class="form-control habilitado amt numero" required value="<?php echo $cb; ?>" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>PROMEDIO FINAL:</label>
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="pf" id="inputTotal" class="form-control habilitado" required value="<?php echo $pf; ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <input type="hidden" name="proceso" id="proceso" value=""/>
                </form>
            </div>
            <!-- /.body-->
            <div class="box-footer">
                <center>
                    <button type="submit" class="btn btn-info" id="Modificar" onclick="Registrar()"><i class="fa fa-pencil"></i><span>Actualizar Registro</span></button>
                    <button id="Cancelar" class="btn btn-info" onclick="Cancelar()">
                        <i class="fa fa-close">Cancelar</i>
                    </button>
                </center>
            </div>
            <!-- /.footer-->
        </div>
        <!-- /.box-->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script src="../plugins/jquery-1.10.2.js"></script>
<script src="../plugins/jquery-ui.js"></script>
<script>
    $(document).ready(function(){
        $("#nivel").change(function(){
            $("#id_nivelSeleccionado").val($("#nivel option:selected").val());
        });
    });
</script>
<script>
    $(function() {
        $("#alumno").autocomplete({
            source: "busquedaalumno.php",
            minLength: 2,
            select: function(event, ui) {
                event.preventDefault();
                $('#alumno').val(ui.item.nombre_alumno);
                $('#id_alumnoSeleccionado').val(ui.item.id_alumno);
            }
        });
    });
</script>
<script type="text/javascript">
    $('.numero').on('input', function () {
        this.value = this.value.replace(/[^0-9]/g,'');
    });
</script>
<script>
    $('.amt').keyup(function() {
        var importe_total = 0
        $(".amt").each(
            function(index, value) {
                if ( $.isNumeric( $(this).val() ) ){
                    importe_total = importe_total + eval($(this).val());
                }
            }
        );
        $("#inputTotal").val(Math.round(importe_total/4));
    });
</script>
<script>
    $(document).ready(function() {

        $('.nivel_grado').change(function() {
            if($(this).val() != '')
            {
                var action = $(this).attr("id");
                var query = $(this).val();
                var result = '';

                if (action == "nivel"){
                    result = 'grado';
                } else if (action == "grado") {
                    result = 'aula';
                } else if (action == "aula") {
                    result = 'curso';
                }

                $.ajax({
                    url:"selectdependientes.php",
                    method:"POST",
                    data:{action:action, query:query},
                    success:function(data){
                        $('#'+result).html(data);
                    }
                })
            }

            $("#aula").change(function(){
                $("#nombre_aulaSeleccionado").val($("#aula option:selected").val());
            });

            $("#curso").change(function(){
                $("#nombre_cursoSeleccionado").val($("#curso option:selected").val());
            });
        });
    });
</script>
<script type="text/javascript">

    function Registrar(){

        var error = 0;

        $('.requerido').each(function(i, elem){
            if($(elem).val() == ''){
                $(elem).css({'background-color':'#FFEDFF','border':'1px solid red'});
                error++;
            }
        });

        if(error > 0) {
            event.preventDefault();
            $('#aviso').text(' ■ Se deben completar los campos obligatorios');
            $('#aviso').css({'color':'red','font-size':'12px'});
        } else {
            $("#proceso").attr("value","Modificar");
            $( "form" ).submit();
        }
    }

    function Cancelar() {
        // Recargo la página
        location.href="calificaciones.php";
    }
</script>
<?php include("../central/pie2.php"); ?>
<?php include("../central/pie.php");?>