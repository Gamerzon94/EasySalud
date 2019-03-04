<?php
	include("config.php");
	include("mysql.php");
	if(isset($_COOKIE["rol"])){
	$rol = $_COOKIE["rol"];
	}
	$admin = "1";
	$usuario = "2";
        $profesional = "3";
        $farmacia = "4";
        if(isset($_GET[id])){
            $idProfesional = $_GET['id'];
            $esProfesional = verificarProfesional2($idProfesional);
            if($esProfesional==false){
                ?><script type="text/javascript">
	window.location.href='index.php';
</script><?php
            }else{
                
                                ?><script type="text/javascript">
                                    alert("Dentro de poco recibirá un correo confirmando el registro.");
                                    window.location.href='index.php';</script><?php 
                    }
        }else{
            ?><script type="text/javascript">
	window.location.href='index.php';</script><?php 
        }
?>