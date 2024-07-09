@extends('frontend.home')

@section('content')
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Buat Pesanan</h2>
                <ol>
                    <li><a href="{{route('frontend.home')}}">Home</a></li>
                    <li>Buat Pesanan</li>
                </ol>
        </div>
    </div>
</section>

<div class="container">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">
        Buat Pesanan pada Tanggal: {{ $tanggal }}
    </h5>
    <div class="row">
        <div class="col-12 mt-3">
            <form action="{{ route('frontend.buat-pesanan') }}" method="POST">
                @csrf
                <!-- Form fields here -->
                <div class="row mb-3">
                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama">
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="unit_atau_instansi" class="col-sm-3 col-form-label">Unit Atau Instansi</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('unit_atau_instansi') is-invalid @enderror" id="unit_atau_instansi" name="unit_atau_instansi">
                        @error('unit_atau_instansi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="nama_kegiatan" class="col-sm-3 col-form-label">Nama Kegiatan</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan" name="nama_kegiatan">
                        @error('nama_kegiatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="tanggal_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                    <div class="col-sm-4">
                      <input type="datetime-local" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai">
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="tanggal_selesai" class="col-sm-3 col-form-label">Tanggal Selesai</label>
                    <div class="col-sm-4">
                      <input type="datetime-local" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai" name="tanggal_selesai">
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="jumlah_peserta" class="col-sm-3 col-form-label">Jumlah Peserta</label>
                    <div class="col-sm-9">
                      <input type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror" id="jumlah_peserta" name="jumlah_peserta">
                        @error('jumlah_peserta')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                  </div>
                  <fieldset class="row mb-3">
                    <legend class="col-form-label col-sm-3 pt-0">Jenis Pemesanan</legend>
                    <div class="col-sm-9">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_pemesanan" id="gridRadios1" value="penyewaan" checked>
                        <label class="form-check-label" for="gridRadios1">
                          Penyewaan
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_pemesanan" id="gridRadios2" value="peminjaman">
                        <label class="form-check-label" for="gridRadios2">
                          Peminjaman
                        </label>
                      </div>
                  </fieldset>
                  <div class="row mb-3">
                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" name="keterangan" style="height: 100px"></textarea>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label class="col-sm-3 col-form-label"> </label>
                    <div class="col-sm-9">
                      <button type="submit" href="{{route('frontend.jadwal')}}" class="btn btn-success">Simpan</button>
                    </div>
                  </div>
            </form>
        </div>
    </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
      $('#pesanan-form').on('submit', function(e) {
          e.preventDefault();
          $.ajax({
              type: 'POST',
              url: "{{ route('frontend.buat-pesanan') }}",
              data: $(this).serialize(),
              success: function(response) {
                  alert(response.message);
                  window.location.href = response.redirect;
              },
              error: function(xhr, status, error) {
                  console.error(xhr.responseText);
                  alert('Terjadi kesalahan. Silakan coba lagi.');
              }
          });
      });
  });
  </script>
@endsection
