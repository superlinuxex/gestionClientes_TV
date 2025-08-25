<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ERVING-SOFTWARE - Autentication</title>
<link rel="STYLESHEET" type="text/css" href="css/Style_login.css">
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />


<style type="text/css">
#fondo
{
   background-image: url(imagenes/linea1optimpp.png);
   background-repeat: no-repeat;
   /*background-position: center center;*/
}
</style>
</head>
<body>
   
	<div id="fondo" style="position:absolute;left:10%;top:0px:0px;width:800px;height:100%;z-index:0;">
		<form name="frmAutenticacion" action="./logica/log_autenticacionmpp.php" method="post" >
			<?php
				$encabezado_msg='<strong><span style="color:#FF0000;position:absolute;left:860px;top:380px;width:800px;">';
				$final_msg='</span></strong></br>';
				if (isset($_GET["emsg"])){
					switch($_GET["emsg"])
					{
						case "err1":
						{
							$msg="User error";
							echo $encabezado_msg.$msg.$final_msg;
							break;
						}
						
						case "err2":
						{
							$msg="Password error";
							echo $encabezado_msg.$msg.$final_msg;
							break;
						}
						case "err3":
						{
							$msg="User or Password no found";
							echo $encabezado_msg.$msg.$final_msg;
							break;
						}
						default: $msg="</br></br>";
						echo $msg;
						break;
					}
				}
			?>			
			
			<strong><span style="color:#FFF;position:absolute;left:850px;top:150px;">User:</span></strong></br>
			
			<input name="txtuser" class="Textbox" title="User" value="" size="20" maxlength="128" 
			style="position:absolute;left:850px;top:170px;"/>
			</br></br>
			
			<strong><span style="color:#FFF;position:absolute;left:850px;top:210px;">Password:</span></strong></br>
			
			<input name="txtclave" class="Textbox" title="Password" type="password" value="" size="20" maxlength="128" 
			style="position:absolute;left:850px;top:230px;"/>
			</br></br>
			
			<input name="btnAutenticar" type="submit" class="btn2" value="Submit"
			style="position:absolute;left:860px;top:280px;"/>
		</form>
							<div class="entry">
							<br></br><br></br><br></br>

							<strong>ERVING-SOFTWARE</strong>
							<div class="entry">
								        Control System for Work Orders</br>
								
							</div>
							<br></br>

							<strong>SYSTEM DESCRIPTION</strong>
							<div class="entry">
							This software is designed to bring the maintenance schedule indicating dates, materials used, hours of execution of tasks 
							they will be made on maintenance. It will also be possible to record the result of the work done with relevant comments.
							</div>
							<br></br>



							<strong>DESIGN AND DEVELOPMENT</strong>
							<div class="entry">
								Erving Chamagua</br>
							</div>
							<br></br>

							</div>


	</div>
</body>
</html>