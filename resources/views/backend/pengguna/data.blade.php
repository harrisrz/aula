@extends('backend.layouts.dashboard')

@section('content')

<div class="pagetitle">
  <h1>Data Pengguna</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Data User</li>
      <li class="breadcrumb-item active">Data Pengguna</li>
    </ol>
  </nav>
</div>

<div class="col-lg-12">

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">
            Data Pengguna
            <button class="btn bi bi-plus-lg btn-success float-right" data-bs-toggle="modal" data-bs-target="#largeModal">
                Tambah
            </button>
            @include('backend.admin.tambah')
        </h5>
        

        <!-- Table with stripped rows -->
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nama</th>
              <th scope="col">Email</th>
              <th scope="col">No Telepon</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($pengguna as $pgn)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pgn->nama }}</td>
                <td>{{ $pgn->email }}</td>
                <td>{{ $pgn->no_telepon }}</td>
                <td>
                    <div class="btn-group">
                        <button data-bs-toggle="modal" data-bs-target="#editModal{{ $pgn->id }}" class="btn btn-secondary btn-spacing btn-sm">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        @include('backend.admin.edit', ['user' => $pgn])
                        <form onclick="return confirm('Apakah Anda Yakin Ingin Menghapus ?')" action="{{ route('admin.backend.admin.delete', ['id' => $pgn->id])}}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i>Hapus</button>
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
@endsection
