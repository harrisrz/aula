<header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <h1 class="logo a me-auto"><img src="{{asset('frontend/assets/img/logokemenag.png')}}" alt="" class="img-fluid">
        Reservasi Aula
      </h1>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{route('frontend.home')}}">Home</a></li>
          <li><a href="{{route('frontend.tentang')}}" >Tentang</a></li>
          <li><a href="{{route('frontend.jadwal')}}" >Jadwal</a></li>
          <li><a href="{{route('frontend.kontak')}}" >Kontak</a></li>
          @if(Auth::check() && Auth::user()->status_admin)
            <li><a href="{{ route('admin.dashboard') }}">Admin</a></li>
          @endif
          @if(Auth::user())
            <li class="dropdown">
              <a class="getstarted" href="#">
                <span>{{ auth()->user()->nama }}</span>
                <i class="bi bi-chevron-down"></i>
              </a>
              <ul>
                <li>
                  <a href="{{route('logout')}}" class="active">
                    Logout
                    <i class="bi bi-box-arrow-in-right"></i>
                  </a>
                </li>
              </ul>
            </li>
          @else
            <li><a href="{{route('login')}}" class="getstarted">Login</a></li>
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header>