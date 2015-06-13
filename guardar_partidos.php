<?php
	$archivo=$_FILES["files"]["tmp_name"];
	$nombreArchivo=$_FILES["files"]["name"];
	
$imagen = getimagesize($archivo);    //Sacamos la información
  $ancho = $imagen[0];              //Ancho
  $alto = $imagen[1];               //Altoç
  
  echo "<div class='alert alert-success'>el alto de la images es:$alto <br>el ancho de la imagen es: $ancho</div>";
?>