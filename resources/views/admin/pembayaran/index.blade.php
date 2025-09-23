@extends('layouts.app')

@section('content')
<h2>Daftar Pembayaran</h2>
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
  <thead>
    <tr>
      <th>ID</th>
      <th>Penyewa</th>
      <th>Motor</th>
      <th>Jumlah</th>
      <th>Metode</th>
      <th>Status</th>
      <th>Tanggal</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($pembayaran as $p)
    <tr>
      <td>{{ $p->id }}</td>
      <td>{{ $p->penyewaan->penyewa->nama ?? '-' }}</td>
      <td>{{ $p->penyewaan->motor->merk ?? '-' }}</td>
      <td>Rp{{ number_format($p->jumlah,0,',','.') }}</td>
      <td>{{ $p->metode_pembayaran }}</td>
      <td>{{ ucfirst($p->status) }}</td>
      <td>{{ $p->tanggal }}</td>
      <td>
        <a href="{{ route('admin.pembayaran.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>
        <form action="{{ route('admin.pembayaran.destroy', $p->id) }}" method="POST" style="display:inline-block;">
          @csrf @method('DELETE')
          <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus pembayaran?')">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
