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
        <!-- aqui va el jumbotron--><br>
        <div class="container">
        	<div class="jumbotron text-center">
            	<h1>Sistema de Votaci&oacute;n</h1>
        	</div>
            <div class="row">
            	<div class="col-sm-12 col-xs-12 col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">Datos de Usuario</div>
                    <div class="panel-body">
                <form action="" method="post" class="form-horizontal">
                  <div class="form-group">
                    <label for="user" class="col-sm-2 control-label">Usuario</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="user" id="user" placeholder="Usuario">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pass" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="pass" id="pass" placeholder="Contrase&ntilde;a">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default" name="iniciar">Ingresar</button>
                    </div>
                  </div>
                </form>
                <?php
			 $msgbox="";
					if(isset($_POST["iniciar"]))
					{
			
						@$nom = $_POST["user"];
						@$pass = md5($_POST["pass"]);
			
								$sesion = "SELECT * FROM usuario WHERE usuario='$nom' AND contrasena='$pass'";
								$verificar = mysql_query($sesion);
								
									$nombre_u = @mysql_result($verificar,0,'nombre');
									$apellido_u = @mysql_result($verificar,0,'apellido');
									$usuario = @mysql_result($verificar,0,'usuario');
									$password = @mysql_result($verificar,0,'contrasena');
									$tusuario = @mysql_result($verificar,0,'tipo');
									$id_user_session = @mysql_result($verificar,0,'id_usuario');
									$detalle_ok = @mysql_result($verificar,0,'estado');
									$_SESSION["log"]=$nombre_u;
									if (($nom == "") OR ($pass == ""))
											{
											$msgbox = "<div class='alert alert-danger'>TODOS LOS CAMPOS SON OBLIGATORIOS</div>";
											}
											elseif(($nom != $usuario) and ($pass != $password))
											{
												$msgbox = "<div class='alert alert-danger'>Usuario o Contraseña erroneos, Vuelvalo a intentar</div>";
											}
											else
											{
												if(($nom == $usuario) and ($pass == $password))
													{
														$estado="OK";
														@$_SESSION["SV_OK"]=$estado;
														@$_SESSION["usertip"]=$tusuario;
														@$_SESSION["userusu"]=$usuario;
														@$_SESSION["usernom"]=$nombre_u;
														@$_SESSION["userape"]=$apellido_u;
														@$_SESSION["user_ide"]=$id_user_session;
														@$_SESSION["user_deta"]=$detalle_ok;
														?>
															<SCRIPT LANGUAGE="javascript">location.href = "index.php";</SCRIPT>
                                                    	<?php
 														exit;
													}
											}
											
					}
					?>
                   </div>
                    </div>
                <?php
				include("nuevo_user.php");
				?>
                </div>
            </div>
        </div>
        <div class="container">
			<?php
             	echo $msgbox;
             ?>
        </div>
			<script src="js/jquery.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/script.js"></script>
    </body>
</html>