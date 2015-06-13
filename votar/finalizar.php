<?php
	session_start () ; 
	include("../config/conexion.php");
	//destruyendo la session
	
	$des_offline=$_GET["id"];
	$sql2="UPDATE persona SET estado='SI' WHERE DUI='$des_offline'";
	$exe2=mysql_query($sql2);
	
	session_destroy () ;
	header ("Location: index.php");
	exit;
?>