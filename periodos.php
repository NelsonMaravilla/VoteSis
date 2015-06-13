 <?php
 	include("fbd/guardar_periodo.php");
 ?>
 <script language="javascript" src="verif_coa/jp.js"></script>
<div class="container">
    <div class="jumbotron">
    	<h1 class="text-center">Periodos de Votaciones</h1>
    </div>
    <div class="panel panel-primary">
       <div class="panel-heading">DATOS DEL PERIODO:</div>
           <div class="panel-body text-justify">
    <form action="" method="post" id="fano" name="fano" enctype="multipart/form-data">
    <div class="row">
    	<div class="col-md-4">
             <div class="form-group has-warning">
                  <label class="control-label" for="anio">A&ntilde; de Eleccion:</label>
                  <input type="text" class="form-control" name="anio" id="anio" placeholder="0000" onChange="javascript:this.value=this.value.toUpperCase();" required>
             </div>
        </div>
        <div class="col-md-4">
             <div class="form-group has-warning">
                  <div class="form-group has-warning">
                    <label class="control-label" for="genero">Tipo de Candidatura:</label><br />
                      <label class="checkbox">
                        <input type="checkbox" name="Can[]" id="Can" value="1"> MUNICIPALES
                      </label>
                      <label class="checkbox">
                        <input type="checkbox" name="Can[]" id="Can" value="2"> DIPUTADOS
                      </label>
                      <label class="checkbox">
                        <input type="checkbox" name="Can[]" id="Can" value="3"> PRESIDENCIALES
                      </label>
             </div>
             </div>
         </div>
         <div class="col-md-4">
             <div class="form-group has-warning">
                  <label class="control-label" for="ape_per">Estado:</label>
                  <select name="estado" id="estado" class="form-control" required>
                    <option value="ACTIVADO">ACTIVADO</option>
                    <option value="DESACTIVADO">DESACTIVADO</option>                
                </select>
             </div>
         </div>     
    </div>
    <div class="row">
    	<div class="col-lg-12">
        	<div class="form-group has-warning">
               	 <label class="control-label" for="des">Titulo:</label>
                  <input type="text" class="form-control" name="des" id="des" placeholder="t&iacute;tulo de la votaci&oacute;n" onChange="javascript:this.value=this.value.toUpperCase();" required>
            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-lg-12">
        	<div class="text-center">
               	 <button type="submit" class="btn btn-info" name="enviarp"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
                 <?php
				 if($tipo_user == "Administrador")
				 {
				 ?>
					 &nbsp; <button type="submit" class="btn btn-success" name="modificar"<?php echo $est_editar;?>><span class="glyphicon glyphicon-pencil"></span> Modificar</button>
                 <?php
				 }
				 ?>
                 &nbsp;<a href="#verconsulta" class="btn btn-primary" data-toggle="modal"><span class="glyphicon glyphicon-eye-open"></span> Ver Elecciones</a>
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
<script type="text/javascript">
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
<!--ventana modal-->
<div class="modal fade" id="verconsulta">
	<div class="modal-dialog modal-lg">
    	<div class="modal-content">
        	<div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" arial-hidden="true">&times;</button>
            	<h3 class="modal-title">Lista de elecciones</h3>
            </div>
            <div class="modal-body table-responsive">
            	<table class="table table-bordered">
                <thead>
                  <tr class="text-center">
                  	<td>Ano</td>
                    <td>Titulo</td>
                    <td>Estado</td>
                    <td>Acciones</td>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $ver_person = "SELECT * FROM anio_elecciones" ;
                    $person = mysql_query($ver_person);
					$cuantopr = mysql_num_rows($person);
					if($cuantopr == 0)
					{
				  ?>
                  <tr>
                  	<td colspan="3">no hay ningun año activado</td>
                  </tr>
                  <?php
					}
					else
					{
						for($pr=0;$pr<mysql_num_rows($person);$pr++)
						{
							$nl = mysql_result($person,$pr,'anio_eleccion');
							$t_l = mysql_result($person,$pr,'titulo');
							$e_ele = mysql_result($person,$pr,'estado');
							$id_elec = mysql_result($person,$pr,'id_anioe');
						echo "<tr>
								 <td>$nl</td>
								 <td>$t_l</td>
								 <td>";
							echo $e_ele;
						echo "	</td>";
						echo "<td>";
						if($tipo_user == "Administrador")
				 		{
						echo "<a href='?page=periodo-votos&accion=editar&anio=$nl'>Editar</a> / <a href='?page=periodo-votos&accion=cerrar&anio=$nl'>Cerrar</a>";
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