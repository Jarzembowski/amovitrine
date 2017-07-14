<?php
   include('httpful.phar');
   
   
   
   $uri = "http://localhost/atividade/consulta/total/";
   $response = \Httpful\Request::get($uri)
   ->addHeader('Accept', 'application/json')
   ->send();

   $total_usuarios_app = $response->body[0]->total_usuarios_app;
   
   
   /* Notificações dos lojistas */
   $total_ativado_lojasamei = $response->body[0]->total_ativado_lojasamei; 
   $total_desativado_lojas_amei = $total_usuarios_app - $total_ativado_lojasamei;
   $pc_desativado_lojas_amei = ceil($total_desativado_lojas_amei * 100/$total_usuarios_app);
   $pc_ativado_lojas_amei = floor($total_ativado_lojasamei * 100/$total_usuarios_app);
   
   /* Notificações amo vitrine */
   $total_ativado_amovitrine = $response->body[0]->total_ativado_amovitrine; 
   $total_desativado_amovitrine = $total_usuarios_app - $total_ativado_amovitrine;
   $pc_desativado_amovitrine = ceil($total_desativado_amovitrine * 100/$total_usuarios_app);
   $pc_ativado_amovitrine = floor($total_ativado_amovitrine * 100/$total_usuarios_app);

   
   ?>
