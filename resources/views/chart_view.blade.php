<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chart</title>
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.min.css" /> --}}
	{!! Charts::styles() !!}
</head>
<body>
	<div class="container">{!! $chart->html() !!}</div>
</body>
       {!! Charts::scripts() !!}
        {!! $chart->script() !!}
</html>