<?php

include './mysql.php';
if(isset($_POST["id"])){
    $id = $_POST["id"];
    $puntaje = $_POST["puntaje"];
    $comentario = $_POST["comentario"];
    nuevoComentario($id,$puntaje,$comentario);
    header("Location:solicitudes.php");
}else{
    header("Location:index.php");
}