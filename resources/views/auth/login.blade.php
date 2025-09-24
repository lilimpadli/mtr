
@extends('layouts.auth')

@section('content')
<div class="card p-4 mx-auto" style="max-width:400px;">
  <h3 class="mb-3">Login</h3>
  <form action="/login" method="POST">
    @csrf
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button class="btn btn-primary w-100">Login</button>
    <p class="mt-3">Belum punya akun? <a href="{{ route('register') }}">Register</a></p>
  </form>
</div>
@endsection


