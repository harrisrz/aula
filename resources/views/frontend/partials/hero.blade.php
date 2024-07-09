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
              <a href="{{ route('frontend.jadwal')}}" class="btn-get-started animate__animated animate__fadeInUp scrollto">Pesan Sekarang</a>
            </div>
          </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url(frontend/assets/img/aula3.jpeg)">
          <div class="carousel-container">
            <div class="container">
              <h2 class="animate__animated animate__fadeInDown">Kontak Kami</h2>
              <p class="animate__animated animate__fadeInUp">Silahkan Hubungi Kami Untuk Informasi Lebih Lanjut</p>
              <a href="{{route('frontend.kontak')}}" class="btn-get-started animate__animated animate__fadeInUp scrollto">Kontak</a>
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