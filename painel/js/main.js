$(function(){
	var open = true;
	var windowSize = $(window)[0].innerWidth;
	// ? - seja : - caso contrário
	var targetSizeMenu = (windowSize <= 400) ? 200 : 300;



		
		
				$('[actionBtn=delete]').click(function(){
					var txt;
					var r = confirm("Deseja excluir o registro?");
					if (r === true) {
					    return true;
	

					} 
					else {
					    return false;
					}
				})

			$('[formato=data]').mask('99/99/9999');


		$('nav.mobile').click(function(){
		//O que vai acontecer quando clicarmos na nav.mobile!
		var listaMenu = $('nav.mobile ul');
		//Abrir menu através do fadein
		/*
		if(listaMenu.is(':hidden') == true){
			listaMenu.fadeIn();
		}
		else{
			listaMenu.fadeOut();
		}
		*/

		//Abrir ou fechar sem efeitos
		/*
		
		if(listaMenu.is(':hidden') == true){
			//listaMenu.show();
			listaMenu.css('display','block');
		}
		else{
			//listaMenu.hide();
			listaMenu.css('display','none');
		}
		*/

		if(listaMenu.is(':hidden') == true){
			//fa fa-times
			//fa fa-bars
			//var icone =  $('.botao-menu-mobile i');
			var icone = $('.botao-menu-mobile').find('i');
			icone.removeClass('fa-bars');
			icone.addClass('fa-times');
			listaMenu.slideToggle();
		}
		else{
			var icone = $('.botao-menu-mobile').find('i');
			icone.removeClass('fa-times');
			icone.addClass('fa-bars');
			listaMenu.slideToggle();
		}

	});


		$('nav.mobile2').click(function(){
		//O que vai acontecer quando clicarmos na nav.mobile!
		var listaMenu = $('nav.mobile2 ul');
		//Abrir menu através do fadein
		/*
		if(listaMenu.is(':hidden') == true){
			listaMenu.fadeIn();
		}
		else{
			listaMenu.fadeOut();
		}
		*/

		//Abrir ou fechar sem efeitos
		/*
		
		if(listaMenu.is(':hidden') == true){
			//listaMenu.show();
			listaMenu.css('display','block');
		}
		else{
			//listaMenu.hide();
			listaMenu.css('display','none');
		}
		*/

		if(listaMenu.is(':hidden') == true){
			//fa fa-times
			//fa fa-bars
			//var icone =  $('.botao-menu-mobile i');
			var icone = $('.botao-menu-mobile2').find('i');
			icone.removeClass('fa-bars');
			icone.addClass('fa-times');
			listaMenu.slideToggle();
		}
		else{
			var icone = $('.botao-menu-mobile2').find('i');
			icone.removeClass('fa-times');
			icone.addClass('fa-bars');
			listaMenu.slideToggle();
		}

	});



			

	})


