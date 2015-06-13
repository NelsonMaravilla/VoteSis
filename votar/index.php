<?php
session_start();
include("../config/conexion.php");
//error_reporting(0);
		if ( isset ($_SESSION [ "VT_OK" ] )  &&  $_SESSION [ "VT_OK" ] == "OK" )
		{
			include("../config/datos_user_p.php");
			//include("open.php"); 
?>
<?php
        //verificar el periodo activo
		$elecciones_acti ="SELECT * FROM anio_elecciones WHERE estado='ACTIVADO'";
		$activada = mysql_query($elecciones_acti);
			for($d=0;$d<mysql_num_rows($activada);$d++)
				{
					$anio_acti=mysql_result($activada,$d,'anio_eleccion');
					$titulo=utf8_encode(mysql_result($activada,$d,'titulo'));
				}
		?>
<?php
if(isset($_GET["votar_alcalde"]))
{
	$persona_votante = $_GET["dui_votante"];
	$tcd = $_GET["candidatura_v"];
		$sql2="UPDATE voto_persona SET estado='CERRADO' WHERE dui='$persona_votante' AND tipo_candidatura='$tcd' AND ano='$anio_acti'";
		$exe2=mysql_query($sql2);
		
		/*$sql2="UPDATE persona SET estado='SI' WHERE DUI='$persona_votante'";
		$exe2=mysql_query($sql2);*/
}
else
{

}

				$queryes = "SELECT * FROM voto_persona WHERE dui='$dui_userp' AND tipo_candidatura='1' AND ano='$anio_acti'";
				$ok_queryes = mysql_query($queryes);
				$alcalde_ver = mysql_num_rows($ok_queryes);
				if($alcalde_ver == 0)
				{
					$estalcalde = '<a href="?eleccion=municipales">Municipales</a>';
				}
				else
				{
					for($inse = 0; $inse < mysql_num_rows($ok_queryes); $inse++)
						{
						$est_persona = mysql_result($ok_queryes,$inse,'estado');
						}
						if($est_persona == "CERRADO")
							{
								$estalcalde = 'Municipales';
							}
							else
							{
								$estalcalde = '<a href="?eleccion=municipales">Municipales</a>';
							}
				}
						
				$queryds = "SELECT * FROM voto_persona WHERE dui='$dui_userp' AND tipo_candidatura='2' AND ano='$anio_acti'";
				$ok_queryds = mysql_query($queryds);
				$diputado_ver = mysql_num_rows($ok_queryds);
				if($diputado_ver == 0)
				{
					$estdiput = '<a href="?eleccion=diputados">Diputados</a>';
				}
				else
				{
					for($insd = 0; $insd < mysql_num_rows($ok_queryds); $insd++)
						{
							$est_personad = mysql_result($ok_queryds,$insd,'estado');
						}
						if($est_personad == "CERRADO")
							{
								$estdiput = 'Diputados';
							}
							else
							{
								$estdiput = '<a href="?eleccion=diputados">Diputados</a>';
							}
				}
				
				$queryes = "SELECT * FROM voto_persona WHERE dui='$dui_userp' AND tipo_candidatura='3' AND ano='$anio_acti'";
				$ok_queryes = mysql_query($queryes);
				$pre_ver = mysql_num_rows($ok_queryes);
				if($pre_ver == 0)
				{
					$estpresidente = '<a href="?eleccion=presidencial">Presidenciales</a>';
				}
				else
				{
					for($inse = 0; $inse < mysql_num_rows($ok_queryes); $inse++)
						{
						$est_personap = mysql_result($ok_queryes,$inse,'estado');
						}
						if($est_persona == "CERRADO")
							{
								$estpresidente = 'Presidenciales';
							}
							else
							{
								$estpresidente = '<a href="?eleccion=presidencial">Presidenciales</a>';
							}
				}
				
				if(($est_personad == "CERRADO") AND ($est_persona == "CERRADO"))
				{
					$Cerrar = "<a href='finalizar.php?id=$dui_userp' class='btn btn-success btn-lg'>Finalizar Votaciones</a>";
				}
				else
				{
					if($est_personap == "CERRADO")
					{
						$Cerrar = "<a href='finalizar.php?id=$dui_userp' class='btn btn-success btn-lg'>Finalizar Votaciones</a>";
					}
				}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/estilos.css" rel="stylesheet">
<title>SISTEMA DE VOTACIONES</title>
</head>
    <body>
        <!-- aqui va el jumbotron-->
        <div class="container">
        	<div class="row cabesera text-center">
            	<div class="col-xs-12 col-sm-12 col-md-12">
     					<h1>Bienvenido al sistema de votaciones en l&iacute;nea<br><small class="nombre_persona"><?php echo "$nom_userp $apel_userp";?></small></h1>
        		</div>
       		</div>
        <!--informacion del sitio // aqui ya se cambiarian las paginas-->
		
        <div class="row">
        	<div class="col-md-12 text-center">
            	<h4><?php echo $titulo;?></h4>
            </div>
        </div>
        <div class="row">
        <?php
        //verificar el periodo activo
		$elecciones ="SELECT * FROM elecciones_activas WHERE ano='$anio_acti' AND estado='ACTIVADO'";
		$activadae = mysql_query($elecciones);
			for($dt=0;$dt<mysql_num_rows($activadae);$dt++)
				{
					$ano_ver=mysql_result($activadae,$dt,'ano');
					$tip=utf8_encode(mysql_result($activadae,$dt,'tipo'));
				}
		?>
        <?php
			if($tip == 1)
			{
		?>
            <div class="col-md-6 text-center alcaldes">
            	<h4><?php echo $estalcalde;?></h4>
            </div>
        <?php
			}
		?>
        <?php
			if($tip == 2)
			{
		?>
            <div class="col-md-6 text-center diputados">
            	<h4><?php echo $estdiput;?></h4>
            </div>
       <?php
			}
		?>
        <?php
			if($tip == 3)
			{
		?>
        	<div class="col-md-12 text-center presidente">
            	<h4><?php echo $estpresidente;?></h4>
            </div>
       <?php
			}
		?>
        
        </div>
        <div class="row">
            	<?php
					if(isset($_GET["eleccion"]))
					{
						$ver = $_GET["eleccion"];
						switch ($ver)
							{
								case 'diputados':
									 $page = "voto_diputados.php";
								break;
								case 'municipales':
									 $page = "voto_alcaldes.php";
								break;
								case 'presidencial':
									 $page = "voto_presidente.php";
								break;
								default:
									 $page = "error.php";
							}
						echo '<div class="row"><div class="col-md-12 text-center">';	
							include("$page");
						echo '</div></div>';
					}
					else
					{
						echo '<div class="row"><div class="col-md-12 text-center">';	
						echo $Cerrar;
						echo '</div></div>';
					}
				?>
            
        <!--finde la informacion-->
        </div>
        <footer>
        	<div class="container-fluid">
          		<div class="row">
                	<div class="col-xs-12 text-center">
                    </div>
                </div>
            </div>
        </footer>
			<script src="../js/jquery.js"></script>
            <script src="../js/bootstrap.min.js"></script>
            <script src="../js/script.js"></script>
    </body>
</html>
<?php
		}
		else
		{
			include("login.php");
		}
?>