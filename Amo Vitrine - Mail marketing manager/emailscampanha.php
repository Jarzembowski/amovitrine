<?php
ini_set('default_charset','UTF-8');
date_default_timezone_set('America/Sao_Paulo');
  session_start();

  if (!isset($_SESSION['login'])) {
       header("location:index.html");
   }
   

   include('httpful.phar');

   ?>
<html>
   <head>
     
     
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />      
      <title>Amo Vitrine | Lojistas</title>      
      <link rel="shortcut icon" type="image/png" href="favicon.png"/>    
      <link rel="stylesheet" href="assets/css/chartist.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="assets/css/bootstrap.css">      
      <link rel="stylesheet" href="assets/css/jquery-ui.css">            
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

           .centralizar{
        text-align:center;
        }
    

   </style>
   </head>
   <body>

             
             <?php


              /* Usuários ativos/inativos */
              $uri = "http://localhost/atividade/consulta/getusuariosativosemail/";
              $responseListaApp = \Httpful\Request::get($uri)
              ->addHeader('Accept', 'application/json')
              ->send();                   

              $array = json_decode( utf8_encode($responseListaApp), true );

               $file_name = "lista_emails_usuarios_ativos_".date('Y-m-d').".txt";               

                if(file_exists($file_name)){
                unlink($file_name);
                }
              foreach ($array as $key => $jsons) {                                   
                  file_put_contents($file_name, "".$jsons["nome_usuario"]."<".$jsons["userEmail"].">;".PHP_EOL,FILE_APPEND);                                   
              }
            
              ?>
              <a target="blank" href="<?php echo $file_name ?>">E-mails dos usuários ativos</a>

              <?php
              /* Usuários ativos/inativos */
              $uri = "http://localhost/atividade/consulta/getusuariosinativosemail/";
              $responseListaApp = \Httpful\Request::get($uri)
              ->addHeader('Accept', 'application/json')
              ->send();                   
              echo $responseListaApp;
              $array = json_decode( utf8_encode($responseListaApp), true );

               $file_name = "lista_emails_usuarios_inativos_".date('Y-m-d').".txt";               

                if(file_exists($file_name)){
                unlink($file_name);
                }


              foreach ($array as $key => $jsons) {                                   
                  $texto = $jsons["nome_usuario"]."<".$jsons["userEmail"].">;";
                  file_put_contents($file_name, $texto.PHP_EOL,FILE_APPEND);                                   
              }
            
              ?>
              <a target="blank" href="<?php echo $file_name ?>">E-mails dos usuários inativos</a>

   </body>   
   <script src="assets/js/chartist.min.js"></script>
   <script src="assets/js/jquery-1.11.1.min.js"></script>
   <script type="text/javascript" src="assets/js/jquery.tablesorter.min.js"></script>
   <script src="assets/js/jquery-ui.js"></script>

   <script>

    /*Busca*/
     $(document).ready(function () {

       $(function(){
          $("#lista-usuarios").tablesorter( {debug:false,
          dateFormat: "uk"
          } );
          });

      if(Number($("#pc_total_inativos").val()) > 75){
          alert("Atenção!! Mais de 75% dos usuários estão INATIVOS!!! FODEU!!!");
      }

       if($("#lista-usuarios .oculto").length == 0){      
        $("#mostrarmais").css({"display": "none"}); 
      }



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


   </script>
</html>