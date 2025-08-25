<?php
//importando clase superiores
require_once './datos/dat_autenticacion.php';
//Validando datos ingresado 
$mensaje="";
if(trim($_POST["txtuser"])==""){
	header("Location: ../principal.php?emsg=err1");
}
else{
	if(trim($_POST["txtclave"])=="")
	{
		header("Location: ../principal.php?emsg=err2");
	}
	else
	{
		//validadndo datos contra DB
		$resultado = Validar_Usuario(trim($_POST["txtuser"]),sha1(trim($_POST["txtclave"])));
		if ($resultado!="")
		{
			 session_start(); 
			 $_SESSION["autenticado"]= "TRUE";
			 $_SESSION["idBodega"]=$resultado["idbodega"];
			 $_SESSION["perfil"]=$resultado["idperfiles"];
			 $_SESSION["idusuarios"]=$resultado["idusuarios"];
			 $_SESSION["nombre_usuario"]=$resultado["nombre"];
			 $_SESSION['cant_reg_pag']=100;
			 $_SESSION['nombre_bodega']=$resultado["nombre_bodega"];
		
                        $resultado2 = contador_usuario(trim($_POST["txtuser"]),sha1(trim($_POST["txtclave"])));
                        if($resultado["clave"]=="40bd001563085fc35165329ea1ff5c5ecbdbbeef")
               		{
 	                 header ("Location: ../cambiar_claveinicialmpp.php");
			}
                        else
               		{
	                 header ("Location: ../indexmpp.php");
			}
		}
		else
		{
			header("Location: ../principal.php?emsg=err3");
		}
	}
}
?>
