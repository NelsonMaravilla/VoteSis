<?php include 'Coneccion.php';
$conexion = new mysqli('localhost', 'root', '', 'prueba');
?>
<!doctype html>
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>formulario de captura de datos de Alumnos</title>
        <link rel="stylesheet"  href="oto.css">
     <script language="javascript" src="jquery.js"></script>



      
            </head>
<style>
          .thumb {
            height: 150px;
            border: 1px solid #000;
            margin: 10px 5px 0 0;
          }
        </style>
        <body>
        <div class="contenedor">
<form class="contact_form" method="post" action="personag.php" enctype="multipart/form-data">


    <ul>

       <li>

            <h2>Registro de Votantes</h2>

       </li>

             
      

       <li>
    <label>Elige Imagen:</label> 
        <input type="file" id="files" name="files" />

         <center><output id="list"></output></center>
</li>

   

                     </li>

  <li>
          <label>Nombres:</label>

           <input type="text"  placeholder="Johan Ricardo" name="nombre" required /><br><br>

       </li>

       <li>
    

           <label >Apellidos:</label>

           <input type="text" name="apellido" placeholder="Rivera Torres" required />

       </li>

       <li>

        <label > Numero de DUI  </label>
        <input type="text" name = "dui" onkeyup="mascara(this,'-',patron3,true)" onkeypress="return justNumbers(event);" maxlength="10" placeholder="00000000-0" required pattern="[0-9]{8}[-]{1}[0-9]{1}" title="coloque los 9 digitos de su Dui el guion se generara solo."   /> <br><br>

</li>
<li>
           <label >Fecha de Vencimiento (DUI):</label><br>

           <input type="date" name="fvd"  required /><br><br>

       </li>

       <li>
           <label >Fecha de Nacimiento:</label><br>

           <input type="date" name="fdn"  required /><br><br>

       </li>

<li>

           <label> Genero:</label><br><br>

           <label >Masculino:</label><input type="radio" name="to1" Value="Masculino"  required /><br><br>
         <label>Femenino:</label><input type="radio"  name="to1" Value="Femenino" required />
           

       </li>

  <li>
       <label>Departamento:</label>
  <select name="depto" id="depto" required >
    <option value="">--------</option>
    <?php
    $result = $conexion->query("SELECT * FROM departamentos");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<option value="'.$row['codigo'].'">'.utf8_encode($row['nombre']).'</option>';
        }
    }
    ?>

</select>
</li>

<li>
  
          
 <label >Municipio:</label>
 <select name="municipio" id="municipio" required >
    <option value="">------</option>

</select>
        </li>


        <li>

   


           <textarea name="Resi" cols="40" rows="6" required ></textarea>

         <label >Residencia:</label>


 <br> <br>

        </li>
 <li>
<button class="submit" type="submit" name="boton">Guardar</button>
 </li>
    </ul>

</form>
</div>
 <script>
 function justNumbers(e)
{
var keynum = window.event ? window.event.keyCode : e.which;
if ((keynum == 8) || (keynum == 46))
return true;
 
return /\d/.test(String.fromCharCode(keynum));
document.tree.miSelect.options[indice].text
}
var patron = new Array(2,2,4)
var patron2 = new Array(1,3,3,3,3)
var patron3 = new Array(8,1)
function mascara(d,sep,pat,nums){
if(d.valant != d.value){
  val = d.value
  largo = val.length
  val = val.split(sep)
  val2 = ''
  for(r=0;r<val.length;r++){
    val2 += val[r]  
  }
  if(nums){
    for(z=0;z<val2.length;z++){
      if(isNaN(val2.charAt(z))){
        letra = new RegExp(val2.charAt(z),"g")
        val2 = val2.replace(letra,"")
      }
    }
  }
  val = ''
  val3 = new Array()
  for(s=0; s<pat.length; s++){
    val3[s] = val2.substring(0,pat[s])
    val2 = val2.substr(pat[s])
  }
  for(q=0;q<val3.length; q++){
    if(q ==0){
      val = val3[q]
    }
    else{
      if(val3[q] != ""){
        val += sep + val3[q]
        }
    }
  }
  d.value = val
  d.valant = val
  }
}

              function archivo(evt) {
                  var files = evt.target.files; // FileList object
             
                  // Obtenemos la imagen del campo "file".
                  for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
             
                    var reader = new FileReader();
             
                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen
                         document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                        };
                    })(f);
             
                    reader.readAsDataURL(f);
                  }
              }
             
              document.getElementById('files').addEventListener('change', archivo, false);

                $(document).ready(function(){
        $("#depto").change(function () {
            $("#depto option:selected").each(function () {
                id_depto = $(this).val();
                $.post("municipios.php", { id_depto: id_depto }, function(data){
                    $("#municipio").html(data);
                });
            });
        })
    });
      </script>


    
    </body>
</html>