<?php
$conexion=mysql_connect("localhost","root","") or die ("no hay conexion");
$conectBD=mysql_select_db("prueba",$conexion)or die ("no existe BD");

if (isset($_POST['boton'])){
   $nombrec = $_POST["nombrec"];
   $terr=$_POST["depto"];
   $terr1=$_POST["municipio"];
   $terr2= 0 ;
   $tipo= $_POST["Can"];
  
 foreach ($_REQUEST['destino'] as $destino1)
        { 
          if($tipo==1){
    $checkuser = mysql_query("SELECT * FROM coalicion c INNER JOIN partidos_pc pc on c.id=pc.id_coa WHERE c.Tipo='$tipo' AND pc.id_partido='$destino1' AND c.codigo_loca='$terr1'");
         $username_exist = mysql_num_rows($checkuser);

} else if ($tipo==2){

    $checkuser = mysql_query("SELECT * FROM coalicion c INNER JOIN partidos_pc pc on c.id=pc.id_coa WHERE c.Tipo='$tipo' AND pc.id_partido='$destino1' AND c.codigo_loca='$terr'");
         $username_exist = mysql_num_rows($checkuser);
  
}else {
     $checkuser = mysql_query("SELECT * FROM coalicion c INNER JOIN partidos_pc pc on c.id=pc.id_coa WHERE c.Tipo='$tipo' AND pc.id_partido='$destino1' AND c.codigo_loca='$terr2'");
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
          $query = 'INSERT INTO partidos_pc (id_coa, id_partido)
            VALUES (\''.$id.'\',\''.$destino.'\')';
            mysql_query($query) or die(mysql_error());


        } 
         echo 'La Coalicion '.$nombrec.' ha sido registrado de manera satisfactoria.<br />'; 
 
     }
  }else{
  echo "Error";

}

}
?>
