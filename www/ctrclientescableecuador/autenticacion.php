<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Oswald" rel="stylesheet" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Arvo' rel='stylesheet' type='text/css'>
<link href="css/style_Masterforo.css" rel="stylesheet" type="text/css" media="screen" />
<link href="css/style_menuforo.css" rel="stylesheet" type="text/css"  />
<link rel="stylesheet" href="css/style_Tableforo.css" type="text/css" media="screen" title="default" />
<link rel="STYLESHEET" type="text/css" href="css/Style_login.css">

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ErvingSoftware | Sistema de Informacion</title>
        <!-- favicon -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <!-- bootstrap -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- fontawesome -->
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
        <!-- flaticon -->
        <link rel="stylesheet" href="assets/css/flaticon.css">
        <!-- slicknav -->
        <link rel="stylesheet" href="assets/css/slicknav.min.css">
        <!-- magnific popup css -->
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <!-- owl carousel css -->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <!-- stylesheet -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- responsive -->
        <link rel="stylesheet" href="assets/css/responsive.css">
    </head>
    <body>
        <!-- support bar area start -->
        <div class="support-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <a href="index.html" class="logo">
                            <img src="assets/img/logo.png" alt="ERVINGSOFTWARE | CTRCLIENTESCABLE">
                        </a>
                    </div>
                    <div class="col-md-7 col-sm-9 col-xs-12">
                        <div class="support-right">
                            <p>Tienes una Empresa Cableoperadora? Esta Aplicacion en para ti</p>
			    <p>Administracion de Cuentas y Actividades Relacionadas con Clientes de Cableoperadoras</p>
                            <div class="single-support-box">
                                <div class="icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="content">
                                    <a href="mailto:ervingsoft@gmail.com">ervingsoft@gmail.com</a>
                                </div>
                            </div>
		<form name="frmAutenticacion" action="./logica/log_autenticacion.php" method="post" >
			<?php
				$encabezado_msg='<strong><span style="color:#FF0000;position:absolute;left:1px;top:190px;width:500px;">';
				$final_msg='</span></strong></br>';
				if (isset($_GET["emsg"])){
					switch($_GET["emsg"])
					{
						case "err1":
						{
							$msg="Nombre de usuario, por favor";
							echo $encabezado_msg.$msg.$final_msg;
							break;
						}
						
						case "err2":
						{
							$msg="Contraseña, por favor";
							echo $encabezado_msg.$msg.$final_msg;
							break;
						}
						case "err3":
						{
							$msg="Usuario o contraseña invalida ";
							echo $encabezado_msg.$msg.$final_msg;
							break;
						}
						default: $msg="</br></br>";
						echo $msg;
						break;
					}
				}
			?>			
			
			<strong><span style="color:#3badfc;position:absolute;left:32px;top:76px;">Usuario:</span></strong></br>
			
			<input name="txtuser" class="frm_txt" title="Usuario" value="" size="20" maxlength="60" 
			style="position:absolute;left:100px;top:76px;"/>
			</br></br>
			
			<strong><span style="color:#3badfc;position:absolute;left:28px;top:110px;">Su Clave:</span></strong></br>
			
			<input name="txtclave" class="frm_txt" title="contraseña" type="password" value="" size="20" maxlength="60" 
			style="position:absolute;left:100px;top:110px;"/>
			</br></br>
			
			<input name="btnAutenticar" type="submit" class="btn2" value="Aceptar"
			style="position:absolute;left:210px;top:76px;width:100px"/>
		</form>

                    </div>
                </div>
            </div>
        </div>
        <!--end support bar area -->



        <!-- header-area start -->
        <header class="header-area header-area-bg">
            <div class="container" id="home">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1 text-center">
                        <div class="header-inner-content">
                            <h1>CONTROL DE CUENTAS DE CLIENTES DE CABLEOPERADORAS</h1>
<p> CtrClientesCable .... Su mejor opcion para el control de pagos de clientes de cableoperadoras</p>
<p>SOBRE ESTA APLICACION</p>
<p>Esta Aplicacion Web ha sido desarrollada por el Ing.Erving Chamagua y diseñada a la medida de las empresas CABLEOPERADORAS para la gestion administrativa y técnica de cuentas de clientes abonados al servicio de Television por Cable</p> 
<br></br>
<p>DESCRIPCION DEL SISTEMA</p>
<p>Este software esta diseñado para llevar el control de las cuentas de clientes de empresas cableoperadoras, cubriendo los
                                                                 principales procesos de las empresas de este rubro, a saber, registro del cliente, facturacion, soporte tecnico, atencion
                                                                 telefonica al cliente para cobro y solucion de problemas, listado de cobros diarios, moras por pagos pendientes, gastos y otras utilidades que facilitan el trabajo
                                                                 operativo y administrativo.
Una ventaja de esta Aplicacion es su diseño multiempresa, lo que significa que puede administrar varias oficinas de cobro y operaciones de tal forma que los empleados o usuarios que administran los datos de los clientes solo tengan acceso a su cartera de clientes en la zona a la que pertenecen. Sin embargo, los propietarios de la compañia pueden ver cualquier informe del negocio en forma global o parcial segun lo deseen.
Esta aplicacion puede ser instalada en un Servidor Web de la Empresa o en un Servidor VPS adquirido por la empresa. Contactame para detalles sobre la instalacion y configuracion para tu empresa a mi Email:  ervingchamagua@gmail.com<p>


                        </div>
                    </div>
                </div>
            </div>
        </header>



        <!-- footer area start -->
        <footer class="footer-area">
            <div class="footer-inner-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!---<div class="footer-top">
                                <ul id="footer-payment-logo">
                                    <li>
                                        <a href="#"><img src="assets/img/payment/01.jpg" alt="payment logo"></a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="assets/img/payment/02.jpg" alt="payment logo"></a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="assets/img/payment/03.jpg" alt="payment logo"></a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="assets/img/payment/04.jpg" alt="payment logo"></a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="assets/img/payment/01.jpg" alt="payment logo"></a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="assets/img/payment/02.jpg" alt="payment logo"></a>
                                    </li>
                                </ul>
                            </div>-->
                            <div class="footer-bottom">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="widget about">
                                            <div class="widget-body">
                                                <a href="index.html" class="footer-logo">
                                                    <img src="assets/img/footer-logo.png" alt="ErvingSoft | Soluciones Informáticas">
                                                </a>
                                                <p>Somos una iniciativa de Desarrollo de Aplicaciones a la Medida en forma remota, siendo un grupo de profesionales con mas de 20 años de experiencia</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="widget contact">
                                            <div class="widget-title">
                                                <h4>Oficinas</h4>
                                            </div>
                                            <div class="widget-body">
                                                <ul>
                                                    <li>
                                                        <i class="fas fa-home"></i> San Salvador, <br /> El Salvador CA.</li>
                                                </ul>
                                                <ul>
                                                </ul>

                                            </div>
                                        </div>
                                    </div>



                                    <!-- <div class="col-md-4">
                                        <div class="widget subscribe">
                                            <div class="widget-title">
                                                <h4>Suscribete con nosotros</h4>
                                            </div>
                                            <div class="widget-body">
                                                <div class="subscribe-form">
                                                    <form action="index.html" method="POST">
                                                        <input type="email" placeholder="Ingresa tu correo eletrónico....">
                                                        <input type="submit" value="Subscribete">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="copyright-area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            Copyright &copy; Erving Chamagua 2020. Todos los Derechos Reservados.
                        </div>
                    </div>
                </div>
            </div>
        </footer>

 </div>
</body>
</html>