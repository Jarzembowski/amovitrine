<?php
require_once("Rest.php");
require_once("Atividade.php");
		
class AtividadeRestHandler extends Rest {

	function getTotalInativos() {	

		$atividade = new Atividade();
		$rawData = $atividade->getTotalInativos();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'Nenhum dado encontrado.');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		}
	}


	function getTotalUsuariosInativosCritico() {	

		$atividade = new Atividade();
		$rawData = $atividade->getTotalUsuariosInativosCritico();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'Nenhum dado encontrado.');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		}
	}

		function getTotalLojistaInativosCritico() {	

		$atividade = new Atividade();
		$rawData = $atividade->getTotalLojistaInativosCritico();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'Nenhum dado encontrado.');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		}
	}



	function getTotal() {	

		$atividade = new Atividade();
		$rawData = $atividade->getTotal();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'Nenhum dado encontrado.');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		}
	}

	function getTotalLojistasInativos() {	

		$atividade = new Atividade();
		$rawData = $atividade->getTotalLojistasInativos();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'Nenhum dado encontrado.');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		}
	}


	function getTotalLojistas() {	

		$atividade = new Atividade();
		$rawData = $atividade->getTotalLojistas();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'Nenhum dado encontrado.');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		}
	}
	
	
	public function encodeHtml($responseData) {
	
		$htmlResponse = "<table border='1'>";
		foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
		}
		$htmlResponse .= "</table>";
		return $htmlResponse;		
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	public function encodeXml($responseData) {
		// creating object of SimpleXMLElement
		$xml = new SimpleXMLElement('<?xml version="1.0"?><mobile></mobile>');
		foreach($responseData as $key=>$value) {
			$xml->addChild($key, $value);
		}
		return $xml->asXML();
	}
	
	public function getLista() {

		$atividade = new Atividade();
		$rawData = $atividade->getLista();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'nenhum dado encontrado.');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		}
	}



	public function getListaLojistas() {

		$atividade = new Atividade();
		$rawData = $atividade->getListaLojistas();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'nenhum dado encontrado.');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		}
	}


	public function getListaLojistasBairro() {

		$atividade = new Atividade();
		$rawData = $atividade->getListaLojistasBairro();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'nenhum dado encontrado.');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($requestContentType,'application/json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($requestContentType,'text/html') !== false){
			$response = $this->encodeHtml($rawData);
			echo $response;
		} else if(strpos($requestContentType,'application/xml') !== false){
			$response = $this->encodeXml($rawData);
			echo $response;
		}
	}
}


?>