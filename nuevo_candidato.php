 <?php
 	include("fbd/guardar_candidato.php");
	$anio = date("Y");
 ?>
 <script language="javascript" src="verif_coa/jp.js"></script>
<div class="container">
    <div class="panel panel-primary">
       <div class="panel-heading">DATOS DEL CANDIDATO:</div>
           <div class="panel-body text-justify">
    <form action="" method="post" id="fpersonac" name="fpersonac" enctype="multipart/form-data">
    <div class="row">
    <div class="col-md-6">
               <div class="form-group has-warning">
                   <label class="control-label" for="npartido">Partido al que se registrar&aacute;:</label>
                        <select name="partido" id="partido" class="form-control" required>
                            <option value="">------</option>
                            <?php
							$partidos="SELECT id_partido,iniciales_p FROM partido";
								$partidos_mos = mysql_query($partidos);
									for($p=0;$p<mysql_num_rows($partidos_mos);$p++)
										{
											$cod_par=mysql_result($partidos_mos,$p,'id_partido');
											$nom_par=utf8_encode(mysql_result($partidos_mos,$p,'iniciales_p'));
							?>
											<option value='<?php echo $cod_par;?>' <?php echo ($cod_par == $partido)?'selected':'';?>><?php echo $nom_par;?></option>";
                            <?php
										}
                			?>
                        </select>
               </div>
         </div>
    	<div class="col-md-6">
               <div class="form-group has-warning">
                    <label class="control-label" for="genero">Tipo de Candidatura:</label><br />
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
                      <label class="radio-inline">
                        <input type="radio" name="Can" id="Can" value="<?php echo $tpcan;?>"<?php echo $est_candidatura;?>> <?php echo $n_candidatura;?>
                      </label>
                      		<?php
										}
                			?>
                     
             </div>
         </div>
    </div>
    <div class="row">
    	<div class="col-md-8">
             <div class="form-group has-warning">
                  <label class="control-label" for="nom_per">Nombres:</label>
                  <input type="text" class="form-control" onkeypress="return validar_letras(event)" name="nom_per" id="nom_per" placeholder="Johan Ricardo" value="<?php echo $nombre;?>" onChange="javascript:this.value=this.value.toUpperCase();" required>
             </div>
             <div class="form-group has-warning">
                  <label class="control-label" for="ape_per">Apellidos:</label>
                  <input type="text" class="form-control"  onkeypress="return validar_letras(event)"name="ape_per" id="ape_per" placeholder="Rivera Torres" value="<?php echo $apellido;?>" onChange="javascript:this.value=this.value.toUpperCase();" required>
             </div>
             <div class="form-group has-warning">
                    <label class="control-label" for="genero">Genero:</label>
                      <label class="radio-inline">
                        <input type="radio" name="genero" id="genero" value="MASCULINO" <?php echo ($to1 == 'MASCULINO')?'checked':'';?>> Masculino
                      </label>
                      <label class="radio-inline">
                        <input type="radio" name="genero" id="genero" value="FEMENINO" <?php echo ($to1 == 'FEMENINO')?'checked':'';?>> Femenino
                      </label>
             </div>
             <div class="form-group has-warning">
                   <label class="control-label" for="files">Fotograf&iacute;a:</label>
                        <input type="file" class="form-control" name="files" id="files"<?php echo $est_img;?>>
             </div>
         </div>
         <div class="col-md-4">
              <div class="text-center" id="list"></div>
              <?php echo $archivo;?>
         </div>
    </div>
    <div class="row">
    	<div class="col-md-4">
        	<div class="form-group has-warning">
                <label class="control-label" for="dui">DUI N&ordm;:</label>
                <input type="text" class="form-control" name="dui" id="dui" placeholder="00000000-0" onKeyUp="mascara(this,'-',patron3,true)" onKeyPress="return justNumbers(event);" maxlength="10" value="<?php echo $dui;?>">
            </div>
        </div>
        <div class="col-md-4">
        	<div class="form-group has-warning">
                  <label class="control-label" for="fvd">Fecha de Vencimiento (DUI):</label>
                  <input type="date" class="form-control" name="fvd" id="fvd" placeholder="DD/MM/AAAA" value="<?php echo $fvd;?>" required>
            </div>
        </div>
        <div class="col-md-4">
        	<div class="form-group has-warning">
                  <label class="control-label" for="fdn">Fecha de Nacimiento:</label>
                  <input type="date" class="form-control" name="fdn" id="fdn" placeholder="DD/MM/AAAA" value="<?php echo $fdn;?>" required>
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
					?>
								<option value="<?php echo $cod_depa;?>" <?php echo ($cod_depa == $depto)?'selected':'';?>><?php echo $nom_depa;?></option>
                    <?php
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
         	<div id="demo2" class="form-group has-warning">
                <label class="control-label" for="municipio">Municipio:</label>
                 <select name="municipio" id="municipio" class="form-control">
                    <option value="">------</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-md-12">
            <div class="form-group has-warning">
                <label class="control-label" for="residencia">Residencia:</label>
                <textarea name="residencia" id="residencia" class="form-control" rows="3" placeholder="Lugar de donde reside" onChange="javascript:this.value=this.value.toUpperCase();" required><?php echo $Resi;?></textarea>
            </div>
         </div>
    </div>
    <div class="row">
    	<div class="col-lg-12">
        	<div class="text-center">
               	 <button type="submit" class="btn btn-info active" name="enviar"<?php echo $est_guardar;?>><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Candidatura</button>
                 <?php
				 if($tipo_user == "Administrador")
				 {
				 ?>
					 &nbsp; <button type="submit" class="btn btn-success" name="modificar"<?php echo $est_editar;?>><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                 <?php
				 }
				 ?>
                 &nbsp;<a href="#verconsulta" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-eye-open"></span> Ver Candidatos</a>
                 
            </div>
        </div>
    </div>
    </form>
    </div></div></div>
