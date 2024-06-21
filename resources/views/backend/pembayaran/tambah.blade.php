@extends('backend.layouts.dashboard')

@section('content')
    
<div class="pagetitle">
  <h1>Tambah Data Pembayaran</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Data Reservasi</li>
      <li class="breadcrumb-item active">Data Pembayaran</li>
    </ol>
  </nav>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">
      Tambah Data Pembayaran
  </h5>
<form action="{{route('admin.backend.pembayaran.store')}}" method="POST">
  @csrf
  <div class="row mb-3">
    <label for="id_pemesanan" class="col-sm-3 col-form-label">ID Pemesanan</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="id_pemesanan" value="{{ $pesan->id }}" readonly>
    </div>
  </div>
  <div class="row mb-3">
    <label for="tanggal_pembayaran" class="col-sm-3 col-form-label">Tanggal Pembayaran</label>
    <div class="col-sm-9">
      <input type="datetime-local" class="form-control" name="tanggal_pembayaran">
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
  <div class="row mb-3">
    <label for="nominal_biaya" class="col-sm-3 col-form-label">Nominal Biaya</label>
    <div class="col-sm-9">
      <input type="number" class="form-control" name="nominal_biaya">
    </div>
  </div>
  <div class="row mb-3">
    <label for="pembayaran_ke" class="col-sm-3 col-form-label">Pembayaran Ke-</label>
    <div class="col-sm-9">
      <input type="number" class="form-control" name="pembayaran_ke">
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-3 col-form-label">Keterangan</label>
    <div class="col-sm-9">
      <select name="keterangan" class="form-select" aria-label="Default select example">
        <option selected value="lunas">Lunas</option>
        <option value="cicilan">Cicilan</option>
      </select>
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
@endsection
