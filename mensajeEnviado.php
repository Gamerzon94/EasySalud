<?php
require './mysql.php';
if(isset($_POST["para"])){
    $para = $_POST["para"];
    $de = $_POST["de"];
    $titulo = $_POST["titulo"];
    $mensaje = $_POST["mensaje"];
    nuevoMensaje($de, $para, $titulo, $mensaje);
    ?> <script>alert("Mensaje enviado");</script><?php 
    header("Location:mensajes.php");
}else{
    header("Location:index.php");
}