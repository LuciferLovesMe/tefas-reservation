<!DOCTYPE html>
<html lang="id">

@include('layouts.head')
<style>
        /* Custom Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        html {
           scroll-behavior: smooth;
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

    <!-- Hero Section -->
    <section id="hero">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="hero-title">Teaching Factory</h1>
                    <p class="hero-subtitle my-4">
                        Menjembatani dunia akademik dengan industri melalui program pembelajaran berbasis produk (barang/jasa).
                    </p>
                    <a href="#" class="btn btn-primary me-2">Pelajari Lebih Lanjut</a>
                    <a href="#" class="btn btn-light">Produk Kami</a>
                </div>
                <div class="col-lg-6 text-center mt-5 mt-lg-0">
                    <img src="{{ asset('/assets/images/undraw_quiet-street_v45k.png') }}" alt="Teaching Factory Illustration" class="hero-image rounded-3">
                </div>
            </div>
        </div>
    </section>

    <!-- Why TEFA Section -->
    <section id="why-tefa" class="section bg-white">
        <div class="container text-center">
            <h2 class="section-title">Mengapa Teaching Factory (TEFA)</h2>
            <p class="section-subtitle">
                TEFA disusun untuk meningkatkan kualitas pembelajaran melalui integrasi dunia akademik dan industri, mempersiapkan peserta didik yang siap menjawab tantangan dunia kerja.
            </p>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="card-icon">
                                <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.2" d="M11.4352 35.8148C11.3131 35.9389 11.1675 36.0373 11.0069 36.1046C10.8464 36.1718 10.6741 36.2064 10.5 36.2064C10.326 36.2064 10.1537 36.1718 9.99311 36.1046C9.83257 36.0373 9.68699 35.9389 9.56487 35.8148L6.18518 32.4352C6.06117 32.313 5.96269 32.1675 5.89546 32.0069C5.82824 31.8464 5.79362 31.6741 5.79362 31.5C5.79362 31.3259 5.82824 31.1536 5.89546 30.9931C5.96269 30.8325 6.06117 30.687 6.18518 30.5648L23.625 13.125L28.875 18.375L11.4352 35.8148Z" fill="#FF6250"/>
                                    <path d="M35.4375 21V28.875" stroke="#FF6250" stroke-width="2.375" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M31.5 24.9375H39.375" stroke="#FF6250" stroke-width="2.375" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.7813 6.5625V13.125" stroke="#FF6250" stroke-width="2.375" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5 9.84375H17.0625" stroke="#FF6250" stroke-width="2.375" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M27.5625 30.1875V35.4375" stroke="#FF6250" stroke-width="2.375" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M24.9375 32.8125H30.1875" stroke="#FF6250" stroke-width="2.375" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M30.5856 6.17398L6.18876 30.5708C5.6762 31.0834 5.6762 31.9144 6.18876 32.427L9.58204 35.8203C10.0946 36.3328 10.9256 36.3328 11.4382 35.8203L35.835 11.4234C36.3476 10.9109 36.3476 10.0798 35.835 9.56727L32.4418 6.17398C31.9292 5.66142 31.0982 5.66142 30.5856 6.17398Z" stroke="#FF6250" stroke-width="2.375" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M23.625 13.125L28.875 18.375" stroke="#FF6250" stroke-width="2.375" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h5 class="card-title">Berbasis Praktik</h5>
                            <p class="card-text text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="card-icon">
                                <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.2" d="M34.125 6.5625H28.875C28.1501 6.5625 27.5625 7.15013 27.5625 7.875V13.125C27.5625 13.8499 28.1501 14.4375 28.875 14.4375H34.125C34.8499 14.4375 35.4375 13.8499 35.4375 13.125V7.875C35.4375 7.15013 34.8499 6.5625 34.125 6.5625Z" fill="#009379"/>
                                    <path opacity="0.2" d="M7.875 6.625H13.125C13.8154 6.625 14.375 7.18464 14.375 7.875V13.125C14.375 13.8154 13.8154 14.375 13.125 14.375H7.875C7.18464 14.375 6.625 13.8154 6.625 13.125V7.875C6.625 7.18464 7.18464 6.625 7.875 6.625Z" fill="#009379" stroke="#009379" stroke-width="0.125"/>
                                    <path opacity="0.2" d="M28.875 27.625H34.125C34.8154 27.625 35.375 28.1846 35.375 28.875V34.125C35.375 34.8154 34.8154 35.375 34.125 35.375H28.875C28.1846 35.375 27.625 34.8154 27.625 34.125V28.875C27.625 28.1846 28.1846 27.625 28.875 27.625Z" fill="#009379" stroke="#009379" stroke-width="0.125"/>
                                    <path opacity="0.2" d="M7.875 27.625H13.125C13.8154 27.625 14.375 28.1846 14.375 28.875V34.125C14.375 34.8154 13.8154 35.375 13.125 35.375H7.875C7.18464 35.375 6.625 34.8154 6.625 34.125V28.875C6.625 28.1846 7.18464 27.625 7.875 27.625Z" fill="#009379" stroke="#009379" stroke-width="0.125"/>
                                    <path d="M34.125 6.5625H28.875C28.1501 6.5625 27.5625 7.15013 27.5625 7.875V13.125C27.5625 13.8499 28.1501 14.4375 28.875 14.4375H34.125C34.8499 14.4375 35.4375 13.8499 35.4375 13.125V7.875C35.4375 7.15013 34.8499 6.5625 34.125 6.5625Z" stroke="#009379" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.125 6.5625H7.875C7.15013 6.5625 6.5625 7.15013 6.5625 7.875V13.125C6.5625 13.8499 7.15013 14.4375 7.875 14.4375H13.125C13.8499 14.4375 14.4375 13.8499 14.4375 13.125V7.875C14.4375 7.15013 13.8499 6.5625 13.125 6.5625Z" stroke="#009379" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M34.125 27.5625H28.875C28.1501 27.5625 27.5625 28.1501 27.5625 28.875V34.125C27.5625 34.8499 28.1501 35.4375 28.875 35.4375H34.125C34.8499 35.4375 35.4375 34.8499 35.4375 34.125V28.875C35.4375 28.1501 34.8499 27.5625 34.125 27.5625Z" stroke="#009379" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M13.125 27.5625H7.875C7.15013 27.5625 6.5625 28.1501 6.5625 28.875V34.125C6.5625 34.8499 7.15013 35.4375 7.875 35.4375H13.125C13.8499 35.4375 14.4375 34.8499 14.4375 34.125V28.875C14.4375 28.1501 13.8499 27.5625 13.125 27.5625Z" stroke="#009379" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M10.5 27.5625V14.4375" stroke="#009379" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M27.5625 31.5H14.4375" stroke="#009379" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M31.5 14.4375V27.5625" stroke="#009379" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M14.4375 10.5H27.5625" stroke="#009379" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <h5 class="card-title">Siap Kerja</h5>
                            <p class="card-text text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <div class="card-icon">
                                <svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.2" d="M16.8 32.55L9.45003 25.2L6.218 34.1086C6.12865 34.3424 6.10888 34.597 6.16108 34.8417C6.21328 35.0865 6.33523 35.3109 6.51219 35.4879C6.68914 35.6648 6.91355 35.7868 7.1583 35.839C7.40305 35.8912 7.65768 35.8714 7.89144 35.782L16.8 32.55Z" fill="#F8D57E"/>
                                    <path opacity="0.2" d="M16.0101 9.03851C16.2157 8.99339 16.4293 9.00054 16.6312 9.06C16.8333 9.11957 17.0171 9.22975 17.1654 9.37933H17.1664L32.6205 24.8344C32.7701 24.9827 32.8802 25.1665 32.9398 25.3686C32.9993 25.5705 33.0064 25.7841 32.9613 25.9897C32.9161 26.1955 32.8198 26.3868 32.681 26.5453C32.5422 26.7038 32.3654 26.825 32.1674 26.8969L25.4779 29.3276L12.6713 16.5209L15.1029 9.83246C15.1749 9.63445 15.296 9.45759 15.4545 9.31879C15.613 9.17998 15.8044 9.08372 16.0101 9.03851Z" fill="#F8D57E" stroke="#F8D57E" stroke-width="0.125"/>
                                    <path d="M6.218 34.1086L15.0446 9.81092C15.1201 9.603 15.247 9.41756 15.4134 9.27181C15.5799 9.12607 15.7804 9.02476 15.9965 8.97729C16.2126 8.92982 16.4371 8.93773 16.6493 9.0003C16.8615 9.06286 17.0544 9.17804 17.2102 9.33514L32.6649 24.7898C32.822 24.9456 32.9372 25.1385 32.9997 25.3507C33.0623 25.5629 33.0702 25.7874 33.0227 26.0035C32.9753 26.2196 32.8739 26.4201 32.7282 26.5866C32.5825 26.753 32.397 26.8799 32.1891 26.9554L7.89144 35.782C7.65768 35.8714 7.40305 35.8911 7.1583 35.8389C6.91355 35.7867 6.68914 35.6648 6.51219 35.4878C6.33523 35.3109 6.21328 35.0865 6.16108 34.8417C6.10888 34.597 6.12865 34.3423 6.218 34.1086V34.1086Z" stroke="#F8D57E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M27.5625 11.8125C27.5625 11.8125 27.5625 7.875 31.5 7.875C35.4375 7.875 35.4375 3.9375 35.4375 3.9375" stroke="#F8D57E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.8 32.55L9.44995 25.2" stroke="#F8D57E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M23.625 2.625V6.5625" stroke="#F8D57E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M35.4375 18.375L38.0625 21" stroke="#F8D57E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M35.4375 13.125L39.375 11.8125" stroke="#F8D57E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12.6 16.5375L25.4625 29.4" stroke="#F8D57E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>

                            <h5 class="card-title">Inovasi & Riset</h5>
                            <p class="card-text text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- CTA Visit Section -->
    <section id="cta-visit" class="section">
        <div class="decorator-1"></div>
        <div class="decorator-2"></div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 text-center">
                     <img src="{{ asset('/assets/images/Visuals.png') }}" alt="Visuals" class="img-fluid">
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <h2 class="section-title">Tertarik Mengunjungi Kami?</h2>
                    <p class="text-muted mb-4">Segera klik tombol di bawah ini.</p>
                    <a href="#" class="btn btn-primary">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="section bg-white">
        <div class="container text-center">
            <h2 class="section-title">Apa Saja di TEFA?</h2>
            <p class="section-subtitle">Terdapat beberapa unit Teaching Factory di sekolah kami, yaitu:</p>
            <div class="row g-4 justify-content-center">
                @forelse ($tefaData as $key => $tefa)
                <div class="col-lg-4 col-md-6">
                    <div class="card">
                        @if (count($tefa->kegiatanTefa) > 0)
                            <img src="{{ asset('uploads/tefa/kegiatan/' . $tefa->id . '/' . $tefa->kegiatanTefa[0]->detail) }}" alt="">
                        @endif
                        <div class="card-body text-start">
                            <h5 class="card-title mb-3">{{ $tefa->nama }}</h5>
                            <p class="card-text">{{ $tefa->deskripsi }}</p>
                            <a href="{{ route('landing.show', $tefa->id) }}" class="btn btn-outline-primary mt-4">Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
                @empty
                    <p>Tidak ada data TEFA yang tersedia.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA Banner Section -->
    <section class="section">
        <div class="container">
            <div id="cta-banner">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <h2 class="section-title">Segera kunjungi TEFA!</h2>
                        <p class="">Tingkatkan Keterampilan, Asah Kemampuan, dan Menjadi Percaya Diri dengan Pengalaman Nyata.</p>
                        <a href="#" class="btn btn-primary">Hubungi Kami</a>
                    </div>
                    <div class="col-lg-5 text-center mt-4 mt-lg-0">
                         <img src="{{ asset('/assets/images/undraw_adventure-map_3e4p.png') }}" alt="Adventure Map" class="img-fluid" style="max-width: 250px;">
                    </div>
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

