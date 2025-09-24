<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Rental Motor</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --primary-color: #4361ee;
      --secondary-color: #3f37c9;
      --accent-color: #f72585;
      --dark-color: #2b2d42;
      --light-color: #f8f9fa;
      --sidebar-width: 260px;
    }
    
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f1f3f5;
      color: #333;
    }
    
    .sidebar {
      width: var(--sidebar-width);
      min-height: 100vh;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      padding-top: 20px;
      position: fixed;
      left: 0;
      top: 0;
      box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      transition: all 0.3s ease;
    }
    
    .sidebar-header {
      padding: 15px 20px;
      text-align: center;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      margin-bottom: 20px;
    }
    
    .sidebar-header h4 {
      color: white;
      font-weight: 600;
      font-size: 1.4rem;
      margin-bottom: 5px;
    }
    
    .sidebar-header p {
      color: rgba(255, 255, 255, 0.7);
      font-size: 0.85rem;
    }
    
    .sidebar-menu {
      padding: 0 15px;
    }
    
    .sidebar-menu a {
      color: rgba(255, 255, 255, 0.9);
      display: flex;
      align-items: center;
      padding: 12px 15px;
      text-decoration: none;
      border-radius: 8px;
      margin-bottom: 5px;
      transition: all 0.3s ease;
    }
    
    .sidebar-menu a:hover {
      background-color: rgba(255, 255, 255, 0.15);
      transform: translateX(5px);
    }
    
    .sidebar-menu a i {
      margin-right: 10px;
      width: 20px;
      text-align: center;
    }
    
    .sidebar-menu a.active {
      background-color: rgba(255, 255, 255, 0.2);
      font-weight: 500;
    }
    
    .content {
      margin-left: var(--sidebar-width);
      padding: 25px;
      min-height: 100vh;
      width: calc(100% - var(--sidebar-width));
    }
    
    .content-header {
      margin-bottom: 25px;
      padding-bottom: 15px;
      border-bottom: 1px solid #e9ecef;
    }
    
    .content-header h1 {
      font-size: 1.8rem;
      font-weight: 600;
      color: var(--dark-color);
      margin-bottom: 5px;
    }
    
    .content-header p {
      color: #6c757d;
      font-size: 0.95rem;
    }
    
    .alert {
      border-radius: 10px;
      padding: 15px 20px;
      margin-bottom: 20px;
      border: none;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }
    
    .alert-success {
      background-color: #d1e7dd;
      color: #0f5132;
    }
    
    .alert-danger {
      background-color: #f8d7da;
      color: #842029;
    }
    
    .btn-logout {
      background-color: rgba(255, 255, 255, 0.15);
      color: white;
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 8px;
      padding: 8px 20px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .btn-logout:hover {
      background-color: rgba(255, 255, 255, 0.25);
      color: white;
    }
    
    .sidebar-footer {
      position: absolute;
      bottom: 20px;
      left: 0;
      width: 100%;
      padding: 0 20px;
      text-align: center;
    }
    
    .sidebar-footer p {
      color: rgba(255, 255, 255, 0.6);
      font-size: 0.8rem;
    }
    
    @media (max-width: 768px) {
      .sidebar {
        width: 70px;
      }
      
      .sidebar-header h4, .sidebar-header p, .sidebar-menu a span, .sidebar-footer {
        display: none;
      }
      
      .sidebar-menu a {
        justify-content: center;
        padding: 15px 0;
      }
      
      .sidebar-menu a i {
        margin-right: 0;
        font-size: 1.2rem;
      }
      
      .content {
        margin-left: 70px;
        width: calc(100% - 70px);
      }
    }
  </style>
</head>
<body>
  <div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-header">
        <h4><i class="fas fa-motorcycle"></i> Rental Motor</h4>
        <p>Sistem Penyewaan Motor</p>
      </div>

      <div class="sidebar-menu">
        @auth
          @if(Auth::user()->role == 'admin')
            <a href="/admin/dashboard" class="active">
              <i class="fas fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.users.index') }}">
              <i class="fas fa-users"></i>
              <span>Kelola User</span>
            </a>
            <a href="{{ route('admin.motors.index') }}">
              <i class="fas fa-motorcycle"></i>
              <span>Verifikasi Motor</span>
            </a>
            <a href="{{ route('admin.tarifs.index') }}">
              <i class="fas fa-money-bill-wave"></i>
              <span>Kelola Tarif</span>
            </a>
            <a href="{{ route('admin.pembayaran.index') }}">
              <i class="fas fa-credit-card"></i>
              <span>Kelola Pembayaran</span>
            </a>
            <a href="{{ route('admin.bookings.index') }}">
              <i class="fas fa-calendar-check"></i>
              <span>Kelola Booking</span>
            </a>
            <a href="{{ route('admin.reports.index') }}">
              <i class="fas fa-chart-bar"></i>
              <span>Laporan</span>
            </a>
          @elseif(Auth::user()->role == 'pemilik')
            <a href="/owner/dashboard" class="active">
              <i class="fas fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </a>
            <a href="{{ route('owner.motors.index') }}">
              <i class="fas fa-motorcycle"></i>
              <span>Kelola Motor</span>
            </a>
            <a href="{{ route('owner.reports.index') }}">
              <i class="fas fa-chart-bar"></i>
              <span>Laporan</span>
            </a>
          @elseif(Auth::user()->role == 'penyewa')
            <a href="/renter/dashboard" class="active">
              <i class="fas fa-tachometer-alt"></i>
              <span>Dashboard</span>
            </a>
            
            <a href="{{ route('renter.bookings.history') }}">
              <i class="fas fa-history"></i>
              <span>Riwayat Sewa</span>
            </a>
          @endif
        @endauth
      </div>

      <div class="sidebar-menu mt-auto">
        @auth
          <form action="{{ route('logout') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn-logout w-100">
              <i class="fas fa-sign-out-alt"></i>
              <span>Logout</span>
            </button>
          </form>
        @else
          <a href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt"></i>
            <span>Login</span>
          </a>
          <a href="{{ route('register') }}">
            <i class="fas fa-user-plus"></i>
            <span>Register</span>
          </a>
        @endauth
      </div>
      
      <div class="sidebar-footer">
        <p>&copy; {{ date('Y') }} Rental Motor</p>
      </div>
    </div>

    <!-- Content -->
    <div class="content">
      <div class="content-header">
        <h1>@yield('title', 'Dashboard')</h1>
        <p>@yield('subtitle', 'Selamat datang di sistem Rental Motor')</p>
      </div>
      
      @if(session('success'))
        <div class="alert alert-success">
          <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        </div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger">
          <i class="fas fa-exclamation-circle me-2"></i> {{ implode(', ', $errors->all()) }}
        </div>
      @endif

      @yield('content')
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Add active class to current menu item
    document.addEventListener('DOMContentLoaded', function() {
      const currentPath = window.location.pathname;
      const menuItems = document.querySelectorAll('.sidebar-menu a');
      
      menuItems.forEach(item => {
        if (item.getAttribute('href') === currentPath) {
          item.classList.add('active');
        }
      });
    });
  </script>
</body>
</html>