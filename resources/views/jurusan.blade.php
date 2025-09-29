@extends('components.layouts.page')
@section('content')
    <style>
        .card-body {
            font-size: 14pt;
            padding: 20px;
        }
        img {
            width: 100%;
            height: auto;
        }
    </style>
    <!-- News Section -->
    <section class="news" id="berita" style="margin-top: 100px;">
        <div class="container">
            <h2 class="section-title animate-on-scroll">{{$jurusan->nama_jurusan}}</h2>
            <div class="subtitle">
                <div class="news-date">
                    <i class="fas fa-calendar"></i> {{ $jurusan->created_at->format('d M Y') }}
                </div>
            </div>

            <div class="card-body">
                <p>{!!$jurusan->deskripsi!!}</p>
            </div>
        </div>
    </section>
@endsection