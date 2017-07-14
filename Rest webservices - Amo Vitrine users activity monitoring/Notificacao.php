<?php
include_once('safe/conn.php');


Class Notificacao {
	
	public function getTotal(){
		
		$pdo = pdo();
		$Query = "SELECT sum(amoVitrine) as total_ativado_amovitrine, sum(LojasAmei) as total_ativado_lojasamei, count(usuario.UserId) as total_usuarios_app FROM `usuario` left outer join push on push.UserId = usuario.UserId where usuario.UserType = 1";		
		$go = $pdo->prepare($Query);
		$go->execute();
		$data = $go->fetchAll(PDO::FETCH_ASSOC);
		
		return $data;
	}
	
	public function getLista(){		
		return $this->lista2;		
	}
}
?>