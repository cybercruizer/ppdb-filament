@extends('components.layouts.page')
@section('content')
<!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <h1>{{$title}}</h1>
            <p class="hero-subtitle">SMK Muhammadiyah Mungkid - Membangun Generasi Unggul dengan Pendidikan Berkualitas
                dan Berbasis Islami</p>

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
            <h2 class="section-title animate-on-scroll">Berita & Pengumuman</h2>

            <div class="news-grid">
                @forelse ($posts as $post)
                    <div class="news-card animate-on-scroll">
                        <div class="news-date">
                            <i class="fas fa-calendar"></i> {{ $post->created_at->format('d M Y') }}
                        </div>
                        <h3>{{$post->title}}</h3>
                        <p>{!!Str::limit($post->content,100)!!}</p>
                        <a href="post/{{$post->id}}" class="read-more">
                            Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                @empty
                    <p class="animate-on-scroll">Belum ada berita terbaru.</p>
                @endforelse

            </div>
        </div>
    </section>
@endsection