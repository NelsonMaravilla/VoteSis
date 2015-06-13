<?php
//mostrando paginas del sistema
if(!isset($_GET["page"]))
{
	$page = "homes.php";
}
else
{
	$aplication = $_GET["page"];
switch ($aplication)
				{
	case 'home':
         $page = "homes.php";
    break;
	
	case 'reg-partidos':
         $page = "nuevo_partido.php";
    break;
	
	case 'reg-coalicion':
         $page = "nueva_coalicion.php";
    break;
	
	case 'persona-natural':
         $page = "nueva_persona_natural.php";
    break;
	
	case 'candidatos':
         $page = "nuevo_candidato.php";
    break;
		
	case 'user':
         $page = "nuevo_usuario.php";
    break;
	
	case 'periodo-votos':
         $page = "periodos.php";
    break;
	
	case 'estadistica':
         $page = "estadistica.php";
    break;

	default:
		$page = "homes.php";
				}
		}
?>