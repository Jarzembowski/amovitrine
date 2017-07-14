<?php
include('httpful.phar');

//$response = \Httpful\Request::get($uri)->expectsXml()->send();
$uri = "http://localhost/notificacao/consulta/total/";

$response = \Httpful\Request::get($uri)
->addHeader('Accept', 'application/json')
->send();
 
$total_usuarios_app = $response->body[0]->total_usuarios_app;
$total_ativado_amovitrine = $response->body[0]->total_ativado_amovitrine; 
$total_desativado_amovitrine = $total_usuarios_app - $total_ativado_amovitrine;

$pc_desativado_amovitrine = ceil($total_desativado_amovitrine * 100/$total_usuarios_app);
$pc_ativado_amovitrine = floor($total_ativado_amovitrine * 100/$total_usuarios_app);

//SELECT usuario.UserId FROM `usuarioitem` left outer join usuario on usuarioitem.UserId = usuario.UserId group by usuario.UserId
//SELECT usuario.UserId , GREATEST(IFNULL(dataAmado,'1900-01-01'), IFNULL(dataVisto,'1900-01-01'),IFNULL(dataCompartilhado, '1900-01-01')) FROM `usuario` left outer join usuarioitem on usuarioitem.UserId = usuario.UserId group by usuario.UserId
//SELECT usuario.UserId , datediff(now(), ifNull(greatest(max(dataAmado),max(dataVisto),max(dataCompartilhado)),'2016-01-01')) as nr_dias_inativo FROM `usuario` left outer join usuarioitem on usuarioitem.UserId = usuario.UserId where UserType = 1 group by usuario.UserId order by nr_dias_inativo desc

//FINAL LISTA
//SELECT usuario.UserId , datediff(now(), ifNull(greatest(max(dataAmado),max(dataVisto),max(dataCompartilhado)),'2016-01-01')) as nr_dias_inativo FROM `usuario` left outer join usuarioitem on usuarioitem.UserId = usuario.UserId where UserType = 1 group by usuario.UserId having nr_dias_inativo > 100 order by nr_dias_inativo desc


//FINAL TOTAL INATIVOS
//SELECT count(*) from ( select count(usuario.UserId) FROM `usuario` left outer join usuarioitem on usuarioitem.UserId = usuario.UserId where UserType = 1 group by usuario.UserId having datediff(now(), ifNull(greatest(max(dataAmado),max(dataVisto),max(dataCompartilhado)),'2016-01-01')) > 100) as total


?>
<html>
<head>
<style type="text/css">
	.ct-chart{

		max-width: 500px;
		max-height: 500px;
	}

</style>
 <link rel="stylesheet" href="chartist.css">
 <link rel="stylesheet" href="style.css">
 <link rel="stylesheet" href="assets/css/bootstrap.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>


<body>
	<!-- Total de usuários: <?php echo $total_usuarios_app;?><br>
	Notificações das lojas desativadas: <?php echo $total_desativado_amovitrine; ?><br>
	Notificações do Amo Vitrine ativadas: <?php echo $total_ativado_amovitrine; ?><br>-->

      <div class="container nopadding">
         <div class="row">
           <div class="col-lg-12 col-sm-12 col-xs-12 texto-center nopadding"  style="margin-bottom:20px;">
               <font class="fonte-titulo">Notificações do Amo Vitrine</font>
            </div>
          
            <div class="col-lg-1 col-sm-1 col-xs-1"  style="line-height: 10px;">
                &nbsp;
            </div>
                <div class="col-lg-5 col-sm-5 col-xs-5 rect-ativoinativo nopadding"  style="line-height: 10px;">
                  <div class="legenda-content"><div class="retangulo-ativo"></div>&nbsp;<font class="fonte-subtitulo">ATIVADAS</font></div>
                </div>
                <div class="col-lg-5 col-sm-5 col-xs-5 rect-ativoinativo nopadding"  style="line-height: 5px;padding:0;margin:0;">
                  <div class="legenda-content nopadding" style="align:left;"><div class="retangulo-inativo"></div>&nbsp;<font class="fonte-subtitulo">DESATIVADAS</font></div>
                </div>
                         
             <div class="col-lg-1 col-sm-1 col-xs-1"   style="line-height: 10px;">
                &nbsp;
            </div>     
      
            <div class="col-lg-12 col-sm-12 col-xs-12 nopadding">        
               <div class="ct-chart ct-perfect-fourth nopadding"></div>
            </div>

             <div class="col-lg-12 col-sm-12 col-xs-12 nopadding texto-center" style="margin-top: -115px; ">        
                <font class="fonte-total-label nopadding texto-center">Total <?php echo $total_usuarios_app; ?></font>
            </div>


            <div class="col-lg-3 col-sm-3 col-xs-3 nopadding" style="line-height: 30px; ">
                &nbsp;
            </div>   
            <div class="col-lg-3 col-sm-3 col-xs-3 nopadding texto-center" style="line-height: 35px; ">
                <font class="fonte-total-ativado nopadding"><?php echo $total_ativado_amovitrine; ?></font>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-3 nopadding texto-center" style="line-height: 35px; ">
                <font class="fonte-total-desativado nopadding"><?php echo $total_desativado_amovitrine; ?></font>
            </div>
            <div class="col-lg-3 col-sm-3 col-xs-3" style="line-height: 35px; ">
                &nbsp;
            </div>

             <div class="col-lg-3 col-sm-3 col-xs-3" style="line-height: 5px;">
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

    <input type="hidden" name="total_usuarios_app" id="total_usuarios_app" value = "'<?php echo $total_usuarios_app; ?>'">
    <input type="hidden" name="total_ativado_amovitrine" id="total_ativado_amovitrine" value = "<?php echo $total_ativado_amovitrine; ?>">
    <input type="hidden" name="total_desativado_amovitrine" id="total_desativado_amovitrine" value = "<?php echo $total_desativado_amovitrine; ?>">

</body>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>  
  <script src="chartist.min.js"></script>
  <script>
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

new Chartist.Pie('.ct-chart', data, options, responsiveOptions);


  </script>
</html>
