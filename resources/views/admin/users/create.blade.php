@extends('layouts.app')

@section('content')
<h2>Tambah User</h2>
<form action="{{ route('admin.users.store') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>No Telepon</label>
    <input type="text" name="no_tlpn" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Role</label>
    <select name="role" class="form-control" required>
      <option value="admin">Admin</option>
      <option value="pemilik">Pemilik</option>
      <option value="penyewa">Penyewa</option>
    </select>
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button class="btn btn-success">Simpan</button>
</form>
@endsection
