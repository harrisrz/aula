@extends('frontend.home')

@section('content')
   
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Kontak</h2>
        <ol>
          <li><a href="{{route('frontend.home')}}">Home</a></li>
          <li>Kontak</li>
        </ol>
      </div>

    </div>
  </section>

<section id="contact" class="contact">
    <div class="container">
      <div>
        <iframe 
            style="border:0; width: 100%; height: 270px;" 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31872.165929834624!2d114.37149595794132!3d-3.0111887179227486!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dfb5c7b429be329%3A0x3039d80b2201db0!2sJl.%20Tambun%20Bungai%20No.16%2C%20Selat%20Hilir%2C%20Kec.%20Selat%2C%20Kabupaten%20Kapuas%2C%20Kalimantan%20Tengah%2073516!5e0!3m2!1sen!2sid!4v1652189489200!5m2!1sen!2sid" 
            frameborder="0" 
            allowfullscreen>
        </iframe>
      </div>
        <h3>Hubungi Kami : </h3>
      <div class="row mt-5">

        <div class="col-lg-4">
          <div class="info">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Alamat:</h4>
              <p>Jl. Tambun Bungai No.16, Selat Hilir, Kec. Selat, Kabupaten Kapuas, Kalimantan Tengah 73516</p>
            </div>

            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>humaskemenagkapuas@gmail.com</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>WhatsApp:</h4>
              <p>082148197979</p>
            </div>

          </div>

        </div>

        <div class="col-lg-4 mt-5 mt-lg-0">
            
            <div class="info">
                
                <div class="instagram">
                    <i class="bi bi-instagram"></i>
                        <h4>Instagram:</h4>
                    <p>@kemenagkapuas</p>
                </div>

                <div class="facebook">
                    <i class="bi bi-facebook"></i>
                        <h4>Facebook:</h4>
                    <p>@kemenagkapuas</p>
                </div>

                <div class="youtube">
                    <i class="bi bi-youtube"></i>
                        <h4>Youtube:</h4>
                    <p>@kemenagkapuas</p>
                </div>

            </div>

        </div>

        <div class="col-lg-4">

            <div class="info">
                <div class="twitter">
                    <i class="bi bi-twitter"></i>
                        <h4>Twitter:</h4>
                    <p>@kemenagkapuas</p>
                </div>
            </div>
        </div>

      </div>

    </div>
  </section>

@endsection