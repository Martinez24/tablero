<?php
include("validacion/class.mysql.php");
include("validacion/class.combos.php");
$personal = new selects();
$personal->code = $_GET["code"];
$personal = $personal->cargarPersonal();
foreach($personal as $key=>$value)
{
		echo "<option value=\"$key\">$value</option>";
}
?>