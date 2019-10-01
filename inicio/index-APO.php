<!DOCTYPE html>
<?php 
   error_reporting(E_ALL ^ E_NOTICE);
   session_start();
if($_SESSION["cargo"]=='4'){
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
                  <p>Alumno</p>
               </div>
               <div class="icon">
                  <i class="fa fa-graduation-cap"></i>
               </div>
               <a href="../apoderado/apoderado_alumno.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
               <div class="inner">
                  <h3>&nbsp;</h3>
                  <p>Pagos</p>
               </div>
               <div class="icon">
                  <i class="fa fa-money"></i>
               </div>
               <a href="../apoderado/pagos_apoderado.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
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
               <a href="../apoderado/usuario.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
         <div class="col-lg-3 col-xs-6">            
            <div class="small-box bg-red">
               <div class="inner">
                  <h3>&nbsp;</h3>
                  <p>Calificaciones</p>
               </div>
               <div class="icon">
                  <i class="fa fa-line-chart"></i>
               </div>
               <a href="../apoderado/calificaciones_alumno.php" class="small-box-footer">Ir <i class="fa fa-arrow-circle-right"></i></a>
            </div>
         </div>
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