<?php
	//conexion
	$host="127.0.0.1";
	$user='root';
	$pass='';
	$db='customerscabletv';
	$con=mysqli_connect($host,$user,$pass,$db) or die ('<div class="error">Error al conectar con la base de datos</div>');
?>