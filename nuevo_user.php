<div class="col-md-8 text-center">
                	<?php
						$sesion_si = "SELECT * FROM usuario";
						$veri_sihay = mysql_query($sesion_si);
						$cuantos_user = mysql_num_rows($veri_sihay);
						if($cuantos_user == 0)
						{
					?>
                    <?php
					$msguser = "";
					$nuser = "";
					$apuser = "";
					$duiuser = "";
					$ideuser = "";
					$pa = "";
					$pb = "";
					$causer = "";
					
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
                    <div class="panel panel-primary">
                    <div class="panel-heading">Nuevo Usuario</div>
                      <div class="panel-body text-justify">
                        <form action="" method="post" id="fusuario_n" name="fusuario_n" enctype="multipart/form-data">
                           <div class="form-group has-warning">
                               <label class="control-label text-left" for="nombreu">Nombre:</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" value="<?php echo $nuser;?>">
                           </div>
                           <div class="form-group has-warning">
                               <label class="control-label" for="apeu">Apellido:</label>
                                    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellidos" value="<?php echo $apuser;?>">
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
                             <button type="submit" class="btn btn-info" name="enviar_user" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                           </div>
                       </form><br>
                       <div>
   							<?php
							echo $msguser;
							?>
                       </div>
                      </div>
                    </div>
                     <?php
						}
					?>
                </div>