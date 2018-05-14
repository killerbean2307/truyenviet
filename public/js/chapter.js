$(document).ready(function(){
	$('#theme_setting').show();

	if($.cookie('background-color'))
	{
		$('body').css('background-color', $.cookie('background-color'));
		$('.content').css({'background-color':$.cookie('content-color'), 'color': $.cookie('font-color')});
		$('.background-color').each(function(){
			if(hexToRgb($(this).data('background-color')) == $.cookie('background-color')){
				$(this).addClass('background-active');
			}
		});
	}
	if($.cookie('font-family'))
	{	
		$('.content').css('font-family', $.cookie('font-family'));
		$('.font-family').val($.cookie('font-family')).change();
		// $(document).find('select[name=font-family]').val($.cookie('font-family')).change();
		// $("#font-family > option[value=" + $.cookie('font-family') + "]").prop("selected",true);		
	}

	if($.cookie('font-size'))
	{
		$('.content').css('font-size', $.cookie('font-size')+"px");
		// $('.font-size').css('border','3px solid red');
		var fontsize = $.cookie('font-size');
		// alert(fontsize);
		$('.font-size').val(fontsize);
	}

	if($.cookie('line-height'))
	{
		$('.content').css('line-height', $.cookie('line-height'));
		$('.line-height').val($.cookie('line-height')).change();
	}

	$(document).on('click','.background-color',function(){
		$('body').css('background-color', $(this).css('background-color'));

		$('.content').css({'background-color':$(this).data('content-color'), 'color': $(this).data('font-color')});

		$('.background-color').each(function(){
			$(this).removeClass('background-active');
		});

		$(this).addClass('background-active');

		$.cookie('background-color', $(this).css('background-color'), { expires: 10000 , path:'/'});
		$.cookie('content-color', $(this).data('content-color'), { expires: 10000,  path:'/' });
		$.cookie('font-color', $(this).data('font-color'), { expires: 10000, path:'/'});
	});

	$(document).on('change','.font-family', function(){
		$('.content').css('font-family', $(this).val());
		$.cookie('font-family', $(this).val(), { expires: 10000,  path:'/' });		
	});

	$(document).on('change','.font-size', function(){
		$('.content').css('font-size', $(this).val()+"px");
		$.cookie('font-size', $(this).val(), { expires: 10000, path:'/' });		
	});

	$(document).on('change','.line-height', function(){
		$('.content').css('line-height', $(this).val());
		$.cookie('line-height', $(this).val(), { expires: 10000, path:'/'});		
	});

	$('[data-toggle="popover"]').popover({
		html: true,
		content: function(){
			return $('#data-content').html();
		}
	}); 

	function hexToRgb(hex, alpha) {
	   hex   = hex.replace('#', '');
	   var r = parseInt(hex.length == 3 ? hex.slice(0, 1).repeat(2) : hex.slice(0, 2), 16);
	   var g = parseInt(hex.length == 3 ? hex.slice(1, 2).repeat(2) : hex.slice(2, 4), 16);
	   var b = parseInt(hex.length == 3 ? hex.slice(2, 3).repeat(2) : hex.slice(4, 6), 16);
	   if ( alpha ) {
	      return 'rgba(' + r + ', ' + g + ', ' + b + ', ' + alpha + ')';
	   }
	   else {
	      return 'rgb(' + r + ', ' + g + ', ' + b + ')';
	   }
	}
});