<?php include 'Coneccion.php';
$conexion = new mysqli('localhost', 'root', '', 'prueba');
?>
<script language="javascript" src="jp.js"></script>
<script type="text/javascript" src="jquery2.js"></script>
<script type="text/javascript">
function mostrar(id) {
	if (id == "1") {
		$("#demo1").show();
		$("#demo2").show();
	}
	
	if (id == "2") {
		$("#demo1").show();
		$("#demo2").hide();
	}
	
	if (id == "3") {
		$("#demo1").hide();
		$("#demo2").hide();
	}
}
	
</script>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
	<style>
	body{width:600px;margin:0 auto;overflow-x:hiden;}
	select{width:180px;margin:0 0 50px 0;border:1px solid #ccc;padding:10px;border-radius:10px 0 0 10px;}
	.clear{clear:both;text-align:center}
	div{float:left;width:200px;text-align:center}
	input {margin:25px 1px 0 1px;border:1px solid #ccc;padding:10px;}
	.izq{border-radius:10px 0 0 10px;}
	.der{border-radius:0 10px 10px 0;}
	</style>
	</head>
<form action="guarcoa.php" method="post" id="formulario">
<label >Tipo de Candidatura a laque pertenece la Coalicion:</label>
 <select name="Can" id="Can"  onChange="mostrar(this.value);" required >
    <option  value="1" >Municipal</option>
    <option value="2">Diputado</option>
     <option value="3">Presidente</option>
</select><br><br>
<div id="demo1" style="display: inline;">
Departamento: 
<select name="depto" id="depto" required>
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
</div>
 <div id="demo2" style="display: inline;">
 <script language="javascript" src="jp.js"></script>
Municipio:
 <select name="municipio" id="municipio" required>
    <option value="">------</option>

</select><br />
</div>
<br><br><br><br><br><br>
Nombre de la Coalición: 
  <input type="text" name="nombrec" size="30" maxlength="20" required /><br /><br />

 <br /><br />
<div>
<select name="origen[]" id="origen" class="pasar izq"  multiple="multiple" size="8">
<?php
							$sql =  "SELECT id,Nombre_Partido FROM partido;";
							$datos = consultaD($con, $sql);
							foreach ($datos as $value) {
								print "<option value='";
								print $value['id'];
								print "'>";
								print $value['Nombre_Partido'];
								print "</option>";
							}
                           ?>
</select>
</div>
<div>
<input type="button" class="pasartodos izq" value="Todos »"><input type="button" class="quitartodos der" value="« Todos">
</div>
<div class="">
<select name="destino[]" id="destino" multiple="multiple" class="quitar der" size="8" required></select>
</div>
<p class="clear"><input type="submit" class="submit" value="Procesar formulario" name="boton" onClick="valida()"></p>
</form>

<script type="text/javascript">
function valida(){ 
    if (document.forms['formulario']['destino[]'].length  <=1 ) 
     alert("debe por lo menos escojer 2 opciones"); 
} 

$().ready(function() 
	{
		$('.pasar').click(function() { return !$('#origen option:selected').remove().appendTo('#destino'); });  
		$('.quitar').click(function() { return !$('#destino option:selected').remove().appendTo('#origen'); });
		$('.pasartodos').click(function() { $('#origen option').each(function() { $(this).remove().appendTo('#destino'); }); });
		$('.quitartodos').click(function() { $('#destino option').each(function() { $(this).remove().appendTo('#origen'); }); });
		$('.submit').click(function() { $('#destino option').prop('selected', 'selected'); });
	});

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