
var form = $('.form');
var btn = $('#btlogin');
var topbar = $('.topbar');
var input = $('#senha');
var article =$('.article');
var tries = 0;
var h = input.height();
$('.spanColor').height(h+23);

input.on('focus',function(){
  topbar.removeClass('error success');
  input.text('');
});

btn.on('click',function(){
 		
		$.ajax({
		  url: '../../atividade/login.php',	     
		  data: {'senha' : input.val()},
	      type: 'POST',
	      dataType: 'text',
		  success: function(data) {


				    if(data==1){

						
						setTimeout(function(){
						  btn.text('Success!');
						},250);
						topbar.addClass('success');
						form.addClass('goAway');
						window.location.href = "../../atividade/main.php";
						//logar
				  }
				    else{
						topbar.addClass('error');
						//Erro
				    } 

		  } 
		  ,error: function(jqXHR, textStatus, errorThrown){
	     				alert(textStatus, errorThrown);
  				}
		});


 
});




$('.form').keypress(function(e){
   if(e.keyCode==13)  
   btn.click();
});

input.keypress(function(){
  topbar.removeClass('success error');
});