<?
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include("conectar.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Unidad de Informática - Sistema de Control de Archivo - SCA</title>

<!-- Inicio: CSS colores principales -->
<link rel="stylesheet" type="text/css" href="/archivo/css/colores.css">
<!-- EOF: FIN CSS colores principales -->

<!-- calendario con fecha y hora -->
 <script type="text/javascript" src="/archivo/js/calendar2/datetimepicker.js"></script>

<!-- generar combos -->
<script language="JavaScript" src="/archivo/js/combos/combos.js">
</script>


<!-- Validar campos de myform -->
<script>
function valida_envia(){
        //validar Tipo de Documento
        if (document.myform.tipodoc.selectedIndex==0){
               alert("Debe seleccionar El Tipo de Correspondencia Recibida.")
               document.myform.tipodoc.focus()
               return 0;
        }

        //validar Número de Referencia del Documento
        if (document.myform.referencia.value.length==0){
               alert("Debe escribir Número de Referencia")
               document.myform.referencia.focus()
               return 0;
        }

        //validar listBox Nivel al que pertenece el Establecimiento
        if (document.myform.CmbNivel.selectedIndex==0){
               alert("Debe seleccionar el Nivel de donde proviene la correspondencia.")
               document.myform.CmbNivel.focus()
               return 0;
        }

		//validar listBox Tipo de Establecimiento
        if (document.myform.Cmbtipoestable.selectedIndex==0){
               alert("Debe seleccionar el Tipo de Establecimiento.")
               document.myform.Cmbtipoestable.focus()
               return 0;
        }

		//validar listBox Nombre del Establecimiento
        if (document.myform.Cmbestablecimientos.selectedIndex==0){
               alert("Debe seleccionar el Nombre del Establecimiento.")
               document.myform.Cmbestablecimientos.focus()
               return 0;
        }

		//validar listBox Nombre de la Dependencia
        if (document.myform.Cmbdependencias.selectedIndex==0){
               alert("Debe seleccionar el Nombre de la Dependencia.")
               document.myform.Cmbdependencias.focus()
               return 0;
        }


         //validar Nombre de la persona que envía la correspondencia
        if (document.myform.Nombre.value.length==0){
               alert("Debe escribir el Nombre de la Persona que envía la correspondencia")
               document.myform.Nombre.focus()
               return 0;
        }


         //validar el Cargo de la persona que envía la correspondencia
        if (document.myform.cargo.value.length==0){
               alert("Debe escribir el Cargo de la Persona que envía la correspondencia")
               document.myform.cargo.focus()
               return 0;
        }


        //validar la Fecha de elaboración de la correspondencia
        if (document.myform.demo1.value.length==0){
               alert("Debe especificar la fecha de elaboración de la Correspondencia Recibida")
               document.myform.demo1.focus()
               return 0;
        }


         //validar la Fecha y hora de recepción de la correspondencia
        if (document.myform.demo3.value.length==0){
               alert("Debe especificar la fecha y hora de recepción de la Correspondencia")
               document.myform.demo3.focus()
               return 0;
        }




        //validar el Asunto de la correspondencia
        if (document.myform.asunto.value.length==0){
               alert("Debe especificar el Asunto de la Correspondencia Recibida")
               document.myform.asunto.focus()
               return 0;
        }


        //validar lisBox prioridad la correspondencia
        if (document.myform.prioridad.selectedIndex==0){
               alert("Debe Establecer la Prioridad de Respuesta para la Correspondencia Recibida")
               document.myform.prioridad.focus()
               return 0;
        }


   //validar el Asunto de la correspondencia
        if (document.myform.resumen.value.length==0){
               alert("Debe Escribir el Resumen de la Correspondencia Recibida")
               document.myform.resumen.focus()
               return 0;
        }


     	//validar listBox Status de Correspondencia
        if (document.myform.status.selectedIndex==0){
               alert("Debe seleccionar el Status de la Correspondencia.")
               document.myform.status.focus()
               return 0;
        }


        //el formulario se envia

        document.myform.submit();
}
</script>


</head>
<body>

<center>
<h2>Control de Archivo - Unidad de Informática</h2>
<form id="myform" name="myform" autocomplete="off" action="confirma.php" method="POST" enctype="multipart/form-data">
<table class="tablaprinc">
<tr>
<td class="td2">Tipo de Documento:</td>
<td>
<select name="tipodoc" size="1" tabindex="1">
<option value="0" name="tipo" id="tipo" selected="selected">Seleccione</option>
<option value="1">Oficio</option>
<option value="2">Memorandum</option>
</select>
</td>
</tr>
<tr>
<td class="td2">Número de Referencia:</td><td><input name="referencia" id="referencia" size="16" maxlength="15" tabindex="2">
</td>
</tr>
<!--- combo nivel a seleccionar -->
<tr>
<td class='td2'>Nivel:</td>
<td>
<!-- Combo Niveles -->

<select name="CmbNivel" id="empresa" onChange="componer_subniveles(this.value)">
<option value="0">Seleccione...</option>
<?
if(mysql_fetch_row($rs)>0){
while($fila=mysql_fetch_row($rs)) {
?>
<option value="<? echo $fila[0];?>"><? echo $fila[1];?></option>
<?
}
}
?>
</select>


</td>
</tr>




<!-- Combo Tipos de Establecimientos -->
<tr>
<td class='td2'>Tipo de Establecimiento: </td>
<td>
<div id="Div_tipoestable">
<select name="Cmbtipoestable"  id="Cmbtipoestable" class="select" tabindex="1" tabindex="4" disabled="disabled">
<option value="0">Seleccione...</option>
</select>
</div>
</td>
</tr>

<!-- Combo Establecimientos -->
<tr>
<td class='td2'>Nombre del Establecimiento: </td>
<td>
<div id="Div_Establecimientos">
<select name="Cmbestablecimientos"  id="Cmbestablecimientos" class="select" tabindex="2" tabindex="5" disabled="disabled">
<option value="0">Seleccione...</option>
</select>
</div>
</td>
</tr>
<!-- Combo Dependencias -->
<tr>
<td class='td2'>Procedencia: </td>
<td>
<div id="Div_Dependencias">
<select name="Cmbdependencias"  id="Cmbdependencias" class="select" tabindex="6" disabled="disabled">
<option value="0">Seleccione...</option>
</select>
</div>
</td>
</tr>
<tr>
<td class='td2'>Nombre: </td>
<td>
<input name="Nombre" id="Nombre" size="61" maxlength="60" tabindex="7">
</td>
</tr>
<tr>
<td class='td2'>Cargo: </td>
<td>
<input name="cargo" size="61" maxlength="60" tabindex="8">
</td>
</tr>
<tr>
<td class='td2'>Fecha de Elaboración: </td>
 <td>
<input name="demo1" id="demo1" type="text" size="16"><a href="javascript:NewCal('demo1','yyyymmdd')"><img src="/archivo/imagenes/cal.gif" width="16" height="16" border="0" alt="Escoja Fecha"></a>
</td>
</tr>
<tr>
<td class='td2'>Fecha y Hora de Recibido: </td>
<td><input name="demo3" id="demo3" type="text" size="16"><a href="javascript:NewCal('demo3','yyyymmdd',true,24)"><img src="/archivo/imagenes/cal.gif" width="16" height="16" border="0" alt="Escoja Fecha"></a></td>
</tr>
<tr>
<td class='td2'>Asunto: </td>
<td>
<input name="asunto" size="81" maxlength="80" tabindex="11" id="asunto">
</td>
</tr>

<tr>
<td class='td2'>Temática: </td>
<td>
<select name="temas" size="1" tabindex="12" id="temas">
<option value="0" selected="selected">Seleccione...</option>

</select>
</td>
</tr>






<tr>
<td class='td2'>Prioridad de respuesta: </td>
<td>
<select name="prioridad" size="1" tabindex="12" id="prioridad">
<option value="0" selected="selected">Seleccione...</option>
<option value="1">Normal</option>
<option value="2">Urgente</option>
</select>
</td>
</tr>
<tr>
<td class='td2'>Resumen de Correspondencia: </td>
<td>
<textarea name="resumen" rows="4" cols="61" tabindex="13"></textarea>
</td>
</tr>
<tr>
<td class='td2'>Estatus de Correspondencia: </td>
<td class="td1">
<select name="status" size="1" tabindex="14">
<option value="0" selected="selected">Seleccione...</option>
<option value="1">Pendiente</option>
<option value="1">Informativa</option>
</select>
</td>
</tr>
<tr>
<td class="td2">Adjuntar Archivo</td><td class="td1">

<input type="hidden" name="MAX_FILE_SIZE" />
Elija Archivo a Adjuntar: <input name="uploadedfile" type="file" /><br />

</td>
</tr>
<tr><td class='td3' colspan="2"><input type="button" value="Guardar" name="btnguardar"  onclick="valida_envia()" id="btnguardar"><input type="reset" name="btncancelar" value="Cancelar"></td>
</tr>
</table>
</form>
 </center>
</body>
</html>