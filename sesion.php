<?php
	include("mysql.php");
	$usuario = $_POST["email"];
	$clave = $_POST["cla"];
	$resultado = buscarUsuario($usuario,$clave);
	if($filas = mysqli_fetch_array($resultado)){
            if($filas['C_ID_ESTADO_CUENTA'] != '2'){
                ?><script type="text/javascript" src="js.js"></script> <script>usuarioNoAutorizado();</script><?php 
            }else{
		$rol = $filas['C_ID_TIPO_USUARIO'];
		$idUsu = $filas['C_ID_USUARIO'];
                $nomUsu = $filas['D_NOMBRE_USUARIO'];
                $apeUsu = $filas['D_APELLIDO_USUARIO'];
	if($rol == 1){
		setcookie("rol","$rol",time()+3600);
		setcookie("idUsu","$idUsu",time()+3600);
                setcookie("nomUsu","$nomUsu",time()+3600);
                setcookie("apeUsu","$apeUsu",time()+3600);
		header("Location:Admin/index.php");
	}
	else if($rol == 2){
		setcookie("rol","$rol",time()+3600);
		setcookie("idUsu","$idUsu",time()+3600);
                setcookie("nomUsu","$nomUsu",time()+3600);
                setcookie("apeUsu","$apeUsu",time()+3600);
		header("Location:index.php");
	}else if($rol == 3){
		setcookie("rol","$rol",time()+3600);
		setcookie("idUsu","$idUsu",time()+3600);
                setcookie("nomUsu","$nomUsu",time()+3600);
                setcookie("apeUsu","$apeUsu",time()+3600);
		header("Location:index.php");
	}else if($rol == 4){
		setcookie("rol","$rol",time()+3600);
		setcookie("idUsu","$idUsu",time()+3600);
                setcookie("nomUsu","$nomUsu",time()+3600);
                setcookie("apeUsu","$apeUsu",time()+3600);
		header("Location:index.php");
	}else{
            ?><script type="text/javascript" src="js.js"></script> <script>mensajeError();</script><?php
	}?><script type="text/javascript" src="js.js"></script> <script>mensajeError();</script><?php
            }}?><script type="text/javascript" src="js.js"></script> <script>mensajeError();</script><?php
?>