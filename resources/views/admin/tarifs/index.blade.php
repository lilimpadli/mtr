@extends('layouts.app')

@section('content')
<h2>Daftar Tarif Rental</h2>
<a href="{{ route('admin.tarifs.create') }}" class="btn btn-primary mb-3">Tambah Tarif</a>


@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Motor</th>
      <th>Tarif Harian</th>
      <th>Tarif Mingguan</th>
      <th>Tarif Bulanan</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($tarifs as $tarif)
    <tr>
      <td>{{ $tarif->motor->merk ?? '-' }}</td>
      <td>Rp{{ number_format($tarif->tarif_harian,0,',','.') }}</td>
      <td>Rp{{ number_format($tarif->tarif_mingguan,0,',','.') }}</td>
      <td>Rp{{ number_format($tarif->tarif_bulanan,0,',','.') }}</td>
      <td>
        <a href="{{ route('admin.tarifs.edit', $tarif->id) }}" class="btn btn-warning btn-sm">Edit</a>
    <form action="{{ route('admin.tarifs.destroy', $tarif->id) }}" method="POST" style="display:inline-block;">
      @csrf @method('DELETE')
      <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus tarif?')">Hapus</button>
    </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
