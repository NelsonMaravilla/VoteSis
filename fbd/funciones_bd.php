<?php
if(isset($_POST["enviar"]))
{
	$archivo=$_FILES["files"]["tmp_name"];
	$nombreArchivo=$_FILES["files"]["name"];
	$url= "imagenes/".$nombreArchivo;
	//campos
	$m_idpar = "";
	$npartido = $_POST["npartido"];
	$Ini = $_POST["Ini"];
	$representante = $_POST["representante"];
	$dui = $_POST["dui"];
	$mostrar_nombrep = $_POST["npartido"];
	$est_img = " required";
	$est_guardar = "";
	$est_editar = ' disabled="disabled"';
	
@$imagen = getimagesize($archivo);    //Sacamos la información
  $ancho = $imagen[0];              //Ancho
  $alto = $imagen[1];               //Altoç
  
  if(($npartido == "") OR ($Ini == "") OR ($representante == "") OR ($dui == ""))
  {
	  $msg = "<div class='alert alert-danger'>TODOS LOS CAMPOS SON OBLIGATORIOS</div>";
  }
  elseif(empty($archivo))
  {
	$npartido = $_POST["npartido"];
	$Ini = $_POST["Ini"];
	$representante = $_POST["representante"];
	$dui = $_POST["dui"];
	
	  $msg = "<div class='alert alert-danger'>NO A SELECCIONADO LA IMAGEN</div>";
  }
  else
  { 
  
	  if(($ancho > 200) || ($alto > 144))
	  {
		 $msg = "<div class='alert alert-warning'>NO SE PUEDE SUBIR LA IMAGEN PORQUE EL TAMAÑO NO ES EL CORRECTO</div>";
	  }
		  else
		  {
			//Verificando datos en la Base de datos
			$verificar_partido = "SELECT * FROM partido WHERE nombre_partido='$npartido' OR dui_representante='$dui' OR url='$url' OR iniciales_p='$Ini'";
			$verificadop = mysql_query($verificar_partido);
			$sipartido = mysql_num_rows($verificadop);
			if( $sipartido > 0)
			{
				$npartido = $_POST["npartido"];
				$Ini = $_POST["Ini"];
				$representante = $_POST["representante"];
				$dui = $_POST["dui"];
				$msg = "<div class='alert alert-danger'>EL NOMBRE O EL PARTIDO O EL DUI DEL REPRESENTANTE O LA IMAGEN YA EXISTEN EN EL SISTEMA, POR FAVOR VERIFIQUE</div>";
			}
			else
			{
				 move_uploaded_file($archivo,"imagenes/".$nombreArchivo);
				 
				$sql1="INSERT INTO partido(nombre_partido,representante,dui_representante,iniciales_p,url) VALUES('$npartido','$representante','$dui','$Ini','$url')";
				$resul=mysql_query($sql1);
					$m_idpar = "";
					$npartido = "";
					$Ini = "";
					$representante = "";
					$dui = "";
					$imag = "";	
					$est_img = " required";
					$est_guardar = "";
					$est_editar = ' disabled="disabled"';
					$msg = "<div class='alert alert-success'>El partido $mostrar_nombrep se agrego satisfactoriamente</div>";
			}
		  }
  }
}
elseif(isset($_GET["accion"]))
{
	$accion_t = $_GET["accion"];
	$idpar = $_GET["partido"];
	
	if($accion_t == "editar")
	{
		$ver_candi = "SELECT * FROM partido WHERE id_partido='$idpar'" ;
        $candi = mysql_query($ver_candi);
			for($vvc=0;$vvc<mysql_num_rows($candi);$vvc++)
						{
							$npartido = mysql_result($candi,$vvc,'nombre_partido');
							$Ini = mysql_result($candi,$vvc,'iniciales_p');
							$representante = mysql_result($candi,$vvc,'representante');
							$dui = mysql_result($candi,$vvc,'dui_representante');
							$img_c = mysql_result($candi,$vvc,'url');
							$m_idpar = mysql_result($candi,$vvc,'id_partido');
						
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
		$ver_candi = "SELECT * FROM candidato WHERE id_partido='$idpar'" ;
        $candi = mysql_query($ver_candi);
		$cant_voto = mysql_num_rows($candi);
							if($cant_voto == 0)
								{
									$quitar_eqd = "DELETE FROM partido WHERE id_partido='$idpar'";
									$okq = mysql_query($quitar_eqd);
									$msg =  "<div class='alert alert-success'>El partido se ELIMINO de manera satisfactoria.</div>";
								}
								else
								{
									$msg =  "<div class='alert alert-danger'>lo sentimos, pero no se puede eliminar el partido porque ya contiene candidatos registrados.</div>";
								}

	$m_idpar = "";
	$npartido = "";
	$Ini = "";
	$representante = "";
	$dui = "";
	$imag = "";
	$est_img = " required";
	$est_guardar = "";
	$est_editar = ' disabled="disabled"';
	}
}
else
{
	$m_idpar = "";
	$npartido = "";
	$Ini = "";
	$representante = "";
	$dui = "";
	$imag = "";
	$est_img = " required";
	$est_guardar = "";
	$est_editar = ' disabled="disabled"';
	$msg = "";
}
if(isset($_POST["modificar"]))
{	
	$m_idpar = $_POST["idpartido"];
	$npartido = $_POST["npartido"];
	$Ini = $_POST["Ini"];
	$representante = $_POST["representante"];
	$dui = $_POST["dui"];
	    if(empty($_FILES["files"]["name"]))
			{
     		 	$cm_img ="";
    		}
			else
			{
				$archivo=$_FILES["files"]["tmp_name"];
				$nombreArchivo=$_FILES["files"]["name"];
				$url= "imagenes/".$nombreArchivo;
				$mime = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');
				@$imagen = getimagesize($archivo);
  				$ancho = $imagen[0];
  				$alto = $imagen[1];
				
				if(($ancho > 200) || ($alto > 144))
					  {
						 $cm_img = "(NO SE PUEDE SUBIR LA IMAGEN PORQUE EL TAMAÑO NO ES EL CORRECTO)";
					  }
					  elseif(!in_array($_FILES['files']['type'],$mime))
						  {
							  $cm_img = "(Ups! Solamente puedes subir imagenes con la extensi&oacute;n GIF, JPG, JPEG, PJPEG o PNG)";
						  }
						  else
						  	{
								move_uploaded_file($archivo,"imagenes/".$nombreArchivo);
								$sqli="UPDATE partido SET url='$url' WHERE id_partido='$m_idpar'";
								$exei=mysql_query($sqli);
								$cm_img = "(Imagen Cambiada)";
							}
			}
		$checkuser3 = mysql_query("SELECT dui_representante FROM partido WHERE dui='$dui'");
        $username_exist3 = mysql_num_rows($checkuser3);
			if ($username_exist3 > 0) 
				{
					$cm_dui =  "<font color='red'>DUI REPETIDO NO SE PUEDE EDITAR</font>";
				}
				else
				{
					$sqldd="UPDATE partido SET dui_representante='$dui' WHERE id_partido='$m_idpar'";
					$exedd=mysql_query($sqldd);
					$cm_dui = "";
				}
		$sql2="UPDATE partido SET nombre_partido='$npartido',iniciales_p='$Ini',representante='$representante',dui_representante='$dui' WHERE id_partido='$m_idpar'";
		$exe2=mysql_query($sql2);
		$msg =  "<div class='alert alert-success'>El partido <b>$Ini</b> se modifico de manera satisfactoria. $cm_img</div>";
		$est_candidatura = "";
		$est_guardar = '';
		$est_editar = ' disabled="disabled"';
}
?>