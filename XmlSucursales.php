<?php

include './mysql.php';

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

$sucursales = cargarSucursalMarcador();

header("Content-type: text/xml");

echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;

while($auxSucrusal = mysqli_fetch_array($sucursales)){
      echo '<marker ';
  echo 'id="' . $auxSucrusal["C_ID_SUCURSAL"] . '" ';
  echo 'name="' . parseToXML($auxSucrusal["D_NOMBRE_FARMACIA"]." - ".$auxSucrusal["D_NOMBRE_SUCURSAL"]) . '" ';
  echo 'tel="' . parseToXML($auxSucrusal["N_TELEFONO_SUCURSAL"]) . '" ';
  echo 'web="' . parseToXML($auxSucrusal["D_WEB_FARMACIA"]) . '" ';
  echo 'address="' . parseToXML($auxSucrusal["D_DIRECCION_SUCURSAL"].", ".$auxSucrusal["D_NOMBRE_COMUNA"].", ".$auxSucrusal["D_NOMBRE_REGION"]) . '" ';
  echo 'lat="' . $auxSucrusal["N_LATITUD"] . '" ';
  echo 'lng="' . $auxSucrusal["N_LONGITUD"] . '" ';
  echo 'type="Sucursal" ';
  echo '/>';
  $ind = $ind + 1;
}

echo '</markers>';

?>