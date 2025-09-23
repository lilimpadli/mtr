@extends('layouts.app')

@section('content')
<h2>Daftar Motor Saya</h2>
<a href="{{ route('owner.motors.create') }}" class="btn btn-primary mb-3">Tambah Motor</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Merk</th>
            <th>Tipe CC</th>
            <th>No Plat</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($motors as $motor)
        <tr>
            <td>{{ $motor->merk }}</td>
            <td>{{ $motor->tipe_cc }}</td>
            <td>{{ $motor->no_plat }}</td>
            <td>{{ $motor->status }}</td>
            <td>
                <form action="{{ route('owner.motors.destroy',$motor->id) }}" method="POST" onsubmit="return confirm('Hapus motor?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
