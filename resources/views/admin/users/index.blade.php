@extends('layouts.app')

@section('content')
<h2>Daftar User</h2>
<a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Tambah User</a>
<a href="{{ route('admin.users.export.excel') }}" class="btn btn-success mb-3">Export Excel</a>
<a href="{{ route('admin.users.export.pdf') }}" class="btn btn-danger mb-3">Export PDF</a>


<table class="table table-bordered">
  <thead>
    <tr>
      <th>Nama</th>
      <th>Email</th>
      <th>No Telepon</th>
      <th>Role</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $u)
    <tr>
      <td>{{ $u->nama }}</td>
      <td>{{ $u->email }}</td>
      <td>{{ $u->no_tlpn }}</td>
      <td>{{ $u->role }}</td>
      <td>
        <a href="{{ route('admin.users.edit',$u->id) }}" class="btn btn-sm btn-warning">Edit</a>
        
        <form action="{{ route('admin.users.destroy',$u->id) }}" method="POST" style="display:inline-block;">
          @csrf @method('DELETE')
          <button class="btn btn-sm btn-danger" onclick="return confirm('Hapus user?')">Hapus</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection
