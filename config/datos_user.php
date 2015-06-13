<?php
$usuario_sis=$_SESSION["userusu"];
$tipo_user=$_SESSION["usertip"];
$nom_user=$_SESSION["usernom"];
$apel_user=$_SESSION["userape"];
$id_user_active=$_SESSION["user_ide"];

//funcion para verificar estado
$ano=date("Y");
	$anoactivado = "SELECT * FROM anio_elecciones WHERE anio_eleccion='$ano'";
    $inicial_ano = mysql_query($anoactivado);
	for($pp=0;$pp<mysql_num_rows($inicial_ano);$pp++)
						{
							$anoios = mysql_result($inicial_ano,$pp,'anio_eleccion');
							$estado_anioe = mysql_result($inicial_ano,$pp,'estado');
						}
							if($estado_anioe == "ACTIVADO")
							{
								$menu_estado = '';
								$menu_estado2 ='';
							}
							else
							{
								 $menu_estado = 'disabled';
								 $menu_estado2 =' onclick="return false"';
							}
						

//funcion para las iniciales de partidos
function iniciales_partido($ptd)
{
	$inicialesp = "SELECT iniciales_p FROM partido WHERE id_partido='$ptd'" ;
    $inicial_partido = mysql_query($inicialesp);
	for($pp=0;$pp<mysql_num_rows($inicial_partido);$pp++)
						{
							$partido_iniciales = mysql_result($inicial_partido,$pp,'iniciales_p');
						}
						echo $partido_iniciales;
}

//funcion para el nombre del municipio
function n_municipio($mnp)
{
	$sel_municipio = "SELECT nombre FROM municipio WHERE codigo='$mnp'";
	$resul_m = mysql_query($sel_municipio);
		for($mn = 0; $mn < mysql_num_rows($resul_m); $mn++)
		{
			$n_muni = mysql_result($resul_m,$mn,'nombre');
		}
	echo $n_muni;
}

function generar_pastelm($mc,$anio)
{
$m="m";
	$tor =mysql_query ("SELECT * FROM partido p INNER JOIN candidato c on p.id_partido=c.id_partido WHERE c.id_municipio='$mc' AND c.id_anoe='$anio' AND c.tipo_candidatura='1'");
	$result = mysql_query ("SELECT * FROM candidato WHERE id_municipio='$mc' AND id_anoe='$anio' AND tipo_candidatura='1'");

	$numOfRows = mysql_num_rows($result);
	if($numOfRows == 0)
	{
		echo "no se pueede mostrar el dato de este municipio porque aun no tiene candidatos";
	}
else
{
	for ($i = 0; $i < $numOfRows; $i++)
	
	   {

		$row = mysql_fetch_array($result);
		$result_array[$i] = $row["voto"];
		$row = mysql_fetch_array($tor);
		$result_arrayp[$i] = $row["iniciales_p"];
	   } 

	   	$sel_municipio = "SELECT nombre FROM municipio WHERE codigo='$mc'";
	$resul_m = mysql_query($sel_municipio);
		for($mn = 0; $mn < mysql_num_rows($resul_m); $mn++)
		{
			$n_muni = mysql_result($resul_m,$mn,'nombre');
		}
	
 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint(array($result_array),"Serie1");
 $DataSet->AddPoint(array($result_arrayp),"Serie2");
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie("Serie2");

 // Initialise the graph
 $Test = new pChart(600,400);
 $Test->setFontProperties("Fonts/tahoma.ttf",12);
 $Test->drawFilledRoundedRectangle(20,20,400,295,10,360,360,360);
 $Test->drawRoundedRectangle(20,20,400,295,10,350,350,350);

 // Draw the pie chart
 $Test->AntialiasQuality = 600;
 $Test->setShadowProperties(2,2,200,200,200);
 $Test->drawFlatPieGraphWithShadow($DataSet->GetData(),$DataSet->GetDataDescription(),160,200,140,PIE_PERCENTAGE,6);
 $Test->clearShadow();

 $Test->drawPieLegend(300,50,$DataSet->GetData(),$DataSet->GetDataDescription(),500,500,500);
 $Test->setFontProperties("Fonts/tahoma.ttf",20);
 $Test->drawTitle(150,20,"$n_muni",50,50,50,150);
 $Test->Render("estadistica/$mc$anio.png");
 
 echo"<img src='estadistica/$mc$anio.png' border='0'>";
}
}

