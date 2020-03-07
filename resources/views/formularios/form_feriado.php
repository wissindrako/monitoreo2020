<?php
function pascua ($anno){
# Constantes mágicas
    $M = 24;
    $N = 5;
#Cálculo de residuos
    $a = $anno % 19;
    $b = $anno % 4;
    $c = $anno % 7;
    $d = (19*$a + $M) % 30;
    $e = (2*$b+4*$c+6*$d + $N) % 7;
# Decidir entre los 2 casos:
    if ( $d + $e < 10 ) {
        $dia = $d + $e + 22;
        $mes = 3; // marzo
        }
    else {
        $dia = $d + $e - 9;
        $mes = 4; //abril
        }
# Excepciones especiales (según artículo)
    if ( $dia == 26  and $mes == 4 ) { // 4 = abril
        $dia = 19;
        }
    if ( $dia == 25 and $mes == 4 and $d==28 and $e == 6 and $a >10 ) { // 4 = abril
        $dia = 18;
        }
    $ret = $dia.'-'.$mes.'-'.$anno;
	return ($ret);
}

function mesespanol($m){
	$m=intval($m);
	$meses="No Especificado,Enero,Febrero,Marzo,Abril,Mayo,Junio,Julio,Agosto,Septiembre,Octubre,Noviembre,Diciembre";
	$mes=explode(",",$meses);
	$mesespan=$mes[$m];
return $mesespan;
}
function diaespanol($d){
	$d=intval($d);
	$dias="No Especificado,Lunes,Martes,Miercoles,Jueves,Viernes,Sabado,Domingo";
	$dia=explode(",",$dias);
	$diasspan=$dia[$d];
return $diasspan;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Calcular Semana Santa | Pascua | PHP</title>
</head>

<body>
<center>
<h1>Calcular Pascua:</h1>
<!-- <form action="index.php" name="forma" method="post">
<font face="Arial, Helvetica, sans-serif" size="2">
Año: <input type="text" name="anno" size="5" maxlength="4" >
<input type="submit" name="Go!" value="Calcular!">
</font>
</form>
</center> -->
<?php
#ejecutarlo pasando el año como parámetro.
// if (isset($_POST['anno'])) {
    if(1){
	// $fecha = explode('-',pascua($_POST['anno']));
	$fecha = explode('-',pascua(2019));
?><br />
<div align=center><font face=arial>
La pascua (domingo de resurrección) 
en el año introducido es el: 
<strong><?php echo $fecha[0]; ?> de <?php echo mesespanol($fecha[1]); ?> de <?php echo $fecha[2]; ?></strong><br /><br />
<br />
<table width="400" cellspacing="0" cellpadding="0" style="margin:0px auto;">
        <tr>
          <td colspan="3" align="center"><strong>Fechas especiales:</strong></td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr bgcolor="#CCCCCC">
          <td align="left"><strong><font face="arial">Celebracion</font></strong></td>
          <td align="center"><strong>Dia</strong></td>
          <td align="center"><strong>Fecha</strong></td>
        </tr>
        <tr>
          <td align="left"><strong>Domingo de Pascua</strong></td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0],$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0],$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left">Mi&eacute;rcoles    de ceniza</td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]-46,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]-46,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left">Domingo de Ramos</td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]-7,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]-7,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left"><strong>Jueves Santo</strong></td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]-3,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]-3,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left"><strong>Viernes Santo</strong></td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]-2,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]-2,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left">Ascensi&oacute;n</td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]+39,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]+39,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left">Pentecost&eacute;s</td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]+49,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]+49,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left">Sant&iacute;sima Trinidad</td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]+56,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]+56,$fecha[2])); ?></td>
        </tr>
        <tr>
          <td align="left">Corpus Christi</td>
          <td align="center"><?php echo diaespanol(date("N", mktime(0,0,0,$fecha[1],$fecha[0]+60,$fecha[2]))); ?></td>
          <td align="center"><?php echo date("d/m/Y", mktime(0,0,0,$fecha[1],$fecha[0]+60,$fecha[2])); ?></td>
        </tr>
</table>
<br />
</font></div>
<?php }?>
</div>
</body>
</html>