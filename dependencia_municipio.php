<?php
include("validacion/class.mysql.php");
include("validacion/class.combos.php");
$municipios = new selects();
$municipios->code = $_GET["code"];
$municipios = $municipios->cargarMunicipios();
foreach($municipios as $key=>$value)
{
		echo "<option value=\"$key\">$value</option>";
}
?>