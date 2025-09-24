@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0"><i class="fas fa-users me-2"></i>Daftar User</h2>
            <p class="text-muted mb-0">Kelola data pengguna sistem</p>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Tambah User
            </a>
            <div class="dropdown">
                <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-download me-1"></i> Export
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.users.export.excel') }}" class="dropdown-item">
                            <i class="fas fa-file-excel me-2 text-success"></i>Export Excel
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.export.pdf') }}" class="dropdown-item">
                            <i class="fas fa-file-pdf me-2 text-danger"></i>Export PDF
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">Data Pengguna</h5>
                </div>
                <div class="col-auto">
                    <span class="badge bg-primary">{{ $users->count() }} Pengguna</span>
                </div>
            </div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">#</th>
                            <th>Informasi Pengguna</th>
                            <th>Kontak</th>
                            <th>Role</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $u)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3">
                                        {{ strtoupper(substr($u->nama, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold">{{ $u->nama }}</div>
                                        <small class="text-muted">{{ $u->email }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-phone text-muted me-2"></i>
                                    <span>{{ $u->no_tlpn ?: '-' }}</span>
                                </div>
                            </td>
                            <td>
                                @if($u->role === 'admin')
                                    <span class="badge bg-danger">Admin</span>
                                @elseif($u->role === 'pemilik')
                                    <span class="badge bg-warning text-dark">Pemilik</span>
                                @else
                                    <span class="badge bg-info">Penyewa</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.users.edit', $u->id) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       title="Edit User">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" 
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $u->nama }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-outline-danger" 
                                                title="Hapus User">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <small class="text-muted">Menampilkan {{ $users->count() }} data</small>
                <div>
                    <!-- Pagination jika diperlukan -->
                    {{-- {{ $users->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: #6c757d;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 1.2rem;
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}

.btn-group .btn {
    border-radius: 0.25rem;
}

.btn-group .btn:not(:last-child) {
    margin-right: 0.25rem;
}
</style>
@endpush
@endsection