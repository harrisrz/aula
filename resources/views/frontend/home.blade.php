<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Reservasi Aula Kemenag Kapuas</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('frontend/assets/img/logokemenag.png')}}" rel="icon">
  <link href="{{asset('frontend/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('frontend/assets/vendor/animate.css/animate.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Sailor
  * Template URL: https://bootstrapmade.com/sailor-free-bootstrap-theme/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  @include('frontend.partials.header')
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

      <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url(frontend/assets/img/aula1.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Selamat Datang!</h2>
              <p class="animate__animated animate__fadeInUp">
                Selamat Datang Di Website
                Sistem Reservasi Aula Kementerian Agama Kabupaten Kapuas
              </p>
            </div>
          </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url(frontend/assets/img/aula2.jpg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Pesan Jadwal</h2>
              <p class="animate__animated animate__fadeInUp">Rencanakan Jadwal Acara Anda Pada Aula Kementerian Agama Kabupaten Kapuas</p>
              <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Pesan Sekarang</a>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(frontend/assets/img/aula3.jpeg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Kontak Kami</h2>
              <p class="animate__animated animate__fadeInUp">Silahkan Hubungi Kami Untuk Informasi Lebih Lanjut</p>
              <a href="#about" class="btn-get-started animate__animated animate__fadeInUp scrollto">Kontak</a>
            </div>
          </div>
        </div>

      </div>

      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>

      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>

    </div>
  </section><!-- End Hero -->

  <main id="main">

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Kementerian Agama Kabupaten Kapuas 2024</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/sailor-free-bootstrap-theme/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
  <script src="{{asset('frontend/assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('frontend/assets/js/main.js')}}"></script>

  {{-- sweetalert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  @if($message = Session::get('failed'))
  <script>
    Swal.fire({
    icon: "error",
    title: "Oops...",
    text: "{{$message}}",
    });
  </script>
  @endif
</body>

</html>