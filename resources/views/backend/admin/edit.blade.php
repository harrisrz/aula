<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Data</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.backend.admin.update', ['id' => $user->id])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                  <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                  <div class="col-sm-8">
                    <input type="text" name="nama" class="form-control" value= "{{ $user->nama }}" placeholder="Masukkan Nama" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="email" class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-8">
                    <input type="text" name="email" class="form-control" value= "{{ $user->email }}" placeholder="Masukkan Email" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="password" class="col-sm-4 col-form-label">Password</label>
                  <div class="col-sm-8">
                    <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                  </div>
                </div>
                <div class="row mb-3">
                    <label for="konfirpassword" class="col-sm-4 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-8">
                      <input type="password" name="konfirpassword" class="form-control" placeholder="Masukkan Password" required>
                    </div>
                  </div>
                <div class="row mb-3">
                  <label for="no_telepon" class="col-sm-4 col-form-label">Nomor Telepon</label>
                  <div class="col-sm-8">
                    <input type="text" name="no_telepon" class="form-control" value= "{{ $user->no_telepon }}" placeholder="Masukkan Nomor Telepon" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-4 col-form-label">Status Akun</label>
                  <div class="col-sm-8">
                    <select name="status_admin" class="form-select" aria-label="Default select example" value= "{{ $user->status_admin }}">
                      <option selected value="1">Admin</option>
                      <option value="0">Pengguna</option>
                    </select>
                  </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
        </form>
      </div>
    </div>
  </div>