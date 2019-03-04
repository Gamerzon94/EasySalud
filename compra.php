<script type="text/javascript">function mensajeCompra(){
	alert("Su compra fue exitosa, gracias por usar Easy Salud.");
	window.location.href='index.php';
}</script>
<?php
	include("mysql.php");
        $id = $_POST["id"];
	$plan = $_POST["plan"];
	$usuario = buscarIdProfesional($id);
        while($filas = mysqli_fetch_array($usuario)){
            $idProfesional = $filas['C_ID_PROFESIONAL'];
        }
        premium($idProfesional,$plan,$id);
        
?><script>mensajeCompra();</script>