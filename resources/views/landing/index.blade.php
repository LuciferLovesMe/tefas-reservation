<!DOCTYPE html>
<html lang="id">

@include('layouts.head')
<body class="bg-white text-dark">

    <!-- Container Utama -->
    <div class="container">

        <!-- 1. Header / Navigasi -->
        <header class="d-flex justify-content-between align-items-center py-4 border-bottom">
            <div class="fs-4 fw-bold border  border-secondary px-3 py-1 rounded">Logo</div>
            <nav class="d-none d-md-flex align-items-center">
                <a href="#" class="nav-link me-4">Contact</a>
                <a href="#" class="nav-link me-4">New & Events</a>
                <a href="#" class="btn btn-outline-secondary">Get Started</a>
            </nav>
            <button class="btn btn-outline-secondary d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileNav" aria-controls="mobileNav" aria-expanded="false" aria-label="Toggle navigation">
                <!-- Hamburger Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
        </header>

        <!-- 2. Hero Section -->
        <main class="section-padding">
            <div class="row align-items-center g-5">
                <!-- Kolom Teks -->
                <div class="col-md-6 text-center text-md-start">
                    <h1 class="display-4 fw-bold lh-1 mb-3">Teaching Factory</h1>
                    <p class="fs-5 text-muted mb-4">Menjembatani dunia akademik dengan industri melalui program pembelajaran berbasis produk dan jasa.</p>
                    <div class="d-flex justify-content-center justify-content-md-start gap-2">
                        <button class="btn btn-dark btn-lg px-4">Pelajari Lebih Lanjut</button>
                        <button class="btn btn-outline-secondary btn-lg px-4">Produk Kami</button>
                    </div>
                </div>
                <!-- Kolom Gambar Placeholder -->
                <div class="col-md-6">
                    <div class="placeholder" style="height: 350px;">
                        [Ilustrasi Hero]
                    </div>
                </div>
            </div>
        </main>

        <!-- 3. Mengapa TEFA Section -->
        <section class="section-padding text-center">
            <h2 class="display-5 fw-bold mb-3">Mengapa Teaching Factory (TEFA)</h2>
            <p class="fs-5 text-muted col-lg-8 mx-auto mb-5">TEFA disusun dengan kurikulum yang disesuaikan dengan kebutuhan dunia industri dan menjadi tempat pembelajaran yang sesuai dengan standar industri.</p>
            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card h-100 p-4 border-light shadow-sm">
                        <div class="placeholder mx-auto mb-4 rounded-circle" style="width: 64px; height: 64px;">[Ikon]</div>
                        <h3 class="fs-4 fw-bold mb-2">Berbasis Praktik</h3>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros.</p>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-md-4">
                     <div class="card h-100 p-4 border-light shadow-sm">
                        <div class="placeholder mx-auto mb-4 rounded-circle" style="width: 64px; height: 64px;">[Ikon]</div>
                        <h3 class="fs-4 fw-bold mb-2">Siap Kerja</h3>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros.</p>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="col-md-4">
                     <div class="card h-100 p-4 border-light shadow-sm">
                        <div class="placeholder mx-auto mb-4 rounded-circle" style="width: 64px; height: 64px;">[Ikon]</div>
                        <h3 class="fs-4 fw-bold mb-2">Inovasi & Riset</h3>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Tertarik Mengunjungi Kami? Section -->
        <section class="section-padding">
            <div class="row align-items-center g-5">
                <!-- Kolom Gambar Placeholder -->
                <div class="col-md-6">
                    <div class="placeholder" style="height: 400px;">
                        [Ilustrasi Aplikasi Mobile]
                    </div>
                </div>
                <!-- Kolom Teks -->
                <div class="col-md-6 text-center text-md-start">
                    <h2 class="display-5 fw-bold mb-3">Tertarik Mengunjungi Kami?</h2>
                    <p class="fs-5 text-muted mb-4">Segera klik tombol di bawah ini.</p>
                    <button class="btn btn-dark btn-lg px-4">Hubungi</button>
                </div>
            </div>
        </section>

        <!-- 5. Apa Saja di TEFA? Section -->
        <section class="section-padding text-center">
            <h2 class="display-5 fw-bold mb-3">Apa Saja di TEFA?</h2>
            <p class="fs-5 text-muted col-lg-8 mx-auto mb-5">Berikut beberapa unit usaha yang ada di TEFA.</p>
            <div class="row g-4 text-start">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card h-100 p-4">
                        <h3 class="fs-4 fw-bold mb-3">Kebun Inovasi</h3>
                        <ul class="list-unstyled text-muted mb-4">
                            <li class="mb-2">✔ Lorem ipsum dolor sit amet</li>
                            <li class="mb-2">✔ Consectetur adipiscing elit</li>
                            <li class="mb-2">✔ Suspendisse varius enim</li>
                            <li>✔ In eros elementum tristique</li>
                        </ul>
                        <button class="btn btn-outline-secondary mt-auto">Telusuri</button>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="card h-100 p-4">
                        <h3 class="fs-4 fw-bold mb-3">Smart Greenhouse</h3>
                        <ul class="list-unstyled text-muted mb-4">
                            <li class="mb-2">✔ Lorem ipsum dolor sit amet</li>
                            <li class="mb-2">✔ Consectetur adipiscing elit</li>
                            <li class="mb-2">✔ Suspendisse varius enim</li>
                            <li>✔ In eros elementum tristique</li>
                        </ul>
                        <button class="btn btn-outline-secondary mt-auto">Telusuri</button>
                    </div>
                </div>
                <!-- Card 3 (Featured) -->
                <div class="col-md-4">
                    <div class="card h-100 p-4 bg-dark text-white">
                        <h3 class="fs-4 fw-bold mb-3">Pabrik Roti</h3>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2">✔ Lorem ipsum dolor sit amet</li>
                            <li class="mb-2">✔ Consectetur adipiscing elit</li>
                            <li class="mb-2">✔ Suspendisse varius enim</li>
                            <li>✔ In eros elementum tristique</li>
                        </ul>
                        <button class="btn btn-light mt-auto">Telusuri</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. Segera Kunjungi TEFA! Banner -->
        <section class="my-5">
            <div class="bg-light rounded-3 p-4 p-md-5">
                 <div class="row align-items-center g-4">
                    <!-- Kolom Teks -->
                    <div class="col-md-7 text-center text-md-start">
                        <h2 class="display-6 fw-bold mb-3">Segera kunjungi TEFA!</h2>
                        <p class="text-muted mb-4">Lorem ipsum dolor sit amet, Asah Kemampuanmu dan Menjadi Percaya Diri dengan Pengalaman Nyata.</p>
                        <button class="btn btn-dark btn-lg">Hubungi Kami</button>
                    </div>
                    <!-- Kolom Gambar Placeholder -->
                    <div class="col-md-5">
                        <div class="placeholder" style="height: 250px;">
                            [Ilustrasi Banner]
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 7. Hubungi Kami Section -->
        <section class="section-padding text-center">
            <h2 class="display-5 fw-bold mb-3">Hubungi Kami!</h2>
            <p class="fs-5 text-muted col-lg-8 mx-auto mb-5">Our goal is to build a strong relationship with our partners in the textile and friendly garment.</p>
            <div class="card card-body col-lg-8 mx-auto text-start">
                <p class="fw-bold mb-2">Kontak Info:</p>
                <p class="text-muted mb-2">[Alamat Perusahaan Disini]</p>
                <p class="text-muted mb-2">Email: [email@contoh.com]</p>
                <p class="text-muted">Telepon: [+62 123 4567 890]</p>
                <div class="d-flex gap-3 mt-4">
                    <div class="placeholder rounded-circle" style="width: 40px; height: 40px;">[S]</div>
                    <div class="placeholder rounded-circle" style="width: 40px; height: 40px;">[S]</div>
                    <div class="placeholder rounded-circle" style="width: 40px; height: 40px;">[S]</div>
                </div>
            </div>
        </section>

    </div>

    <!-- 8. Footer -->
    <footer class="bg-light border-top mt-5">
        <div class="container d-flex justify-content-between align-items-center py-3">
            <p class="text-muted mb-0 small">&copy; 2025 Teaching Factory Page. All rights reserved.</p>
            <div class="d-flex gap-3">
                <div class="placeholder rounded-circle" style="width: 32px; height: 32px;">[S]</div>
                <div class="placeholder rounded-circle" style="width: 32px; height: 32px;">[S]</div>
                <div class="placeholder rounded-circle" style="width: 32px; height: 32px;">[S]</div>
            </div>
        </div>
    </footer>
</body>
</html>

