 <script language="javascript" src="verif_coa/jp.js"></script>
<div class="container">
    <div class="panel panel-primary">
       <div class="panel-heading">Estadistica</div>
           <div class="panel-body text-justify">
   				<div class="row">
    					<div class="col-md-4">
                        	<h3 class="text-center">MUNICIPALES</h3>
                            <form action="" method="post" id="fmunicipal" name="fmunicipal">
                           		<div class="form-group has-warning">
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
                                                        <option value="<?php echo $cod_depa;?>"><?php echo $nom_depa;?></option>";
                                            <?php
                                                    }
                                            ?>
                                        
                                        </select>
                                  </div>
                                  <div class="form-group has-warning">
                                        <label class="control-label" for="municipio">Municipio:</label>
                                         <select name="municipio" id="municipio" class="form-control">
                                            <option value="">------</option>
                                        
                                        </select>
                                   </div>
                                   <div class="text-center">
                                     <button type="submit" class="btn btn-primary btn-lg" name="consultar_al"><span class="glyphicon glyphicon-signal"></span> Mostrar</button>
                                   </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                        	<h3 class="text-center">DUPITADOS</h3>
                            <form action="" method="post" id="fdiputaciones" name="fdiputaciones">
                           		<div class="form-group has-warning">
                                       <label class="control-label" for="departamento"> Departamento: </label>
                                        <select name="deptop" id="deptop" class="form-control" required>
                                            <option value="">--------</option>
                                            <?php
                                            $departamento="SELECT * FROM departamentos";
                                            $depa_mos = mysql_query($departamento);
                                                for($d=0;$d<mysql_num_rows($depa_mos);$d++)
                                                    {
                                                        $cod_depa=mysql_result($depa_mos,$d,'codigo');
                                                        $nom_depa=utf8_encode(mysql_result($depa_mos,$d,'nombre'));
                                            ?>
                                                        <option value="<?php echo $cod_depa;?>"><?php echo $nom_depa;?></option>";
                                            <?php
                                                    }
                                            ?>
                                        
                                        </select>
                                  </div>
                                  <div class="text-center">
                                     <button type="submit" class="btn btn-primary btn-lg" name="consultar_di"><span class="glyphicon glyphicon-signal"></span> Mostrar</button>
                                   </div>
                            </form>
                        </div>
                        
   
                        <div class="col-md-4">
                          <h3 class="text-center">PRESIDENCIALES</h3>
                          <form action="" method="post" id="fpre" name="fpre">
                          <button type="submit" class="btn btn-primary btn-lg" name="consultar_pre"><span class="glyphicon glyphicon-signal"></span> Mostrar</button>
                          </form>
                        </div>
               </div>
           </div>
      </div>                  
   </div>   
</div>
<div class="container">
<?php
  if(isset($_POST["consultar_al"]))
    {
      include("municipales_estadistica.php");
    }
    elseif(isset($_POST["consultar_di"]))
    {
      include("diputados_estadistica.php");
    }
    else
    {
      if(isset($_POST["consultar_pre"]))
      {
        include("presidenciales_estadistica.php");
      }
    }
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