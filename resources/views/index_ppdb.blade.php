@extends('components.layouts.page')
@section('content')
    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>{{ $title }}</h1>
            <p class="hero-subtitle">{{ $pengaturan->where('key', 'nama_sekolah')->value('value') }} -
                {{ $pengaturan->where('key', 'slogan_sekolah')->value('value') }}</p>

            <div class="cta-buttons">
                <a href="/pendaftaran" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </a>
                <a href="#tentang" class="btn btn-secondary">
                    <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section class="news" id="berita">
        <div class="container">
            <h2 class="section-title animate-on-scroll">Informasi</h2>

            <div class="news-grid">
                @forelse ($posts as $post)
                    <div class="news-card animate-on-scroll">
                        <div class="news-date">
                            <i class="fas fa-calendar"></i> {{ $post->created_at->format('d M Y') }}
                        </div>
                        <h3>{{ $post->title }}</h3>
                        <p>{!! Str::limit($post->content, 100) !!}</p>
                        <a href="post/{{ $post->id }}" class="read-more">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @empty
                    <p class="animate-on-scroll">Belum ada berita terbaru.</p>
                @endforelse
            </div>
            <div class="container" style="text-align: center; margin-top:50px">
                <a href="/informasi" class="btn btn-primary">Tampilkan semua</a>
            </div>
        </div>
    </section>
    <!-- Jurusan Section -->
    <section class="jurusan" id="jurusan">
        <div class="container">
            <h2 class="section-title animate-on-scroll">Program Keahlian</h2>
            <p class="section-subtitle animate-on-scroll"
                style="text-align: center; color: #64748b; margin-bottom: 3rem; font-size: 1.1rem;">
                Pilih program keahlian yang sesuai dengan minat dan bakat Anda
            </p>

            <div class="jurusan-grid">
                <!-- Teknik Instalasi Tenaga Listrik -->
                <div class="jurusan-card animate-on-scroll">
                    <div class="jurusan-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Teknik Instalasi Tenaga Listrik</h3>
                    <p>Mempelajari teknik instalasi, perawatan, dan perbaikan sistem tenaga listrik untuk berbagai
                        kebutuhan.</p>
                    <a href="/jurusan/teknik-instalasi-tenaga-listrik" class="btn-jurusan">
                        <span>Detail Jurusan</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Teknik Pemesinan -->
                <div class="jurusan-card animate-on-scroll">
                    <div class="jurusan-icon">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3>Teknik Pemesinan</h3>
                    <p>Menguasai teknik pembuatan komponen mesin dengan menggunakan mesin bubut, frais, dan peralatan
                        lainnya.</p>
                    <a href="/jurusan/teknik-pemesinan" class="btn-jurusan">
                        <span>Detail Jurusan</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Teknik Kendaraan Ringan -->
                <div class="jurusan-card animate-on-scroll">
                    <div class="jurusan-icon">
                        <i class="fas fa-car"></i>
                    </div>
                    <h3>Teknik Kendaraan Ringan</h3>
                    <p>Memahami sistem kerja, perawatan, dan perbaikan kendaraan ringan seperti mobil dan kendaraan
                        komersial.</p>
                    <a href="/jurusan/teknik-kendaraan-ringan" class="btn-jurusan">
                        <span>Detail Jurusan</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Teknik Sepeda Motor -->
                <div class="jurusan-card animate-on-scroll">
                    <div class="jurusan-icon">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <h3>Teknik Sepeda Motor</h3>
                    <p>Mempelajari teknik perawatan, perbaikan, dan modifikasi sepeda motor dengan teknologi terkini.</p>
                    <a href="/jurusan/teknik-sepeda-motor" class="btn-jurusan">
                        <span>Detail Jurusan</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Teknik Komputer dan Jaringan -->
                <div class="jurusan-card animate-on-scroll">
                    <div class="jurusan-icon">
                        <i class="fas fa-network-wired"></i>
                    </div>
                    <h3>Teknik Komputer dan Jaringan</h3>
                    <p>Menguasai instalasi, konfigurasi, dan pemeliharaan jaringan komputer serta perangkat keras.</p>
                    <a href="/jurusan/teknik-komputer-dan-jaringan" class="btn-jurusan">
                        <span>Detail Jurusan</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Kuliner -->
                <div class="jurusan-card animate-on-scroll">
                    <div class="jurusan-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3>Kuliner</h3>
                    <p>Mengembangkan keterampilan dalam bidang tata boga, pengolahan makanan, dan manajemen dapur.</p>
                    <a href="/jurusan/kuliner" class="btn-jurusan">
                        <span>Detail Jurusan</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Perhotelan -->
                <div class="jurusan-card animate-on-scroll">
                    <div class="jurusan-icon">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <h3>Perhotelan</h3>
                    <p>Mempelajari manajemen operasional hotel, pelayanan tamu, dan industri pariwisata.</p>
                    <a href="/jurusan/perhotelan" class="btn-jurusan">
                        <span>Detail Jurusan</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Timeline Section -->
    <section class="timeline-section" id="timeline">
        <div class="container">
            <h2 class="section-title animate-on-scroll">Timeline Pendaftaran</h2>
            <p class="section-subtitle animate-on-scroll"
                style="text-align: center; color: #64748b; margin-bottom: 3rem; font-size: 1.1rem;">
                Ikuti jadwal pendaftaran untuk mempersiapkan diri dengan baik
            </p>

            <div class="timeline-container">
                <!-- Timeline Line -->
                <div class="timeline-line"></div>

                <!-- Gelombang Inden -->
                <div class="timeline-item animate-on-scroll">
                    <div class="timeline-marker">
                        <div class="marker-circle"></div>
                        <div class="marker-pulse"></div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-date">September - 30 November 2025</div>
                        <h3 class="timeline-title">Gelombang Inden</h3>
                        <div class="timeline-badge early">Early Bird</div>
                        <p class="timeline-description">
                            Dapatkan keuntungan khusus dengan mendaftar lebih awal.
                            Kuota terbatas untuk gelombang ini.
                        </p>
                        <div class="timeline-status active">Sedang Berlangsung</div>
                    </div>
                </div>

                <!-- Gelombang 1 -->
                <div class="timeline-item animate-on-scroll">
                    <div class="timeline-marker">
                        <div class="marker-circle"></div>
                        <div class="marker-pulse"></div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-date">1 Desember 2025 - 31 Januari 2026</div>
                        <h3 class="timeline-title">Gelombang 1</h3>
                        <div class="timeline-badge regular">Regular</div>
                        <p class="timeline-description">
                            Pendaftaran gelombang pertama dengan kuota lebih banyak
                            dan fasilitas lengkap.
                        </p>
                        <div class="timeline-status upcoming">Akan Datang</div>
                    </div>
                </div>

                <!-- Gelombang 2 -->
                <div class="timeline-item animate-on-scroll">
                    <div class="timeline-marker">
                        <div class="marker-circle"></div>
                        <div class="marker-pulse"></div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-date">1 Februari - 31 Maret 2026</div>
                        <h3 class="timeline-title">Gelombang 2</h3>
                        <div class="timeline-badge regular">Regular</div>
                        <p class="timeline-description">
                            Kesempatan kedua untuk mendaftar dengan pilihan jurusan
                            yang masih tersedia.
                        </p>
                        <div class="timeline-status upcoming">Akan Datang</div>
                    </div>
                </div>

                <!-- Gelombang 3 -->
                <div class="timeline-item animate-on-scroll">
                    <div class="timeline-marker">
                        <div class="marker-circle"></div>
                        <div class="marker-pulse"></div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-date">1 April - 31 Mei 2026</div>
                        <h3 class="timeline-title">Gelombang 3</h3>
                        <div class="timeline-badge regular">Regular</div>
                        <p class="timeline-description">
                            Gelombang terakhir reguler dengan kuota terbatas.
                            Segera daftar sebelum penutupan.
                        </p>
                        <div class="timeline-status upcoming">Akan Datang</div>
                    </div>
                </div>

                <!-- Gelombang Khusus -->
                <div class="timeline-item animate-on-scroll">
                    <div class="timeline-marker">
                        <div class="marker-circle"></div>
                        <div class="marker-pulse"></div>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-date">1 Juni - 31 Juli 2026</div>
                        <h3 class="timeline-title">Gelombang Khusus</h3>
                        <div class="timeline-badge special">Khusus</div>
                        <p class="timeline-description">
                            Pendaftaran khusus untuk kondisi tertentu dengan persyaratan
                            tambahan. Kuota sangat terbatas.
                        </p>
                        <div class="timeline-status upcoming">Akan Datang</div>
                    </div>
                </div>
            </div>

            <div class="timeline-cta animate-on-scroll">
                <p>Jangan lewatkan kesempatan emas untuk bergabung bersama kami!</p>
                <a href="/pendaftaran" class="btn btn-primary">
                    <i class="fas fa-calendar-check"></i> Daftar Sekarang
                </a>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        // Timeline animation
        const timelineItems = document.querySelectorAll('.timeline-item');

        const timelineObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    // Stagger animation
                    const index = Array.from(timelineItems).indexOf(entry.target);
                    entry.target.style.transitionDelay = `${index * 0.2}s`;
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        timelineItems.forEach(item => {
            timelineObserver.observe(item);
        });

        // Update status based on current date (optional functionality)
        function updateTimelineStatus() {
            const currentDate = new Date();
            const timelineDates = [{
                    start: new Date('2025-09-01'),
                    end: new Date('2025-11-30')
                },
                {
                    start: new Date('2025-12-01'),
                    end: new Date('2026-01-31')
                },
                {
                    start: new Date('2026-02-01'),
                    end: new Date('2026-03-31')
                },
                {
                    start: new Date('2026-04-01'),
                    end: new Date('2026-05-31')
                },
                {
                    start: new Date('2026-06-01'),
                    end: new Date('2026-07-31')
                }
            ];

            timelineItems.forEach((item, index) => {
                const statusElement = item.querySelector('.timeline-status');
                if (currentDate >= timelineDates[index].start && currentDate <= timelineDates[index].end) {
                    statusElement.textContent = 'Sedang Berlangsung';
                    statusElement.className = 'timeline-status active';
                } else if (currentDate < timelineDates[index].start) {
                    statusElement.textContent = 'Akan Datang';
                    statusElement.className = 'timeline-status upcoming';
                } else {
                    statusElement.textContent = 'Telah Berakhir';
                    statusElement.className = 'timeline-status completed';
                }
            });
        }

        // Call the function to update status
        updateTimelineStatus();
    </script>
@endsection
