<?php
include("pChart/pData.class");
include("pChart/pChart.class");
	$depa = $_POST["depto"];
	$munici = $_POST["municipio"];
?>
<div class="row">
   <div class="col-md-12">
   		<?php
			echo generar_pastelm($munici,$ano);
		?>
   </div>
</div>