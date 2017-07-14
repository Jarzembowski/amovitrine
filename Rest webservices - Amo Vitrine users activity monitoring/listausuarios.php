<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <link rel="stylesheet" href="style.css">
 <link rel="stylesheet" href="assets/css/bootstrap.css">
<title>Atividade</title>
</head>


<body>

<?php
include('httpful.phar');


$uri = "http://localhost/atividade/consulta/getLista/";
$responseListaApp = \Httpful\Request::get($uri)
->addHeader('Accept', 'application/json')


->send();

$array = json_decode( $responseListaApp, true );

echo "<table  class='table table-striped' style='width:70%;padding-top:20px'>";
echo "<thead>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Nome Usuário</th>";
echo "<th  align='center'>Status</th>";
echo "<th>Dt. Última atividade</th>";
echo "<th>Nível de atividade</th>";
echo "</tr>";
echo "<thead>";
foreach ($array as $key => $jsons) { 
     echo "<tr>";
     foreach($jsons as $key => $value) {        
        if($value === "##0##"){
          echo "<td align='center'><div style='border-radius: 50%;width:10px;height: 10px;background:red'></div></td>";  
        }elseif($value === "##1##"){
          echo "<td align='center'><div style='border-radius: 50%;width: 10px;height: 10px;background:green'></div></td>";  
        }else{
          echo "<td>".$value."</td>";  
        }
         
        
    }
    echo "</tr>";
}
echo "</table>";
?>
  

</body>
</html>
