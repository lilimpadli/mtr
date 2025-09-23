@extends('layouts.app')

@section('content')
<h2>Daftar Motor Tersedia</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Merk</th>
            <th>No Plat</th>
            <th>Tarif</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($motors as $motor)
        <tr>
            <td>{{ $motor->merk }} ({{ $motor->tipe_cc }} cc)</td>
            <td>{{ $motor->no_plat }}</td>
            <td>
                H: Rp{{ $motor->tarif->tarif_harian }} <br>
                M: Rp{{ $motor->tarif->tarif_mingguan }} <br>
                B: Rp{{ $motor->tarif->tarif_bulanan }}
            </td>
            <td>
                <a href="{{ route('renter.bookings.create',$motor->id) }}" class="btn btn-sm btn-success">Booking</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
