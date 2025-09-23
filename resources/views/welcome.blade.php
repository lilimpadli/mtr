<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>RentMotor - Sistem Penyewaan Motor</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    :root {
        --primary: #2563eb;
        --primary-dark: #1d4ed8;
        --secondary: #f97316;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --light: #f8fafc;
        --dark: #1e293b;
        --gray: #64748b;
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--light);
        color: var(--dark);
        line-height: 1.6;
    }

    .container {
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Header Styles */
    header {
        background-color: white;
        box-shadow: var(--shadow);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
    }

    .logo {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo i {
        color: var(--secondary);
    }

    .nav-links {
        display: flex;
        list-style: none;
        gap: 25px;
        align-items: center;
    }

    .nav-links a {
        text-decoration: none;
        color: var(--dark);
        font-weight: 500;
        transition: color 0.3s;
        position: relative;
    }

    .nav-links a:hover {
        color: var(--primary);
    }

    .nav-links a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -5px;
        left: 0;
        background-color: var(--primary);
        transition: width 0.3s;
    }

    .nav-links a:hover::after {
        width: 100%;
    }

    .btn-auth {
        background-color: var(--primary);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s;
    }

    .btn-auth:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
    }

    /* Hero Section */
    .hero {
        background: linear-gradient(135deg, rgba(37, 99, 235, 0.9), rgba(249, 115, 22, 0.8)), url('https://images.unsplash.com/photo-1558981285-6f0c94906bb0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1950&q=80');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 120px 0 80px;
        text-align: center;
    }

    .hero-content {
        max-width: 700px;
        margin: 0 auto;
    }

    .hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .hero p {
        font-size: 1.2rem;
        margin-bottom: 30px;
        opacity: 0.9;
    }

    .hero-buttons {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .btn-primary, .btn-secondary {
        display: inline-block;
        padding: 12px 30px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: var(--shadow);
    }

    .btn-primary {
        background-color: white;
        color: var(--primary);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-lg);
    }

    .btn-secondary {
        background-color: transparent;
        color: white;
        border: 2px solid white;
    }

    .btn-secondary:hover {
        background-color: rgba(255, 255, 255, 0.2);
    }

    /* Filter Section */
    .filter-section {
        background-color: white;
        padding: 30px 0;
        box-shadow: var(--shadow);
        position: sticky;
        top: 80px;
        z-index: 100;
    }

    .filter-container {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        align-items: flex-end;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--dark);
    }

    .filter-group select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        background-color: white;
        transition: border-color 0.3s;
    }

    .filter-group select:focus {
        outline: none;
        border-color: var(--primary);
    }

    .btn-filter {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .btn-filter:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
    }

    /* Motors Section */
    .motors-section {
        padding: 80px 0;
    }

    .section-title {
        text-align: center;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 50px;
        color: var(--dark);
        position: relative;
    }

    .section-title::after {
        content: '';
        position: absolute;
        width: 80px;
        height: 4px;
        background-color: var(--secondary);
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
    }

    .motors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    .motor-card {
        background-color: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
    }

    .motor-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-lg);
    }

    .motor-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .motor-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .motor-card:hover .motor-image img {
        transform: scale(1.05);
    }

    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        color: white;
    }

    .status-tersedia {
        background-color: var(--success);
    }

    .status-disewa {
        background-color: var(--danger);
    }

    .status-perawatan {
        background-color: var(--warning);
    }

    .motor-info {
        padding: 25px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .motor-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: var(--dark);
    }

    .motor-details {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
        margin-bottom: 20px;
    }

    .detail-item {
        display: flex;
        align-items: center;
        gap: 8px;
        color: var(--gray);
    }

    .detail-item i {
        color: var(--primary);
    }

    .pricing {
        margin-bottom: 25px;
    }

    .pricing h4 {
        font-size: 1.1rem;
        margin-bottom: 12px;
        color: var(--dark);
    }

    .price-options {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .price-item {
        background-color: var(--light);
        padding: 12px;
        border-radius: 8px;
        text-align: center;
    }

    .price-label {
        font-size: 0.85rem;
        color: var(--gray);
        margin-bottom: 5px;
    }

    .price-amount {
        font-weight: 600;
        color: var(--primary);
    }

    .btn-rent {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: auto;
    }

    .btn-rent:hover:not(:disabled) {
        background-color: var(--primary-dark);
    }

    .btn-rent:disabled {
        background-color: var(--gray);
        cursor: not-allowed;
    }

    /* Footer */
    footer {
        background-color: var(--dark);
        color: white;
        padding: 60px 0 30px;
    }

    .footer-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        margin-bottom: 40px;
    }

    .footer-column h3 {
        font-size: 1.3rem;
        margin-bottom: 20px;
        position: relative;
        padding-bottom: 10px;
    }

    .footer-column h3::after {
        content: '';
        position: absolute;
        width: 50px;
        height: 3px;
        background-color: var(--secondary);
        bottom: 0;
        left: 0;
    }

    .footer-column p, .footer-column li {
        color: #cbd5e1;
        margin-bottom: 10px;
    }

    .footer-column ul {
        list-style: none;
    }

    .footer-column ul li a {
        color: #cbd5e1;
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-column ul li a:hover {
        color: var(--secondary);
    }

    .social-links {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }

    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        color: white;
        transition: all 0.3s;
    }

    .social-links a:hover {
        background-color: var(--secondary);
        transform: translateY(-3px);
    }

    .copyright {
        text-align: center;
        padding-top: 30px;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        color: #94a3b8;
        font-size: 0.9rem;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .hero h1 {
            font-size: 2.8rem;
        }
        
        .motors-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .nav-links {
            gap: 15px;
        }
        
        .hero h1 {
            font-size: 2.2rem;
        }
        
        .filter-container {
            flex-direction: column;
        }
        
        .filter-group {
            width: 100%;
        }
        
        .btn-filter {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .hero {
            padding: 80px 0 50px;
        }
        
        .hero h1 {
            font-size: 1.8rem;
        }
        
        .hero p {
            font-size: 1rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .price-options {
            grid-template-columns: 1fr;
        }
        
        .footer-content {
            grid-template-columns: 1fr;
        }
    }
</style>
</head>
<body>

<!-- Header -->
<header>
    <nav class="container">
        <div class="logo">
            <i class="fas fa-motorcycle"></i>
            RentMotor
        </div>
        <ul class="nav-links">
            <li><a href="#home">Beranda</a></li>
            <li><a href="#motors">Motor</a></li>
            
            <li>
                <a href="{{ route('login') }}" class="btn-auth">Masuk</a>
            </li>
        </ul>
    </nav>
</header>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="container">
        <div class="hero-content">
            <h1>Sewa Motor Mudah & Terpercaya</h1>
            <p>Temukan motor impian Anda dengan harga terbaik dan layanan profesional</p>
            <div class="hero-buttons">
                <a href="#motors" class="btn-primary">Lihat Motor</a>
               
            </div>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="filter-section">
    <div class="container">
        <div class="filter-container">
            <div class="filter-group">
                <label for="merk">Merk Motor</label>
                <select id="merk">
                    <option value="">Semua Merk</option>
                    <option value="honda">Honda</option>
                    <option value="yamaha">Yamaha</option>
                    <option value="suzuki">Suzuki</option>
                    <option value="kawasaki">Kawasaki</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="tipe">Tipe CC</label>
                <select id="tipe">
                    <option value="">Semua Tipe</option>
                    <option value="100">100 CC</option>
                    <option value="125">125 CC</option>
                    <option value="150">150 CC</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="durasi">Durasi Sewa</label>
                <select id="durasi">
                    <option value="harian">Harian</option>
                    <option value="mingguan">Mingguan</option>
                    <option value="bulanan">Bulanan</option>
                </select>
            </div>
            <button class="btn-filter" onclick="filterMotors()">
                <i class="fas fa-search"></i> Cari Motor
            </button>
        </div>
    </div>
</section>

<!-- Motors Section -->
<section class="motors-section" id="motors">
<div class="container">
    <h2 class="section-title">Motor Tersedia</h2>
    <div class="motors-grid">
        @forelse($motors as $motor)
            @php
                $statusClass = [
                    'tersedia'=>'status-tersedia',
                    'disewa'=>'status-disewa',
                    'perawatan'=>'status-perawatan',
                    'ditolak'=>'status-perawatan'
                ][$motor->status] ?? 'status-tersedia';
                $tarif = $motor->tarifRental;
            @endphp
            <div class="motor-card" data-merk="{{ strtolower($motor->merk) }}" data-tipe="{{ $motor->tipe_cc }}">
                <div class="motor-image">
                    <span class="status-badge {{ $statusClass }}">{{ ucfirst($motor->status) }}</span>
                    @if($motor->photo)
    <img src="{{ asset('storage/'.$motor->photo) }}" alt="Foto Motor">
@else
    <img src="https://images.unsplash.com/photo-1558981285-6f0c94906bb0?auto=format&fit=crop&w=500&q=80" alt="Default Motor">
@endif
                </div>
                <div class="motor-info">
                    <h3 class="motor-title">{{ ucfirst($motor->merk) }} {{ $motor->tipe_cc }}CC</h3>
                    <div class="motor-details">
                        <div class="detail-item">
                            <i class="fas fa-motorcycle"></i>
                            <span>{{ ucfirst($motor->merk) }}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>{{ $motor->tipe_cc }} CC</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-id-card"></i>
                            <span>{{ $motor->no_plat }}</span>
                        </div>
                        <div class="detail-item">
                            <i class="fas fa-user"></i>
                            <span>{{ $motor->pemilik->nama ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="pricing">
                     <h4>Harga Sewa</h4>
<div class="price-item">
    <div class="price-label">Harian</div>
    <div class="price-amount">
        Rp {{ number_format($motor->tarif->tarif_harian ?? 0, 0, ',', '.') }}
    </div>
</div>
<div class="price-item">
    <div class="price-label">Mingguan</div>
    <div class="price-amount">
        Rp {{ number_format($motor->tarif->tarif_mingguan ?? 0, 0, ',', '.') }}
    </div>
</div>
<div class="price-item">
    <div class="price-label">Bulanan</div>
    <div class="price-amount">
        Rp {{ number_format($motor->tarif->tarif_bulanan ?? 0, 0, ',', '.') }}
    </div>
</div>


                    </div>
                    <button class="btn-rent" {{ $motor->status!='tersedia' ? 'disabled' : '' }}>
                        {{ $motor->status=='tersedia' ? 'Sewa Sekarang' : ucfirst($motor->status) }}
                    </button>
                </div>
            </div>
        @empty
            <div style="text-align:center;padding:3rem;color:#666;grid-column: 1/-1;">
                <h3>Belum ada data motor</h3>
                <p>Silakan tambahkan motor terlebih dahulu</p>
            </div>
        @endforelse
    </div>
</div>
</section>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-column">
                <h3>RentMotor</h3>
                <p>Sistem penyewaan motor terpercaya dengan berbagai pilihan motor berkualitas dan harga terjangkau.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="footer-column">
                <h3>Menu</h3>
                <ul>
                    <li><a href="#home">Beranda</a></li>
                    <li><a href="#motors">Motor</a></li>
                   
                </ul>
            </div>
           
            <div class="footer-column">
                <h3>Kontak</h3>
                <p><i class="fas fa-map-marker-alt"></i> Jl.Kawali No. 23, Ciamis</p>
                <p><i class="fas fa-phone"></i> +62 821-2663-5330</p>
                <p><i class="fas fa-envelope"></i> lilimpadli@gmail.com</p>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; {{ date('Y') }} RentMotor. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 80,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Filter motor function
    function filterMotors() {
        const merkFilter = document.getElementById('merk').value.toLowerCase();
        const tipeFilter = document.getElementById('tipe').value;
        const motorCards = document.querySelectorAll('.motor-card');
        
        motorCards.forEach(card => {
            const merk = card.getAttribute('data-merk');
            const tipe = card.getAttribute('data-tipe');
            
            const merkMatch = !merkFilter || merk === merkFilter;
            const tipeMatch = !tipeFilter || tipe === tipeFilter;
            
            if (merkMatch && tipeMatch) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Add event listeners to filter dropdowns
    document.getElementById('merk').addEventListener('change', filterMotors);
    document.getElementById('tipe').addEventListener('change', filterMotors);
</script>
</body>
</html>