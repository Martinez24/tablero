<?php
include("validacion/class.mysql.php");
include("validacion/class.combos.php");
$selects = new selects();
$departamentos = $selects->cargarDepartamentos();
foreach($departamentos as $key=>$value)
{
		echo "<option value=\"$key\">$value</option>";
}
?>