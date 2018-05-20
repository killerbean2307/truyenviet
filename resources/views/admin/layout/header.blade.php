  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{route('admin.category.index')}}"><img src="logo.png" style="max-height: 50px; max-width: 50px;">&nbsp;&nbsp;<span class="text-white">QUẢN LÝ TRUYỆN</span></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tổng quan">
          <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Tổng quan</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tác giả">
          <a class="nav-link" href="{{route('admin.author.index')}}">
            <i class="fa fa-fw fa-users"></i>
            <span class="nav-link-text">Tác Giả</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Thể Loại">
          <a class="nav-link" href="{{route('admin.category.index')}}">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Thể Loại</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Truyện">
          <a class="nav-link" href="{{route('admin.story.index')}}">
            <i class="fa fa-fw fa-book"></i>
            <span class="nav-link-text">Danh sách truyện</span>
          </a>
        </li>
        
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="User">
          <a class="nav-link" href="{{route('admin.user.index')}}">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Danh sách tài khoản</span>
          </a>
        </li>

      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        @if(Auth::check())
          <li class="nav-item">
            <a class="nav-link">
              <i class="fa fa-fw fa-user"></i>
              {{Auth::user()->name}}
            </a>
          </li>
        @endif
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Đăng Xuất</a>
        </li>
      </ul>
    </div>
  </nav>
<!-- modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Xác nhận đăng xuất?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
        </div>
      <div class="modal-body">Chọn Đăng Xuất nếu bạn đã chắc chắn.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
          <a class="btn btn-primary" href="{{route('logout')}}">Đăng xuất</a>
        </div>
      </div>
    </div>
</div>