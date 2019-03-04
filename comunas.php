<?php
include("config.php");
include("mysql.php");
$html = '';
$id_category = $_POST['id_category'];
$comuna = buscarComuna($id_category);
if ($comuna->num_rows > 0) {
    while ($auxComuna = mysqli_fetch_array($comuna)) {                
        $html .= '<option value="'.$auxComuna['C_ID_COMUNA'].'">'.$auxComuna['D_NOMBRE_COMUNA'].'</option>';
    }
}
echo $html;
?>