@extends('layouts.app')

@section('content')
<h2>Edit User</h2>
<form action="{{ route('admin.users.update',$user->id) }}" method="POST">
  @csrf @method('PUT')
  <div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" value="{{ $user->nama }}" required>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
  </div>
  <div class="mb-3">
    <label>No Telepon</label>
    <input type="text" name="no_tlpn" class="form-control" value="{{ $user->no_tlpn }}" required>
  </div>
  <div class="mb-3">
    <label>Role</label>
    <select name="role" class="form-control" required>
      <option value="admin" {{ $user->role=='admin'?'selected':'' }}>Admin</option>
      <option value="pemilik" {{ $user->role=='pemilik'?'selected':'' }}>Pemilik</option>
      <option value="penyewa" {{ $user->role=='penyewa'?'selected':'' }}>Penyewa</option>
    </select>
  </div>
  <div class="mb-3">
    <label>Password (kosongkan jika tidak ganti)</label>
    <input type="password" name="password" class="form-control">
  </div>
  <button class="btn btn-success">Update</button>
</form>
@endsection
