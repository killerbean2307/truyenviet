<!DOCTYPE html>
<html lang="en">
<head>
  	<title>Truyện Việt</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<base href="{{asset('')}}">
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Fira+Sans|Noto+Serif|Roboto|Roboto+Slab" rel="stylesheet">
	<link rel="icon" href="favicon.ico" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
  	<style>
	  	body{
	  		background-color: #F2F3F7 ;
	  		font-family: 'Roboto Slab', sans-serif;
	  	}

	  	.breadcrumb{
		    display: -webkit-box;
		    display: -ms-flexbox;
		    display: flex;
		    -ms-flex-wrap: wrap;
		    flex-wrap: wrap;
		    padding: .75rem 1rem;
		    margin-bottom: 1rem;
		    list-style: none;
		    background-color: white;
		    border-radius: .25rem;
		    box-shadow: 0px 0px 10px 0px rgba(245, 166, 35, 0.2)
	  	}
		
		ol.breadcrumb{
			-webkit-margin-before: 1em;
    		-webkit-margin-after: 1em;
    		-webkit-margin-start: 0px;
    		-webkit-margin-end: 0px;
    		-webkit-padding-start: 40px;
		}
		
		.breadcrumb a{
			text-decoration: none;
			color: #8B572A;
			font-weight: bold;
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
			z-index: 99999999999999999!important;
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

		/* .nav-item:hover{
			background-color: #CCCCCC;
		} */

		footer{
			background-color: #2C3E50;
/*			height: 100px;*/
			font-size: 0.85em;
			line-height: 2em;
		}

		.title-list{
			border-bottom: 2px solid #F5A623;
		}

		.title-list>a>span{
			background-color: #F5A623;
	        color: aliceblue;
	        padding: 8px 20px;
	        display: inline-block;
	        font-size: 1rem;
	        font-weight: bold;
		}

		.hot-icon:before{
    		content: "HOT";
    		color: #e74c3c;
    		border: 1px solid #e74c3c;			
		}

		.full-icon:before{
			content: "FULL";
    		color: #4CAF50;
    		border: 1px solid #4CAF50;
		}
		
		.new-icon:before{
			content: "NEW";
    		color: #2980b9;
    		border: 1px solid #2980b9;
		}

		.full-icon:before, .hot-icon:before, .new-icon:before{
			width: 20px;
    		font-size: 11px;
    		font-weight: 500;
    		padding: 0 3px;
    		letter-spacing: -1px;
    		margin-left: 5px;
		}

		.list-content{
			background-color: white;
			box-shadow: 0px 0px 10px 0px rgba(245, 166, 35, 0.2);
		}

		.list-content>.row{
			border-top: 0.5px dashed #e5e5e5;
			margin: 0;
		}

		.list-content>:first-child{
			padding-top: 1em;
			margin-top: 1em;
			border: none;
		}

		.content a{
			text-decoration: none;
			color: black;
		}

		.content a:hover{
			color: #F5A623;
		}

		/*pagination*/
		.page-item.active .page-link{
			background-color: #F5A623!important;
			border-color: #F5A623!important;
		}

		.font-size-85-em{
			font-size: 0.85em;
		}
		
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script>
	new WOW().init();
</script>
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
