<script type="text/javascript">function mensajeRegistro(){
	alert("Atención solicitada con exito.");
	window.location.href='index.php';
}</script>
<?php
include("mysql.php");
$idPaciente = 0;
if(isset($_POST['paciente'])){
    if($_POST['paciente']=="si"){
        if($_POST['idPaciente']==0){
            $idPaciente = 0;
        }else{
            $idPaciente = $_POST['idPaciente'];
        }
    }else{
        $idPaciente = 0;
    }
}else{
    $idPaciente = 0;
}
$horaDesde=$_POST['desdeh'];
$minutosDesde=$_POST['desdem'];
$anotaciones=$_POST['anotaciones'];
$fecha=$_POST['fecha'];
$idUsuario=$_POST['idUsu'];
$idProfe=$_POST['idProfe'];
crearAtencion($idUsuario, $idProfe, $fecha, $horaDesde, $minutosDesde, $anotaciones,$idPaciente);
?><script>mensajeRegistro();</script>