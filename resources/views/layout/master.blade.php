<!DOCTYPE html>
<html lang="en">
<head>
  	<title>Truyện Việt</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<base href="{{asset('')}}">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="icon" href="favicon.ico" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  	<style>

	  	body{
	  		background-color: #F2F3F7 ;
	  		font-family: 'Open Sans', sans-serif;
	  	}
	  	.navbar{
	  		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	  		/*position: static!important;*/
	  	}

	  	#search:hover, #search:active{
	  		background-color: white!important;
	  	}
		
		.search-box{
			border-radius: 0px;
		}

		.dropdown-menu{
			border-radius: 0;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			margin: 0;
			border: 1px #f0f0f5;
		}
		
		.dropdown-item-custom{
			padding: 10px 20px;
		    transition: padding 0.5s;
    		-moz-transition: padding 0.5s;
    		-webkit-transition: padding 0.5s;
    		-o-transition: padding 0.5s;
		}

		.dropdown-item-custom a{
			text-decoration: none;
			width: 100%;
			height: 100%;
			color:black;
		}

		.dropdown-item-custom:hover{
			background-color: #e6e8f2;
			padding-left: 35px;
		}
		
		.navbar-brand{
			transition: all 0.5s;
		}

		.navbar-brand:hover{
			text-shadow: 5px 5px 5px #98B9BF;
		}
		
		.nav-link{
			color: white!important;
		}

		.nav-item:hover{
			background-color: #CCCCCC;
		}

		footer{
			background-color: #2C3E50;
/*			height: 100px;*/
			font-size: 0.85em;
			line-height: 2em;
		}

		.title-list{
			border-bottom: 2px solid #1ABC9C;
		}

		.title-list>a>span{
			background-color: #1ABC9C;
	        color: aliceblue;
	        padding: 8px 20px;
	        display: inline-block;
	        font-size: 1rem;
		}
			
/*		.list-content a{
			text-decoration: none;
			color: black;
		}*/
	</style>

@yield('css')

</head>
<body>

{{-- <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.12&appId=194208891305427';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> --}}
<!-- <h1>Sticky nav</h1> -->

@include('layout.header')

@yield('content')

</body>

@include('layout.footer')

<script>
	$(document).ready(function(){
      	$(".dropdown").hover(function () {
        	$(this).find(".dropdown-menu").toggleClass("show"); 
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
   			$('.nav-link').removeClass('text-center');
    	}
    	else
    	{
    		$('#category_dropdown_menu').width('100%');
    		$('.nav-link').addClass('text-center');
    	}
	}

	function changeTextCenterDropdownMenu()
	{
		if($(window).width() < 992)
		{
			$('#category_dropdown_menu').css('text-align','center');
		}
		else 
		{
			$('#category_dropdown_menu').css('text-align','left');
		}
	}
</script>

@yield('script')
</html>
