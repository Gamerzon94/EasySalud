<?php
    if(isset($_COOKIE["rol"])) {
        setcookie("rol","$rol",time()-3600);
	setcookie("idUsu","$idUsu",time()-3600);
        setcookie("nomUsu","$nomUsu",time()-3600);
        setcookie("apeUsu","$apeUsu",time()-3600);
	}
    header("Location:index.php");
?>