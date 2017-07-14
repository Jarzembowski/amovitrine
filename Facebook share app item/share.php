<?php
include_once('safe/conn.php');

$pdo = pdo();
$ItemId = $_GET['ItemId'];

$Query = "SELECT item.ItemId,ItemCodigo,ItemSituacao,ItemCategoria,ItemValor1,ItemValor2,ItemTipo,ItemNome,ItemDescricao,ItemAvatar,
CAST(REPLACE(REPLACE(`ItemValor1`,'.',''),',','.') AS DECIMAL(10,2)) as vl_formatado1, 
CAST(REPLACE(REPLACE(`ItemValor2`,'.',''),',','.') AS DECIMAL(10,2)) as vl_formatado2,LojaBairro,
ItemPendencia, TipoNome, CategoriaNome,LojaPagamentos, LojaEndereco, loja.LojaId, loja.LojaNome, loja.LojaCapa, loja.LojaImagem, loja.LojaPagamentos, loja.LojaStatus as StatusLoja ,LojaTelefone1,LojaTelefone2,case IFNULL(`ItemValor1`, 0) when 0 then 0 else 1 end as fl_preco_de, case IFNULL(`ItemValor2`, 0) when 0 then 0 else 1 end as fl_preco_por   FROM `item` LEFT JOIN tipo ON tipo.TipoId = item.ItemTipo LEFT JOIN categoria ON item.ItemCategoria = categoria.CategoriaId LEFT JOIN itemloja ON itemloja.ItemId = item.ItemId LEFT JOIN loja ON itemloja.LojaId = loja.LojaId LEFT JOIN itemtempo ON itemtempo.ItemId = item.ItemId WHERE item.ItemId=?";

$go = $pdo->prepare($Query);
$go->bindParam(1,$ItemId);
$go->execute();

$data = $go->fetchAll(PDO::FETCH_ASSOC);


header('Content-type: text/html;');


?>


