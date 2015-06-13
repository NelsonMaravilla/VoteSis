<?php
$anio = date("Y");
function n_depto($dp)
{
	$sel_depto = "SELECT nombre FROM departamentos WHERE codigo='$dp'";
	$resul_p = mysql_query($sel_depto);
		for($pn = 0; $pn < mysql_num_rows($resul_p); $pn++)
		{
			$n_deptop = mysql_result($resul_p,$pn,'nombre');
		}
	echo $n_deptop;
}

function bandera($prd)
{
	$sel_bandera = "SELECT url FROM partido WHERE id_partido='$prd'";
	$resul_bd = mysql_query($sel_bandera);
		for($bd = 0; $bd < mysql_num_rows($resul_bd); $bd++)
		{
			$url_b = mysql_result($resul_bd,$bd,'url');
		}
	echo "<img class='thumb img-responsive img-thumbnail' src='../$url_b'>";
}

	$persona_vot = "SELECT * FROM persona WHERE DUI='$dui_userp'";
	$resul_pv = mysql_query($persona_vot);
		for($pv = 0; $pv < mysql_num_rows($resul_pv); $pv++)
		{
			$id_pers = mysql_result($resul_pv,$pv,'id');
		}
?>
<script language="javascript">
function Suma(myValue)
{
	tot = parseInt(document.votoalcalde.tvotoa.value);
	myValue = parseInt(1);
	document.votoalcalde.tvotoa.value = tot + myValue;

}
</script>
<script language="javascript">
function validando()
         {
			var votoc=document.votoalcalde.tvotoa.value;
			if(votoc > 1)
                    {
                       	alert('error solo puede elegir a uno');
						document.votoalcalde.tvotoa.value="1";
                        return (false);
                    }
			return(true);
   		 }  
</script>
<script language="javascript">
/*funcion que crea el ajax, o eso creo que hace siempre hago copy paste*/
function nuevoAjax() {    
    var xmlhttp=false;
    try  {
        // Creacion del objeto AJAX para navegadores no IE
        xmlhttp=new ActiveXObject("Msxml2.XMLHTTP");    }
    catch(e) {
        try {
            // Creacion del objet AJAX para IE
           xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
       }
       catch(E) { xmlhttp=false; }
   }
   if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); }
   return xmlhttp; 
}
function agregar(p,d,c,i){
	v = document.getElementById("resultado");
	ajax = nuevoAjax();
	ajax.open("GET","generar_voto.php?i="+i+"&p="+p+"&d="+d+"&c="+c);
	ajax.onreadystatechange=function()
	{
		if(ajax.readyState == 4)
		{
			v.innerHTML = ajax.responseText;
		}
	}
	ajax.send(null)
}
function quitar(d,c,i){
	v = document.getElementById("resultado");
	ajax = nuevoAjax();
	ajax.open("GET","quitarva.php?i="+i+"&d="+d+"&c="+c);
	ajax.onreadystatechange=function()
	{
		if(ajax.readyState == 4)
		{
			v.innerHTML = ajax.responseText;
		}
	}
	ajax.send(null)
}
</script>
<form method="get" action="" name="votoalcalde">
<?php
echo"<input type='hidden' name='dui_votante' value='$dui_userp'>";
echo"<input type='hidden' name='candidatura_v' value='2'>";
		$queryss = "SELECT * FROM voto_persona WHERE dui='$dui_userp' AND tipo_candidatura='2' AND ano='$anio'";
		$ok_queryss = mysql_query($queryss);
		$cvotoss = mysql_num_rows($ok_queryss);
			echo"<input type='hidden' name='tvotoa' value='$cvotoss'>";
?>
<div class="row">
    <div class="col-md-6 text-center">
         <h4>Elecci&oacute;n de diputados y diputadas a la Asamblea Legislativa<br /><small><?php echo n_depto($depa_userp);?></h4>
    </div>
        <div class="col-md-6 text-center">
         <div id="resultado"></div>
    </div>
</div>
<!-- mostrar papeleta -->
<?php
$mostrar_candidatos = "SELECT * FROM candidato WHERE tipo_candidatura='2' AND id_departamento='$depa_userp'";
$resul_candidatos = mysql_query($mostrar_candidatos);

	for($cd = 0; $cd < mysql_num_rows($resul_candidatos); $cd++)
			{
				$partido = mysql_result($resul_candidatos,$cd,'id_partido');
				$coalicion = mysql_result($resul_candidatos,$cd,'id_coalicion');
			}
			//verificar si los partidos estan en coalicion
			if($coalicion == 0)
			{
						$candidatosA = "SELECT * FROM candidato WHERE tipo_candidatura='2' AND id_departamento='$depa_userp'";
						$resul_c = mysql_query($candidatosA);
						$numcol = 3; 
 						$x=0; 
						if ($row = mysql_fetch_array($resul_c)) 
 							{
								echo"<div class='table-responsive'>
										<table class='table table-bordered'>";
								DO    
									{ 
									$id_partido=$row["id_partido"];
									$candi_v=$row["tipo_candidatura"];
									$idcandidato = $row["id_candidato"];
									if ($x % $numcol==0)
										 {
											echo"<tr><td align='center'>";
											echo"<span onclick='agregar(".$id_partido.",".$id_pers.",".$candi_v.",".$idcandidato.");Suma(this.checked,this.value);validando()'>";
											echo bandera($id_partido);
											echo"</span>";
											echo"</td>";
										 }
											 elseif ($x % $numcol==$numcol - 1)
											 {
												echo"<td align='center'>";
												echo"<span onclick='agregar(".$id_partido.",".$id_pers.",".$candi_v.",".$idcandidato.");Suma(this.checked,this.value);validando()'>";
												echo bandera($id_partido);
												echo"</span>";
												echo"</td></tr>";
											 }
												else
												 {
													echo"<td align='center'>";
													echo"<span onclick='agregar(".$id_partido.",".$id_pers.",".$candi_v.",".$idcandidato.");Suma(this.checked,this.value);validando()'>";
													echo bandera($id_partido);
													echo"</span>";
													echo"</td>";
												  } 
												$x++;
									}
									while($row=mysql_fetch_array($resul_c));
									echo "</table></div>";
							}
			}
				else
					{
						
					}
					//fin de la verificacion
?>
</form>