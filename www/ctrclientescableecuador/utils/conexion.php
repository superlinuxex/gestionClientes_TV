<?php
function conectar()
{
	mysql_connect("localhost", "root", "mspasweb");
	mysql_select_db("scc");
}

function desconectar()
{
	mysql_close();
}
?>