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
   
   	$est_img = " required";
	$est_guardar = "";
	$est_editar = ' disabled="disabled"';
	
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
							  	$checkuser3 = mysql_query("SELECT DUI FROM persona WHERE DUI='$dui'");
         						$username_exist3 = mysql_num_rows($checkuser3);
								
									if ($username_exist3 > 0) 
										{
											$msg =  "<div class='alert alert-danger'>ESTE DUI YA ESTA REGISTRADO EN NUESTRA BASE DE DATOS</div>";
										}
										else
										{
											//guardar los datos
											$query = 'INSERT INTO persona(Nombres,Apellidos,DUI,Fecha_vncdui,fecha_nac,codigo_depto,codigo_muni,residencia,Genero,imag_per) VALUES (\''.$nombre.'\',\''.$apellido.'\',\''.$dui.'\',\''.$fvd.'\',\''.$fdn.'\',\''.$depto.'\',\''.$municipio.'\',\''.$Resi.'\',\''.$to1.'\',\''.$url.'\')';
            								mysql_query($query) or die(mysql_error());
											//subir imagen a la carpeta del servidor
											move_uploaded_file($_FILES['files']['tmp_name'],$ruta."/".$nombrei);
											
											$msg =  "<div class='alert alert-success'>El Votante $nombre $apellido con DUI: $dui ha sido registrado de manera satisfactoria.</div>";
											
											$nombre = "";
											$apellido = "";
											$to1 = "";
											$dui = "";
											$fvd = "";
											$fdn = "";
											$depto = "";
											$Resi = "";
											$imag = "";
											$est_img = " required";
											$est_guardar = "";
											$est_editar = ' disabled="disabled"';
										}
						  }
}
elseif(isset($_GET["accion"]))
{
	$accion_t = $_GET["accion"];
	$idpersonad = $_GET["persona"];
	
	if($accion_t == "editar")
	{
		$ver_candi = "SELECT * FROM persona WHERE id='$idpersonad'" ;
        $candi = mysql_query($ver_candi);
			for($vvc=0;$vvc<mysql_num_rows($candi);$vvc++)
						{
							$nombre = mysql_result($candi,$vvc,'Nombres');
							$apellido = mysql_result($candi,$vvc,'Apellidos');
							$to1 = mysql_result($candi,$vvc,'Genero');
							$dui = mysql_result($candi,$vvc,'DUI');
							$fvd = mysql_result($candi,$vvc,'Fecha_vncdui');
							$fdn = mysql_result($candi,$vvc,'fecha_nac');
							$depto = mysql_result($candi,$vvc,'codigo_depto');
							$municipio = mysql_result($candi,$vvc,'codigo_muni');
							$Resi = mysql_result($candi,$vvc,'residencia');
							$img_c = mysql_result($candi,$vvc,'imag_per');
						
							$imag = "<div class='text-center' id='list_2'><img class='thumb img-responsive img-thumbnail' src='$img_c' /></div>";
							$est_img = "";
							$est_candidatura = ' disabled="disabled"';
							$est_guardar = ' disabled="disabled"';
							$est_editar = '';
						}
				$msg = "";
	}
	
	if($accion_t == "eliminar")
	{
		$ddp = $_GET["iden"];
		$ver_candi = "SELECT * FROM voto_persona WHERE dui='$ddp'" ;
        $candi = mysql_query($ver_candi);
		$cant_voto = mysql_num_rows($candi);
							if($cant_voto == 0)
								{
									$quitar_eqd = "DELETE FROM persona WHERE id='$idpersonad'";
									$okq = mysql_query($quitar_eqd);
									$msg =  "<div class='alert alert-success'>La persona se ELIMINO de manera satisfactoria.</div>";
								}
								else
								{
									$msg =  "<div class='alert alert-danger'>lo sentimos, pero no se puede eliminar esta persona porque ya emitio su respectivo sufragio.</div>";
								}

	$nombre = "";
    $apellido = "";
    $to1 = "";
    $dui = "";
    $fvd = "";
    $fdn = "";
	$depto = "";
    $Resi = "";
	$imag = "";
	$est_img = " required";
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
    $Resi = "";
	$imag = "";
	$est_img = " required";
	$est_guardar = "";
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
	//cambiando la imagen
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
								$sqli="UPDATE persona SET imag_per='$url' WHERE dui='$duis'";
								$exei=mysql_query($sqli);
								$cm_img = "(Imagen Cambiada)";
							}
			}
		$checkuser3 = mysql_query("SELECT DUI FROM persona WHERE DUI='$dui'");
        $username_exist3 = mysql_num_rows($checkuser3);
			if ($username_exist3 > 0) 
				{
					$cm_dui =  "<font color='red'>DUI REPETIDO NO SE PUEDE EDITAR</font>";
				}
				else
				{
					$sqldd="UPDATE persona SET DUI='$dui' WHERE DUI='$duis'";
					$exedd=mysql_query($sqldd);
					$cm_dui = "";
				}
		$sql2="UPDATE persona SET Nombres='$nombre',Apellidos='$apellido',Genero='$to1',Fecha_vncdui='$fvd',fecha_nac='$fdn',residencia='$Resi' WHERE DUI='$duis'";
		$exe2=mysql_query($sql2);
		$msg =  "<div class='alert alert-success'>La perdona con el nombre de: <b>$nombre $apellido</b> se modifico de manera satisfactoria. $cm_dui $cm_img</div>";
		$est_candidatura = "";
		$est_guardar = '';
		$est_editar = ' disabled="disabled"';
}
?>