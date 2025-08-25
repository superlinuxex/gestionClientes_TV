<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<title>Customerscabletv - Mantenimiento de Menus </title>
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Master.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuopti.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_Table.css" type="text/css" media="screen" title="default" />


<script type="text/javascript">
function mostrar_menus(str)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("tabla").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// codigo para IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// codigo para  IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("tabla").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","utils/lista_menus.php?id="+str,true);
  xmlhttp.send();
}
</script>
</head>


 <?php
  error_reporting (5);
  include "./utils/validar_sesion.php";
 ?>

<body>
<!-- Inicio de marco principal -->
<div id="wrapper">

	<!-- Inicio de encabezado -->
	<div id="header-wrapper">
		<div id="header">
			<div id="logo" align="center">
				<img src="imagenes/linea1opti.png" alt="logo"  border="0" align="texttop" />
			</div>
		</div>
	</div>
	<!-- Fin de encabezado -->
	
  	<!-- Inicio de menu -->
	<div id="menu">
		<div id="menu-wrapper">
			<ul class="hmenu">
				<?php
					include("./utils/crear_menu.php");
				?>	
		  </ul>
		</div>
	</div>
	<!-- Fin del menu -->
	
   	<!-- Inicio del contenido -->
	<div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="page-content">
					<div id="content">
						<div class="post">
							<h3 class="title">Asignación de Opciones del Menú a Perfiles</a></h3>
							<div class="entry">
								<div id="itsthetable">
                                	<?php
										require_once("./logica/log_perfiles.php");
										require_once("./logica/log_menus.php");
										echo '<form method="POST" id="id-form" action="'.$_SERVER["PHP_SELF"].'" >';
										echo '
										<table style="border:hidden; padding:0px 0px 0px 0px; border-style:hidden; outline-style:hidden"; cellpadding="0"; cellspacing="0"; border="0;" align="center" >
										<tr>
										<td>Seleccione el Perfil al cual desea asignarle opciones: 
										<select name="perfiles" class="frm_cmb" onchange="mostrar_menus(this.value)"/>
										<option>Seleccione un perfil...</option>';										
										$resultado=log_obtener_perfiles_cmb();
										while ( $fila = mysql_fetch_array($resultado))
										{
											echo "<option value='".$fila['Codigo']."'> ".$fila['Nombre']."</option>";
										}
										echo'</td>
										</tr>
										</table>
										<div id="tabla" style="width=40%"></div>
										</form>';
										if (isset ($_POST['aceptar']))
										{
											log_eliminar_opciones_menu($_POST['perfiles']);
											foreach($_POST['chk'] as $iId) 
											{
												$resultado=log_insertar_opciones_menu($_POST['perfiles'],$iId);
											}
											
										}
                                    ?>

                              </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin del contenido -->
	
	<!-- Inicio del Pie de Pagina -->
	<div id="footer">
		<p>Todos los derechos reservados</p>
	</div>
	<!-- Fin del Pie de Pagina -->
</div>
<!-- Fin de marco principal -->

</body>
</html>
