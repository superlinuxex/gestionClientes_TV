<?php
function Validar_Decimales($numero)
{
	$expresion_regular = "/^([+-]{1})?[0-9]+(\.[0-9]+)?$/";
	
	return preg_match($expresion_regular, $numero);
}

function Validar_Decimales_Positivos($numero)
{
	$expresion_regular = "/^([+]{1})?[0-9]+(\.[0-9]+)?$/";
	
	return preg_match($expresion_regular, $numero);
}
?>