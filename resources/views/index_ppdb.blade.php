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
                <a href="#mengapa-kami" class="btn btn-secondary">
                    <i class="fas fa-info-circle"></i> Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>
    <!-- Why Choose Us Section -->
    <section class="news" id="mengapa-kami">
        <div class="container">
            <h2 class="section-title animate-on-scroll">Mengapa Memilih Kami?</h2>

            <!-- Highlight Quote -->
            <div class="news-card animate-on-scroll"
                style="text-align: center; background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%); border-left: 4px solid #4CAF50;">
                {{-- <div class="news-date">
                    <i class="fas fa-star"></i> Keunggulan Kami
                </div> --}}
                <h3 style="color: #2E7D32; font-style: italic; font-size: 1.5rem;">
                    "Sebelum lulus-pun kamu sudah dipesan oleh industri lho.."
                </h3>
            </div>

            <div class="news-grid">
                <!-- Point 1 -->
                <div class="news-card animate-on-scroll" style="margin-top: 30px">
                    <div class="news-date">
                        <i class="fas fa-award"></i> Sekolah Unggulan
                    </div>
                    <h3>Ditunjuk Sebagai Sekolah Unggul</h3>
                    <p>
                        Merupakan sekolah unggulan yang ditetapkan oleh Pimpinan Pusat Muhammadiyah,
                        menjamin kualitas pendidikan yang terstandar dan terpercaya. Di samping itu SMK Muhammadiyah Mungkid
                        Sejak tahun 2021 telah ditunjuk sebagai Sekolah Pusat Keunggulan oleh Kemdikbud
                    </p>
                </div>

                <!-- Point 2 -->
                <div class="news-card animate-on-scroll">
                    <div class="news-date">
                        <i class="fas fa-building"></i> Fasilitas Lengkap
                    </div>
                    <h3>Infrastruktur Modern</h3>
                    <p>
                        Memiliki fasilitas lengkap dan modern yang mendukung proses belajar mengajar
                        serta praktik keterampilan siswa secara optimal.
                    </p>
                </div>

                <!-- Point 3 -->
                <div class="news-card animate-on-scroll">
                    <div class="news-date">
                        <i class="fas fa-briefcase"></i> Kerjasama Industri
                    </div>
                    <h3>Jaringan Luas</h3>
                    <p>
                        Banyak pilihan jurusan dengan berbagai industri yang telah bekerja sama,
                        membuka peluang magang dan kerja yang lebih luas.
                    </p>
                </div>

                <!-- Point 4 -->
                <div class="news-card animate-on-scroll">
                    <div class="news-date">
                        <i class="fas fa-graduation-cap"></i> Pembelajaran Praktis
                    </div>
                    <h3>Orientasi Kerja</h3>
                    <p>
                        Pembelajaran berorientasi kerja dengan kurikulum yang disesuaikan
                        kebutuhan industri masa kini.
                    </p>
                </div>

                <!-- Point 5 -->
                <div class="news-card animate-on-scroll">
                    <div class="news-date">
                        <i class="fas fa-industry"></i> Penyalur Tenaga Kerja
                    </div>
                    <h3>Terpercaya di Magelang</h3>
                    <p>
                        Merupakan salah satu penyalur tenaga kerja di Kabupaten Magelang
                        ke berbagai industri besar ternama.
                    </p>
                </div>

                <!-- Point 6 -->
                <div class="news-card animate-on-scroll">
                    <div class="news-date">
                        <i class="fas fa-globe-asia"></i> Alumni Internasional
                    </div>
                    <h3>Go International</h3>
                    <p>
                        Alumni tersebar sampai ke Malaysia, Jepang, Amerika, dan Jerman,
                        membuktikan kualitas lulusan yang diakui secara global.
                    </p>
                </div>
            </div>

            <div class="container" style="text-align: center; margin-top:50px">
                <a href="/pendaftaran" class="btn btn-primary">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </a>
            </div>
        </div>
    </section>
    <!-- Jurusan Section -->
    <section class="jurusan" id="jurusan">
        <div class="container">
            <h2 class="section-title animate-on-scroll">Pilihan Jurusan</h2>
            <p class="section-subtitle animate-on-scroll"
                style="text-align: center; color: #64748b; margin-bottom: 3rem; font-size: 1.1rem;">
                Pilih jurusan yang sesuai dengan minat dan bakat kamu
            </p>

            <div class="jurusan-grid">
                @forelse ($jurusans as $jurusan)
                    <div class="jurusan-card animate-on-scroll">
                        <div class="jurusan-icon">
                            <i class="{{$jurusan->icon}}"></i>
                        </div>
                        <h3>{{$jurusan->nama_jurusan}}</h3>
                        <p>{{$jurusan->deskripsi_singkat}}</p>
                        <a href="/jurusan/{{$jurusan->kode_jurusan}}" class="btn-jurusan">
                            <span>Detail Jurusan</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @empty
                    <p class="animate-on-scroll">Belum ada jurusan tersedia.</p>
                @endforelse
                
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
                @forelse ($gelombangs as $gelombang)
                    <div class="timeline-item animate-on-scroll">
                        <div class="timeline-marker">
                            <div class="marker-circle"></div>
                            <div class="marker-pulse"></div>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-date">{{ $gelombang->tanggal_mulai }} s/d
                                {{ $gelombang->tanggal_selesai }}</div>
                            <h3 class="timeline-title">{{ $gelombang->nama_gelombang }}</h3>

                            <p class="timeline-description">
                                {!! $gelombang->keterangan !!}
                            </p>
                            <div
                                class="timeline-status {{ \Carbon\Carbon::now() > $gelombang->tanggal_mulai && \Carbon\Carbon::now() < $gelombang->tanggal_selesai ? 'active' : 'upcoming' }}">
                                {{ \Carbon\Carbon::now() > $gelombang->tanggal_mulai && \Carbon\Carbon::now() < $gelombang->tanggal_selesai ? 'Sedang Berlangsung' : 'Akan Datang' }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="timeline-content">
                        <p class="timeline-description">
                            Tidak ada jadwal pendaftaran saat ini.
                        </p>
                    </div>
                @endforelse

                <div class="timeline-cta animate-on-scroll">
                    <p>Jangan lewatkan kesempatan emas untuk bergabung bersama kami!</p>
                    <a href="/pendaftaran" class="btn btn-primary">
                        Daftar Sekarang
                    </a>
                </div>
            </div>
    </section>
    <!-- Beasiswa Section -->
    <section class="news" id="beasiswa">
        <div class="container">
            <h2 class="section-title animate-on-scroll">Program Beasiswa</h2>
            <p class="section-subtitle animate-on-scroll"
                style="text-align: center; color: #64748b; margin-bottom: 3rem; font-size: 1.1rem;">
                Berbagai kesempatan beasiswa untuk mendukung pendidikan kamu
            </p>

            <div class="news-grid">
                <!-- Beasiswa Prestasi -->
                <div class="news-card animate-on-scroll">
                    <div class="news-date">
                        <i class="fas fa-trophy"></i> Beasiswa Prestasi
                    </div>
                    <h3>Potongan hingga 100%</h3>
                    <p>
                        <strong>Persyaratan:</strong><br>
                        • Follower sosial media > 500K: 50%<br>
                        • Juara 1 Kabupaten: 50%<br>
                        • Juara Nasional: 100%<br>
                        • Tahfidz > 5 juz: 100%<br>
                        • Tahfidz 1-5 juz: 50%<br><br>

                        <strong>Dokumen:</strong> Sertifikat prestasi/tahfidz<br>
                        <strong>Kuota:</strong> Terbuka<br>
                        <strong>Jurusan:</strong> Semua jurusan
                    </p>
                    <a href="#daftar-beasiswa" class="read-more">
                        Daftar Beasiswa <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Beasiswa AUM -->
                <div class="news-card animate-on-scroll">
                    <div class="news-date">
                        <i class="fas fa-handshake"></i> Beasiswa AUM
                    </div>
                    <h3>Potongan 50%</h3>
                    <p>
                        <strong>Persyaratan:</strong><br>
                        • Surat Rekomendasi PRM/PCM/PDM<br>
                        • SK bekerja di AUM tahun berjalan<br>
                        • Aktif di persyarikatan<br><br>

                        <strong>Dokumen:</strong> Surat rekomendasi dan SK<br>
                        <strong>Kuota:</strong> 40 murid baru<br>
                        <strong>Jurusan:</strong> Semua jurusan
                    </p>
                    <a href="#daftar-beasiswa" class="read-more">
                        Daftar Beasiswa <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Beasiswa Afirmasi -->
                <div class="news-card animate-on-scroll">
                    <div class="news-date">
                        <i class="fas fa-heart"></i> Beasiswa Afirmasi
                    </div>
                    <h3>Untuk Siswa Berprestasi</h3>
                    <p>
                        <strong>Persyaratan:</strong><br>
                        • SKTM dari Desa<br>
                        • Rekomendasi Sekolah Asal<br>
                        • Lolos Seleksi SPMB<br>
                        • Lolos Survey Panitia<br><br>

                        <strong>Dokumen:</strong> SKTM dan rekomendasi<br>
                        <strong>Kuota:</strong> Terbatas<br>
                        <strong>Jurusan:</strong> Semua jurusan
                    </p>
                    <a href="#daftar-beasiswa" class="read-more">
                        Daftar Beasiswa <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <div class="container" style="text-align: center; margin-top:50px">
                <a href="/pendaftaran" class="btn btn-primary">
                    <i class="fas fa-file-download"></i> Download Persyaratan Lengkap
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
                        <p>{!! strip_tags(Str::limit($post->content, 100)) !!}</p>
                        <a href="post/{{ $post->slug }}" class="read-more">
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
@endsection
