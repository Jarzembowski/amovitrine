<?php
  session_start();

   include('httpful.phar');
  
  
   if (!isset($_SESSION['login'])) {
       header("location:index.html");
   }
   
 ?>
 
<html>
   <head>
		<link rel="stylesheet" href="assets/css/bootstrap.css">          
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
  	   	<style type="text/css">
  	   		.fonte-subtitulo{
				  font-family: Arial, sans-serif;
				    font-size: 25px;
				    color: #FFFFFF;
				    font-weight: bold;
  	   		}
  	   	</style>
   </head>
   <body style="background:#EF4260;">
      
        <div style="width:100%;margin:0;padding-right:10px;padding-top:10px;">
          <a href="logout.php"><img src='assets/images/logout.png' style="width: 10%;height: auto;float:right;"></a>
        </div>        
    

   		<div class="row" style="width: 30%;height: 75%;margin-left: auto;margin-right: auto; position: relative;top: 50%;transform: translateY(-50%);">
         	<div class="col-lg-12 col-sm-12 col-xs-12" style="margin:0;padding:0;">
         		<img src='assets/images/logo-amo.png' style="width: 100%;height: auto;">
 			    </div>
        	<div class="col-lg-12 col-sm-12 col-xs-12" style="margin:0;padding:0;text-align: center;">
         		<div class="fonte-subtitulo" style="display:inline-block;padding-top:10px;padding-bottom:70px;">Estatísticas do aplicativo</div>
 			  </div>
          <div class="col-lg-12 col-sm-12 col-xs-12" style="margin:0;padding:0;text-align: center;">
            <div class="fonte-subtitulo" style="display:inline-block;padding-bottom:15px;">
              <a href="relatoriolojistas.php"><img src='assets/images/lojistasnivelatv.png' style="width: 70%;height: auto;"></a>
            </div>
          </div>
             <div class="col-lg-12 col-sm-12 col-xs-12" style="margin:0;padding:0;text-align: center;">
            <div class="fonte-subtitulo" style="display:inline-block;padding-bottom:15px;">
             <a href="relatoriousuarios.php"><img src='assets/images/usuarionivelatv.png' style="width: 70%;height: auto;"></a>
            </div>
          </div>
               <div class="col-lg-12 col-sm-12 col-xs-12" style="margin:0;padding:0;text-align: center;">
            <div class="fonte-subtitulo" style="display:inline-block;padding-bottom:15px;">
              <a href="usuariosnotificacoes.php"><img src='assets/images/notificacoes.png' style="width: 70%;height: auto;"></a>
            </div>
          </div>
         <div class="col-lg-12 col-sm-12 col-xs-12" style="margin:0;padding:0;text-align: center;">
            <div class="fonte-subtitulo" style="display:inline-block;padding-bottom:15px;">
              <a href="listaatividadelojabairro.php"><img src='assets/images/reperclojas.png' style="width: 70%;height: auto;"></a>
            </div>
          </div>
		</div>
   </body>
</html>