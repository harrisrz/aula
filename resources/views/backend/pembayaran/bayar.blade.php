@extends('backend.layouts.dashboard')

@section('content')

<div class="pagetitle">
    <h1>Data Pembayaran</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item active">Data Reservasi</li>
        <li class="breadcrumb-item active">Data Pembayaran</li>
      </ol>
    </nav>
</div>

<div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
            Data Pembayaran
        </h5>
        
        <!-- Table with stripped rows -->
        <table class="table table-striped">
          <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">ID Pemesanan</th>
                <th scope="col">Tanggal Pembayaran</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($bayar as $b)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $b->id_pemesanan }}</td>
                <td>{{ $b->tanggal_pembayaran }}</td>
                <td> 
                    @if ($b->keterangan == 'cicilan')
                        <span class="badge bg-warning">Cicilan</span>
                    @elseif ($b->keterangan == 'lunas')
                        <span class="badge bg-success">lunas</span>
                    @endif
                </td>
                <td>
                    <div class="btn-group">
                        <button data-bs-toggle="modal" data-bs-target="#largeModal{{ $b->id }}" class="btn btn-success btn-spacing btn-sm">
                            <i class="bi bi-eye"></i> Info
                        </button>
                        <div class="modal fade" id="largeModal{{ $b->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Detail Pembayaran</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>ID Pemesanan</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : {{ $b->id_pemesanan }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Tanggal Pembayaran</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : {{ $b->tanggal_pembayaran }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Metode Pembayaran</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : {{ $b->metode_pembayaran }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Nominal Biaya</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : Rp.{{ number_format($b->nominal_biaya, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <strong>Pembayaran Ke-</strong>
                                                </div>
                                                <div class="col-md-8">
                                                    : {{ $b->pembayaran_ke }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer d-flex justify-content-between">
                                    <div>
                                        <form action="#" method="POST">
                                            @csrf
                                            <input type="hidden" name="status_konfirmasi" value="disetujui">
                                            <button type="submit" class="btn btn-success">Konfirmasi</button>
                                        </form>
                                    </div>
                                    <div class="col text-start">
                                        <form action="#" method="POST">
                                            @csrf
                                            <input type="hidden" name="status_konfirmasi" value="ditolak">
                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                        </form>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        <a class="btn btn-secondary btn-spacing btn-sm" href="{{ route('admin.backend.pembayaran.edit', ['id' => $b->id]) }}">
                            <i class="bi bi-pencil-square"></i> Edit
                        </a>
                        <form onclick="return confirm('Apakah Anda Yakin Ingin Menghapus ?')" action="{{ route('admin.backend.pembayaran.delete', ['id' => $b->id]) }}" method="POST">
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
