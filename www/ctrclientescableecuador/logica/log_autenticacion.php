<?php
//importando clase superiores
require_once './datos/dat_autenticacion.php';
//Validando datos ingresado 
$mensaje="";
if(trim($_POST["txtuser"])==""){
	header("Location: ../autenticacion.php?emsg=err1");
}
else{
	if(trim($_POST["txtclave"])=="")
	{
		header("Location: ../autenticacion.php?emsg=err2");
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
			 $_SESSION['cant_reg_pag']=45;
			 $_SESSION['nombre_bodega']=$resultado["nombre_bodega"];
		
                        $resultado2 = contador_usuario(trim($_POST["txtuser"]),sha1(trim($_POST["txtclave"])));
                        if($resultado["clave"]=="40bd001563085fc35165329ea1ff5c5ecbdbbeef")
               		{
 	                 header ("Location: ../cambiar_claveinicial.php");
			}
                        else
               		{
	                 header ("Location: ../index.php");
			}
		}
		else
		{
			header("Location: ../autenticacion.php?emsg=err3");
		}
	}
}
?>
