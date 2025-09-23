@extends('layouts.app')

@section('content')
<h2>Daftar Booking</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Penyewa</th>
            <th>Motor</th>
            <th>Periode</th>
            <th>Harga</th>
            <th>Status</th>
            <th>Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bookings as $b)
        <tr>
            <td>{{ $b->penyewa->nama }}</td>
            <td>{{ $b->motor->merk }} ({{ $b->motor->no_plat }})</td>
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
            <td>
                @if($b->status == 'pending' && $b->transaksi)
                    <form action="{{ route('admin.bookings.confirm',$b->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-success">Konfirmasi</button>
                    </form>
                @elseif($b->status == 'disewa')
                    <form action="{{ route('admin.bookings.finish',$b->id) }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-primary">Selesai</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
