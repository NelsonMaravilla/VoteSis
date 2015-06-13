 <script language="javascript" src="verif_coa/jp.js"></script>
<div class="container">
	<div class="panel panel-primary">
       <div class="panel-heading">DATOS DE LA COALICION A REGISTRAR</div>
           <div class="panel-body text-justify">
    <form action="" method="post" id="fcoaliciones" name="fcoaliciones">
    <div class="row">
    	<div class="col-sm-12 col-md-12">
               <div class="form-group has-warning">
                   <label class="control-label" for="npartido">Tipo de Candidatura a laque pertenece la Coalicion</label>
                        <select name="Can" id="Can" class="form-control" onChange="mostrar(this.value);" required>
                        		<option value="">--------</option>
                        <?php
								$candidaturas_activas="SELECT * FROM elecciones_activas WHERE ano='$ano' AND estado='ACTIVADO'";
								$canactivas = mysql_query($candidaturas_activas);
									for($cac=0;$cac<mysql_num_rows($canactivas);$cac++)
										{
											$tpcan=mysql_result($canactivas,$cac,'tipo');
											if($tpcan == 1)
												{
													$n_candidatura ="MUNICIPALES";
												}
												elseif($tpcan == 2)
												{
													$n_candidatura ="DIPUTADOS";
												}
												else
												{
													$n_candidatura ="PRESIDENCIALES";
												}
						?>
												 <option  value="<?php echo $tpcan;?>" ><?php echo $n_candidatura;?></option>
                        <?php
										}
						?>
                        </select>
               </div>
         </div>
    </div>
    <div class="row">
    	<div class="col-md-6">
        	<div id="demo1" style="display: inline;" class="form-group has-warning">
               <label class="control-label" for="departamento"> Departamento: </label>
                <select name="depto" id="depto" class="form-control" required>
                    <option value="">--------</option>
                    <?php
					$departamento="SELECT * FROM departamentos";
					$depa_mos = mysql_query($departamento);
						for($d=0;$d<mysql_num_rows($depa_mos);$d++)
							{
								$cod_depa=mysql_result($depa_mos,$d,'codigo');
								$nom_depa=utf8_encode(mysql_result($depa_mos,$d,'nombre'));
								
								echo "<option value='$cod_depa'>$nom_depa</option>";
							}
					/*
                    $result = $conexion->query("SELECT * FROM departamentos");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="'.$row['codigo'].'">'.utf8_encode($row['nombre']).'</option>';
                        }
                    }*/
                    ?>
                
                </select>
			</div>
        </div>
        <div class="col-md-6">
         	<div id="demo2" style="display: inline;" class="form-group has-warning">
                <label class="control-label" for="municipio">Municipio:</label>
                 <select name="municipio" id="municipio" class="form-control">
                    <option value="">------</option>
                
                </select>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-sm-12 col-md-12">
            <div class="form-group has-warning">
                       <label class="control-label" for="nombrec">Nombre de la Coalici&oacute;n:</label>
                            <input type="text" class="form-control" name="nombrec" id="nombrec" placeholder="Nombre de la Coalici&oacute;n" required>
            </div>
         </div>
    </div>
    <div class="row">
        <div class="col-md-5">
        	<div class="form-group">
            	<label class="control-label" for="partidosc">Partidos:</label>
                <select name="origen[]" id="origen" class="form-control pasar izq" multiple="multiple" size="8">
				<?php
				$partidos="SELECT id_partido,iniciales_p FROM partido WHERE NOT iniciales_p='N/P'";
					$partidos_mos = mysql_query($partidos);
						for($p=0;$p<mysql_num_rows($partidos_mos);$p++)
							{
								$cod_par=mysql_result($partidos_mos,$p,'id_partido');
								$nom_par=utf8_encode(mysql_result($partidos_mos,$p,'iniciales_p'));
								
								echo "<option value='$cod_par'>$nom_par</option>";
							}
                ?>
                </select>
            </div>
        </div>
        <div class="col-md-2 text-center">
        	<!-- Grupo de Botones-->
            <div class="btn-group-vertical form-group btn-group-lg" role="group" aria-label="...">
              <button type="button" class="btn btn-danger quitartodos der"><span class="glyphicon glyphicon-backward"></span> Quitar Todos</button>
            </div>
        </div>
        <div class="col-md-5">
        	<div class="form-group">
            	<label class="control-label" for="partidosc">Partidos a coalicionar:</label>
                <select name="destino[]" id="destino" multiple="multiple" class="form-control quitar der" size="8"></select>
            </div>
        </div>
  	</div>
    <div class="row">
    	<div class="col-lg-12">
        	<div class="text-center">
               	 <button type="submit" class="btn btn-info" name="enviar" onClick="valida()"><span class="glyphicon glyphicon-floppy-disk"></span> Crear Coalici&oacute;n</button>
                 <?php
				 if($tipo_user == "Administrador")
				 {
				 ?>
					 &nbsp; <button type="submit" class="btn btn-success" name="modificar" disabled="disabled"><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                     &nbsp; <button type="submit" class="btn btn-danger" name="borrar" disabled="disabled"><span class="glyphicon glyphicon-trash"></span> Borrar</button>
                 <?php
				 }
				 ?>
                 &nbsp;<a href="#" class="btn btn-primary" role="button"><span class="glyphicon glyphicon-eye-open"></span> Ver Coaliciones</a>
            </div>
        </div>
    </div>
    <!--           <div class="form-group has-warning">
                   <label class="control-label" for="Ini">Iniciales del partido (Siglas):</label>
                        <input type="text" class="form-control" name="Ini" id="Ini" placeholder="SIGLAS" value="<?php echo $Ini;?>">
               </div>
               <div class="form-group has-warning">
                   <label class="control-label" for="representante">Representante del Partido:</label>
                        <input type="text" class="form-control" name="representante" id="representante" placeholder="nombre del Representante del Partido" value="<?php echo $representante;?>">
               </div>
               <div class="form-group has-warning">
                   <label class="control-label" for="dui">DUI Representante:</label>
                        <input type="text" class="form-control" name="dui" id="dui" placeholder="00000000-0" onKeyUp="mascara(this,'-',patron3,true)" onKeyPress="return justNumbers(event);" maxlength="10" value="<?php echo $dui;?>">
               </div>
                <div class="form-group has-warning">
                   <label class="control-label" for="img">Bandera del partido:</label>
                        <input type="file" class="form-control" name="files" id="files">
               </div>
               <div class="text-center" id="list"></div><br>
               <div class="text-center">
               	 <button type="submit" class="btn btn-info" name="enviar"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
               </div>-->
    </form>
    </div></div></div>
</div><br>
<div class="container">
<?php
 	include("guardar_coalicion.php");
 ?>
</div>
<script type="text/javascript">
//validar u combinar partidos para coalicion
function valida(){ 
    if (document.forms['formulario']['destino[]'].length  <=1 ) 
     alert("debe por lo menos escojer 2 opciones"); 
} 

$().ready(function() 
	{
		$('.pasar').click(function() { return !$('#origen option:selected').remove().appendTo('#destino'); });  
		$('.quitar').click(function() { return !$('#destino option:selected').remove().appendTo('#origen'); });
		$('.pasartodos').click(function() { $('#origen option').each(function() { $(this).remove().appendTo('#destino'); }); });
		$('.quitartodos').click(function() { $('#destino option:selected').each(function() { $(this).remove().appendTo('#origen'); }); });
		$('.submit').click(function() { $('#destino option').prop('selected', 'selected'); });
	});
//codigo para generar municipios
 $(document).ready(function(){
        $("#depto").change(function () {
            $("#depto option:selected").each(function () {
                id_depto = $(this).val();
                $.post("verif_coa/municipios.php", { id_depto: id_depto }, function(data){
                    $("#municipio").html(data);
                });
            });
        })
    });
</script>