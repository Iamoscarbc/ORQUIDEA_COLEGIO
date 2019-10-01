<?php
   include("../seguridad.php");
   $codigo=$_SESSION["codigo"];
   include_once("../conexion/clsConexion.php");
   $obj=new clsConexion;
   $result=$obj->consultar("SELECT t.descripcion AS descripcion, u.idcargo AS cargo FROM usuario u INNER JOIN tipo t ON u.idcargo = t.idTipo WHERE codigo='$codigo'");
   if(count($result) == 0){
      $result = $obj->consultar("SELECT t.descripcion AS descripcion, a.idcargo AS cargo FROM apoderado a INNER JOIN tipo t ON a.idcargo = t.idTipo WHERE codigo='$codigo'");
   }
   foreach((array)$result as $row){
      $c=$row["descripcion"];
      $cargo=$row["cargo"];
   }
?>
<aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
         <div class="pull-left image">
            <p><?php echo $c;?></p>
         </div>
         <div class="pull-left info">
            <p><?php echo $c;?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
         </div>
      </div>
      <ul class="sidebar-menu">         
         <li>
            <a href="../inicio">
               <i class="fa fa-home"></i>
               <span> Volver al Menú</span>
            </a>
         </li>
         <?php if($cargo=='0') {?> 
         <li class="active treeview">
            <a href="../inicio/index-ADM.php">
               <i class="fa fa-home"></i>
               <span>PANEL DE HERRAMIENTAS</span>
            </a>
         </li>
         <li>
             <a href="#">
                 <i class="fa fa-user-circle"></i>
                 <span>Pestaña Informativa</span>
           <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
           </span>
             </a>
             <ul class="treeview-menu">
                 <li>
                     <a href="../infoadicional/infoadicional.php"><i class="fa fa-male"></i> Información Adicional</a>
                 </li>
             </ul>
         </li>
         <li>
            <a href="#">
               <i class="fa fa-cog fa-spin fa-lg fa-fw"></i>
               <span>Administracion del Sistema</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="../configuracion/configuracion.php"><i class="fa fa-cogs"></i> <span>Configuracion del Sistema</span></a>
               </li>
               <li>
                  <a href="../backup/backup.php"><i class="fa fa-database"></i> <span>Respaldo de Base de Datos</span></a>
               </li>
            </ul>
         </li>
         <li>
            <a href="#">
               <i class="fa fa-cog fa-spin fa-lg fa-fw"></i>
               <span>Administracion del Financiera</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="../concepto_pago/concepto_pago.php"><i class="fa fa-circle-o"></i>Conceptos de pago</a>
               </li>
               <li>
                  <a href="../pago/pago.php"><i class="fa fa-circle-o"></i>Pago</a>
               </li>
               <li>
                  <a href="../voucher_pago/voucher_pago.php"><i class="fa fa-circle-o"></i>Voucher Pago</a>
               </li>
            </ul>
         </li>

         <li>
            <a href="#">
               <i class="fa fa-university"></i>
               <span>Administracion Academica</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="../periodo/periodo.php"><i class="fa fa-calendar-check-o"></i> <span>Periodo Academico</span></a>
               </li>
               <li>
                  <a href="../nivel/nivel.php"><i class="fa fa-certificate"></i> <span>Nivel Educativo</span></a>                  
               </li>
               <li>
                  <a href="../grado/grado.php"><i class="fa fa-certificate"></i> <span>Grado Academico</span></a>
               </li>
               <li>
                  <a href="../aula_grado/aula_grado.php"><i class="fa fa-sign-in"></i> <span>Aulas</span></a>
               </li>
               <li>
                  <a href="../cursos/cursos.php"><i class="fa fa-book"></i> <span>Asignaturas</span></a>
               </li>
               <li>
                  <a href="../cursos_prof/cursos_prof.php"><i class="fa fa-book"></i> <span>Programacion Academica</span></a>
               </li>
            </ul>
         </li>
         <li class="treeview">
            <a href="#">
               <i class="fa fa-users"></i>
               <span>Administracion de Usuarios</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="../cargos/cargos.php"><i class="fa fa-id-card-o"></i> <span>Tipos de Usuarios</span></a>
               </li>
               <li>
                  <a href="../usuario/usuario.php"><i class="fa fa-user"></i>Todos los usuarios</a>
               </li>
            </ul>
         </li>

         <li>
            <a href="#">
               <i class="fa fa-user-circle"></i>
               <span>Apoderado</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="../apoderado/apoderado.php"><i class="fa fa-male"></i> Apoderado</a>
               </li>
            </ul>
         </li>
         <li>
            <a href="#">
               <i class="fa fa-graduation-cap"></i>
               <span>Estudiante</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="../alumno/Alumno.php"><i class="fa fa-address-book-o"></i> <span>Estudiante</span></a>
               </li>               
            </ul>
         </li>

         <li>
            <a href="../matricula/matricula.php"><i class="fa fa-pencil-square-o"></i> <span>Matricula</span></a>
         </li>
         <li>
            <a href="#">
               <i class="fa fa-navicon"></i>
               <span>Calificaciones</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="../Calificaciones/calificaciones.php"><i class="fa fa-circle-o"></i> Registro de calicaciones</a>
               </li>
            </ul>
         </li>
         <li class="treeview">
            <a href="#">
               <i class="ion ion-pie-graph"></i>
               <span>Reportes</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="../reportes/rptaula.php"><i class="fa fa-circle-o"></i> Aulas</a>
               </li>
               <li>
                  <a href="../reportes/rptpension.php"><i class="fa fa-circle-o"></i> Pensiones</a>
               </li>
               <li>
                  <a href="../reportes/rptrango1pago.php"><i class="fa fa-circle-o"></i> Pagos</a>
               </li>
            </ul>
         </li>         
         <?php } ?>






         <?php if($cargo=='2') { //secretaria?>

<!--  MODULO apoderado en secretaria -->

             <li class="active treeview">
                 <a href="../inicio/index-SEC.php">
                     <i class="fa fa-home"></i>
                     <span>PANEL DE HERRAMIENTAS</span>
                 </a>
             </li>
             <li>
                 <a href="#">
                     <i class="fa fa-user-circle"></i>
                     <span>Pestaña Informativa</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
                 </a>
                 <ul class="treeview-menu">
                     <li>
                         <a href="../infoadicional/infoadicional.php"><i class="fa fa-male"></i> Información Adicional</a>
                     </li>
                 </ul>
             </li>

            <li>
            <a href="#">
               <i class="fa fa-user-circle"></i>
               <span>Apoderado</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="../apoderado/apoderado.php"><i class="fa fa-male"></i> Apoderado</a>
               </li>
            </ul>
         </li>


 

<!--  MODULO ESTUDIANTE -->

        <li>
            <a href="#">
               <i class="fa fa-graduation-cap"></i>
               <span>Estudiante</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="../alumno/Alumno.php"><i class="fa fa-address-book-o"></i> <span>Estudiante</span></a>
               </li>               
            </ul>
         </li>




         <li>
            <a href="../matricula/matricula.php"><i class="fa fa-pencil-square-o"></i> <span>Matricula</span></a>
         </li>

            <li>
               <a href="#">
                  <i class="fa fa-cog fa-spin fa-lg fa-fw"></i>
                  <span>Administracion Financiera</span>
                  <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                  </span>
               </a>
               <ul class="treeview-menu">
                  <li>
                     <a href="../concepto_pago/concepto_pago.php"><i class="fa fa-circle-o"></i>Conceptos de pago</a>
                  </li>
                  <li>
                     <a href="../voucher_pago/voucher_pago.php"><i class="fa fa-circle-o"></i>Voucher Pago</a>
                  </li>
               </ul>
            </li>
            <li>
            <a href="#">
               <i class="fa fa-university"></i>
               <span>Administracion Academica</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="../periodo/periodo.php"><i class="fa fa-calendar-check-o"></i> <span>Periodo Academico</span></a>
               </li>
               <li>
                  <a href="../nivel/nivel.php"><i class="fa fa-certificate"></i> <span>Nivel Educativo</span></a>                  
               </li>
               <li>
                  <a href="../grado/grado.php"><i class="fa fa-certificate"></i> <span>Grado Academico</span></a>
               </li>
               <li>
                  <a href="../aula_grado/aula_grado.php"><i class="fa fa-sign-in"></i> <span>Aulas</span></a>
               </li>
               <li>
                  <a href="../cursos/cursos.php"><i class="fa fa-book"></i> <span>Asignaturas</span></a>
               </li>
               <li>
                  <a href="../cursos_prof/cursos_prof.php"><i class="fa fa-book"></i> <span>Programacion Academica</span></a>
               </li>
            </ul>
         </li>
         
 <?php } ?>

 <?php if($cargo=='3') { //docente?>

 <li>
               <a href="#">
                  <i class="fa fa-navicon"></i>
                  <span>Calificaciones</span>
                  <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                  </span>
               </a>
               <ul class="treeview-menu">
                  <li>
                     <a href="../Calificaciones/calificaciones.php"><i class="fa fa-circle-o"></i> Calicaciones</a>
                  </li>
               </ul>
            </li>


 <li>
            <a href="#">
               <i class="fa fa-graduation-cap"></i>
               <span>Estudiante</span>
               <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
               <li>
                  <a href="../alumno/Alumno.php"><i class="fa fa-address-book-o"></i> <span>Estudiante</span></a>
               </li>               
            </ul>
         </li>

 <?php } ?>





         <?php if($cargo=='4') { //apoderado?>
            <li class="treeview">
               <a href="#">
                  <i class="fa fa-users"></i>
                  <span>Administracion de Usuarios</span>
                  <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                  </span>
               </a>
               <ul class="treeview-menu">
                  <li>
                     <a href="../apoderado/usuario.php"><i class="fa fa-user"></i>Mi Usuario</a>
                  </li>
               </ul>
            </li>
            <li>
               <a href="#">
                  <i class="fa fa-navicon"></i>
                  <span>Calificaciones</span>
                  <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                  </span>
               </a>
               <ul class="treeview-menu">
                  <li>
                     <a href="../apoderado/calificaciones_alumno.php"><i class="fa fa-circle-o"></i> Calicaciones</a>
                  </li>
               </ul>
            </li>

            <li>
               <a href="#">
                  <i class="fa fa-graduation-cap"></i>
                  <span>Estudiante</span>
                  <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                  </span>
               </a>
               <ul class="treeview-menu">
                  <li>
                     <a href="../apoderado/apoderado_alumno.php"><i class="fa fa-address-book-o"></i> <span>Estudiante</span></a>
                  </li>               
               </ul>
            </li>

            <li>
               <a href="#">
                  <i class="fa fa-cog fa-spin fa-lg fa-fw"></i>
                  <span>Administracion Financiera</span>
                  <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                  </span>
               </a>
               <ul class="treeview-menu">               
                  <li>
                     <a href="../apoderado/pagos_apoderado.php"><i class="fa fa-circle-o"></i>Historial de Pagos</a>
                  </li>
               </ul>
         </li>
             <?php } ?>  
      </ul>
   </section>
   <!-- /.sidebar -->
</aside>