<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB SMK Muhammadiyah Mungkid</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            overflow-x: hidden;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }

        /* Light Background */
        .bg-animation {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 50%, #cbd5e1 100%);
        }

        .bg-animation::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23cbd5e1" opacity="0.3"/><circle cx="30" cy="20" r="0.5" fill="%23cbd5e1" opacity="0.2"/><circle cx="60" cy="30" r="1.5" fill="%23cbd5e1" opacity="0.1"/><circle cx="80" cy="50" r="1" fill="%23cbd5e1" opacity="0.2"/><circle cx="20" cy="70" r="0.8" fill="%23cbd5e1" opacity="0.15"/><circle cx="90" cy="80" r="1.2" fill="%23cbd5e1" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        }

        /* Light Theme Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(203, 213, 225, 0.3);
            z-index: 1000;
            padding: 1rem 0;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            padding: 0.5rem 0;
        }

        .navbar-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: #1e293b;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.25rem;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            margin: 0;
        }

        .nav-menu a {
            color: #475569;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .nav-menu a:hover {
            background: rgba(76, 175, 80, 0.1);
            color: #2E7D32;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 4px;
            cursor: pointer;
            padding: 0.5rem;
        }

        .hamburger span {
            width: 25px;
            height: 3px;
            background: #475569;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .hamburger.active span:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .hamburger.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger.active span:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }

        /* Light Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100vh;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-left: 1px solid rgba(203, 213, 225, 0.3);
            z-index: 999;
            transition: right 0.3s ease;
            padding: 5rem 2rem 2rem;
            box-shadow: -4px 0 6px rgba(0, 0, 0, 0.1);
        }

        .sidebar.active {
            right: 0;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .sidebar-menu a {
            color: #475569;
            text-decoration: none;
            font-weight: 500;
            padding: 1rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .sidebar-menu a:hover {
            background: rgba(76, 175, 80, 0.1);
            border-color: rgba(76, 175, 80, 0.2);
            color: #2E7D32;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 2rem;
            margin-top: 5rem;
            background: linear-gradient(135deg, #e0f7fa 0%, #c8e6c9 50%);
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('/img/bg.jpg');
            opacity: 0.2;
            pointer-events: none;
            z-index: 0;
        }
        .hero-content {
            position: relative;
            z-index: 1;
        }

        .hero-content {
            max-width: 800px;
            animation: fadeInUp 1s ease;
        }

        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #475569;
            margin-bottom: 2rem;
            font-weight: 400;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
            color: white;
            box-shadow: 0 8px 25px rgba(76, 175, 80, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.8);
            color: #475569;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(203, 213, 225, 0.5);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn:hover::before {
            left: 100%;
        }

        /* Light News Section */
        .news {
            padding: 5rem 2rem;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            margin: 2rem;
            border-radius: 30px;
            border: 1px solid rgba(203, 213, 225, 0.3);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, #4CAF50, #2E7D32);
            border-radius: 2px;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }

        .news-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(203, 213, 225, 0.3);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .news-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #4CAF50, #2E7D32);
        }

        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            background: rgba(255, 255, 255, 0.95);
        }

        .news-date {
            color: #4CAF50;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .news-card h3 {
            color: #1e293b;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .news-card p {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .read-more {
            color: #4CAF50;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .read-more:hover {
            color: #2E7D32;
        }

        /* Light Footer */
        .footer {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 3rem 2rem 2rem;
            margin-top: 2rem;
            border-top: 1px solid rgba(203, 213, 225, 0.3);
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            color: #1e293b;
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .footer-section p,
        .footer-section a {
            color: #64748b;
            line-height: 1.6;
            text-decoration: none;
        }

        .footer-section a:hover {
            color: #4CAF50;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 50%;
            transition: all 0.3s ease;
            color: #64748b;
            border: 1px solid rgba(203, 213, 225, 0.3);
        }

        .social-links a:hover {
            background: #4CAF50;
            transform: translateY(-3px);
            color: white;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(203, 213, 225, 0.3);
            color: #64748b;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .animate-on-scroll.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .hero h1 {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }

            .news-grid {
                grid-template-columns: 1fr;
            }

            .news {
                margin: 1rem;
                padding: 3rem 1.5rem;
            }

            .navbar-container {
                padding: 0 1rem;
            }
        }

        @media (max-width: 480px) {
            .hero {
                padding: 0 1rem;
            }

            .hero h1 {
                font-size: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="bg-animation"></div>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="navbar-container">
            <a href="/" class="logo">
                <div class="logo-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <span>SMK Muhammadiyah Mungkid</span>
            </a>

            <ul class="nav-menu">
                <li><a href="/">Beranda</a></li>
                <li><a href="/#tentang">Tentang</a></li>
                <li><a href="/#jurusan">Jurusan</a></li>
                <li><a href="/#berita">Berita</a></li>
                <li><a href="/#kontak">Kontak</a></li>
                {{-- <li><a href="/pendaftaran" class="btn btn-primary" style="padding: 0.5rem 1.5rem;">Daftar PPDB</a></li> --}}
            </ul>

            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
            <li><a href="#home">Beranda</a></li>
            <li><a href="#tentang">Tentang</a></li>
            <li><a href="#jurusan">Jurusan</a></li>
            <li><a href="#berita">Berita</a></li>
            <li><a href="#kontak">Kontak</a></li>
            <li><a href="#ppdb">Daftar PPDB</a></li>
        </ul>
    </div>
    
    @yield('content')

    <!-- Footer -->
    <footer class="footer" id="kontak">
        <div class="footer-content">
            <div class="footer-section">
                <h3>SMK Muhammadiyah Mungkid</h3>
                <p>Sekolah Menengah Kejuruan terdepan yang mengintegrasikan pendidikan teknologi modern dengan
                    nilai-nilai Islami untuk mencetak generasi unggul.</p>
                <div class="social-links">
                    <a href="https://facebook.com/smkmuhmungkid"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com/smk_muhmungkid"><i class="fab fa-instagram"></i></a>
                    <a href="https://youtube.com/"><i class="fab fa-youtube"></i></a>
                    <a href="https://wa.me/6285729910005"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Kontak</h3>
                <p><i class="fas fa-map-marker-alt"></i> Jl. Pemandian Blabak, Mungkid, Magelang, Jawa Tengah</p>
                <p><i class="fas fa-phone"></i> (0293) 782029</p>
                <p><i class="fas fa-envelope"></i> smkmuhmungkid@gmail.com</p>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <p><a href="#tentang">Tentang Kami</a></p>
                <p><a href="#program">Program Keahlian</a></p>
                <p><a href="#ppdb">PPDB</a></p>
                <p><a href="#berita">Berita</a></p>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 SMK Muhammadiyah Mungkid. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');

        hamburger.addEventListener('click', function() {
            hamburger.classList.toggle('active');
            sidebar.classList.toggle('active');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', function(e) {
            if (!hamburger.contains(e.target) && !sidebar.contains(e.target)) {
                hamburger.classList.remove('active');
                sidebar.classList.remove('active');
            }
        });

        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }

                // Close mobile menu after clicking
                hamburger.classList.remove('active');
                sidebar.classList.remove('active');
            });
        });

        // Scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });

        // Add stagger animation to news cards
        const newsCards = document.querySelectorAll('.news-card');
        newsCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });

        // Dynamic text animation for hero
        const heroTitle = document.querySelector('.hero h1');
        const text = heroTitle.textContent;
        heroTitle.textContent = '';

        let i = 0;

        function typeWriter() {
            if (i < text.length) {
                heroTitle.textContent += text.charAt(i);
                i++;
                setTimeout(typeWriter, 100);
            }
        }

        setTimeout(typeWriter, 1000);
    </script>
</body>

</html>