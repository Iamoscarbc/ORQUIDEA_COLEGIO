<!DOCTYPE html>
<?php 
   error_reporting(E_ALL ^ E_NOTICE);
   session_start();
if($_SESSION["cargo"]=='1' || $_SESSION["cargo"]=='3'){
   include("../central/cabecera.php");
   include("../central/sidebar.php"); 
?>
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
      Accesos Directos
      <small>Panel De Control</small>
      </h1>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
               <div class="inner">
                  <h3>&nbsp;</h3>
                  <p>Alumnos</p>
               </div>
               <div class="icon">
                  <i class="fa fa-graduation-cap"></i>
               </div>
               <a href="../alumno/alumno.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
               <div class="inner">
                  <h3>&nbsp;</h3>
                  <p>Calificaciones</p>
               </div>
               <div class="icon">
                  <i class="fa fa-pencil-square-o"></i>
               </div>
               <a href="../Calificaciones/calificaciones.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <?php if($_SESSION["cargo"]=='1'){?>
         <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-orange">
               <div class="inner">
                  <h3>&nbsp;</h3>
                  <p>Matricula</p>
               </div>
               <div class="icon">
                  <i class="fa fa-pencil-square-o"></i>
               </div>
               <a href="../matricula/matricula.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <?php 
         }
         if($_SESSION["cargo"]=='1'){?>
         <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
               <div class="inner">
                  <h3>&nbsp;</h3>
                  <p>Contabilidad</p>
               </div>
               <div class="icon">
                  <i class="fa fa-money"></i>
               </div>
               <a href="../pago/pago.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">            
            <div class="small-box bg-purple">
               <div class="inner">
                  <h3>&nbsp;</h3>
                  <p>Usuario</p>
               </div>
               <div class="icon">
                  <i class="fa fa-users"></i>
               </div>
               <a href="../usuario/usuario.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">            
            <div class="small-box bg-green">
               <div class="inner">
                  <h3>&nbsp;</h3>
                  <p>Aulas</p>
               </div>
               <div class="icon">
                  <i class="fa fa-university"></i>
               </div>
               <a href="../aula_grado/aula_grado.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">            
            <div class="small-box bg-aqua">
               <div class="inner">
                  <h3>&nbsp;<sup style="font-size: 20px"></sup></h3>
                  <p>Periodo Academico</p>
               </div>
               <div class="icon">
                  <i class="fa fa-calendar"></i>
               </div>
               <a href="../periodo/periodo.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">            
            <div class="small-box bg-yellow">
               <div class="inner">
                  <h3>&nbsp;</h3>
                  <p>Configuracion</p>
               </div>
               <div class="icon">
                  <i class="fa fa-cogs"></i>
               </div>
               <a href="../configuracion/configuracion.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">            
            <div class="small-box bg-red">
               <div class="inner">
                  <h3>&nbsp;</h3>
                  <p>Reportes</p>
               </div>
               <div class="icon">
                  <i class="fa fa-line-chart"></i>
               </div>
               <a href="../reportes/rptrango1pago.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <?php } ?>
      </div>
   </section>
   <!-- /.content -->
</div>
<?php 
}
else{
   if($_SESSION["cargo"]=='0') {
      header('location: index-ADM.php');
   } else if($_SESSION["cargo"]=='1') {
      header('location: index.php');
   } else if($_SESSION["cargo"]=='2') {
      header('location: index-SEC.php');
   } else if($_SESSION["cargo"]=='3') {
      header('location: index.php');
   } else if($_SESSION["cargo"]=='4') {
      header('location: ../apoderado/apoderado.php');
   }
}
include("../central/pie2.php");
include("../central/pie.php");?>