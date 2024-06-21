<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <h1 class="logo a me-auto"><img src="{{asset('frontend/assets/img/logokemenag.png')}}" alt="" class="img-fluid">
        Reservasi Aula
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{route('frontend.home')}}" class="active">Home</a></li>
          <li><a href="#" >Tentang</a></li>
          <li><a href="#" >Jadwal</a></li>
          <li><a href="#" >Kontak</a></li>
          @if(Auth::check() && Auth::user()->status_admin)
            <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
          @endif
          <li><a href="{{route('login')}}" class="getstarted">Login</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>