<?php
	//partidos
	$sqlpar = "SELECT * FROM partido WHERE id_partido='$partido'";
	$exepar = mysql_query($sqlpar);
	for($ipa = 0; $ipa<mysql_num_rows($exepar);$ipa++)
	{
		$siglas_par=mysql_result($exepar,$ipa,'iniciales_p');
	}
	//depto
	$sqlalu = "SELECT * FROM departamentos WHERE codigo='$depto'";
	$exedip = mysql_query($sqlalu);
	for($ie = 0; $ie<mysql_num_rows($exedip);$ie++)
	{
		$num_dipu=mysql_result($exedip,$ie,'can_diputados');
	}
?>