<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Đăng nhập | Truyện Việt</title>
  <!-- Bootstrap core CSS-->
  <base href="{{asset('')}}">
  <!-- Bootstrap core CSS-->
  <link href="admin_asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="admin_asset/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="admin_asset/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
                      @if(count($errors) > 0)
                          <div class="alert alert-danger">
                              @foreach($errors->all() as $err)
                                  {{$err}}<br>
                              @endforeach
                          </div>
                      @endif
                      
                      @if(session('thongbao'))
                        <div class="alert alert-danger">
                          {{session('thongbao')}}
                        </div>
                      @endif        
        <form method="POST" action="{{route('post.login')}}">
          {{csrf_field()}}
          <div class="form-group">
            <label for="exampleInputEmail1">User Name</label>
            <input class="form-control" name="username" id="username" type="text" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" name="password" id="password" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" name="remember" type="checkbox"> Remember Password</label>
            </div>
          </div>
          <button class="btn btn-primary btn-block" href="#" role="button" type="submit">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
    <script src="admin_asset/vendor/jquery/jquery.min.js"></script>  
    <script src="admin_asset/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="admin_asset/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
