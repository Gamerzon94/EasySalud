<?php
include("mysql.php");
if(isset($_POST["codigo"])){
    $cuenta = verificarCodigo($_POST["email"],$_POST["codigo"]);
    $existe = FALSE;
    while($aux = mysqli_fetch_array($cuenta)){
        $existe = TRUE;
        break;
    }
    if($existe == TRUE){
    activarUsuario($_POST["codigo"],$_POST["email"]);
    ?><script type="text/javascript">
	alert("Su cuenta fue activada.");
	window.location.href='index.php';</script><?php
    }else{
        ?><script type="text/javascript">
	alert("El email y/o el codigo son incorrectos o la cuenta no se encuentra pendiente de activación");
	window.location.href='index.php';</script><?php
    }
}else{
    header("Location:index.php");
}