<?php
   session_start();
   if(count($_SESSION) == 0 || $_SESSION["autentificado"]!=1){
      include_once("conexion/clsConexion.php");
      $obj=new clsConexion;
      $result=$obj->consultar("SELECT * FROM configuracion");
      foreach((array)$result as $row){
         $logo=$row['imagen_logo'];
         $background=$row['imagen_fondo'];
         $razon_social=$row['razon_social'];
      }
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>SISCOLEGIO | Login</title>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.6 -->
      <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="plugins/dist/css/AdminLTE.min.css">
      <link rel="stylesheet" href="plugins/alert/alertify/alertify.css">
      <link rel="stylesheet" href="plugins/alert/alertify/themes/default.css">
      <script src="plugins/alert/alertify/alertify.js"></script>      
            


            <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

         <!--<script>
            function captchaSubmit(data) {
               document.getElementById("login").submit();
            }
         </script>-->

      <style>
         .fondo {
            background-image: url(configuracion/<?php echo $background ?>);
         }
      </style>
   </head>
   <body class="hold-transition login-page fondo">
      <div class="login-box">
         <div class="login-box-body">
			<!-- <p align="right">Para información e inscripciones pulse <a href="informacion/informacion.php">Aqui</a></p> -->
            <div class="login-logo">
               <img src="configuracion/<?php echo $logo?>" width="150" height="150" />
            </div>
            <!-- /.login-logo -->
            <p class="login-box-msg">Por favor ingrese su codigo y clave.</p>
            <form id="login" name="form1" method="post" action="">
               <div class="form-group has-feedback">
                  <input type="text" class="form-control" name="codigo" id="username" required placeholder="codigo"  autocomplete="off" />
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
               </div>
               <div class="form-group has-feedback">
                  <input type="password" class="form-control" name="clave" id="password" required placeholder="clave" autocomplete="off" />
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
               </div>               
               <div class="form-group has-feedback">
                  <center>

                     <!--<div class="g-recaptcha" data-sitekey="6Lf-9kkUAAAAAAVzAw8UB7qc46nQW16zzusDtcvP" data-callback='captchaSubmit'> </div> -->

                  </center>
                  <button type="submit" value="Ingresar" class="btn btn-primary btn-block btn-flat"> <i class="fa fa-unlock"></i> Entrar </button>
               </div>
            </form>

            <div align="center">
               <h5 style="margin-bottom:0px"><?php echo $razon_social ?></h5>
               <br />
               <span>2018</span>  - <span>Todos los derechos reservados</span>
            </div>
         </div>
         <!-- /.login-box-->
      </div>
      <!-- /.login-box-body -->
   </body>

   <!-- jQuery 2.2.3 -->
   <script src="plugins/plugins/jQuery/jquery-2.2.3.min.js"></script>
   <!-- Bootstrap 3.3.6 -->
   <script src="plugins/bootstrap/js/bootstrap.min.js"></script>
</html>
<?php
      if(!empty($_POST['codigo']) and !empty($_POST['clave'])){

         $codigo= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['codigo'],ENT_QUOTES))));
         $clave= trim($obj->real_escape_string(htmlentities(strip_tags($_POST['clave'],ENT_QUOTES))));
         $clavemd5 = md5($clave);
         $resultapo=$obj->consultar("SELECT * FROM usuario WHERE codigo='".$obj->real_escape_string($codigo)."' and clave='".$obj->real_escape_string($clavemd5)."'");
         foreach((array)$resultapo as $row){
            $valor=$row['codigo'];
            $estado=$row["estado"];
            $cargo=$row["idcargo"];
         }
         //si el codigo no existe en la bd manda el mensaje de error es como decir $row['codigo']=nulo
         if(isset($valor)=='') {
            echo"<script>
            alertify.alert('Mensaje','Usuario y/o clave Incorrecta.', function(){
            alertify.message('OK');
            self.location='index.php';
            });
            </script>";
            // echo '<b><p align="center" style="color:red;">Usuario y/o clave Incorrecta</p></b>';
         } else if($estado!='ACTIVO') {
            echo"<script>
            alertify.alert('Mensaje','Usted no se encuentra Activo en la base de datos.', function(){
            alertify.message('OK');
            self.location='index.php';
            });
            </script>";
         } else if($cargo=='0') {
            // esta sesion de autentificado lo pongo 1 para seguridad i despues haga la comprobacion si no es igual a 1 se redireccion al inicio
            $_SESSION["autentificado"]=1;
            $_SESSION["codigo"]=$codigo;
            $_SESSION["clave"]=$clavemd5;
            $_SESSION["cargo"]=$cargo;
            header('location:inicio/index-ADM.php');
         } else if($cargo=='1') {
            $_SESSION["autentificado"]=1;
            $_SESSION["codigo"]=$codigo;
            $_SESSION["clave"]=$clavemd5;
            $_SESSION["cargo"]=$cargo;
            header('location:inicio/index.php');
         } else if($cargo=='2') {
            $_SESSION["autentificado"]=1;
            $_SESSION["codigo"]=$codigo;
            $_SESSION["clave"]=$clavemd5;
            $_SESSION["cargo"]=$cargo;
            header('location:inicio/index-SEC.php');
         } else if($cargo=='3') {
            $_SESSION["autentificado"]=1;
            $_SESSION["codigo"]=$codigo;
            $_SESSION["clave"]=$clavemd5;
            $_SESSION["cargo"]=$cargo;
            header('location:inicio/index.php');
         } else if($cargo=='4') {
            $_SESSION["autentificado"]=1;
            $_SESSION["codigo"]=$codigo;
            $_SESSION["clave"]=$clavemd5;
            $_SESSION["cargo"]=$cargo;
            header('location:apoderado/apoderado.php');
         }
      }
   }else{
      if(isset($_SESSION)){
         if($_SESSION["cargo"]=='0') {
            header('location:inicio/index-ADM.php');
         } else if($_SESSION["cargo"]=='1') {
            header('location:inicio/index.php');
         } else if($_SESSION["cargo"]=='2') {
            header('location:inicio/index-SEC.php');
         } else if($_SESSION["cargo"]=='3') {
            header('location:inicio/index.php');
         } else if($_SESSION["cargo"]=='4') {
            header('location:apoderado/apoderado.php');
         }
      }
   }
?>