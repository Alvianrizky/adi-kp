<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="{{url('assets/img/logo/icon.jpg')}}" rel="icon">
  <title>RuangGuru - TPA Firdaus</title>
  <link href="{{url('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
  <link href="{{url('assets/css/ruang-admin.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="{{url('assets/DataTables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('assets/sweetalert/sweetalert.min.css')}}">

  <script src="{{url('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{url('assets/js/ruang-admin.min.js')}}"></script>
  <script src="{{url('assets/sweetalert/sweetalert.min.js')}}"></script>
  <script src="{{url('assets/DataTables/DataTables-1.10.20/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{url('assets/DataTables/DataTables-1.10.20/js/dataTables.bootstrap4.min.js')}}"></script>
  @yield('css')
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="{{url('assets/img/logo/icon.jpg')}}">
        </div>
        <div class="sidebar-brand-text mx-2">TPA FIRDAUS</div>
      </a>
      <hr class="sidebar-divider my-0">
      @if (Auth::User()->role == 'guru')
        @include('partials.guru-menu')
      @else
        @include('partials.admin-menu')
      @endif

      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="{{url('assets/img/logo/user.png')}}" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">{{Auth::user()->name}}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('guru.change.password.index') }}">Change Password</a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->
        <!-- Container Fluid-->
        @yield('contents')
        <!---Container Fluid-->
      </div>
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  @include('sweet::alert')
  @yield('js')
</body>

</html>
