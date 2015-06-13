 <?php
					$msguser = "";
					$nuser = "";
					$apuser = "";
					$duiuser = "";
					$ideuser = "";
					$pa = "";
					$pb = "";
					$causer = "";
					$est_guardar = "";
					$est_editar = ' disabled="disabled"';
					
                       if(isset($_POST["enviar_user"]))
                            {
								$nuser = $_POST["nombre"];
								$apuser = $_POST["apellido"];
								$duiuser = $_POST["dui"];
								$ideuser = $_POST["IDu"];
								$pa = $_POST["password"];
								$pb = $_POST["password2"];
								$pad = md5($_POST["password"]);
								$causer = $_POST["tipo"];
								
								//verificar si vienen vacios los campos
								if(($nuser == "") OR ($apuser == "") OR ($duiuser == "") OR ($ideuser == "") OR ($pa == "") OR ($pb == ""))
								  {
									  $msguser = "<div class='alert alert-danger'>TODOS LOS CAMPOS SON OBLIGATORIOS</div>";
								  }
								  elseif ($pa != $pb)
							   		{
										$msguser = "<div class='alert alert-danger'>Las contraseñas no coinsiden</div>";
									}
									else
									{
										$verificar_user_bd = "SELECT * FROM usuario WHERE usuario ='$ideuser' OR dui ='$duiuser'";
										$userbd = mysql_query($verificar_user_bd);
										$user_bd_ok = mysql_num_rows($userbd);
										if($user_bd_ok > 0)
										{
											$msguser = "<div class='alert alert-danger'>Ya existe un usuario con ese ide y DUI</div>";
										}
										else
										{
											$sql1="INSERT INTO usuario(nombre,apellido,dui,usuario,contrasena,tipo) VALUES('$nuser','$apuser','$duiuser','$ideuser','$pad','$causer')";
											$resul=mysql_query($sql1);
											
												$msguser = "<div class='alert alert-success'>OK</div>";
										}
									}
                            }
							
						?>
<div class="container">
	<div class="row">
			<div class="col-md-12 text-center">
                   <div class="panel panel-primary">
                    <div class="panel-heading">DATOD DEL USUARIO</div>
                      <div class="panel-body text-justify">
                        <form action="" method="post" id="fusuario_n" name="fusuario_n" enctype="multipart/form-data">
                           <div class="form-group has-warning">
                               <label class="control-label text-left" for="nombreu">Nombre:</label>
                                    <input type="text" class="form-control" onkeypress="return validar_letras(event)" name="nombre" id="nombre" placeholder="Nombres" value="<?php echo $nuser;?>">
                           </div>
                           <div class="form-group has-warning">
                               <label class="control-label" for="apeu">Apellido:</label>
                                    <input type="text" class="form-control" onkeypress="return validar_letras(event)" name="apellido" id="apellido" placeholder="Apellidos" value="<?php echo $apuser;?>">
                           </div>
                           <div class="form-group has-warning">
                               <label class="control-label" for="dui">DUI:</label>
                                    <input type="text" class="form-control" name="dui" id="dui" placeholder="00000000-0" onKeyUp="mascara(this,'-',patron3,true)" onKeyPress="return justNumbers(event);" maxlength="10" value="<?php echo $duiuser;?>">
                           </div>
                           <div class="form-group has-warning">
                               <label class="control-label" for="IDu">Usuario:</label>
                                    <input type="text" class="form-control" name="IDu" id="IDu" placeholder="Nombre de Usuario" value="<?php echo $ideuser;?>">
                           </div>
                           <div class="form-group has-warning">
                               <label class="control-label" for="pas1">Contrase&ntilde;a:</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña de acceso">
                           </div>
                           <div class="form-group has-warning">
                               <label class="control-label" for="pas2">Repetir Contrase&ntilde;a:</label>
                                    <input type="password" class="form-control" name="password2" id="password2" placeholder="Repetir Contraseña de acceso">
                           </div>
                           <div class="form-group has-warning">
                               <label class="control-label" for="pas2">Tipo:</label>
                                    <select class="form-control" name="tipo" id="tipo">
                                          <option value="Administrador">Administrador</option>
                                          <option value="Usuario">Usuario</option>
                                        </select>
                           </div>
                           <div class="text-center">
                            <button type="submit" class="btn btn-info" name="enviar_user"<?php echo $est_guardar;?>><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                 <?php
				 if($tipo_user == "Administrador")
				 {
				 ?>
					 &nbsp; <button type="submit" class="btn btn-success" name="modificar"<?php echo $est_editar;?>><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                 <?php
				 }
				 ?>
                 &nbsp;<a href="#verconsulta" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-eye-open"></span> Ver Usuarios</a>
               </div>
                           </div>
                       </form><br>
                       <div>
   							<?php
							echo $msguser;
							?>
                       </div>
                      </div>
                    </div>
                </div>
             </div>
        </div>
        <div class="modal fade" id="verconsulta">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
        	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" arial-hidden="true">&times;</button>
            	<h3 class="modal-title">Usuarios Registrados</h3>
            </div>
            <div class="modal-body table-responsive">
            	<table class="table table-bordered">
                <thead>
                  <tr class="text-center">
                  	<td>Nombre</td>
                    <td>Tipo</td>
                    <td>Estado</td>
                    <td>Acciones</td>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $ver_person = "SELECT * FROM usuario" ;
                    $person = mysql_query($ver_person);
					$cuantopr = mysql_num_rows($person);
					if($cuantopr == 0)
					{
				  ?>
                  <tr>
                  	<td colspan="3">No hay registro de usuario</td>
                  </tr>
                  <?php
					}
					else
					{
						for($pr=0;$pr<mysql_num_rows($person);$pr++)
						{
							$nombreu = mysql_result($person,$pr,'nombre');
							$apellidou = mysql_result($person,$pr,'apellido');
							$user = mysql_result($person,$pr,'usuario');
							$tipo_us = mysql_result($person,$pr,'tipo');
							$est_usu = mysql_result($person,$pr,'estado');
							$ide_usu = mysql_result($person,$pr,'id_usuario');
						echo "<tr>
								 <td>$nombreu $apellidou</td>
								 <td>$tipo_us</td>
								 <td>";
							echo $est_usu;
						echo "	</td>";
						echo "<td>";
						if($tipo_user == "Administrador")
				 		{
						echo "<a href='?page=user&accion=editar&usuario=$ide_usu'>Editar</a> / <a href='?page=user&accion=eliminar&usuario=$ide_usu'>Eliminar</a>";
						}
						echo "</td>";
						echo "</tr>";
						}
					}
					?>
                  </tbody>
                </table>
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-primary" data-dismiss="modal">cerrar</button>
                <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
 function validar_letras(e) 
    { 
        tecla=(document.all)?e.keyCode:e.which; 
        patron=/[A-Z a-z áÁéÉíÍóÓúÚüÜñÑ]/; 
        te=String.fromCharCode(tecla); 
        return patron.test(te); 
    }
</script>