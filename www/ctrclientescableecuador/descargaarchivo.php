<?php

$archivo = '/descargassiccae/'.$_GET['archivo'];

//PARA LA WEB
//$archivo = '//home1/franconi/public_html/siccae/archivos/'.$_GET['archivo'];
$downloadfilename=null;
if (file_exists($archivo)) {
        $downloadfilename = $downloadfilename !== null ? $downloadfilename : basename($archivo);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $downloadfilename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($archivo));

        ob_clean();
        flush();
        readfile($archivo);
        exit;
    }


?>

