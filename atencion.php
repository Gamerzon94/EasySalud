<script type="text/javascript">function aceptar(){
	alert("La solicitud fue aceptada con exito.");
	window.location.href='solicitudes.php';
}

function cancelar(){
	alert("La solicitud fue cancelada con exito.");
	window.location.href='solicitudes.php';
}

function rechazar(){
	alert("La solicitud fue rechazada con exito.");
	window.location.href='solicitudes.php';
}

function confirmar(){
	alert("La solicitud fue confirmada con exito.");
	window.location.href='solicitudes.php';
}

function finalizar(){
	alert("La solicitud fue finalizada con exito.");
	window.location.href='solicitudes.php';
}

function error(){
	alert("Ingreso incorrecto.");
	window.location.href='solicitudes.php';
}</script>
<?php
include("mysql.php");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    if(isset($_GET['accion'])){
        $accion = $_GET['accion'];
        if($accion == 1){
            actualizarAtencion('3',$id);
            ?> <script>confirmar();</script> <?php
        }else if($accion == 2){
            actualizarAtencion('5',$id);
            ?> <script>cancelar();</script> <?php
        }else if($accion == 3){
            actualizarAtencion('2',$id);
            ?> <script>aceptar();</script> <?php
        }else if($accion == 4){
            actualizarAtencion('4',$id);
            ?> <script>finalizar();</script> <?php
        }else if($accion == 5){
            actualizarAtencion('6',$id);
            ?> <script>rechazar();</script> <?php
        }
    }else{
    ?> <script>error();</script> <?php
    }
}else{
    ?> <script>error();</script> <?php
}
?><script>mensajeExito();</script>