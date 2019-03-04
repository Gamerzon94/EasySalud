<script type="text/javascript">function mensajeExito(){
	alert("Se a cambiado el estado correctamente.");
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
    $actividad = verActividad($id);
    while($filas = mysqli_fetch_array($actividad)){
         if($filas['L_ACTIVO']==TRUE){
             cambiarActividad($id, FALSE);
             ?> <script>mensajeExito();</script> <?php
         }else{
             cambiarActividad($id, TRUE);
             ?> <script>mensajeExito();</script> <?php
         }
    }
}else{
    ?> <script>error();</script> <?php
}
?><script>mensajeExito();</script>