<html>
   <head>
      <style type="text/css">
         .ct-chart{
         max-width: 500px;
         max-height: 500px;
         }

          a{
            text-decoration: none;
            color: inherit;    
          }

           a:hover{
            text-decoration: none;
            color: inherit;    
          }

           a:active{
            text-decoration: none;
            color: inherit;    
          }

            a:link{
            text-decoration: none;
            color: inherit;    
          }
          

      </style>
      <link rel="stylesheet" href="assets/css/chartist.css">
      <link rel="stylesheet" href="assets/css/style.css">
      <link rel="stylesheet" href="assets/css/bootstrap.css">      
      <link rel="stylesheet" href="assets/css/jquery-ui.css">    
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   </head>
   <body>
      <!--Total de usuários: <?php echo $response->body[0]->total_usuarios_app;?><br>-->
      <!--Notificações das lojas ativadas: <?php echo $response->body[0]->total_ativado_lojasamei; ?><br>-->
      <!--Notificações das lojas desativadas: <?php echo $total_desativado_lojas_amei; ?><br>-->
      <!--Notificações do Amo Vitrine ativadas: <?php echo $response->body[0]->total_ativado_amovitrine; ?><br>-->
      <div style="position:fixed;width:100%;top:0;height:30px;background:#a5a5a5;z-index:1000;">
        <div style="float:left;padding-left:20px;padding-top:5px;color:#FFFFFF;font-weight:bold;">
          <a style="color:#FFFFFF;text-decoration: none;" href="main.php">Voltar</a>
        </div>
        <div style="float:right;padding-right:20px;padding-top:5px;color:#FFFFFF;font-weight:bold;">
          Bem vindo, Administrador | <a style="color:#FFFFFF;text-decoration: none;" href="logout.php">Sair</a>
        </div>
      </div>
      <div class="row" style="width: 96%;height: 85%;margin-left: auto;margin-right: auto; position: relative;top: 50%;transform: translateY(-50%);">

         <div class="col-lg-3 col-sm-3 col-xs-3 nopadding texto-center">        
            <font class="fonte-total-label nopadding texto-center">&nbsp;</font>
         </div>
         <div class="col-lg-6 col-sm-6 col-xs-6 nopadding texto-center">        
            <font class="fonte-total-label nopadding texto-center">Total de usuários: <?php echo $total_usuarios_app; ?></font>
         </div>

         <div class="col-lg-3 col-sm-3 col-xs-3 nopadding texto-center">        
            <font class="fonte-total-label nopadding texto-center">&nbsp;</font>
         </div>

    
    
          <div class="col-lg-3 col-sm-3 col-xs-3">
         &nbsp;
         </div>

         <div class="col-lg-3 col-sm-3 col-xs-3" style="margin:0;padding:0;">
            <div class="row"  style="width: 100%;height:80%;margin:0;padding:0;min-width:300px">
               <div class="col-lg-12 col-sm-12 col-xs-12 texto-center nopadding"  style="margin-bottom:20px;">
                  <font class="fonte-titulo-notificacoes">Notificações dos lojistas</font>
               </div>
               <div class="col-lg-1 col-sm-1 col-xs-1"  style="line-height: 10px;">
                  &nbsp;
               </div>
               <div class="col-lg-5 col-sm-5 col-xs-5 rect-ativoinativo nopadding"  style="line-height: 10px;">
                  <div class="legenda-content">
                     <div class="retangulo-ativo"></div>
                     &nbsp;<font class="fonte-subtitulo">ATIVADAS</font>
                  </div>
               </div>
               <div class="col-lg-5 col-sm-5 col-xs-5 rect-ativoinativo nopadding"  style="line-height: 5px;padding:0;margin:0;">
                  <div class="legenda-content nopadding" style="align:left;">
                     <div class="retangulo-inativo"></div>
                     &nbsp;<font class="fonte-subtitulo">DESATIVADAS</font>
                  </div>
               </div>
               <div class="col-lg-1 col-sm-1 col-xs-1"   style="line-height: 10px;">
                  &nbsp;
               </div>
               <div class="col-lg-12 col-sm-12 col-xs-12 nopadding">
                  <div id="grafico-lojista" class="ct-chart ct-perfect-fourth nopadding"></div>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 nopadding" style="line-height: 30px; ">
                  &nbsp;
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 nopadding texto-center" style="line-height: 30px; ">
                  <font class="fonte-total-ativado nopadding"><?php echo $total_ativado_lojasamei; ?></font>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 nopadding texto-center">
                  <font class="fonte-total-desativado nopadding"><?php echo $total_desativado_lojas_amei; ?></font>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3" style="line-height: 35px; ">
                  &nbsp;
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3" style="line-height: 5px;  ">
                  &nbsp;
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 texto-center" style="margin-left:5px">
                  <font class="fonte-pc-ativado"><?php echo $pc_ativado_lojas_amei; ?>%</font>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 texto-center">
                  <font class="fonte-pc-desativado"><?php echo $pc_desativado_lojas_amei; ?>%</font>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3" style="line-height: 5px;  ">
                  &nbsp;
               </div>
               <div class="col-lg-12 col-sm-12 col-xs-12 texto-center">
                  <font class="fonte-regra">Quantidade de usuários que desativaram pelo menu a opção de notificações das lojas amadas.
                  </font>
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-sm-3 col-xs-3" style="margin:0;padding:0;">
            <div class="row"  style="width: 100%;height:80%;margin:0;padding:0;min-width:300px">
               <div class="col-lg-12 col-sm-12 col-xs-12 texto-center nopadding"  style="margin-bottom:20px;">
                  <font class="fonte-titulo-notificacoes">Notificações do Amo Vitrine</font>
               </div>
               <div class="col-lg-1 col-sm-1 col-xs-1"  style="line-height: 10px;">
                  &nbsp;
               </div>
               <div class="col-lg-5 col-sm-5 col-xs-5 rect-ativoinativo nopadding"  style="line-height: 10px;">
                  <div class="legenda-content">
                     <div class="retangulo-ativo"></div>
                     &nbsp;<font class="fonte-subtitulo">ATIVADAS</font>
                  </div>
               </div>
               <div class="col-lg-5 col-sm-5 col-xs-5 rect-ativoinativo nopadding"  style="line-height: 5px;padding:0;margin:0;">
                  <div class="legenda-content nopadding" style="align:left;">
                     <div class="retangulo-inativo"></div>
                     &nbsp;<font class="fonte-subtitulo">DESATIVADAS</font>
                  </div>
               </div>
               <div class="col-lg-1 col-sm-1 col-xs-1"   style="line-height: 10px;">
                  &nbsp;
               </div>
               <div class="col-lg-12 col-sm-12 col-xs-12 nopadding">
                  <div id="grafico-amovitrine" class="ct-chart ct-perfect-fourth nopadding"></div>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 nopadding" style="line-height: 30px; ">
                  &nbsp;
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 nopadding texto-center" style="line-height: 30px; ">
                  <font class="fonte-total-ativado nopadding"><?php echo $total_ativado_amovitrine; ?></font>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 nopadding texto-center">
                  <font class="fonte-total-desativado nopadding"><?php echo $total_desativado_amovitrine; ?></font>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3" style="line-height: 35px; ">
                  &nbsp;
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3" style="line-height: 5px;  ">
                  &nbsp;
               </div>            
               <div class="col-lg-3 col-sm-3 col-xs-3 texto-center" style="margin-left:5px">
                  <font class="fonte-pc-ativado"><?php echo $pc_ativado_amovitrine; ?>%</font>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3 texto-center">
                  <font class="fonte-pc-desativado"><?php echo $pc_desativado_amovitrine; ?>%</font>
               </div>
               <div class="col-lg-3 col-sm-3 col-xs-3" style="line-height: 5px;  ">
                  &nbsp;
               </div>
               <div class="col-lg-12 col-sm-12 col-xs-12 texto-center">
                  <font class="fonte-regra">Quantidade de usuários que desativaram pelo menu a opção de notificações do Amo Vitrine.
                  </font>
               </div>
            </div>
         </div>
         <div class="col-lg-3 col-sm-3 col-xs-3">
         &nbsp;
         </div>
      </div>
      <input type="hidden" name="total_usuarios_app" id="total_usuarios_app" value = "'<?php echo $total_usuarios_app; ?>'">
      <input type="hidden" name="total_ativado_lojasamei" id="total_ativado_lojasamei" value = "<?php echo $total_ativado_lojasamei; ?>">
      <input type="hidden" name="total_desativado_lojas_amei" id="total_desativado_lojas_amei" value = "<?php echo $total_desativado_lojas_amei; ?>">
      <input type="hidden" name="total_ativado_lojasamei" id="total_ativado_amovitrine" value = "<?php echo $total_ativado_amovitrine; ?>">
      <input type="hidden" name="total_desativado_lojas_amei" id="total_desativado_amovitrine" value = "<?php echo $total_desativado_amovitrine; ?>">

   </body>
   <script src="assets/js/jquery-1.11.1.min.js"></script>  
   <script src="assets/js/chartist.min.js"></script>
   <script src="assets/js/jquery-1.11.1.min.js"></script>
   <script src="assets/js/jquery-ui.js"></script>
   <script>
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
      
      new Chartist.Pie('#grafico-lojista', data, options, responsiveOptions);

      var data = {
        labels: ['Notificações desativadas', 'Notificações ativadas'],
        series: [$("#total_desativado_amovitrine").val(), $("#total_ativado_amovitrine").val()]
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
      
      new Chartist.Pie('#grafico-amovitrine', data, options, responsiveOptions);
      
      
        
   </script>
</html>