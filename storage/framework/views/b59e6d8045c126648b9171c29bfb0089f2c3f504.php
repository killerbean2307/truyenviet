<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

  <title>
    <?php if(View::hasSection('title')): ?>
      <?php echo $__env->yieldContent('title'); ?>
    <?php else: ?>
      ADMIN TRUYỆN VIỆT
    <?php endif; ?>

  </title>
  <base href="<?php echo e(asset('')); ?>">
  <!-- Bootstrap core CSS-->
  <link href="admin_asset/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="admin_asset/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Page level plugin CSS-->
  <link href="admin_asset/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="admin_asset/css/sb-admin.css" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="admin_asset/vendor/select2/dist/css/select2.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.1/css/responsive.bootstrap4.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/pretty-checkbox.css"/>
  <link rel="stylesheet" href="css/materialdesignicons.min.css">
  <link rel="stylesheet" href="css/scroll.css">
  <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
  <link rel="icon" href="favicon.ico" />


  <?php echo $__env->yieldContent('css'); ?>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
    <?php echo $__env->make('admin.layout.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <div class="content-wrapper">
    <!-- /.container-fluid-->
    <?php if(Session::has('thongbao')): ?>
      <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <?php echo e(Session::get('thongbao')); ?>

      </div>
    <?php endif; ?>
    <?php echo $__env->yieldContent('content'); ?>
    <!-- /.content-wrapper-->
    <?php echo $__env->make('admin.layout.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>  
    <!-- Bootstrap core JavaScript-->
    

    <script src="admin_asset/vendor/jquery/jquery.js"></script>  

    <script src="admin_asset/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="admin_asset/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <?php echo $__env->make('toast::messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <script src="admin_asset/vendor/datatables/jquery.dataTables.js"></script>
    <script src="admin_asset/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="admin_asset/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="admin_asset/js/sb-admin-datatables.min.js"></script>
    <script src="js/function.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.1/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/locale/vi.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment-with-locales.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment-with-locales.min.js"></script>
    <script type="text/javascript" src="admin_asset/vendor/select2/dist/js/select2.js"></script>
    <script src="admin_asset/vendor/ckeditor/ckeditor.js"></script>
    <script>
      $(document).ajaxComplete(function(event,xhr,setting){
        if(xhr.status == 403)
          alert(jQuery.parseJSON(xhr.responseText).error);
      });
    </script>
  </div>

    <?php echo $__env->yieldContent('script'); ?>

</body>

</html>
