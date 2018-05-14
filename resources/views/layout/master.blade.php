<!DOCTYPE html>
<html lang="en">
<head>
  	<title>Truyện Việt</title>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<base href="{{asset('')}}">
  	<link rel="stylesheet" href="admin_asset/vendor/bootstrap/css/bootstrap.min.css">
  	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
  	<link href="https://fonts.googleapis.com/css?family=Merriweather+Sans" rel="stylesheet">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
  	<link rel="stylesheet" href="css/owl.carousel.min.css">
  	<link rel="stylesheet" href="css/owl.theme.default.min.css">
  	<link rel="stylesheet" href="css/main.css">
    <link rel="shortcut icon" href="logo.png">
@yield('css')

</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v3.0&appId=194208891305427&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@include('layout.header')

@yield('content')

@include('layout.footer')
</body>  

<script src="admin_asset/vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="admin_asset/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script src="js/main.js"></script>
<script>
	new WOW().init();
</script>


@yield('script')
</html>
