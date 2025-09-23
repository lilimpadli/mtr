@extends('layouts.app')

@section('content')
<h2>Daftar Motor (Verifikasi Admin)</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Pemilik</th>
            <th>Merk</th>
            <th>No Plat</th>
            <th>Status</th>
            <th>Tarif</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($motors as $motor)
        <tr>
            <td>{{ $motor->pemilik->nama }}</td>
            <td>{{ $motor->merk }} ({{ $motor->tipe_cc }} cc)</td>
            <td>{{ $motor->no_plat }}</td>
            <td>{{ $motor->status }}</td>
           <td>
    @if($motor->photo)
        <img src="{{ asset('storage/'.$motor->photo) }}" 
             alt="Foto Motor" width="120">
    @else
        <em>Tidak ada foto</em>
    @endif
</td>
<td>
    @if($motor->dokumen_kepemilikan)
        <a href="{{ asset('storage/'.$motor->dokumen_kepemilikan) }}" target="_blank">Lihat Dokumen</a>
    @else
        <em>Tidak ada dokumen</em>
    @endif
</td>

            <td>
                @if($motor->tarif)
                    H: Rp{{ $motor->tarif->tarif_harian }} <br>
                    M: Rp{{ $motor->tarif->tarif_mingguan }} <br>
                    B: Rp{{ $motor->tarif->tarif_bulanan }}
                @else
                    <em>Belum ada</em>
                @endif
            </td>
            <td>
    @if($motor->status === 'pending')
        <form action="{{ route('admin.motors.approve', $motor->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-sm btn-success">Terima</button>
        </form>

        <form action="{{ route('admin.motors.reject', $motor->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-sm btn-danger">Tolak</button>
        </form>
    @elseif($motor->status === 'tersedia')
        <span class="badge bg-success">Diterima</span>
    @elseif($motor->status === 'ditolak')
        <span class="badge bg-danger">Ditolak</span>
    @endif
</td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection
