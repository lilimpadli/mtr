<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Rental Motor</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body { background-color: #f9f9f9; }
    .sidebar {
      height: 100vh;
      background-color: #343a40;
      padding-top: 20px;
    }
    .sidebar a {
      color: #fff;
      display: block;
      padding: 10px 20px;
      text-decoration: none;
    }
    .sidebar a:hover {
      background-color: #495057;
    }
    .content {
      padding: 20px;
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
      <h4 class="text-white text-center mb-4">Rental Motor</h4>

      @auth
        @if(Auth::user()->role == 'admin')
          <a href="/admin/dashboard">Dashboard</a>
           <a href="{{ route('admin.users.index') }}">Kelola User</a>
           <a href="{{ route('admin.motors.index') }}">Verifikasi Motor</a>
          <a href="{{ route('tarifs.index') }}">Kelola Tarif</a>
          <a href="{{ route('admin.pembayaran.index') }}">Kelola Pembayaran</a>
          <a href="{{ route('admin.bookings.index') }}">Kelola Booking</a>
          <a href="{{ route('admin.reports.index') }}">Laporan</a>

           
          
        @elseif(Auth::user()->role == 'pemilik')
          <a href="/owner/dashboard">Dashboard</a>
          <a href="{{ route('owner.motors.index') }}">Kelola Motor</a>
          <a href="{{ route('owner.reports.index') }}">Laporan</a>
        @elseif(Auth::user()->role == 'penyewa')
          <a href="/renter/dashboard">Dashboard</a>
          <a href="{{ route('renter.motors.index') }}">Cari & Booking Motor</a>
          <a href="{{ route('renter.bookings.history') }}">Riwayat Sewa</a>
        @endif

        <form action="{{ route('logout') }}" method="POST" class="mt-3 text-center">
          @csrf
          <button class="btn btn-sm btn-danger">Logout</button>
        </form>
      @endauth

      @guest
        <a href="{{ route('login') }}">Login</a>
        <a href="{{ route('register') }}">Register</a>
      @endguest
    </div>

    <!-- Content -->
    <div class="content flex-grow-1">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger">{{ implode(', ', $errors->all()) }}</div>
      @endif

      @yield('content')
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
