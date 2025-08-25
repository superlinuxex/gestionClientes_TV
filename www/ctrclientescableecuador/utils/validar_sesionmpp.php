<?php
	session_start();
	if (!(isset($_SESSION['autenticado']) && $_SESSION['autenticado'] != '')) {
	 echo'<div style="background:url(imagenes/msg_green.png) no-repeat; padding:10px 10px 10px 10px; Color:#6da827;">
	 ERROR, INGRESE A LA APLICACION CON LA URL CORRECTA.
	 </div>';
	 exit;
		header ("Location:./customerscabletv/autenticacionmpp.php");
	}
	else
	{
		echo'<strong><span style="color:#000000;font-size:10px;position:absolute;left:175px;top:110px;">
		 En sesion: <u>'.$_SESSION['nombre_usuario'].'</u> &nbsp;&nbsp; &nbsp;&nbsp;
		 Ubicacion: <u>'.$_SESSION['nombre_bodega'].'</u></span></strong>';
	}
?>