<html>
   <head>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="assets/css/bootstrap.css">
      <link rel="stylesheet" href="assets/css/style.css">
       <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Open Graph meta tags -->
    <meta prefix="fb: http://ogp.me/ns/fb#" property="fb:app_id" content="209966506002524" />
    <meta property="og:site_name" content="AmoVitrine"/>
    <meta property="og:url" content="http://amovitrine.com.br/share/itemshare.php?ItemId=<?php echo $data[0]['ItemId'];?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="<?php echo $data[0]['ItemNome']; ?>"/>
    <meta property="og:image" content="<?php echo $data[0]['ItemAvatar']; ?>"/>
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <meta property="og:description" content="<?php echo $data[0]['ItemDescricao']; ?>"/>


    <title>Amo Vitrine</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>    
    <script>
        window.fbAsyncInit = function () {
            FB.init({
                appId: '209966506002524',
                xfbml: true,
                version: 'v2.5'
            });
        };

        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

   </head>
   <body>
      <div class="container">
         <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 nopadding">
               <div class="imagem-topo">
                  <img class="img-responsive" src="assets/images/logoamo.png">
               </div>
            </div>

            <?php
            echo "<div class='col-lg-12 col-sm-12 col-xs-12 nopadding content-endereco ";
            if($data[0]['ItemCodigo']  == 0 &&  $data[0]['ItemCodigo']  == ""){
              echo " oculta";
             } 
             echo " '>";
            ?>
             <div class="referencia">
                  REFERÊNCIA DO ITEM: <font class="referencia-bold"><?php echo $data[0]['ItemCodigo'] ?></font>
               </div>
            </div>
            
            <div class="col-lg-12 col-sm-12 col-xs-12 nopadding content-interno-topo">
               <div class="col-lg-12 col-sm-12 col-xs-12 nopadding">
                  <div class="imagem-topo">
                     <img class="img-responsive" src="<?php echo $data[0]['ItemAvatar']; ?>">
                  </div>
               </div>
               <div class="col-lg-12 col-sm-12 col-xs-12 nopadding sombra-caixa">

                  
                  <?php

                     $VarCLasseValorNaoInformado = "oculta";
                     if($data[0]['fl_preco_de']  <> 0 &&  $data[0]['fl_preco_por']  <> 0){
                        $varClassesPrecoDe = "col-lg-6 col-sm-6 col-xs-6 nopadding caixa-preco ";                        
                        $varClassesPrecoPor = "col-lg-6 col-sm-6 col-xs-6 nopadding caixa-preco ";
                      }
                     elseif($data[0]['fl_preco_de']  <> 0  && $data[0]['fl_preco_por']  == 0){
                        $varClassesPrecoDe = "col-lg-12 col-sm-12 col-xs-12 nopadding caixa-preco ";
                        $varClassesPrecoPor = "oculta";                        
                      }
                      elseif($data[0]['fl_preco_por']  <> 0 &&  $data[0]['fl_preco_de']  == 0){
                        $varClassesPrecoPor = "col-lg-12 col-sm-12 col-xs-12 nopadding caixa-preco ";
                        $varClassesPrecoDe = "oculta";
                      }
                     else{
                        $varClassesPrecoPor = "oculta";
                        $varClassesPrecoDe = "oculta";
                        $VarCLasseValorNaoInformado = "col-lg-12 col-sm-12 col-xs-12 nopadding caixa-preco ";
                     }


                     $arrPrecoDe = explode (".", $data[0]['vl_formatado1']);   
                     $arrPrecoPor = explode (".", $data[0]['vl_formatado2']);   
                 ?>

                  <!-- varClassesPrecoDE -->  
                  <div class="<?php echo $varClassesPrecoDe; ?>">   
                        <?php if($varClassesPrecoPor != "oculta"){
                            echo "<div class='fonte-preco  texto-cinza '>";}
                            else{
                              echo "<div class='fonte-preco  texto-rosa '>";
                            }
                        ?>
                          <font class="fonte-preco-moeda">R$ </font>
                            <?php if($varClassesPrecoPor != "oculta"){
                              echo "<s class='texto-cortado'><span class='fonte-preco  texto-cinza'>".$arrPrecoDe[0]."</span></s>";}
                            else{
                              echo $arrPrecoDe[0];
                            }
                        ?><font class="fonte-preco-moeda">,<?php echo $arrPrecoDe[1]; ?></font>
                       </div>
                  </div>
                  
                  <!-- varClassesPrecoPor -->                  
                  <div class="<?php echo $varClassesPrecoPor; ?>">
                     <div class="fonte-preco   texto-rosa ">
                        <font class="fonte-preco-moeda">R$ </font><?php echo $arrPrecoPor[0]; ?><font class="fonte-preco-moeda">,<?php echo $arrPrecoPor[1]; ?></font>
                     </div>
                  </div>

                  <!-- valornaoinformado -->
                  <!--<div class="<?php echo $VarCLasseValorNaoInformado; ?>">
                     <div class="fonte-preco   texto-rosa ">
                        <font class="fonte-preco-moeda">&nbs</font>
                     </div>
                  </div>-->

               </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12 nopadding content-interno">
               <div class="col-lg-12 col-sm-12 col-xs-12 logo-loja">
                  <div class="imagem-topo" >
                     <img class="img-responsive-logo" src="<?php echo $data[0]['LojaImagem']; ?>">
                  </div>
               </div>
               <div class="col-lg-12 col-sm-12 col-xs-12 nopadding">
                  <div class="nome-loja nopadding">
                     <?php echo $data[0]['LojaNome']; ?>
                  </div>
               </div>
               <div class="col-lg-12 col-sm-12 col-xs-12 content-endereco">
                  <div class="end-loja">
                     <?php echo $data[0]['LojaEndereco']." - ".$data[0]['LojaBairro']; ?>
                  </div>
               </div>
               <div class="col-lg-6 col-sm-6 col-xs-6  fone ">
                  <div class="fonte-fone   texto-cinza-escuro arredondado-esquerda">
                     <span class="glyphicon  glyphicon-earphone icones"></span>&nbsp;<?php echo $data[0]['LojaTelefone1']; ?>
                  </div>                 
               </div>
               
               <div class="col-lg-6 col-sm-6 col-xs-6  fone ">
                  <div class="fonte-fone   texto-cinza-escuro arredondado-direita">
                     <span class="glyphicon  glyphicon-phone icones"></span>&nbsp;<?php echo $data[0]['LojaTelefone2']; ?>
                  </div>
               </div>
            </div>
            <div class="col-lg-12 col-sm-12 col-xs-12 nopadding">
               <div class="imagem-topo">
                  <img class="img-responsive" src="assets/images/rodape.png">
               </div>
            </div>
         </div>
      </div>
   </body>
   <script src="js/bootstrap.min.js"></script>	
</html>
