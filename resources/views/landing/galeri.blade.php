<!DOCTYPE html>
<html lang="id">

@include('layouts.head')
<style>
        /* Custom Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        /* Custom Colors */
        :root {
            --brand-teal: #0d9488;
            --brand-teal-dark: #0f766e;
            --brand-pink: #f2bfaf;
            --brand-salmon: #fecaca;
            --text-dark: #333;
            --text-muted: #6c757d;
        }

        .navbar {
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }

        .nav-link {
            color: var(--text-dark);
            font-weight: 500;
        }
        
        .nav-link:hover {
            color: var(--brand-teal);
        }

        .btn-primary {
            background-color: var(--brand-teal);
            border-color: var(--brand-teal);
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
        }

        .btn-primary:hover {
            background-color: var(--brand-teal-dark);
            border-color: var(--brand-teal-dark);
        }
        
        .btn-outline-primary {
            color: var(--brand-teal);
            border-color: var(--brand-teal);
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--brand-teal);
            color: #fff;
        }
        
        .btn-light {
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }


        /* Hero Section */
        #hero {
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }
        
        #hero::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -150px;
            width: 400px;
            height: 400px;
            background-image: url('Ellipse 5.png');
            background-size: contain;
            background-repeat: no-repeat;
            z-index: 0;
        }

        .hero-title {
            font-weight: 700;
            font-size: 3.5rem;
            color: var(--text-dark);
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: var(--text-muted);
            max-width: 500px;
        }

        .hero-image {
            max-width: 100%;
            height: auto;
        }

        /* Sections */
        .section {
            padding: 5rem 0;
        }

        .section-title {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--text-muted);
            max-width: 700px;
            margin: 0 auto 3rem auto;
        }

        .card {
            border: 1px solid #e9ecef;
            border-radius: 1rem;
            padding: 2rem;
            height: 100%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }
        
        .card-icon {
            font-size: 2.5rem;
            color: var(--brand-salmon);
            margin-bottom: 1rem;
        }
        
        .card-title {
            font-weight: 600;
        }

        /* Why TEFA section */
        #why-tefa .card {
             background-color: #fff;
        }
        
        /* What's in TEFA */
        #features .card-highlight {
            background-color: var(--brand-teal);
            color: #fff;
        }

        #features .card-highlight .card-title,
        #features .card-highlight .card-text,
        #features .card-highlight .list-group-item {
            color: #fff;
        }
        
        #features .card-highlight .btn {
            background-color: #fff;
            color: var(--brand-teal);
        }
        
        #features .list-group-item {
            border: none;
            padding-left: 0;
            background-color: transparent;
        }
        
        #features .bi-check-lg {
            color: var(--brand-teal);
        }
        
        #features .card-highlight .bi-check-lg {
            color: #fff;
        }

        /* CTA sections */
        #cta-visit {
            position: relative;
        }
        #cta-visit .img-fluid{
            max-width: 80%;
        }
        
         #cta-visit .decorator-1 {
            position: absolute;
            top: -50px;
            left: -50px;
            width: 250px;
            height: 250px;
            background-image: url('Ellipse 5.png');
            background-size: contain;
            background-repeat: no-repeat;
            opacity: 0.5;
            z-index: -1;
        }
        
        #cta-visit .decorator-2 {
            position: absolute;
            bottom: -30px;
            right: 20px;
            width: 150px;
            height: 150px;
            background-image: url('Ellipse 4.png');
            background-size: contain;
            background-repeat: no-repeat;
            z-index: -1;
        }

        #cta-banner {
            background-color: var(--brand-pink);
            border-radius: 1.5rem;
            padding: 4rem;
        }

        /* Footer */
        footer {
            padding: 3rem 0;
            background-color: #fff;
        }
        
        .social-icons a {
            color: var(--text-muted);
            font-size: 1.5rem;
            margin-left: 1rem;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: var(--brand-teal);
        }

        .product-card img {
            width: 100%;
            height: auto;
            aspect-ratio: 1 / 1;
            object-fit: cover;
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-auto-rows: minmax(200px, auto);
            gap: 1.5rem;
        }

        .gallery-item {
            overflow: hidden;
            border-radius: 1rem;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item-large {
            grid-column: 1 / 3;
            grid-row: 1 / 3;
        }

        .gallery-link {
            display: inline-block;
            margin-top: 2rem;
            font-weight: 500;
            color: var(--brand-teal);
            text-decoration: none;
        }
        .gallery-link:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-buildings-fill text-primary"></i> TEFA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="#hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#why-tefa">Alasan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Tefa</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="btn btn-primary" href="{{ route('login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="gallery" class="section">
        <div class="container text-center">
            <!-- Gallery Section -->
            <div class="mb-5 pt-5">
                 <h2 class="section-title">Galeri Kegiatan</h2>
                 <p class="section-subtitle">Liputan kegiatan mengajar kami.</p>
                 <div class="gallery-grid">
                    @foreach($tefa->kegiatanTefa as $key => $image)
                        <div class="gallery-item">
                            <img src="{{ asset('uploads/tefa/kegiatan/' . $tefa->id . '/' . $image->detail) }}" alt="Galeri Kegiatan 2">
                        </div>
                    @endforeach
                 </div>
            </div>
        </div>
    </section>
    
    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                     <h2 class="section-title">Hubungi Kami!</h2>
                     <p class="section-subtitle">
                         Our quotes are built to be tailored to your needs. Fill out the form to get a quote for our services. We look forward to hearing from you.
                     </p>
                     <div class="mt-4">
                         <p class="mb-1"><strong><i class="bi bi-envelope-fill text-primary me-2"></i>hello@tefa.com</strong></p>
                         <p><strong><i class="bi bi-telephone-fill text-primary me-2"></i>+62 123 4567 890</strong></p>
                     </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="text-muted mb-0">© 2025 TEFA Landing Page. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <div class="social-icons">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</html>

