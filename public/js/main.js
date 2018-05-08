	$(document).ready(function(){
      	// $(".dropdown").hover(function () {
       //  	$(this).find(".dropdown-menu").toggleClass("show"); 
       // 	});
     	$(document).on('click', '#data-content.dropdown-menu', function (e) {
  			e.stopPropagation();
		});

      	changeDropdownMenuWidth();
		changeTextCenterDropdownMenu();

        $(window).resize(function() {
        	changeDropdownMenuWidth();
        	changeTextCenterDropdownMenu();
        });

	});

	function changeDropdownMenuWidth()
	{
		if($(window).width() > 992)
    	{
   			$('#category_dropdown_menu').width('750px');
   			$('#data-content').width('400px');
   			$('.nav-link').removeClass('text-center');
    	}
    	else
    	{
    		$('#category_dropdown_menu').width('100%');
    	   	$('#data-content').width('100%');	
    		$('.nav-link').addClass('text-center');
    	}
	}

	function changeTextCenterDropdownMenu()
	{
		if($(window).width() < 992)
		{
			$('.dropdown_menu').css('text-align','center');
		}
		else 
		{
			$('.dropdown_menu').css('text-align','left');
		}
	}