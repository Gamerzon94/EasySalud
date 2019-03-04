<script type="text/javascript">function mensajeRegistro(){
	alert("Dentro de poco recibirá un correo confirmando el registro.");
	window.location.href='index.php';
}</script>
<?php
require("conexionBD.php");
$lunes = false;
$martes = false;
$miercoles = false;
$jueves = false;
$viernes = false;
$sabado = false;
$domingo = false;
$activo = false;
if(isset($_POST['dia'])){
    foreach ($_POST['dia'] as $opcion) {
       if($opcion == 'lunes'){
           $lunes = true;
       }else if($opcion == 'martes'){
           $martes = true;
       }else if($opcion == 'miercoles'){
           $miercoles = true;
       }else if($opcion == 'jueves'){
           $jueves = true;
       }else if($opcion == 'viernes'){
           $viernes = true;
       }else if($opcion == 'sabado'){
           $sabado = true;
       }else if($opcion == 'domingo'){
           $domingo = true;
       }
     }
}
if(isset($_POST['activo'])){
    if($_POST['activo']=='si'){
        $activo=true;
    }
}
$con = new Conexion();
$tip="3";
$run=$_POST['run'];
$nom=$_POST['nom'];
$ape=$_POST['ape'];
$email=$_POST['email'];
$cla=$_POST['cla'];
$com=$_POST['comuna'];
if($_POST['tel'] == ''){
    $tel=NULL;
}else{
    $tel=$_POST['tel'];
}
$movil=$_POST['cel'];
$dir=$_POST['dir'];
$dep=$_POST['dep'];
$nac=$_POST['fechaNacimiento'];
$esp=$_POST['esp'];
$estu=$_POST['estu'];
$instu=$_POST['inst'];
$titu=$_POST['titu'];
$con->ConectarBD();
$horaDesde=$_POST['desdeh'];
$minutosDesde=$_POST['desdem'];
$horaHasta=$_POST['hastah'];
$minutosHasta=$_POST['hastam'];
$descripcion=$_POST['descripcion'];
$idProfesional = $con->crearProfesional($tip, $run, $nom, $ape, $email, $cla, $com, $tel, $movil, $dir, $dep, $nac, $esp, $estu, $instu, $titu,$activo,$descripcion);
if(isset($_POST['equi'])){
    foreach ($_POST['equi'] as $i => $value){
       $con->guardarEquipamiento($idProfesional,$value);   
    }
}
$con->guardarDisponibilidad($idProfesional, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo, $horaDesde, $minutosDesde, $horaHasta, $minutosHasta);
$con->desconectarBD();
?><script>mensajeRegistro();</script>