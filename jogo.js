$(function($){

	$(document).ready(function() {
		$.post("query.php",{query: "carregar-resposta"},function(r){
			
		var cod = r.split(",");

		$(".question").each(function(){
			for(var i=0;i<=cod.length;i++){
				
				if($(this).attr("cod")==cod[i]){//$(this).attr("cod")
					$(this).addClass("respond");
					console.log("["+i+"] "+$(this).attr("cod") + " - " + cod[i]);
				}

			}

		});
			
			
			
  		});
	});

	$("#meu-projeto").click(function(){
		$("#dialog-projeto").dialog("open");
	});
	
	$("#dialog-projeto").dialog({

		autoOpen: false, modal: true, position: 'top',
	  	buttons: {
	  		"Salvar" : function(){
				if($('#nome').val()!=''){
		  			$.post("query.php",{query: "salvar-projeto", nome:$("#nome").val(), 
					empreendedor:$("#empreendedor").val()}, 					
					function(r){				
		  				$("#dialog-projeto").dialog("close");
		  			});
				}
	  		},
			"Cancelar" : function(){
	  			$(this).dialog("close");
	  		},
	  		"Novo" : function(){
	  			$.post("query.php",{query: "reseta-projeto"}, 					
					function(r){				
		  				$("#dialog-projeto").dialog("close");
		  			});
	  		},
	  		"Gerar Canvas" : function(){
	  			window.location.href='gerar_canvas.php';
	  		}
	  	}
	  });
//});

	$(".question").click(function(){
		
		var cod = $(this).attr("cod");
		var id = $(this).attr("id");
		if(cod==15){
			alert('Seja bem vindo!');
		}else if(cod=='16'){
			$.post("query.php",{query: "verifica-fim", id: cod},function(r){
				
				if(r>0){
					alert('Para completar o jogo você precisará responder todas as perguntas, não desista!');
				}else{
					alert('Parabens!');
				}
				
			
	  		});
		}else{
			$("#dialog-pergunta").attr("cod",cod);
			$("#dialog-pergunta").attr("nome",id);

			$.post("query.php",{query: "pergunta", id: cod},function(r){
				$("#dialog-pergunta").html(r+"<textarea rows='4' cols='22' id='resposta' name='resposta'></textarea>");
			
				$("#dialog-pergunta").dialog("open");
			
	  		});
		}
		
	});
	
	//$("#dialog-pergunta").dialog("close");
	
	$("#dialog-pergunta").dialog({

		
	  	
		autoOpen: false, modal: true, position: 'top',
	  	buttons: {
	  		"Salvar" : function(){
				if($('#resposta').val()!=''){
	  			$.post("query.php",{query: "salvar-resposta", id:$(this).attr("cod"), resposta:$("#resposta").val()}, function(r){				
					$("#"+$("#dialog-pergunta").attr("nome")).addClass("respond");
	  				$("#dialog-pergunta").dialog("close");
	  			});
}else{
	$("#resposta").css("border","1 px solid red");
}
	  		},
	  		"Cancelar" : function(){
	  			$(this).dialog("close");
	  		}
	  	}
	  });

	
	
});
