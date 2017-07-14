<?php
session_start();

$senha = $_REQUEST["senha"];


if($senha == "senha"){    
    $_SESSION['login'] = "amovitrine";    
    echo "1";
}else{
	echo "0";
}


?>