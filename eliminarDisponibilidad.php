<?php
	include("config.php");
	include("mysql.php");
	if(isset($_COOKIE["rol"])){
	$rol = $_COOKIE["rol"];
        $idUsuario = $_COOKIE["idUsu"];
	$admin = "1";
	$usuario = "2";
        $profesional = "3";
        $farmacia = "4";
        }
        if(isset($_GET[id])){
            eliminarDisponibilidad($_GET['id']);
            header('Location: modificarDisponibilidad.php?id='.$_GET['idProf']);
        }else{
            header('Location: index.php');
        }
?>