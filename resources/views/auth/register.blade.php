@extends('layouts.app')

@section('content')
<div class="card p-4 mx-auto" style="max-width:500px;">
  <h3 class="mb-3">Register</h3>
  <form action="/register" method="POST">
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
        <option value="penyewa">Penyewa</option>
        <option value="pemilik">Pemilik</option>
        <option value="admin">Admin</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Konfirmasi Password</label>
      <input type="password" name="password_confirmation" class="form-control" required>
    </div>
    <button class="btn btn-success w-100">Register</button>
    <p class="mt-3">Sudah punya akun? <a href="{{ route('login') }}">Login</a></p>
  </form>
</div>
@endsection
