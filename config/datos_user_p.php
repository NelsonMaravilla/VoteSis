<?php
$nom_userp=$_SESSION["usernomp"];
$apel_userp=$_SESSION["userapep"];
$depa_userp=$_SESSION["userdep"];
$muni_userp=$_SESSION["usermun"];
$dui_userp=$_SESSION["userduip"];
$id_user_activep=$_SESSION["user_idep"];

function iniciales_partido($ptd)
{
	$inicialesp = "SELECT iniciales_p FROM partido WHERE id_partido='$ptd'" ;
    $inicial_partido = mysql_query($inicialesp);
	for($pp=0;$pp<mysql_num_rows($inicial_partido);$pp++)
						{
							$partido_iniciales = mysql_result($inicial_partido,$pp,'iniciales_p');
						}
						echo $partido_iniciales;
}

?>