<?php
include("validacion/class.mysql.php");
include("validacion/class.combos.php");
$selects = new selects();
$estados = $selects->cargarEstados();
foreach($estados as $key=>$value)
{
		echo "<option value=\"$key\">$value</option>";
}
?>