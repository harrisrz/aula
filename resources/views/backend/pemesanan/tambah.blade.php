@extends('backend.layouts.dashboard')

@section('content')

<div class="pagetitle">
  <h1>Tambah Data Pemesanan</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Data Reservasi</li>
      <li class="breadcrumb-item active">Data Pemesanan</li>
    </ol>
  </nav>
</div>

<div class="card">
  <div class="card-body">
    <h5 class="card-title">
      Tambah Data Pemesanan
  </h5>
<form action="{{route('admin.backend.pemesanan.store')}}" method="POST">
  @csrf
  <div class="row mb-3">
    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="nama">
    </div>
  </div>
  <div class="row mb-3">
    <label for="unit_atau_instansi" class="col-sm-3 col-form-label">Unit Atau Instansi</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="unit_atau_instansi">
    </div>
  </div>
  <div class="row mb-3">
    <label for="nama_kegiatan" class="col-sm-3 col-form-label">Nama Kegiatan</label>
    <div class="col-sm-9">
      <input type="text" class="form-control" name="nama_kegiatan">
    </div>
  </div>
  <div class="row mb-3">
    <label for="tanggal_pemakaian" class="col-sm-3 col-form-label">Tanggal Pemakaian</label>
    <div class="col-sm-4">
      <input type="datetime-local" class="form-control" name="tanggal_pemakaian">
    </div>
  </div>
  <div class="row mb-3">
    <label for="jumlah_peserta" class="col-sm-3 col-form-label">Jumlah Peserta</label>
    <div class="col-sm-9">
      <input type="number" class="form-control" name="jumlah_peserta">
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
      <button type="submit" class="btn btn-success">Simpan</button>
    </div>
  </div>

</form>
  </div>
</div>
@endsection
