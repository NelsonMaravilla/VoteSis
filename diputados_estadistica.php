<?php
include("pChart/pData.class");
include("pChart/pChart.class");
	$depa = $_POST["deptop"];
?>
<div class="row">
   <div class="col-md-12">
   		<?php
			echo generar_pasteld($depa,$ano);
		?>
   </div>
</div>