$(function(){
    getData();

});



function getData(){
    totalclientes =0;

    totalclientes = 0;
    var url = "getters/getShare.php?ItemId="+ItemId;
    var data = "";

    $.get(url, function(response){

        serverResponse = response;
        console.log(response);

        for(i in response.content){
            var avatar =
                '\
               <img src="'+response.content[i].ItemAvatar+'">';


            var Valor1 = response.content[i].ItemValor1;
            var Valor2 = response.content[i].ItemValor2;

            if(Valor1 != "" && Valor2 != ""){
                document.getElementById("bootstrapPreco").style.display= "block";
                document.getElementById("bootstrapPromo").style.display= "block";
            }
            else if (Valor1 != "" && Valor2 == ""){
                document.getElementById("bootstrapPreco").style.display= "block";
            }
            else{
                document.getElementById("semPreco").style.display= "block";
            }
            var array1 = Valor1.split(',');
            var array2 = Valor2.split(',');
            var tipo = response.content[i].TipoNome;
            var Pagamentos = response.content[i].LojaPagamentos;
            var NomeItem = response.content[i].ItemNome;
            var Descricao = response.content[i].ItemDescricao;
            var Status =  response.content[i].ItemPendencia;
            if(Status == 1){
                var dsp = "Item disponivel";
            }else{
                var dsp = "Item indisponivel";
            }
            var NomeLoja = response.content[i].LojaNome;
            var endereco = response.content[i].LojaEndereco;
            var tel1 = response.content[i].LojaTelefone1;
            var tel2 = response.content[i].LojaTelefone2;
            var Logo =
                '\
               <img src="'+response.content[i].LojaImagem+'" alt="logoLoja" height="150" width="150">';

        }
            var promo2 = ","+array1[1];
            var valor2 = ","+array2[1];

        $('#valor1').empty();
        $('#valor1').append(array1[0]);
        $('#valor2').empty();
        $('#valor2').append(promo2);
        $('#promo1').empty();
        $('#promo1').append(array2[0]);
        $('#promo2').empty();
        $('#promo2').append(valor2);
        

    });
}



