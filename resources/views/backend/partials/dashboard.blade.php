
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Admin</li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <div class="card">
            <div class="card-body">
              <h2 class="card-title-d align-items-center justify-content-center">
                <i class="bi bi-person-fill icon-i"></i> Selamat Datang, {{ auth()->user()->nama }}!</h2>
            </div>
          </div>
        </div>
      </div><!-- End Left side columns -->

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Reservasi Aula Kementerian Agama Kabupaten Kapuas</h5>

          <!-- Slides with indicators -->
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="{{asset('backend/assets/img/aula1.jpg')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('backend/assets/img/aula2.jpg')}}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="{{asset('backend/assets/img/aula3.jpeg')}}" class="d-block w-100" alt="...">
              </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>

          </div><!-- End Slides with indicators -->

        </div>
      </div>

    </div>
  </section>