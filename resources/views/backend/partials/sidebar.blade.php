<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{ route('admin.dashboard')}}">
          <i class="bi bi-grid icon-i"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <!-- End Dashboard Nav -->

      <hr class="sidebar-divider my-0">

     <!-- Heading -->
     <li class="nav-heading">Data User</li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" href="{{route('admin.backend.admin.data')}}">
          <i class="bi bi-person-fill icon-i"></i><span>Data Admin</span></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" href="{{route('admin.backend.pengguna.data')}}">
          <i class="bi bi-people-fill icon-i"></i><span>Data Pengguna</span></i>
        </a>
      </li>
      <!-- End Components Nav -->

      <hr class="sidebar-divider my-0">

       <!-- Heading -->
       <li class="nav-heading">Data Reservasi</li>

       <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" href="{{route('admin.backend.pemesanan.pesan')}}">
          <i class="bi bi-journal-text"></i><span>Data Pemesanan</span></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" href="{{route('admin.backend.pembayaran.bayar')}}">
          <i class="bi bi-coin"></i><span>Data Pembayaran</span></i>
        </a>
      </li>

      <hr class="sidebar-divider my-0">

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" href="{{route('frontend.home')}}">
          <i class="bi bi-box-arrow-in-left"></i><span>Halaman Utama</span></i>
        </a>
      </li>
    </ul>

  </aside>