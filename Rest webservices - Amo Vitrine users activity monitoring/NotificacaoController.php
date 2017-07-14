<?php
require_once("NotificacaoRestHandler.php");
		
$view = "";
if(isset($_GET["view"]))
	$view = $_GET["view"];
/*
controls the RESTful services
URL mapping
*/
switch($view){

	case "all":		
		$notificacaoRestHandler = new NotificacaoRestHandler();
		$notificacaoRestHandler->getLista();
		break;
		
	case "total":		
		$notificacaoRestHandler = new NotificacaoRestHandler();
		$notificacaoRestHandler->getTotal();
		break;

	case "" :
		//404 - not found;
		break;
}
?>
