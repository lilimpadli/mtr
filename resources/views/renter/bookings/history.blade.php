@extends('layouts.app')

@section('content')
<h2>Riwayat Penyewaan</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Motor</th>
            <th>Periode</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $b)
        <tr>
            <td>{{ $b->motor->merk }} ({{ $b->motor->tipe_cc }} cc)</td>
            <td>{{ $b->tanggal_mulai }} - {{ $b->tanggal_selesai }}</td>
            <td>Rp{{ $b->harga }}</td>
            <td>{{ $b->status }}</td>
            <td>
                @if($b->transaksi)
                    {{ $b->transaksi->metode_pembayaran }} - {{ $b->transaksi->status }}
                @else
                    Belum bayar
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
