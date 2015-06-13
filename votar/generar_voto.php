<?php
include("../config/conexion.php");

$ano_v = date("Y");
$partido_sel = $_GET["p"];
$cod_candidato = $_GET["i"];
$id_sel = $_GET["d"];
$can_sel = $_GET["c"];
	
	$persona_voto = "SELECT * FROM persona WHERE id='$id_sel'";
	$resul_pvo = mysql_query($persona_voto);
		for($pvo = 0; $pvo < mysql_num_rows($resul_pvo); $pvo++)
		{
			$dui_pers = mysql_result($resul_pvo,$pvo,'DUI');
		}
		
		//funciones
			function concultar($du,$cs,$av,$iid,$ic)
			{
				
				$querys = "SELECT * FROM voto_persona WHERE dui='$du' AND tipo_candidatura='$cs' AND ano='$av'";
				$ok_querys = mysql_query($querys);
				$cvotos = mysql_num_rows($ok_querys);
				for($ins = 0; $ins < mysql_num_rows($ok_querys); $ins++)
					{
					$dp = mysql_result($ok_querys,$ins,'dui');
					$ip = mysql_result($ok_querys,$ins,'id_partido');
					$tc = mysql_result($ok_querys,$ins,'tipo_candidatura');
					$iv = mysql_result($ok_querys,$ins,'id_voto');
					
						$inicialesp = "SELECT iniciales_p FROM partido WHERE id_partido='$ip'" ;
						$inicial_partido = mysql_query($inicialesp);
							for($pp=0;$pp<mysql_num_rows($inicial_partido);$pp++)
									{
										$partido_iniciales = mysql_result($inicial_partido,$pp,'iniciales_p');
									}
					
					echo"<div class='table-responsive'>
						<table class='table table-bordered'>
							<tr><td align='center'>$partido_iniciales</td><td align='center'><a class='btn btn-danger' onclick='quitar(".$iid.",".$cs.",".$ic.")'><span class='glyphicon glyphicon-print'></span> Quitar</a></td><td align='center'><button type='submit' class='btn btn-primary' name='votar_alcalde'><span class='glyphicon glyphicon-floppy-disk'></span> VOTAR</button></td><tr>
						</table>
					</div>";
					}	
			}
			function guardar($d,$p,$c,$a,$i)
			{
				$query_s = "SELECT * FROM voto_persona WHERE dui='$d' AND tipo_candidatura='$c' AND ano='$a'";
				$ok_query_s = mysql_query($query_s);
				$cvoto_s = mysql_num_rows($ok_query_s);
				if($cvoto_s != 0)
				{
				echo"<script language = 'JavaScript'> alert('SOLO PUEDE ELEGIR UN PARTIDO'); </script>";
				}
				else
				{
					$query = "INSERT INTO voto_persona(dui,id_partido,tipo_candidatura,ano) VALUES ('$d','$p','$c','$a')";
					$resultp= mysql_query($query);
					
						$query_su = "SELECT voto FROM candidato WHERE id_candidato='$i'";
						$ok_query_su = mysql_query($query_su);
							for($upc = 0; $upc < mysql_num_rows($ok_query_su); $upc++)
								{
									$vt = mysql_result($ok_query_su,$upc,'voto');
									$voto_ok = $vt + 1;
									$sql2="UPDATE candidato SET voto='$voto_ok' WHERE id_candidato='$i'";
									$exe2=mysql_query($sql2);
								}
				}
			}
		echo guardar($dui_pers,$partido_sel,$can_sel,$ano_v,$cod_candidato);
		echo concultar($dui_pers,$can_sel,$ano_v,$id_sel,$cod_candidato);
?>