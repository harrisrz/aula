@extends('frontend.home')

@section('content')
    
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Tentang</h2>
        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Tentang</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="row content d-flex align-items-center">
        <div class="col-lg-6">
          <h2>Kantor Kementerian Agama Kabupaten Kapuas</h2>
          <div class="pic"><img src="{{asset('frontend/assets/img/aula1.jpg')}}" class="img-fluid" alt=""></div>
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0">
          <p style="text-align: justify;">
            Kantor Kementerian Agama Kabupaten Kapuas merupakan sebuah instansi
            pemerintah yang bertugas menyelenggarakan pemerintahan dalam bidang
            agama. Kantor ini bertempat di Jl. Tambun Bungai No. 16, Kuala Kapuas,
            Kalimantan Tengah, Kode Pos 73514. Kantor Kementerian Agama Kabupaten
            Kapuas memiliki beberapa unit kerja, seperti Bidang Tata Usaha, Bidang
            Pendidikan Islam, Bidang Penyelenggaraan Haji dan Umrah, Bidang
            Pendidikan Diniyah dan Pondok Pesantren, Bimbingan Masyarakat Islam,
            Bimbingan Masyarakat Kristen dan Bimbingan Masyarakat Hindu.
          </p>
        </div>
      </div>

    </div>
  </section>

@endsection