@extends('components.layouts.page')
@section('content')
    <style>
        .card-body {
            font-size: 14pt;
            padding: 20px;
        }
    </style>
    <!-- News Section -->
    <section class="news" id="berita" style="margin-top: 100px;">
        <div class="container">
            <h2 class="section-title animate-on-scroll">Informasi</h2>

            <div class="news-grid">
                @forelse ($posts as $post)
                    <div class="news-card animate-on-scroll">
                        <div class="news-date">
                            <i class="fas fa-calendar"></i> {{ $post->created_at->format('d M Y') }}
                        </div>
                        <h3>{{$post->title}}</h3>
                        <div>{{ strip_tags(Str::limit($post->content,100)) }}</div>
                        <a href="post/{{$post->slug}}" class="read-more">
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