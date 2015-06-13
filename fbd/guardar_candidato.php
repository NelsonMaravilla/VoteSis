<?php
if(isset($_POST["enviar"]))
{
	$archivo=$_FILES["files"]["tmp_name"];
	$nombreArchivo=$_FILES["files"]["name"];
	$ruta="personas";
	//campos
	$nombre = $_POST["nom_per"];
    $apellido = $_POST["ape_per"];
    $to1 = $_POST["genero"];
    $dui = $_POST["dui"];
    $fvd = $_POST["fvd"];
    $fdn = $_POST["fdn"];
    $depto = $_POST["depto"];
    $municipio = $_POST["municipio"];
    $Resi = $_POST["residencia"];
	$partido=$_POST["partido"];
	$candidatura=$_POST["Can"];

	//estados_botones
	$est_img = " required";
	$est_candidatura = "";
	$est_guardar = "";
	$est_editar = ' disabled="disabled"';

	include("fbd/consultas.php");

   	$extension = end(explode('.',$nombreArchivo));
	$nombrei = $dui.".".$extension; 
	$url = $ruta."/".$nombrei;
	$mime = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
	
	@$imagen = getimagesize($archivo);    //Sacamos la información
  	$ancho = $imagen[0];              //Ancho
  	$alto = $imagen[1];               //Altoç
	

	  if($nombre==NULL | $apellido==NULL | $dui==NULL | $Resi==NULL | $url==NULL)
	  {
		  $msg = "<div class='alert alert-danger'>TODOS LOS CAMPOS SON OBLIGATORIOS</div>";
	  }
		  elseif(empty($archivo))
		  {
				$msg = "<div class='alert alert-danger'>NO A SELECCIONADO LA IMAGEN</div>";
		  }
			  elseif(!in_array($_FILES['files']['type'],$mime))
			  {
				  $msg = "<div class='alert alert-danger'>Ups! Solamente puedes subir imagenes con la extension GIF, JPG, JPEG, PJPEG o PNG</div>";
			  }
				  elseif(($ancho > 192) || ($alto > 240))
					  {
						  $msg = "<div class='alert alert-danger'>NO SE PUEDE SUBIR LA IMAGEN PORQUE EL TAMAÑO NO ES EL CORRECTO</div>";
					  }
						  else
						  {
							  	$checkuser3 = mysql_query("SELECT dui FROM candidato WHERE dui='$dui'");
         						$username_exist3 = mysql_num_rows($checkuser3);
								
									if ($username_exist3 > 0) 
										{
											$msg =  "<div class='alert alert-danger'>ESTE DUI YA ESTA REGISTRADO EN NUESTRA BASE DE DATOS</div>";
										}
										else
										{
											//inicia el guardado
											if($candidatura == 1)
												{
														 //verificar si el partido esta en coalicion
														 $coalision = "SELECT * FROM coalicion WHERE Tipo='$candidatura' AND codigo_loca='$municipio'";
														 $query_coa = mysql_query($coalision);
														 $count_coalicion = mysql_num_rows($query_coa);
														 if($count_coalicion > 0)
														 {
															 for($co = 0;$co < mysql_num_rows($query_coa); $co++)
															 {
																 $id_coalicion = mysql_result($query_coa,$co,'id');
																 $nom_coalicion = mysql_result($query_coa,$co,'Nombre_coa');
																 
																 //verificar la coalicion dentro del partido
																 $coalision_p = "SELECT * FROM partidos_coalicion WHERE id_coalicion='$id_coalicion' AND id_partido='$partido'";
																 $query_coap = mysql_query($coalision_p);
																 $count_coap = mysql_num_rows($query_coap);
																	if($count_coap > 0)
																	{
																		 $verificar_diputaciones = "SELECT * FROM candidato WHERE id_municipio='$municipio' AND id_coalicion='$id_coalicion'" ;
																		 $diputados_cuantos = mysql_query($verificar_diputaciones);
																		 @$cuantosd = mysql_num_rows($diputados_cuantos);
																			 if($cuantosd > 0)
																			 {
																				 $msg =  "<div class='alert alert-danger'>A SUPERADO EL NUMERO DE ALCALDES EN ESTE MUNICIPIO.</div>";
																			 }
																				 else
																					 {
																						 $query = 'INSERT INTO candidato(nombre,apellido,dui,fecha_ven,fecha_naci,id_departamento,id_municipio,residencia,genero,imag_can,id_partido,id_coalicion,tipo_candidatura,id_anoe) VALUES (\''.$nombre.'\',\''.$apellido.'\',\''.$dui.'\',\''.$fvd.'\',\''.$fdn.'\',\''.$depto.'\',\''.$municipio.'\',\''.$Resi.'\',\''.$to1.'\',\''.$url.'\',\''.$partido.'\',\''.$id_coalicion.'\',\''.$candidatura.'\',\''.$ano.'\')';
																						 mysql_query($query) or die(mysql_error());
																						 //subir imagen a la carpeta del servidor
																						 move_uploaded_file($_FILES['files']['tmp_name'],$ruta."/".$nombrei);
																						 $msg =  "<div class='alert alert-success'>El candidato a alcalde:<b>$nombre $apellido</b> con DUI: $dui se a registrado en el partido <b>$siglas_par</b> dentro de la coalicion <b>$nom_coalicion</b> ha sido registrado de manera satisfactoria.</div>";
																						 $apellido = "";
																								 $to1 = "";
																								 $dui = "";
																								 $fvd = "";
																								 $fdn = "";
																								 $depto = "";
																								 $municipio = "";
																								 $nmunicipio = "<option value=''>------</option>";
																								 $Resi = "";
																								 $partido="";
																								 $candidatura="";
																								 $archivo = "";
																								 $est_img = " required";
																								 $est_candidatura = "";
																								 $est_guardar = "";
																								 $est_editar = ' disabled="disabled"';
																					 }
																		
																	}
															 }
																													 
														 }
														  else
															 {
																$verificar_diputaciones = "SELECT * FROM candidato WHERE id_municipio='$municipio' AND id_partido='$partido' AND tipo_candidatura='$candidatura'";
																$diputados_cuantos = mysql_query($verificar_diputaciones);
																@$cuantosd = mysql_num_rows($diputados_cuantos);
																	if($cuantosd > 0)
																			 {
																				 $msg =  "<div class='alert alert-danger'>A SUPERADO EL NUMERO DE ALCALDES EN ESTE MUNICIPIO.</div>";
																			 }
																				 else
																					 {
																						 $query = 'INSERT INTO candidato(nombre,apellido,dui,fecha_ven,fecha_naci,id_departamento,id_municipio,residencia,genero,imag_can,id_partido,tipo_candidatura,id_anoe) VALUES (\''.$nombre.'\',\''.$apellido.'\',\''.$dui.'\',\''.$fvd.'\',\''.$fdn.'\',\''.$depto.'\',\''.$municipio.'\',\''.$Resi.'\',\''.$to1.'\',\''.$url.'\',\''.$partido.'\',\''.$candidatura.'\',\''.$ano.'\')';
																						 mysql_query($query) or die(mysql_error());
																						 //subir imagen a la carpeta del servidor
																						 move_uploaded_file($_FILES['files']['tmp_name'],$ruta."/".$nombrei);
																						 $msg =  "<div class='alert alert-success'>El candidato  a alcalde:<b>$nombre $apellido</b> con DUI: $dui se a registrado en el partido <b>$siglas_par</b> de manera satisfactoria.</div>";
																						 $apellido = "";
																								 $to1 = "";
																								 $dui = "";
																								 $fvd = "";
																								 $fdn = "";
																								 $depto = "";
																								 $municipio = "";
																								 $nmunicipio = "<option value=''>------</option>";
																								 $Resi = "";
																								 $partido="";
																								 $candidatura="";
																								 $archivo = "";
																								 $est_img = " required";
																								 $est_candidatura = "";
																								 $est_guardar = "";
																								 $est_editar = ' disabled="disabled"';
																					 }
															 }
													}
													elseif($candidatura == 2)
													{
														//verificar si el partido esta en coalicion
														 $coalision = "SELECT * FROM coalicion WHERE Tipo='$candidatura' AND codigo_loca='$depto'";
														 $query_coa = mysql_query($coalision);
														 $count_coalicion = mysql_num_rows($query_coa);
														 if($count_coalicion > 0)
														 {
															 for($co = 0;$co < mysql_num_rows($query_coa); $co++)
															 {
																 $id_coalicion = mysql_result($query_coa,$co,'id');
																 $nom_coalicion = mysql_result($query_coa,$co,'Nombre_coa');
																 
																 //verificar la coalicion dentro del partido
																 $coalision_p = "SELECT * FROM partidos_coalicion WHERE id_coalicion='$id_coalicion' AND id_partido='$partido'";
																 $query_coap = mysql_query($coalision_p);
																 $count_coap = mysql_num_rows($query_coap);
																	if($count_coap > 0)
																	{
																		 $verificar_diputaciones = "SELECT * FROM candidato WHERE id_departamento='$depto' AND id_coalicion='$id_coalicion'" ;
																		 $diputados_cuantos = mysql_query($verificar_diputaciones);
																		 @$cuantosd = mysql_num_rows($diputados_cuantos);
																			 if($cuantosd > 0)
																			 {
																				 $msg =  "<div class='alert alert-danger'>A SUPERADO EL NUMERO DE DIPUTADOS EN ESTE DEPARTAMENTO PARA ESTE PARTIDO.</div>";
																			 }
																				 else
																					 {
																						 $query = 'INSERT INTO candidato(nombre,apellido,dui,fecha_ven,fecha_naci,id_departamento,id_municipio,residencia,genero,imag_can,id_partido,id_coalicion,tipo_candidatura,id_anoe) VALUES (\''.$nombre.'\',\''.$apellido.'\',\''.$dui.'\',\''.$fvd.'\',\''.$fdn.'\',\''.$depto.'\',\''.$municipio.'\',\''.$Resi.'\',\''.$to1.'\',\''.$url.'\',\''.$partido.'\',\''.$id_coalicion.'\',\''.$candidatura.'\',\''.$ano.'\')';
																						 mysql_query($query) or die(mysql_error());
																						 //subir imagen a la carpeta del servidor
																						 move_uploaded_file($_FILES['files']['tmp_name'],$ruta."/".$nombrei);
																						 $msg =  "<div class='alert alert-success'>El candidato a Diputado:<b>$nombre $apellido</b> con DUI: $dui se a registrado en el partido <b>$siglas_par</b> dentro de la coalicion <b>$nom_coalicion</b> ha sido registrado de manera satisfactoria.</div>";
																						 $apellido = "";
																								 $to1 = "";
																								 $dui = "";
																								 $fvd = "";
																								 $fdn = "";
																								 $depto = "";
																								 $municipio = "";
																								 $nmunicipio = "<option value=''>------</option>";
																								 $Resi = "";
																								 $partido="";
																								 $candidatura="";
																								 $archivo = "";
																								 $est_img = " required";
																								 $est_candidatura = "";
																								 $est_guardar = "";
																								 $est_editar = ' disabled="disabled"';
																					 }
																		
																	}
															 }
																													 
														 }
														  else
															 {
																$verificar_diputaciones = "SELECT * FROM candidato WHERE id_departamento='$depto' AND id_partido='$partido' AND tipo_candidatura='$candidatura'";
																$diputados_cuantos = mysql_query($verificar_diputaciones);
																@$cuantosd = mysql_num_rows($diputados_cuantos);
																	if($cuantosd > 0)
																			 {
																				 $msg =  "<div class='alert alert-danger'>A SUPERADO EL NUMERO DE DIPUTADOS EN ESTE DEPARTAMENTO PARA ESTE PARTIDO.</div>";
																			 }
																				 else
																					 {
																						 $query = 'INSERT INTO candidato(nombre,apellido,dui,fecha_ven,fecha_naci,id_departamento,id_municipio,residencia,genero,imag_can,id_partido,tipo_candidatura,id_anoe) VALUES (\''.$nombre.'\',\''.$apellido.'\',\''.$dui.'\',\''.$fvd.'\',\''.$fdn.'\',\''.$depto.'\',\''.$municipio.'\',\''.$Resi.'\',\''.$to1.'\',\''.$url.'\',\''.$partido.'\',\''.$candidatura.'\',\''.$ano.'\')';
																						 mysql_query($query) or die(mysql_error());
																						 //subir imagen a la carpeta del servidor
																						 move_uploaded_file($_FILES['files']['tmp_name'],$ruta."/".$nombrei);
																						 $msg =  "<div class='alert alert-success'>El candidato  a Diputado:<b>$nombre $apellido</b> con DUI: $dui se a registrado en el partido <b>$siglas_par</b> de manera satisfactoria.</div>";
																						 $apellido = "";
																								 $to1 = "";
																								 $dui = "";
																								 $fvd = "";
																								 $fdn = "";
																								 $depto = "";
																								 $municipio = "";
																								 $nmunicipio = "<option value=''>------</option>";
																								 $Resi = "";
																								 $partido="";
																								 $candidatura="";
																								 $archivo = "";
																								 $est_img = " required";
																								 $est_candidatura = "";
																								 $est_guardar = "";
																								 $est_editar = ' disabled="disabled"';
																					 }
															 }
													}
													else
													{
														if($candidatura == 3)
														{
															//PRESIDENCIAL
																 $coalision = "SELECT * FROM coalicion WHERE Tipo='$candidatura' AND codigo_loca='0'";
																 $query_coa = mysql_query($coalision);
																 $count_coalicion = mysql_num_rows($query_coa);
																 if($count_coalicion > 0)
																 {
																	 for($co = 0;$co < mysql_num_rows($query_coa); $co++)
																	 {
																		 $id_coalicion = mysql_result($query_coa,$co,'id');
																		 $nom_coalicion = mysql_result($query_coa,$co,'Nombre_coa');
																		 
																		 //verificar la coalicion dentro del partido
																		 $coalision_p = "SELECT * FROM partidos_coalicion WHERE id_coalicion='$id_coalicion' AND id_partido='$partido'";
																		 $query_coap = mysql_query($coalision_p);
																		 $count_coap = mysql_num_rows($query_coap);
																			if($count_coap > 0)
																			{
																				 $verificar_diputaciones = "SELECT * FROM candidato WHERE id_departamento='$depto' AND id_coalicion='$id_coalicion'";
																				 $diputados_cuantos = mysql_query($verificar_diputaciones);
																				 @$cuantosd = mysql_num_rows($diputados_cuantos);
																					 if($cuantosd > 0)
																					 {
																						 $msg =  "<div class='alert alert-danger'SOLO SE PERMITE REGISTRAR UN CANDIDATO PRESIDENCIAL POR PARTIDO EN COALICION.</div>";
																					 }
																						 else
																							 {
																								 $query = 'INSERT INTO candidato(nombre,apellido,dui,fecha_ven,fecha_naci,id_departamento,id_municipio,residencia,genero,imag_can,id_partido,id_coalicion,tipo_candidatura,id_anoe) VALUES (\''.$nombre.'\',\''.$apellido.'\',\''.$dui.'\',\''.$fvd.'\',\''.$fdn.'\',\''.$depto.'\',\''.$municipio.'\',\''.$Resi.'\',\''.$to1.'\',\''.$url.'\',\''.$partido.'\',\''.$id_coalicion.'\',\''.$candidatura.'\',\''.$ano.'\')';
																								 mysql_query($query) or die(mysql_error());
																								 //subir imagen a la carpeta del servidor
																								 move_uploaded_file($_FILES['files']['tmp_name'],$ruta."/".$nombrei);
																								 $msg =  "<div class='alert alert-success'>El candidato <b>$nombre $apellido</b> con DUI: $dui se a registrado en el partido <b>$siglas_par</b> dentro de la coalicion <b>$nom_coalicion</b> ha sido registrado de manera satisfactoria.</div>";
																								 $nombre = "";
																								 $apellido = "";
																								 $to1 = "";
																								 $dui = "";
																								 $fvd = "";
																								 $fdn = "";
																								 $depto = "";
																								 $municipio = "";
																								 $nmunicipio = "<option value=''>------</option>";
																								 $Resi = "";
																								 $partido="";
																								 $candidatura="";
																								 $archivo = "";
																								 $est_img = " required";
																								 $est_candidatura = "";
																								 $est_guardar = "";
																								 $est_editar = ' disabled="disabled"';
																							 }
																				
																			}
																	 }
																															 
																 }
																 else
																 {
															
																 $verificar_diputaciones = "SELECT * FROM candidato WHERE id_partido='$partido' AND tipo_candidatura='$candidatura'";
																		$diputados_cuantos = mysql_query($verificar_diputaciones);
																		@$cuantosd = mysql_num_rows($diputados_cuantos);
																			if($cuantosd > 0)
																					 {
																						 $msg =  "<div class='alert alert-danger'>SOLO SE PERMITE REGISTRAR UN CANDIDATO PRESIDENCIAL POR PARTIDO.</div>";
																					 }
																						 else
																							 {
																								 $query = 'INSERT INTO candidato(nombre,apellido,dui,fecha_ven,fecha_naci,id_departamento,id_municipio,residencia,genero,imag_can,id_partido,tipo_candidatura,id_anoe) VALUES (\''.$nombre.'\',\''.$apellido.'\',\''.$dui.'\',\''.$fvd.'\',\''.$fdn.'\',\''.$depto.'\',\''.$municipio.'\',\''.$Resi.'\',\''.$to1.'\',\''.$url.'\',\''.$partido.'\',\''.$candidatura.'\',\''.$ano.'\')';
																								 mysql_query($query) or die(mysql_error());
																								 //subir imagen a la carpeta del servidor
																								 move_uploaded_file($_FILES['files']['tmp_name'],$ruta."/".$nombrei);
																								 $msg =  "<div class='alert alert-success'>El candidato a Presidente: <b>$nombre $apellido</b> con DUI: $dui se a registrado en el partido <b>$siglas_par</b> de manera satisfactoria.</div>";
																								 $nombre = "";
																								 $apellido = "";
																								 $to1 = "";
																								 $dui = "";
																								 $fvd = "";
																								 $fdn = "";
																								 $depto = "";
																								 $municipio = "";
																								 $nmunicipio = "<option value=''>------</option>";
																								 $Resi = "";
																								 $partido="";
																								 $candidatura="";
																								 $archivo = "";
																								 $est_img = " required";
																								 $est_candidatura = "";
																								 $est_guardar = "";
																								 $est_editar = ' disabled="disabled"';
																							 }
																 }
														}
													}
													//finaliza el guardado
												
										}
						  }
}
elseif(isset($_GET["accion"]))
{
	$accion_t = $_GET["accion"];
	$idcandi = $_GET["can"];
	
	if($accion_t == "editar")
	{
		$ver_candi = "SELECT * FROM candidato WHERE id_candidato='$idcandi'" ;
        $candi = mysql_query($ver_candi);
			for($vvc=0;$vvc<mysql_num_rows($candi);$vvc++)
						{
							$nombre = mysql_result($candi,$vvc,'nombre');
							$apellido = mysql_result($candi,$vvc,'apellido');
							$to1 = mysql_result($candi,$vvc,'genero');
							$dui = mysql_result($candi,$vvc,'dui');
							$fvd = mysql_result($candi,$vvc,'fecha_ven');
							$fdn = mysql_result($candi,$vvc,'fecha_naci');
							$depto = mysql_result($candi,$vvc,'id_departamento');
							$municipio = mysql_result($candi,$vvc,'id_municipio');
							$Resi = mysql_result($candi,$vvc,'residencia');
							$partido= mysql_result($candi,$vvc,'id_partido');
							$candidatura= mysql_result($candi,$vvc,'tipo_candidatura');
							$img_c = mysql_result($candi,$vvc,'imag_can');
						
							$archivo = "<div class='text-center' id='list_2'><img class='thumb img-responsive img-thumbnail' src='$img_c' /></div>";
							$est_img = "";
							$est_candidatura = ' disabled="disabled"';
							$est_guardar = ' disabled="disabled"';
							$est_editar = '';
						}
				$msg = "";
	}
	
	if($accion_t == "eliminar")
	{
		$ver_candi = "SELECT * FROM candidato WHERE id_candidato='$idcandi'" ;
        $candi = mysql_query($ver_candi);
			for($vvc=0;$vvc<mysql_num_rows($candi);$vvc++)
						{
							$votos = mysql_result($candi,$vvc,'voto');
							if($votos == 0)
								{
									$quitar_eqd = "DELETE FROM candidato WHERE id_candidato='$idcandi'";
									$okq = mysql_query($quitar_eqd);
									$msg =  "<div class='alert alert-success'>El candidato se ELIMINO de manera satisfactoria.</div>";
								}
								else
								{
									$msg =  "<div class='alert alert-danger'>No se puede eliminar el candidato porque ya tiene votos a su favor.</div>";
								}
						}
		$nombre = "";
		$apellido = "";
		$to1 = "";
		$dui = "";
		$fvd = "";
		$fdn = "";
		$depto = "";
		$municipio = "";
		$nmunicipio = "";
		$Resi = "";
		$partido="";
		$candidatura="";
		$est_img = " required";
		$archivo = "";
		$est_candidatura = "";
		$est_guardar = "";
		$est_editar = ' disabled="disabled"';
	}
}
else
{
	$nombre = "";
    $apellido = "";
    $to1 = "";
    $dui = "";
    $fvd = "";
    $fdn = "";
    $depto = "";
    $municipio = "";
	$nmunicipio = "<option value=''>------</option>";
    $Resi = "";
	$partido="";
	$candidatura="";
	$est_candidatura = "";
	$est_guardar = "";
	$archivo = "";
	$est_img = " required";
	$est_editar = ' disabled="disabled"';
	$msg = "";
}
if(isset($_POST["modificar"]))
{
	$duis = $_POST["dui"];
	$nombre = $_POST["nom_per"];
    $apellido = $_POST["ape_per"];
    $to1 = $_POST["genero"];
    $dui = $_POST["dui"];
    $fvd = $_POST["fvd"];
    $fdn = $_POST["fdn"];
    $depto = $_POST["depto"];
    $municipio = $_POST["municipio"];
    $Resi = $_POST["residencia"];
	if(empty($_FILES["files"]["name"]))
			{
     		 	$cm_img ="";
    		}
			else
			{
				$archivo=$_FILES["files"]["tmp_name"];
				$nombreArchivo=$_FILES["files"]["name"];
				$ruta= "personas";
				$mime = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
				@$imagen = getimagesize($archivo);
  				$ancho = $imagen[0];
  				$alto = $imagen[1];
				
				$extension = end(explode('.',$nombreArchivo));
				$nombrei = $dui.".".$extension; 
				$url = $ruta."/".$nombrei;
				
				if(($ancho > 192) || ($alto > 240))
					  {
						 $cm_img = "(NO SE PUEDE SUBIR LA IMAGEN PORQUE EL TAMAÑO NO ES EL CORRECTO)";
					  }
					  elseif(!in_array($_FILES['files']['type'],$mime))
						  {
							  $cm_img = "(Ups! Solamente puedes subir imagenes con la extensi&oacute;n GIF, JPG, JPEG, PJPEG o PNG)";
						  }
						  else
						  	{
								move_uploaded_file($archivo,$ruta."/".$nombrei);
								$sqli="UPDATE candidato SET imag_can='$url' WHERE dui='$duis'";
								$exei=mysql_query($sqli);
								$cm_img = "(Imagen Cambiada)";
							}
			}
		$checkuser3 = mysql_query("SELECT dui FROM candidato WHERE dui='$dui'");
        $username_exist3 = mysql_num_rows($checkuser3);
			if ($username_exist3 > 0) 
				{
					$cm_dui =  "<font color='red'>DUI REPETIDO NO SE PUEDE EDITAR</font>";
				}
				else
				{
					$sqldd="UPDATE candidato SET dui='$dui' WHERE dui='$duis'";
					$exedd=mysql_query($sqldd);
					$cm_dui = "";
				}
		$sql2="UPDATE candidato SET nombre='$nombre',apellido='$apellido',genero='$to1',fecha_ven='$fvd',fecha_naci='$fdn',residencia='$Resi' WHERE dui='$duis'";
		$exe2=mysql_query($sql2);
		$msg =  "<div class='alert alert-success'>El candidato <b>$nombre $apellido</b> se modifico de manera satisfactoria. $cm_dui $cm_img</div>";
		$est_candidatura = "";
		$est_guardar = '';
		$est_editar = ' disabled="disabled"';
}
?>