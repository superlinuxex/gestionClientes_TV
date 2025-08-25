<?php
	require "dat_base.php"; 
	global $parametros , $conexion ;
	
	$result=mysql_query('show tables');
	while($tables = mysql_fetch_array($result)) {
 		foreach ($tables as $key => $value) {
			/*mysql_query("ALTER TABLE $value COLLATE utf8_general_ci");*/
			mysql_query("ALTER TABLE $value CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;");
	 	}
	 }
	 echo "collation de tablas cambiado a utf8_general_ci y charset de campos a utf8";
 ?>