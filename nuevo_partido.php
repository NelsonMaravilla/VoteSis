		<?php
			include("fbd/funciones_bd.php");
		?>
<div class="container">
        <div class="panel panel-primary">
       		<div class="panel-heading">DATOS DEL NUEVO PARTIDO:</div>
           	<div class="panel-body text-justify">
        	<form action="" method="post" id="fpartidos" name="fpartidos" enctype="multipart/form-data">
            <input type='hidden' name='idpartido' value='<?php echo $m_idpar;?>'>
            <div class="row">
    			<div class="col-md-6">
                   <div class="form-group has-warning">
                       <label class="control-label" for="npartido">Nombre del partido</label>
                            <input type="text" class="form-control" onkeypress="return validar_letras(event)" name="npartido" id="npartido" placeholder="Nombre del partido a ingresar" value="<?php echo $npartido;?>" onChange="javascript:this.value=this.value.toUpperCase();" required>
                   </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-warning">
                       <label class="control-label" for="Ini">Iniciales del partido (Siglas):</label>
                            <input type="text" class="form-control" name="Ini" id="Ini" placeholder="SIGLAS" value="<?php echo $Ini;?>" onChange="javascript:this.value=this.value.toUpperCase();" required>
                   </div>
                </div>
            </div>
            <div class="row">
    			<div class="col-md-6">
                   <div class="form-group has-warning">
                       <label class="control-label" for="representante">Representante del Partido:</label>
                            <input type="text" class="form-control" onkeypress="return validar_letras(event)" name="representante" id="representante" placeholder="nombre del Representante del Partido" value="<?php echo $representante;?>" onChange="javascript:this.value=this.value.toUpperCase();" required>
                   </div>
                </div>
                <div class="col-md-6">
                   <div class="form-group has-warning">
                       <label class="control-label" for="dui">DUI Representante:</label>
                            <input type="text" class="form-control" name="dui" id="dui" placeholder="00000000-0" onKeyUp="mascara(this,'-',patron3,true)" onKeyPress="return justNumbers(event);" maxlength="10" value="<?php echo $dui;?>">
                   </div>
                </div>
            </div>
                <div class="form-group has-warning">
                   <label class="control-label" for="img">Bandera del partido:</label>
                        <input type="file" class="form-control" name="files" id="files"<?php echo $est_img;?>>
               </div>
               <div class="text-center" id="list"></div>
               <?php echo $imag;?><br>
               <div class="text-center">
               	 <button type="submit" class="btn btn-info" name="enviar"<?php echo $est_guardar;?>><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                 <?php
				 if($tipo_user == "Administrador")
				 {
				 ?>
					 &nbsp; <button type="submit" class="btn btn-success" name="modificar"<?php echo $est_editar;?>><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                 <?php
				 }
				 ?>
                 &nbsp;<a href="#verconsulta" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-eye-open"></span> Ver Partidos</a>
               </div>
            </form>
            </div></div></div>
        </div>
    </div>
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
            	<h3 class="modal-title">Partidos Registrados</h3>
            </div>
            <div class="modal-body table-responsive">
            	<table class="table table-bordered">
                <thead>
                  <tr class="text-center">
                  	<td>Siglas</td>
                    <td>Representante</td>
                    <td>DUI</td>
                    <td>Acciones</td>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $ver_person = "SELECT * FROM partido" ;
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
							$nombre = mysql_result($person,$pr,'nombre_partido');
							$iniciales = mysql_result($person,$pr,'iniciales_p');
							$dui = mysql_result($person,$pr,'dui_representante');
							$id_partidod = mysql_result($person,$pr,'id_partido');
							$repre = mysql_result($person,$pr,'representante');
						echo "<tr>
								 <td>$iniciales</td>
								 <td>$repre</td>
								 <td>";
							echo $dui;
						echo "	</td>";
						echo "<td>";
						if($tipo_user == "Administrador")
				 		{
						echo "<a href='?page=reg-partidos&accion=editar&partido=$id_partidod'>Editar</a> / <a href='?page=reg-partidos&accion=eliminar&partido=$id_partidod'>Eliminar</a>";
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

    </script>