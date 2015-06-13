<?php
session_start();
include("config/conexion.php");
//error_reporting(0);
		if ( isset ($_SESSION [ "SV_OK" ] )  &&  $_SESSION [ "SV_OK" ] == "OK" )
		{
			include("config/datos_user.php");
			include("open.php"); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/estilos.css" rel="stylesheet">
<title>SISTEMA DE VOTACIONES</title>
</head>
    <body>
        <header>
        <!--barra de menu-->
        	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            	<div class="container">
                	<div class="navbar-header">
                    	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navegacion-tx">
                        	<span class="sr-only">Mostrar/Ocultar menu</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a href="page=home" class="navbar-brand hidden-lg hidden-md hidden-sm">SIVO</a>
                        </div>
                        <!-- inicia el menu-->
                        <div class="collapse navbar-collapse" id="navegacion-tx">
                        	<ul class="nav navbar-nav">
                            	<li class="active"><a href="?page=home">Inicio</a></li>
                                <li class="dropdown">
                                	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="buttom">Registros <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                    	<li><a href="?page=periodo-votos"><span class="glyphicon glyphicon-asterisk"></span> Periodo de Votaciones</a></li>
                                        	<li class="divider"></li>
                                    	<li class="<?php echo $menu_estado;?>"><a href="?page=reg-partidos"<?php echo $menu_estado2;?>><span class="glyphicon glyphicon-asterisk"></span> Registro de Partidos</a></li>
                                        	<li class="divider"></li>
                                        <li class="<?php echo $menu_estado;?>"><a href="?page=reg-coalicion"<?php echo $menu_estado2;?>><span class="glyphicon glyphicon-asterisk"></span> Registro de Coalici&oacute;n</a></li>
                                        	<li class="divider"></li>
                                        <li class="<?php echo $menu_estado;?>"><a href="?page=candidatos"<?php echo $menu_estado2;?>><span class="glyphicon glyphicon-asterisk"></span> Registro de Candidatos</a></li>
                                        	<li class="divider"></li>
                                        <li class="<?php echo $menu_estado;?>"><a href="?page=persona-natural"<?php echo $menu_estado2;?>><span class="glyphicon glyphicon-asterisk"></span> Registro de Personas Naturales</a></li>
                                        	<li class="divider"></li>
                                        <li class="<?php echo $menu_estado;?>"><a href="?page=user"<?php echo $menu_estado2;?>><span class="glyphicon glyphicon-asterisk"></span> Registro de Usuarios</a></li>
                                    </ul>
                                </li>
                                <li class="<?php echo $menu_estado;?>"><a href="?page=estadistica"<?php echo $menu_estado2;?>>estadisticas</a></li>
                                <li><a href="?page=free-quore">Ayuda</a></li>
                                <li><a href="cerrarsesion.php">Cerrar Sesi&oacute;n</a></li>
                                <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo "$nom_user $apel_user";?></a></li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <!-- aqui va el jumbotron-->
        <div class="container color_seccion">
        	<div class="row cabesera text-center">
            	<div class="col-xs-12 col-sm-12 col-md-12">
                    <img src="img/header_img.png" class="img-responsive center-block">
                 </div>
        	</div>
        </div>
        <!--informacion del sitio // aqui ya se cambiarian las paginas-->
		<?php include("$page"); ?>
        <!--finde la informacion-->
        <footer>
        	<div class="container-fluid">
          		<div class="row">
                	<div class="col-xs-12 text-center">
                    </div>
                </div>
            </div>
        </footer>
			<script src="js/jquery.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/script.js"></script>
    </body>
</html>
<?php
		}
		else
		{
			include("sesion.php");
		}
?>