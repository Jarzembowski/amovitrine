<?php
require_once("AtividadeRestHandler.php");
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "lista":		
		$atividadeRestHandler = new AtividadeRestHandler();
		$atividadeRestHandler->getLista();
		break;
	case "listaLojista":		
		$atividadeRestHandler = new AtividadeRestHandler();
		$atividadeRestHandler->getListaLojistas();
		break;
	case "listaLojistaBairro":		
		$atividadeRestHandler = new AtividadeRestHandler();
		$atividadeRestHandler->getListaLojistasBairro();
		break;
	case "totalInativos":		
		$atividadeRestHandler = new AtividadeRestHandler();
		$atividadeRestHandler->getTotalInativos();
		break;
	case "totalInativosCritico":		
		$atividadeRestHandler = new AtividadeRestHandler();
		$atividadeRestHandler->getTotalUsuariosInativosCritico();
		break;
	case "total":		
		$atividadeRestHandler = new AtividadeRestHandler();
		$atividadeRestHandler->getTotal();
		break;
	case "totalLojistasInativos":		
		$atividadeRestHandler = new AtividadeRestHandler();
		$atividadeRestHandler->getTotalLojistasInativos();
		break;
	case "totalLojistas":		
		$atividadeRestHandler = new AtividadeRestHandler();
		$atividadeRestHandler->getTotalLojistas();
		break;
	case "totalInativosLojistaCritico":		
		$atividadeRestHandler = new AtividadeRestHandler();
		$atividadeRestHandler->getTotalLojistaInativosCritico();
		break;

	case "" :
		//404 - not found;
		break;
}
?>
