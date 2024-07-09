@extends('backend.layouts.dashboard')

@section('content')
    
<div class="pagetitle">
  <h1>Edit Data Pemesanan</h1>
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
      Edit Data Pemesanan
  </h5>
<form action="{{ route('admin.backend.pemesanan.update', ['id' => $pesan->id])}}" method="POST">
  @csrf
  @method('PUT')
  <div class="row mb-3">
    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
    <div class="col-sm-9">
      <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value= "{{ $pesan->nama }}">
      @error('nama')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label for="unit_atau_instansi" class="col-sm-3 col-form-label">Unit Atau Instansi</label>
    <div class="col-sm-9">
      <input type="text" class="form-control @error('unit_atau_instansi') is-invalid @enderror" id="unit_atau_instansi" name="unit_atau_instansi" value= "{{ $pesan->unit_atau_instansi }}">
      @error('unit_atau_instansi')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label for="nama_kegiatan" class="col-sm-3 col-form-label">Nama Kegiatan</label>
    <div class="col-sm-9">
      <input type="text" class="form-control @error('nama_kegiatan') is-invalid @enderror" id="nama_kegiatan" name="nama_kegiatan" value= "{{ $pesan->nama_kegiatan }}">
      @error('nama_kegiatan')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label for="tanggal_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
    <div class="col-sm-4">
      <input type="datetime-local" class="form-control @error('tanggal_mulai') is-invalid @enderror" id="tanggal_mulai" name="tanggal_mulai" value= "{{ $pesan->tanggal_mulai }}">
      @error('tanggal_mulai')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label for="tanggal_selesai" class="col-sm-3 col-form-label">Tanggal Selesai</label>
    <div class="col-sm-4">
      <input type="datetime-local" class="form-control @error('tanggal_selesai') is-invalid @enderror" id="tanggal_selesai" name="tanggal_selesai" value= "{{ $pesan->tanggal_selesai }}">
      @error('tanggal_selesai')
          <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label for="jumlah_peserta" class="col-sm-3 col-form-label">Jumlah Peserta</label>
    <div class="col-sm-9">
      <input type="text" class="form-control @error('jumlah_peserta') is-invalid @enderror" id="jumlah_peserta" name="jumlah_peserta" value= "{{ $pesan->jumlah_peserta }}">
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
      <button type="submit" class="btn btn-success">Simpan</button>
    </div>
  </div>

</form>
  </div>
</div>
@endsection
