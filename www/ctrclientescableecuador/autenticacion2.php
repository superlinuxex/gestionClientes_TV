<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CABLEOPERADORA - Autenticación</title>
<link rel="STYLESHEET" type="text/css" href="css/Style_login.css">
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />


<style type="text/css">
#fondo
{
   background-image: url(imagenes/linea1opti.png);
   background-repeat: no-repeat;
   /*background-position: center center;*/
}
</style>
</head>
<body>
   
	<div id="fondo" style="position:absolute;left:10%;top:0px:0px;width:800px;height:100%;z-index:0;">
		<form name="frmAutenticacion" action="./logica/log_autenticacion.php" method="post" >
			<?php
				$encabezado_msg='<strong><span style="color:#FF0000;position:absolute;left:600px;top:120px;width:800px;">';
				$final_msg='</span></strong></br>';
				if (isset($_GET["emsg"])){
					switch($_GET["emsg"])
					{
						case "err1":
						{
							$msg="Debe ingresar un nombre de usuario";
							echo $encabezado_msg.$msg.$final_msg;
							break;
						}
						
						case "err2":
						{
							$msg="Debe ingresar la contraseña de usuario";
							echo $encabezado_msg.$msg.$final_msg;
							break;
						}
						case "err3":
						{
							$msg="El usuario o contraseña ingresado no es valido";
							echo $encabezado_msg.$msg.$final_msg;
							break;
						}
						default: $msg="</br></br>";
						echo $msg;
						break;
					}
				}
			?>			
			
			<strong><span style="color:#FFF;position:absolute;left:710px;top:15px;">Usuario:</span></strong></br>
			
			<input name="txtuser" class="frm_txt" title="usuario" value="" size="20" maxlength="60" 
			style="position:absolute;left:770px;top:13px;"/>
			</br></br>
			
			<strong><span style="color:#FFF;position:absolute;left:725px;top:37px;">Clave:</span></strong></br>
			
			<input name="txtclave" class="frm_txt" title="contraseña" type="password" value="" size="20" maxlength="60" 
			style="position:absolute;left:770px;top:35px;"/>
			</br></br>
			
			<input name="btnAutenticar" type="submit" class="btn2" value="Submit"
			style="position:absolute;left:700px;top:65px;"/>
		</form>
							<div class="entry">
							<br></br><br></br>

							<strong>SOBRE ESTA APLICACION</strong>
							<div class="entry">
 Esta Aplicacion Web ha sido desarrollada por el Ing.Erving Chamagua y diseñada a la medida de las empresas CABLEOPERADORAS para la gestion administrativa y técnica de cuentas de clientes abonados al servicio de Television por Cable. 
</br>
								
							</div>
							<br></br>

							<strong>DESCRIPCION DEL SISTEMA</strong>
							<div class="entry">
								 Este software esta diseñado para llevar el control de las cuentas de clientes de empresas cableoperadoras, cubriendo los
                                                                 principales procesos de las empresas de este rubro, a saber, registro del cliente, facturacion, soporte tecnico, atencion
                                                                 telefonica al cliente para cobro y solucion de problemas, listado de cobros diarios, moras por pagos pendientes, gastos y otras utilidades que facilitan el trabajo
                                                                 operativo y administrativo.
Una ventaja de esta Aplicacion es su diseño multiempresa, lo que significa que puede administrar varias oficinas de cobro y operaciones de tal forma que los empleados o usuarios que administran los datos de los clientes solo tengan acceso a su cartera de clientes en la zona a la que pertenecen. Sin embargo, los propietarios de la compañia pueden ver cualquier informe del negocio en forma global o parcial segun lo deseen.
Esta aplicacion no se vende, debera pagarse una cuota mensual por su uso, funciona en la nube de tal forma que las compañias cableoperadoras pueden usarla con solo tener acceso al Internet. </br>
							</div>
							<br></br>



							<strong>DATOS DE ACCESO, VIDEOS EXPLICATIVOS Y COSTO POR USAR LA APLICACION</strong>
							<div class="entry">
								Escribeme a ervingchamagua@gmail.com</br>
							</div>
							<br></br>

							</div>


	</div>



</body>
</html>