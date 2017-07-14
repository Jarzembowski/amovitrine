<?php

  session_start();

   include('httpful.phar');
  
  
   if (!isset($_SESSION['login'])) {
       header("location:index.html");
   }
   
 ?>

<html>
   <head>
      <link rel="stylesheet" href="assets/css/chartist.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="assets/css/bootstrap.css">
      <link rel="stylesheet" href="assets/css/jquery-ui.css">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <style type="text/css"> 
         a{
         text-decoration: none;
         color: inherit;    
         }
         a:hover{
         text-decoration: none;
         color: inherit;    
         }
         span.glyphicon-sort {
         font-size: 0.7em;
         }
      </style>
   </head>
   <body>
      <div style="position:fixed;width:100%;top:0;height:30px;background:#a5a5a5;z-index:1000;">
         <div style="float:left;padding-left:20px;padding-top:5px;color:#FFFFFF;font-weight:bold;">
            <a href="main.php">Voltar</a>
         </div>
         <div style="float:right;padding-right:20px;padding-top:5px;color:#FFFFFF;font-weight:bold;">
            Bem vindo, Administrador | <a href="logout.php">Sair</a>
         </div>
      </div>
      <div class="row" style="width: 96%;height: 85%;margin-left: auto;margin-right: auto; position: relative;top: 50%;transform: translateY(-50%);">
      <div class="col-lg-12 col-sm-12 col-xs-12" style="margin:0;padding:0;">
         <div class="row"  style="width: 100%;margin:0;padding:0;min-width:300px">
            <input style='width:90%;' type='text' id='filter' class='form-control' placeholder='Pesquisar loja ou bairro'>
         </div>
      </div>
      <div class="col-lg-12 col-sm-12 col-xs-12" style="margin:0;padding:0;">
      <div class="row"  style="width: 100%;margin:0;padding:0;min-width:300px">

      <?php              
         
         $uri = "http://localhost/atividade/consulta/getlistalojistabairro/";
         $responseListaApp = \Httpful\Request::get($uri)
         ->addHeader('Accept', 'application/json')  
         ->send();
         
         
         $array = json_decode( $responseListaApp, true );
         
         echo "<table  class='table table-condensed table-striped' id='lista-usuarios' style='width:90%;'>";
         //echo "<tr><td colspan='9'><input type='text' id='filter' class='form-control' placeholder='Pesquisar loja ou bairro'></td></tr>";
         echo "<thead>";
         echo "<tr>";
         echo "<th>#</th>";
         echo "<th class='col-md-3' style='cursor: pointer; cursor: hand;'>Nome Loja&nbsp;&nbsp;<span class='glyphicon glyphicon glyphicon-sort' aria-hidden='true'></span></th>";
         echo "<th>Status</th>";
         echo "<th class='col-md-3' style='cursor: pointer; cursor: hand;'>Bairro&nbsp;&nbsp;<span class='glyphicon glyphicon glyphicon-sort' aria-hidden='true'></th>"; 
         echo "<th style='cursor: pointer; cursor: hand;'>Nr. de visitas&nbsp;&nbsp;<span class='glyphicon glyphicon glyphicon-sort' aria-hidden='true'></th>";
         echo "<th style='cursor: pointer; cursor: hand;'>Itens vistos&nbsp;&nbsp;<span class='glyphicon glyphicon glyphicon-sort' aria-hidden='true'></th>";
         echo "<th style='cursor: pointer; cursor: hand;'>Itens amados&nbsp;&nbsp;<span class='glyphicon glyphicon glyphicon-sort' aria-hidden='true'></th>";
         echo "<th style='cursor: pointer; cursor: hand;'>Nr. de seguidores&nbsp;&nbsp;<span class='glyphicon glyphicon glyphicon-sort' aria-hidden='true'></th>";  
         echo "<th style='cursor: pointer; cursor: hand;'>Total&nbsp;&nbsp;<span class='glyphicon glyphicon glyphicon-sort' aria-hidden='true'></th>";  
         echo "</tr>";
         echo "<thead>";
         echo "<tbody class='searchable'>";
         
         $contador = 0;
         foreach ($array as $key => $jsons) { 
         
              $contador += 1;
         
              if($contador > 3){
               echo "<tr class='oculto' style='display: none;'>";
              }else{
               echo "<tr class='visivel'>"; 
              }
         
               $total = $jsons["qt_visitas"] + $jsons["qt_itens_vistos"] + $jsons["qt_itens_amados"] + $jsons["qt_seguidores"];
         
               
              if($jsons["LojaStatus"] === "0"){
                 $classeFonte = "#EF4260";
              }elseif($jsons["LojaStatus"] === "1"){
                 $classeFonte = "#a5a5a5";
              }
              else{
                 $classeFonte = "#000000";
              }
              
              foreach($jsons as $key => $value) {        
                 
                 if($key === "LojaStatus"){
                   if($value === "0"){
                   echo "<td align='center'><div style='border-radius: 50%;width:10px;height: 10px;background:#EF4260'></div></td>";                          
                   }elseif($value === "1"){                        
                     echo "<td align='center'><div style='border-radius: 50%;width: 10px;height: 10px;background:#a5a5a5'></div></td>";  
                   }
                 }    
                 else{
                   echo "<td style = 'color:".$classeFonte."'>".$value."</td>";  
                 }
             }
         
              echo "<td style = 'color:".$classeFonte."'>".$total."</td>";  
         
         
             echo "</tr>";    
         
         }
         
         //echo "<tr><td colspan='9'><input type='button' value='Mostrar mais' id='mostrarmais'></td></tr>";
         
         echo "</tbody>";
         echo "</table>";
         
         echo "</div>";
         echo "</div>";
         
         echo "<div class='col-lg-12 col-sm-12 col-xs-12' style='margin:0;padding:0;'>";
         echo "<input type='button' value='Mostrar mais' id='mostrarmais'>";
         echo "</div>";
         
         
         
         echo "</div>";
         
         ?>
      <script src="assets/js/jquery-1.11.1.min.js"></script>  
      <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
      <script src="assets/js/jquery-ui.js"></script>
      <script>
         $(document).ready(function () {
         
         
            $(function(){
            $("#lista-usuarios").tablesorter( {debug:false} );
            });
         
            (function ($) {
         
                $('#filter').keyup(function () {
         
                    var rex = new RegExp($(this).val(), 'i');
                    $('.searchable tr').hide();
                    $('.searchable tr').filter(function () {
                        return rex.test($(this).text());
                    }).show();
         
                })
         
            }(jQuery));
             });
         
         
         
         $("#mostrarmais").click(function() {
          if($("#lista-usuarios .oculto").length <= 10){
            $(this).css({"display": "none"}); 
          }
         
          $("#lista-usuarios .oculto").slice(0,10).css({"display": "table-row"});      
          $("#lista-usuarios .oculto").slice(0,10).removeClass( "oculto" ).addClass( "visivel" );
         });
         
      </script>
   </body>
</html>