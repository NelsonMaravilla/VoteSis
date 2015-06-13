 <?php
 	include("fbd/guardar_persona_natural.php");
 ?>
 <script language="javascript" src="verif_coa/jp.js"></script>
<div class="container">
    <div class="panel panel-primary">
       		<div class="panel-heading">DATOS DE LA PERSONA A REGISTRAR EN EL PADRON:</div>
           	<div class="panel-body text-justify">
    <form action="" method="post" id="fpersona" name="fpersona" enctype="multipart/form-data">
    <div class="row">
    	<div class="col-md-8">
             <div class="form-group has-warning">
                  <label class="control-label" for="nom_per">Nombres:</label>
                  <input  type="text" onkeypress="return validar_letras(event)" class="form-control" name="nom_per" id="nom_per" placeholder="Johan Ricardo" value="<?php echo $nombre;?>" onChange="javascript:this.value=this.value.toUpperCase();" required>
             </div>
             <div class="form-group has-warning">
                  <label class="control-label" for="ape_per">Apellidos:</label>
                  <input type="text"  class="form-control" name="ape_per" id="ape_per" placeholder="Rivera Torres" value="<?php echo $apellido;?>" onChange="javascript:this.value=this.value.toUpperCase();" onkeypress="return validar_letras(event)" required>
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
              <?php echo $imag;?>
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
								<option value="<?php echo $cod_depa;?>"<?php echo ($cod_depa == $depto)?'selected':'';?>><?php echo $nom_depa;?></option>";
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
         	<div id="demo2" style="display: inline;" class="form-group has-warning">
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
                <textarea name="residencia" id="residencia" onkeypress="return validar_letras(event)"  class="form-control" rows="3" placeholder="Lugar de donde reside" onChange="javascript:this.value=this.value.toUpperCase();" required><?php echo $Resi;?></textarea>
            </div>
         </div>
    </div>
    <div class="row">
    	<div class="col-lg-12">
        	<div class="text-center">
               	 <button type="submit" class="btn btn-info" name="enviar"<?php echo $est_guardar;?>><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Persona</button>
                 <?php
				 if($tipo_user == "Administrador")
				 {
				 ?>
					 &nbsp; <button type="submit" class="btn btn-success" name="modificar"<?php echo $est_editar;?>><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                 <?php
				 }
				 ?>
                 &nbsp;<a href="#verconsulta" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-eye-open"></span> Ver Lista de personas</a>
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
            	<h5 class="modal-title">PADRON ELECTORAL <?php echo $ano;?></h5>
            </div>
            <div class="modal-body table-responsive">
            	<table class="table table-bordered">
                <thead>
                  <tr class="text-center">
                  	<td>Nombre</td>
                    <td>DUI</td>
                    <td>Genero</td>
                    <td>Acciones</td>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $ver_person = "SELECT * FROM persona" ;
                    $person = mysql_query($ver_person);
					$cuantopr = mysql_num_rows($person);
					if($cuantopr == 0)
					{
				  ?>
                  <tr>
                  	<td colspan="3">No hay registro de personas en el padr&oacute;n </td>
                  </tr>
                  <?php
					}
					else
					{
						for($pr=0;$pr<mysql_num_rows($person);$pr++)
						{
							$nombre = mysql_result($person,$pr,'Nombres');
							$apellido = mysql_result($person,$pr,'Apellidos');
							$dui = mysql_result($person,$pr,'DUI');
							$id_person = mysql_result($person,$pr,'id');
							$genero = mysql_result($person,$pr,'Genero');
						echo "<tr>
								 <td>$nombre $apellido</td>
								 <td>$dui</td>
								 <td>";
							echo $genero;
						echo "	</td>";
						echo "<td>";
						if($tipo_user == "Administrador")
				 		{
						echo "<a href='?page=persona-natural&accion=editar&persona=$id_person'>Editar</a> / <a href='?page=persona-natural&accion=eliminar&persona=$id_person&iden=$dui'>Eliminar</a>";
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
 function validar_letras(e) 
    { 
        tecla=(document.all)?e.keyCode:e.which; 
        patron=/[A-Z a-z áÁéÉíÍóÓúÚüÜñÑ]/; 
        te=String.fromCharCode(tecla); 
        return patron.test(te); 
    }

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