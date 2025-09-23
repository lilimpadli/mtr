@extends('layouts.app')

@section('content')
<h2>Laporan Pemilik</h2>

<h4>Total Pendapatan: Rp{{ $totalPendapatan }}</h4>

<table class="table table-bordered">
  <thead>
    <tr>
      <th>Motor</th>
      <th>Jumlah Penyewaan</th>
      <th>Total Pendapatan</th>
    </tr>
  </thead>
  <tbody>
    @foreach($motors as $m)
    <tr>
      <td>{{ $m->merk }} ({{ $m->no_plat }})</td>
      <td>{{ $m->penyewaans->count() }}</td>
      <td>
        Rp{{ $m->penyewaans->sum(fn($p) => $p->bagiHasil->bagi_hasil_pemilik ?? 0) }}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
