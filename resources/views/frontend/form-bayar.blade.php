@extends('frontend.home')

@section('content')

<<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Catat Pembayaran</h2>
                <ol>
                    <li><a href="{{route('frontend.home')}}">Home</a></li>
                    <li>Pembayaran</li>
                </ol>
        </div>
    </div>
</section>

<div class="container">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <div class="card">
        <div class="card-body">
          <h5 class="card-title">
            Catat Pembayaran
        </h5>
      <form action="{{route('frontend.bayar')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
          <label for="id_pemesanan" class="col-sm-3 col-form-label">ID Pemesanan</label>
          <div class="col-sm-4">
            <input type="text" class="form-control" name="id_pemesanan" value="{{ $pemesanan->id }}" readonly>
          </div>
        </div>
        <div class="row mb-3">
          <label for="tanggal_pembayaran" class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
          <div class="col-sm-4">
            <input type="datetime-local" class="form-control @error('tanggal_pembayaran') is-invalid @enderror" id="tanggal_pembayaran" name="tanggal_pembayaran">
                @error('tanggal_pembayaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
          </div>
        </div>
        <fieldset class="row mb-3">
          <legend class="col-form-label col-sm-3 pt-0">Metode Pembayaran</legend>
          <div class="col-sm-9">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metode_pembayaran" id="gridRadios1" value="cash" checked>
              <label class="form-check-label" for="gridRadios1">
                Cash
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" name="metode_pembayaran" id="gridRadios2" value="transfer">
              <label class="form-check-label" for="gridRadios2">
                Transfer
              </label>
            </div>
        </fieldset>
        <div class="row">
          <label for="rek" class="col-sm-3 col-form-label"> </label>
          <div class="col-sm-6">
            <p class="italic-faded">Metode Transfer Bisa Dikirim ke Rekening Dibawah Ini:</p>
          </div>
        </div>
        <div class="row">
          <label for="rek" class="col-sm-3 col-form-label"> </label>
          <div class="col-sm-6">
            <p class="italic-faded">BRI : 018001079945502 a.n. xxxxx xxxxx</p>
          </div>
        </div>
        <div class="row mb-3">
          <label for="nominal_biaya" class="col-sm-3 col-form-label">Nominal Biaya</label>
          <div class="col-sm-4">
            <input type="number" class="form-control @error('nominal_biaya') is-invalid @enderror" id="nominal_biaya" name="nominal_biaya">
                @error('nominal_biaya')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="pembayaran_ke" class="col-sm-3 col-form-label">Pembayaran Ke-</label>
          <div class="col-sm-4">
            <input type="number" class="form-control @error('pembayaran_ke') is-invalid @enderror" id="pembayaran_ke" name="pembayaran_ke">
                @error('pembayaran_ke')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label">Keterangan</label>
          <div class="col-sm-4">
            <select name="keterangan" class="form-select" aria-label="Default select example" required>
              <option selected value="lunas">Lunas</option>
              <option value="cicilan">Cicilan</option>
            </select>
          </div>
        </div>
        <div class="row mb-3">
          <label for="bukti_pembayaran" class="col-sm-3 col-form-label">Bukti Pembayaran</label>
          <div class="col-sm-4">
            <input type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror" id="bukti_pembayaran" name="bukti_pembayaran">
                @error('bukti_pembayaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label class="col-sm-3 col-form-label"> </label>
          <div class="col-sm-9">
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </div>
      
      </form>
        </div>
      </div>
</div>

<style>
  .italic-faded {
      font-style: italic;
      color: rgba(0, 0, 0, 0.5); /* You can adjust the rgba values to get the desired faded color */
  }
</style>

@endsection
