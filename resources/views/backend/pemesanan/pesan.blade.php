@extends('backend.layouts.dashboard')

@section('content')

<div class="col-lg-12">

    <div class="pagetitle">
        <h1>Data Pemesanan</h1>
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
            Data Pemesanan
            <a class="btn bi bi-plus-lg btn-success float-right" href="{{ route('admin.backend.pemesanan.tambah') }}">
                Tambah
            </a>
        </h5>
        
        <!-- Table with stripped rows -->
        <table class="table table-striped">
          <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">Nama Kegiatan</th>
                <th scope="col">Tanggal Pemakaian</th>
                <th scope="col">Status Konfirmasi</th>
                <th scope="col">Status Pembayaran</th>
                <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pesan as $p)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $p->nama }}</td>
                <td>{{ $p->nama_kegiatan }}</td>
                <td>{{ $p->tanggal_pemakaian }}</td>
                <td> 
                    @if ($p->status_konfirmasi == 'menunggu')
                        <span class="badge bg-warning">Menunggu</span>
                    @elseif ($p->status_konfirmasi == 'disetujui')
                        <span class="badge bg-success">Disetujui</span>
                    @else
                        <span class="badge bg-danger">Ditolak</span>
                    @endif
                </td>
                <td>
                    @if ($p->status_pembayaran == 'belum_bayar')
                        <span class="badge bg-warning">Belum Bayar</span>
                    @elseif ($p->status_pembayaran == 'belum_lunas')
                        <span class="badge bg-warning">Belum Lunas</span>
                    @else
                        <span class="badge bg-success">Lunas</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <button data-bs-toggle="modal" data-bs-target="#largeModal{{ $p->id }}" class="btn btn-success btn-spacing btn-sm">
                            <i class="bi bi-eye"></i> Info
                        </button>
                        <div class="modal fade" id="largeModal{{ $p->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Detail Pemesanan</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Nama</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : {{ $p->nama }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Unit Atau Instansi</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : {{ $p->unit_atau_instansi }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Nama Kegiatan</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : {{ $p->nama_kegiatan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Tanggal Pemakaian</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : {{ $p->tanggal_pemakaian }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Jumlah Peserta</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : {{ $p->jumlah_peserta }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Jenis Pemesanan</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : {{ $p->jenis_pemesanan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Total Biaya</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : Rp.{{ number_format($p->total_biaya, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Keterangan</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : {{ $p->keterangan }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <div>
                                        <form action="{{ route('admin.backend.pemesanan.update-status', ['id' => $p->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status_konfirmasi" value="disetujui">
                                            <button type="submit" class="btn btn-success">Konfirmasi</button>
                                        </form>
                                    </div>
                                    <div class="col text-start">
                                        <form action="{{ route('admin.backend.pemesanan.update-status', ['id' => $p->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status_konfirmasi" value="ditolak">
                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                        </form>
                                    </div>
                                    @if ($p->status_konfirmasi == 'disetujui')
                                        <a href="{{route('admin.backend.pembayaran.tambah', ['id_pemesanan' => $p->id])}}" class="btn btn-warning">
                                            <i class="bi bi-pen"></i> Catat Pembayaran</a>
                                    @endif
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        <a class="btn btn-secondary btn-spacing btn-sm" href="{{ route('admin.backend.pemesanan.edit', ['id' => $p->id]) }}">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form onclick="return confirm('Apakah Anda Yakin Ingin Menghapus ?')" action="{{ route('admin.backend.pemesanan.delete', ['id' => $p->id])}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i> Hapus</button>
                        </form>
                    </div>
                </td>
                <style>
                    .btn-spacing {
                        margin-right: 10px; 
                    }
                </style>
            </tr>
            @endforeach
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
                     {{ session('success') }}
                 </div>
            @elseif (session('danger'))
            <div class="alert alert-danger">
              <i class="bi bi-check-circle me-1"></i>
                {{ session('danger') }}
            </div>
            @endif
          </tbody>
        </table>
        <!-- End Table with stripped rows -->

      </div>
    </div>
</div>

@endsection
