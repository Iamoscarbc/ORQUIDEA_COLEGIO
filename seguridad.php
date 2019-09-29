<?php
session_start();
// si la sesion es distinta a 1 redirecciona al login porque en el login la sesion autentificado es igual a 1
if(isset($_SESSION["autentificado"]) || count($_SESSION) != 0){
    
}else{
    header('Location: ../index.php');
    exit;
}
?>
