<?php
include './mysql.php';
if(isset($_POST["Pagar"])){
    $idUsu = $_POST["idUsu"];
    $idSucursal = $_POST["idSucursal"];
    $plan = $_POST["plan"];
    premiumSucursal($idUsu,$plan,$idSucursal);
    ?><script>alert("Pago recepcionado, gracias por usar Easy Salud");
    window.location.href = "index.php";</script><?php
}else{
    header("Location:index.php");
}