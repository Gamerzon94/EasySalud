<?php
require '../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

ob_start();
if(isset($_GET["todos"])){
    require_once 'todos.php';
    $html = ob_get_clean();

$html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
$html2pdf->writeHTML($html);
$html2pdf->output();
}else if(isset($_GET["pen"])){
    require_once 'pendientes.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["rech"])){
    require_once 'rechazadas.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["fi"])){
    require_once 'finalizadas.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["can"])){
    require_once 'canceladas.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["usu"])){
    require_once 'usu.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["premium"])){
    require_once 'premium.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["pendiente"])){
    require_once 'pendiente.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["activos"])){
    require_once 'activos.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["suspendidos"])){
    require_once 'suspendidos.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["elim"])){
    require_once 'elim.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["prof"])){
    require_once 'profesionales.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["profPremium"])){
    require_once 'profesionalesSi.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["farmaciasTodas"])){
    require_once 'elim.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["farmaciasActivas"])){
    require_once 'elim.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset($_GET["noPremium"])){
    require_once 'profesionalesNo.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('L','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else if(isset ($_GET["boleta"])){
    $id = $_GET["boleta"];
    require_once 'boleta.php';
    $html = ob_get_clean();
    $html2pdf = new Html2Pdf('P','A4','es','true','UTF-8');
    $html2pdf->writeHTML($html);
    $html2pdf->output();
}else{
    header("Location:index.php");
}

?>