function generar_pasteld($mc,$anio)
{
$m="m";
	$tor =mysql_query ("SELECT * FROM partido p INNER JOIN candidato c on p.id_partido=c.id_partido WHERE c.id_departamento='$mc' AND c.id_anoe='$anio' AND c.tipo_candidatura='2'");
	$result = mysql_query ("SELECT * FROM candidato WHERE id_departamento='$mc' AND id_anoe='$anio' AND tipo_candidatura='2'");
	$numOfRows = mysql_num_rows($result);
	if($numOfRows == 0)
	{
		echo "no se pueede mostrar el dato de este departamento porque aun no tiene candidatos";
	}
else
{
	for ($i = 0; $i < $numOfRows; $i++)
	
	   {

		$row = mysql_fetch_array($result);
		$result_array[$i] = $row["voto"];
		$row = mysql_fetch_array($tor);
		$result_arrayp[$i] = $row["iniciales_p"];
	   } 

	   	$sel_depto = "SELECT nombre FROM departamentos WHERE codigo='$mc'";
	$resul_d = mysql_query($sel_depto);
		for($mn = 0; $mn < mysql_num_rows($resul_d); $mn++)
		{
			$n_dpto = mysql_result($resul_d,$mn,'nombre');
		}
	
 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint(array($result_array),"Serie1");
 $DataSet->AddPoint(array($result_arrayp),"Serie2");
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie("Serie2");

 // Initialise the graph
 $Test = new pChart(600,400);
 $Test->setFontProperties("Fonts/tahoma.ttf",12);
 $Test->drawFilledRoundedRectangle(20,20,400,295,10,360,360,360);
 $Test->drawRoundedRectangle(20,20,400,295,10,350,350,350);

 // Draw the pie chart
 $Test->AntialiasQuality = 600;
 $Test->setShadowProperties(2,2,200,200,200);
 $Test->drawFlatPieGraphWithShadow($DataSet->GetData(),$DataSet->GetDataDescription(),160,200,140,PIE_PERCENTAGE,6);
 $Test->clearShadow();

 $Test->drawPieLegend(300,50,$DataSet->GetData(),$DataSet->GetDataDescription(),500,500,500);
 $Test->setFontProperties("Fonts/tahoma.ttf",20);
 $Test->drawTitle(150,20,"$n_dpto",50,50,50,150);
 $Test->Render("estadistica/$mc-$anio.png");
 
 echo"<img src='estadistica/$mc-$anio.png' border='0'>";
}
}


function generar_pastelpe($anio)
{
$m="m";
	$tor =mysql_query ("SELECT * FROM partido p INNER JOIN candidato c on p.id_partido=c.id_partido WHERE c.id_anoe='$anio' AND c.tipo_candidatura='3'");
	$result = mysql_query ("SELECT * FROM candidato WHERE id_anoe='$anio' AND tipo_candidatura='3'");
	$numOfRows = mysql_num_rows($result);
	if($numOfRows == 0)
	{
		echo "no se pueede mostrar";
	}
else
{
	for ($i = 0; $i < $numOfRows; $i++)
	
	   {

		$row = mysql_fetch_array($result);
		$result_array[$i] = $row["voto"];
		$row = mysql_fetch_array($tor);
		$result_arrayp[$i] = $row["iniciales_p"];
	   } 
$prr="Precidenciales";
	
 // Dataset definition 
 $DataSet = new pData;
 $DataSet->AddPoint(array($result_array),"Serie1");
 $DataSet->AddPoint(array($result_arrayp),"Serie2");
 $DataSet->AddAllSeries();
 $DataSet->SetAbsciseLabelSerie("Serie2");

 // Initialise the graph
 $Test = new pChart(600,400);
 $Test->setFontProperties("Fonts/tahoma.ttf",12);
 $Test->drawFilledRoundedRectangle(20,20,400,295,10,360,360,360);
 $Test->drawRoundedRectangle(20,20,400,295,10,350,350,350);

 // Draw the pie chart
 $Test->AntialiasQuality = 600;
 $Test->setShadowProperties(2,2,200,200,200);
 $Test->drawFlatPieGraphWithShadow($DataSet->GetData(),$DataSet->GetDataDescription(),160,200,140,PIE_PERCENTAGE,6);
 $Test->clearShadow();

 $Test->drawPieLegend(300,50,$DataSet->GetData(),$DataSet->GetDataDescription(),500,500,500);
 $Test->setFontProperties("Fonts/tahoma.ttf",20);
 $Test->drawTitle(150,20,"$prr",50,50,50,150);
 $Test->Render("estadistica/$anio.png");
 
 echo"<img src='estadistica/$anio.png' border='0'>";
}
}
?>