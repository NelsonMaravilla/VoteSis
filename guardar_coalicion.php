<?php
if (isset($_POST['enviar'])){
   $nombrec = $_POST["nombrec"];
   $terr=$_POST["depto"];
   $terr1=$_POST["municipio"];
   $terr2= 0 ;
   $tipo= $_POST["Can"];
 
 if($tipo == 1)
 {
	 $tipo_g = "MUNICIPALES";
 }
 elseif($tipo == 2)
 {
	 $tipo_g = "DIPUTADOS";
 }
 else
 {
	 $tipo_g = "PRESIDENCIALES";
	 }
 foreach ($_REQUEST['destino'] as $destino1)
        { 
          if($tipo==1){
    $checkuser = mysql_query("SELECT * FROM coalicion c INNER JOIN partidos_coalicion pc on c.id=pc.id_coalicion WHERE c.Tipo='$tipo' AND pc.id_partido='$destino1' AND c.codigo_loca='$terr1'");
         $username_exist = mysql_num_rows($checkuser);

} else if ($tipo==2){

    $checkuser = mysql_query("SELECT * FROM coalicion c INNER JOIN partidos_coalicion pc on c.id=pc.id_coalicion WHERE c.Tipo='$tipo' AND pc.id_partido='$destino1' AND c.codigo_loca='$terr'");
         $username_exist = mysql_num_rows($checkuser);
  
}else {
     $checkuser = mysql_query("SELECT * FROM coalicion c INNER JOIN partidos_coalicion pc on c.id=pc.id_coalicion WHERE c.Tipo='$tipo' AND pc.id_partido='$destino1' AND c.codigo_loca='$terr2'");
         $username_exist = mysql_num_rows($checkuser);
}
        
         } 
if ($username_exist>0) {
            echo "<script type=\"text/javascript\">alert('el Nombre del Partido o el Dui del Representante ya existe o  tipo de archivo no es valido ');window.location.assign('tell.php');</script>";
        
}if($username_exist==0){

  if($tipo==1){
    $query = 'INSERT INTO coalicion (Nombre_coa,Tipo, codigo_loca)
            VALUES (\''.$nombrec.'\',\''.$tipo.'\',\''.$terr1.'\')';
            mysql_query($query) or die(mysql_error());

} else if ($tipo==2){

    $query = 'INSERT INTO coalicion (Nombre_coa,Tipo, codigo_loca)
            VALUES (\''.$nombrec.'\',\''.$tipo.'\',\''.$terr.'\')';
            mysql_query($query) or die(mysql_error());
  
}else {
   $query = 'INSERT INTO coalicion (Nombre_coa,Tipo, codigo_loca)
            VALUES (\''.$nombrec.'\',\''.$tipo.'\',\''.$terr2.'\')';
            mysql_query($query) or die(mysql_error());
}

$rs = mysql_query("SELECT MAX(id) AS id FROM coalicion");

if ($row = mysql_fetch_row($rs)) {
$id = trim($row[0]);

        foreach ($_REQUEST['destino'] as $destino)
        { 
          $query = 'INSERT INTO partidos_coalicion (id_coalicion, id_partido,id_anio)
            VALUES (\''.$id.'\',\''.$destino.'\',\''.$ano.'\')';
            mysql_query($query) or die(mysql_error());


        } 
         echo '<div class="alert alert-success">La Coalicion '.$nombrec.' para las elecciones '.$tipo_g.' se registr&oacute; de manera satisfactoria.</div>'; 
 
     }
  }else{
  echo "Error";

}

}
?>
