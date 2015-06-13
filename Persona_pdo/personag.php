<?php
$conexion=mysql_connect("localhost","root","") or die ("no hay conexion");
$conectBD=mysql_select_db("prueba",$conexion)or die ("no existe BD");

if (isset($_POST['boton'])){
 $nombre = $_POST["nombre"];
   $apellido = $_POST["apellido"];
   $dui = $_POST["dui"];
   $fvd = $_POST["fvd"];
   $fdn = $_POST["fdn"];
   $depto = $_POST["depto"];
   $municipio = $_POST["municipio"];
   $to1 = $_POST["to1"];
   $Resi = $_POST["Resi"];


$ruta="imagenes";
$archivo=isset($_FILES['files']['tmp_name']);
@$nombreArchivo=$_FILES['files']['name'];
$extension = end(explode('.',$nombreArchivo));
$nombrei = $dui.".".$extension; 
$url=$ruta."/".$nombrei;
$mime = array('image/jpg', 'image/jpeg', 'image/pjpeg', 'image/gif', 'image/png');

      // Hay campos en blanco
   if($nombre==NULL|$apellido==NULL|$dui==NULL|$Resi==NULL|$url==NULL) {
      echo "<script type=\"text/javascript\">alert('Hay campos vacios');window.location.assign('par.php');</script>";

   }else{
         // Comprobamos si el nombre de usuario o la cuenta de correo ya existían
      $conexion=mysql_connect("localhost","root")or die ('Ha fallado la conexión con el servidor: '.mysql_error());
      mysql_select_db("prueba",$conexion)or die ('Error al seleccionar la Base de Datos: '.mysql_error());

         $checkuser3 = mysql_query("SELECT DUI FROM persona WHERE DUI='$dui'");
         $username_exist3 = mysql_num_rows($checkuser3);

         if ($username_exist3>0) {
            echo "<script type=\"text/javascript\">alert('el Nombre del Partido o el Dui del Representante o  el nombre de la imagen ya existe');</script>";
        
         }

 
   if( !in_array( @$_FILES['files']['type'], $mime ) )
   {
 echo "<script type=\"text/javascript\">alert('Ups! Solamente puedes subir imagenes con la extension GIF, JPG, JPEG, PJPEG o PNG');window.location.assign('par.php');</script>";
   }
         else{
          
            move_uploaded_file($_FILES['files']['tmp_name'],$ruta."/".$nombrei);

        $query = 'INSERT INTO persona (Nombres,Apellidos,DUI,Fecha_vncdui,fecha_nac,codigo_depto,codigo_muni,residencia,Genero,imag_per)
            VALUES (\''.$nombre.'\',\''.$apellido.'\',\''.$dui.'\',\''.$fvd.'\',\''.$fdn.'\',\''.$depto.'\',\''.$municipio.'\',\''.$Resi.'\',\''.$to1.'\',\''.$url.'\')';
            mysql_query($query) or die(mysql_error());

        echo 'El Votante '.$nombre.' ha sido registrado de manera satisfactoria.<br />';
       }
      }
}else{
  print 'No se ha enviado datos';
}
 
?>
