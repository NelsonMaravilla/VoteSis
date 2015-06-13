<?php
include("../config/conexion.php");
$ano_v = date("Y");
$id_sel = $_GET["d"];
$cod_candidato = $_GET["i"];
$can_sel = $_GET["c"];

	$persona_voto = "SELECT * FROM persona WHERE id='$id_sel'";
	$resul_pvo = mysql_query($persona_voto);
	$noexiste = mysql_num_rows($resul_pvo);
	
		for($pvo = 0; $pvo < mysql_num_rows($resul_pvo); $pvo++)
		{
			$dui_pers = mysql_result($resul_pvo,$pvo,'DUI');
		}
	$quitar_eqd = "DELETE FROM voto_persona WHERE dui='$dui_pers' AND tipo_candidatura='$can_sel' AND ano='$ano_v'";
	$okq = mysql_query($quitar_eqd);
	
		$query_su = "SELECT voto FROM candidato WHERE id_candidato='$cod_candidato'";
		$ok_query_su = mysql_query($query_su);
		
		for($upc = 0; $upc < mysql_num_rows($ok_query_su); $upc++)
			{
				$vt = mysql_result($ok_query_su,$upc,'voto');
				$voto_ok = $vt - 1;
					$sql2="UPDATE candidato SET voto='$voto_ok' WHERE id_candidato='$cod_candidato'";
					$exe2=mysql_query($sql2);
			}
	?>
	<script language="javascript">document.votoalcalde.tvotoa.value="0";</script>