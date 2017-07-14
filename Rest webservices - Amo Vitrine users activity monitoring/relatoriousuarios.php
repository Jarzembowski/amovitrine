<?php
session_start();

   include('httpful.phar');

    if (!isset($_SESSION['login'])) {
       header("location:index.html");
   }
   
   
   /* Usuários ativos/inativos */
   $uri = "http://localhost/atividade/consulta/totalinativos/";   
   $response = \Httpful\Request::get($uri)
   ->addHeader('Accept', 'application/json')
   ->send();
   
   $uri = "http://localhost/atividade/consulta/totalapp/";
   $responseTotalApp = \Httpful\Request::get($uri)
   ->addHeader('Accept', 'application/json')
   ->send();
   
   $total_usuarios_app = $responseTotalApp->body[0]->total_usuarios_app;
   $total_inativo = $response->body[0]->qt_inativos; 
   $total_ativo = $total_usuarios_app - $total_inativo;
   $pc_inativo = ceil($total_inativo * 100/$total_usuarios_app);
   $pc_ativo = floor($total_ativo * 100/$total_usuarios_app);
   
    /* Usuários inativos há mais de um mês */
   $uri = "http://localhost/atividade/consulta/totalinativoscritico/";   
   $response_critico = \Httpful\Request::get($uri)
   ->addHeader('Accept', 'application/json')
   ->send();


   $total_inativo_critico = $response_critico->body[0]->qt_inativos_critico; 
   $total_inativo_nao_critico = $total_inativo - $total_inativo_critico;
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
    

   </style>
   </head>
   <body>
      <!--Total de usuários: <?php echo $response->body[0]->total_usuarios_app;?><br>-->
      <!--Notificações das lojas ativadas: <?php echo $response->body[0]->total_ativado_lojasamei; ?><br>-->
      <!--Notificações das lojas desativadas: <?php echo $total_desativado_lojas_amei; ?><br>-->
      <!--Notificações do Amo Vitrine ativadas: <?php echo $response->body[0]->total_ativado_amovitrine; ?><br>-->
      <div style="position:fixed;width:100%;top:0;height:30px;background:#a5a5a5;z-index:1000;">
        <div style="float:left;padding-left:20px;padding-top:5px;color:#FFFFFF;font-weight:bold;">
          <a href="main.php">Voltar</a>
        </div>
        <div style="float:right;padding-right:20px;padding-top:5px;color:#FFFFFF;font-weight:bold;">
          Bem vindo, Administrador | <a href="logout.php">Sair</a>
        </div>
      </div>
      <div class="row" style="width: 96%;height: 85%;margin-left: auto;margin-right: auto; position: relative;top: 50%;transform: translateY(-50%);">
         <div class="col-lg-3 col-sm-3 col-xs-12" style="margin:0;padding:0;">
            <div class="row"  style="width: 100%;height:80%;margin:0;padding:0;min-width:300px">
               <div class="col-lg-12 col-sm-12 col-xs-12 texto-center">
                  <img src="assets/images/1464073792_user3.png">
               </div>
               <div class="col-lg-12 col-sm-12 col-xs-12 texto-center nopadding">
                  <font class="fonte-titulo">Usuários</font>
               </div>
               <div class="col-lg-12 col-sm-12 col-xs-12 nopadding texto-center" style="margin-bottom:20px;">        
                  <font class="fonte-total-label nopadding texto-center">(<?php echo $total_usuarios_app; ?>)</font>
               </div>
               <div class="col-lg-2 col-sm-2 col-xs-2"  style="line-height: 10px;">
                  &nbsp;
               </div>
               <div class="col-lg-8 col-sm-8 col-xs-8" style="text-align: center;margin-bottom:10px;">
                  <div style = "width:auto;display: inline-block;">
                     <div class="retangulo-ativo" ></div>
                     &nbsp;<font class="fonte-subtitulo">ATIVOS</font>&nbsp;
                     &nbsp;&nbsp;
                     <div class="retangulo-inativo"></div>
                     &nbsp;<font class="fonte-subtitulo">INATIVOS</font>
                  </div>
               </div>
               <div class="col-lg-2 col-sm-2 col-xs-2"   style="line-height: 10px;">
                  &nbsp;
               </div>
               <div class="col-lg-12 col-sm-12 col-xs-12">
                  <div class="ct-chart ct-perfect-fourth">                         
                  </div>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 nopadding" style="line-height: 30px; ">
                  &nbsp;
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 nopadding texto-center" style="line-height: 30px; ">
                  <font class="fonte-total-ativado nopadding"><?php echo $total_ativo; ?></font>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 nopadding texto-center">
                  <font class="fonte-total-desativado nopadding"><?php echo $total_inativo; ?></font>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3" style="line-height: 35px;">
                  &nbsp;
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3" style="line-height: 35px; ">
                  &nbsp;
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 texto-center">
                  <font class="fonte-pc-ativado"><?php echo $pc_ativo; ?>%</font>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 texto-center">
                  <font class="fonte-pc-desativado"><?php echo $pc_inativo; ?>%</font>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3" style="line-height: 35px;">
                  &nbsp;
               </div>

                <div class="col-lg-12 col-sm-12 col-xs-12 texto-center" style="text-align: center;">
                 <div style = "width:80%;display: inline-block;padding:0;margin:0;text-align: left;
                 background-image:url(fiopainel.png);background-size: 100%;line-height:60px;background-repeat: no-repeat;"> 
                  &nbsp;                
                  </div>
               </div>

               <div class="col-lg-12 col-sm-12 col-xs-12 texto-center" style="text-align: center;height:8%;margin-0;">
                 <div style = "width:80%;display: inline-block;padding:0;margin:0">    
                   <div id="progressbar"></div>
                </div>
               </div>
                
               <div class="col-lg-12 col-sm-12 col-xs-12 texto-center" style="text-align: center;padding-bottom:20px;">
                 <div style = "width:80%;display: inline-block;padding:0;margin:0">                         
                      <div class="fonte-total-inativo-critico" style="padding:0;float:left"><?php echo $total_inativo_critico; ?></div>
                      <div class="fonte-total-inativo-nao-critico" style="padding:0;float:right"><?php echo $total_inativo_nao_critico; ?></div>
                  </div>
               </div>
              

               <div class="col-lg-12 col-sm-12 col-xs-12 texto-center" style="position:relative;">
                  <font class="fonte-regra">
                  USUÁRIOS QUE NÃO APRESENTAREM NENHUM TIPO DE ATIVIDADE NO APLICATIVO EM <B>CINCO DIAS</B> SÃO CLASSIFICADOS COMO <B>INATIVO
                  </B> (INSTALARAM O APP MAS NÃO ESTÃO MAIS USANDO).
                  </font>
               </div>
            </div>
         </div>
         <div class="col-lg-9 col-sm-9 col-xs-12">

            <?php
             
              $uri = "http://localhost/atividade/consulta/getLista/";
              $responseListaApp = \Httpful\Request::get($uri)
              ->addHeader('Accept', 'application/json')


              ->send();

              $array = json_decode( $responseListaApp, true );

              echo "<table  class='table table-condensed' id='lista-usuarios' style='width:100%;'>";
              echo "<tr><td colspan='5'><input type='text' id='filter' class='form-control' placeholder='Pesquisar usuário'></td></tr>";
              echo "<thead>";
              echo "<tr>";
              echo "<th>#</th>";
              echo "<th>Nome Usuário</th>";
              echo "<th  align='center'>Status</th>";
              echo "<th>Dt. Última atividade</th>";
              echo "<th>Nível de atividade</th>";
              echo "</tr>";
              echo "<thead>";
              echo "<tbody class='searchable'>";

              $contador = 0;
              foreach ($array as $key => $jsons) { 

                   $contador += 1;

                   if($contador > 10){
                    echo "<tr class='oculto' style='display: none;'>";
                   }else{
                    echo "<tr class='visivel'>"; 
                   }
                   
                   if($jsons["status"] === "##0##"){
                      $classeFonte = "#EF4260";
                   }elseif($jsons["status"] === "##1##"){
                      $classeFonte = "#a5a5a5";
                   }
                   else{
                      $classeFonte = "#000000";
                   }
                   
                   foreach($jsons as $key => $value) {        
                      if($value === "##0##"){
                        echo "<td align='center'><div style='border-radius: 50%;width:10px;height: 10px;background:#EF4260'></div></td>";                          
                      }elseif($value === "##1##"){                        
                        echo "<td align='center'><div style='border-radius: 50%;width: 10px;height: 10px;background:#a5a5a5'></div></td>";  
                      }elseif($value === "##2##"){                        
                        echo "<td align='center'><div style='border-radius: 50%;width: 10px;height: 10px;background:#000000'></div></td>";  
                      }else{
                        echo "<td style = 'color:".$classeFonte."'>".$value."</td>";  
                      }
                       
                      
                  }
                  echo "</tr>";    

              }

              echo "<tr><td colspan='5'><input type='button' value='Mostrar mais' id='mostrarmais'></td></tr>";

              echo "</tbody>";
              echo "</table>";
              ?>
              
         </div>
      </div>

      <!-- Usuários -->
      <input type="hidden" name="total_usuarios_app" id="total_usuarios_app" value = "'<?php echo $total_usuarios_app; ?>'">
      <input type="hidden" name="total_ativado_lojasamei" id="total_ativado_lojasamei" value = "<?php echo $total_ativo; ?>">
      <input type="hidden" name="total_desativado_lojas_amei" id="total_desativado_lojas_amei" value = "<?php echo $total_inativo; ?>">

      <!-- Lojistas -->
      <input type="hidden" name="total_lojistas_app" id="total_lojistas_app" value = "'<?php echo $total_lojistas_app; ?>'">
      <input type="hidden" name="total_lojistas_inativo" id="total_lojistas_inativo" value = "<?php echo $total_lojistas_inativo; ?>">
      <input type="hidden" name="total_lojistas_ativo" id="total_lojistas_ativo" value = "<?php echo $total_lojistas_ativo; ?>">

      <!-- Desintalaram -->
      <input type="hidden" name="total_desinstalaram" id="total_desinstalaram" value = "<?php echo $total_inativo_critico; ?>">
      <input type="hidden" name="total_nao_desinstalaram" id="total_nao_desinstalaram" value = "<?php echo $total_inativo_nao_critico; ?>">
      
      <!-- Alerta -->
      <input type="hidden" name="pc_total_inativos" id="pc_total_inativos" value = "<?php echo $pc_inativo; ?>">
   

   </body>   
   <script src="assets/js/chartist.min.js"></script>
   <script src="assets/js/jquery-1.11.1.min.js"></script>
   <script src="assets/js/jquery-ui.js"></script>

   <script>

      /*Usuários*/
      var data = {
        labels: ['Notificações desativadas', 'Notificações ativadas'],
        series: [$("#total_desativado_lojas_amei").val(), $("#total_ativado_lojasamei").val()]
      };
      
      var options = {
        labelInterpolationFnc: function(value) {
          return value[0]
        },
         donut: true,
        showLabel: false,
          chartPadding: 0,
            labelOffset: 0,
      };
      
      var responsiveOptions = [
        ['screen and (min-width: 640px)', {
          chartPadding: 0,
          labelOffset: 0,
          labelDirection: 'explode',
          labelInterpolationFnc: function(value) {
            return value;
          }
        }],
        ['screen and (min-width: 1024px)', {
          labelOffset: 0,
          chartPadding: 0
        }]
      ];      
      new Chartist.Pie('.ct-chart', data, options, responsiveOptions);
      
      var qt_desinstalaram = $("#total_desinstalaram").val();
      var qt_nao_desinstalaram = $("#total_nao_desinstalaram").val();
      var total_grafico = Number(qt_desinstalaram) + Number(qt_nao_desinstalaram);

    /*Busca*/
     $(document).ready(function () {

      if(Number($("#pc_total_inativos").val()) > 75){
          alert("Atenção!! Mais de 75% dos usuários estão INATIVOS!!! FODEU!!!");
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

      $(function() {
        $( "#progressbar" ).progressbar({
          value: Number(qt_desinstalaram),
          max:Number(total_grafico)
        });
      });

    $("#mostrarmais").click(function() {

      if($("#lista-usuarios .oculto").length <= 10){
        $(this).css({"display": "none"}); 
      }

      $("#lista-usuarios .oculto").slice(0,10).css({"display": "table-row"});      
      $("#lista-usuarios .oculto").slice(0,10).removeClass( "oculto" ).addClass( "visivel" );
    });
      

   </script>

    
</html>