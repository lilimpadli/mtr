@extends('layouts.app')

@section('content')
  <h2>Dashboard Admin</h2>
  <p>Halo, {{ Auth::user()->nama }}! Selamat datang di panel admin.</p>
@endsection