</div><br>
<div class="container">
<?php
 echo $msg;
 ?>
</div>
<!--ventana modal-->
<div class="modal fade" id="verconsulta">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
        	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" arial-hidden="true">&times;</button>
            	<h5 class="modal-title">Lista de candidatos</h5>
            </div>
            <div class="modal-body table-responsive">
            	<table class="table table-bordered">
                <thead>
                  <tr class="text-center">
                  	<td>Nombre</td>
                    <td>DUI</td>
                    <td>Partido</td>
                    <td>Acciones</td>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $ver_candidatos = "SELECT * FROM candidato WHERE id_anoe='$anio'" ;
                    $candidatos = mysql_query($ver_candidatos);
					$cuantocd = mysql_num_rows($candidatos);
					if($cuantocd == 0)
					{
				  ?>
                  <tr>
                  	<td colspan="3">Nombre</td>
                  </tr>
                  <?php
					}
					else
					{
						for($cd=0;$cd<mysql_num_rows($candidatos);$cd++)
						{
							$nombre = mysql_result($candidatos,$cd,'nombre');
							$apellido = mysql_result($candidatos,$cd,'apellido');
							$dui = mysql_result($candidatos,$cd,'dui');
							$partido_res = mysql_result($candidatos,$cd,'id_partido');
							$idcan = mysql_result($candidatos,$cd,'id_candidato');
						echo "<tr>
								 <td>$nombre $apellido</td>
								 <td>$dui</td>
								 <td>";
							echo iniciales_partido($partido_res);
						echo "	</td>";
						echo "<td>";
						if($tipo_user == "Administrador")
				 		{
						echo "<a href='?page=candidatos&accion=editar&can=$idcan'>Editar</a> / <a href='?page=candidatos&accion=eliminar&can=$idcan'>Eliminar</a>";
						}
						echo "</td>";
						echo "</tr>";
						}
					}
					?>
                  </tbody>
                </table>
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-primary" data-dismiss="modal">cerrar</button>
                <a href="#" class="btn btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">


//codigo para generar municipios
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

 function validar_letras(e) 
    { 
        tecla=(document.all)?e.keyCode:e.which; 
        patron=/[A-Z a-z áÁéÉíÍóÓúÚüÜñÑ]/; 
        te=String.fromCharCode(tecla); 
        return patron.test(te); 
    }
</script>