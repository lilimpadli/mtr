@extends('layouts.app')

@section('content')
  <h2>Dashboard Pemilik</h2>
  <p>Halo, {{ Auth::user()->nama }}! Kelola motor dan lihat laporanmu di sini.</p>
@endsection
