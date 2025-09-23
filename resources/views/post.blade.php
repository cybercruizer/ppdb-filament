@extends('components.layouts.page')
@section('content')
    <!-- News Section -->
    <section class="news" id="berita">
        <div class="container">
            <h2 class="section-title animate-on-scroll">{{$post->title}}</h2>
            <div class="subtitle">
                <div class="news-date">
                    <i class="fas fa-calendar"></i> {{ $post->created_at->format('d M Y') }}
                </div>
            </div>

            <div class="card-body">
                {!!$post->content!!}
            </div>
        </div>
    </section>
@endsection