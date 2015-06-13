<?php
$msg = "";
if (isset($_POST["enviarp"]))
{
	$ano = $_POST["anio"];
	$titulo = $_POST["des"];
	$estado = $_POST["estado"];
	$candi = $_POST["Can"];
	$est_guardar = "";
	$est_editar = ' disabled="disabled"';
	foreach($candi as $tema)
			{
				$tem = $tema;
			}
			$checkuser3 = mysql_query("SELECT * FROM anio_elecciones WHERE anio_eleccion='$ano' AND tipo_eleccion='$tema'");
         	$username_exist3 = mysql_num_rows($checkuser3);
			if ($username_exist3 > 0) 
					{
						foreach ($_REQUEST['can'] as $destino1)
        				{ 
							 if($$candi==1)
							 {
								$checkuser = mysql_query("SELECT * FROM elecciones_activas WHERE tipo='$destino1' AND ano='$ano'");
								$username_exist = mysql_num_rows($checkuser);
					
							 }
								else if ($candi==2)
								 {
						
									$checkuser = mysql_query("SELECT * FROM elecciones_activas  WHERE tipo='$destino1' AND ano='$ano'");
									$username_exist = mysql_num_rows($checkuser);
						  
								 }
									 else
									 {
										$checkuser = mysql_query("SELECT * FROM elecciones_activas  WHERE tipo='$destino1' AND ano='$ano'");
										$username_exist = mysql_num_rows($checkuser);
									 }
									 
									 if ($username_exist>0) {
																 $msg =  "<div class='alert alert-danger'>ya existe registro de este periodo de votacion.</div>";
															}
															else
															{
																foreach ($_REQUEST['Can'] as $destino)
																	{ 
																	  $query = 'INSERT INTO elecciones_activas(ano,tipo,estado)
																		VALUES (\''.$ano.'\',\''.$destino.'\',\''.$estado.'\')';
																		mysql_query($query) or die(mysql_error());
																	}
																	$msg =  "<div class='alert alert-success'>El periodo electoral se a creado satisfactoriamente</div>";
															}
						} 
					}
					else
					{
						$query = 'INSERT INTO anio_elecciones(anio_eleccion,titulo,tipo_eleccion,estado) VALUES (\''.$ano.'\',\''.$titulo.'\',\''.$tema.'\',\''.$estado.'\')';
						mysql_query($query) or die(mysql_error());
						
						$sql2="UPDATE persona SET estado='NO'";
						$exe2=mysql_query($sql2);
						
						foreach ($_REQUEST['Can'] as $destino)
							{ 
							  $query = 'INSERT INTO elecciones_activas(ano,tipo,estado)
								VALUES (\''.$ano.'\',\''.$destino.'\',\''.$estado.'\')';
								mysql_query($query) or die(mysql_error());
							}
							$msg =  "<div class='alert alert-success'>El periodo electoral se a creado satisfactoriamente</div>";
					}	
}
else
{
	$ano = "";
	$titulo = "";
	$estado = "";
	$candi = "";
	$est_guardar = "";
	$est_editar = ' disabled="disabled"';
	$msg = "";
}
if(isset($_GET["accion"]))
{
	$accion = $_GET["accion"];
	$id_ano = $_GET["anio"];
	if($accion == "cerrar")
	{
		$sql2="UPDATE anio_elecciones SET estado='FINALIZADO' WHERE anio_eleccion='$id_ano'";
		$exe2=mysql_query($sql2);
		$sql2="UPDATE elecciones_activas SET estado='FINALIZADO' WHERE ano='$id_ano'";
		$exe2=mysql_query($sql2);
		echo"<script language = 'JavaScript'> alert('A&Ntilde;O FINALIZADO SATISFACTORIAMENTE'); </script>";
	}
}
?>