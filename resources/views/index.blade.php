@extends('landing-page.layouts.app')

@section('content')
    <!-- Memanggil setiap section secara berurutan -->
    @include('landing-page.sections.hero')
    @include('landing-page.sections.tentang')
    @include('landing-page.sections.menu')
    @include('landing-page.sections.reservasi')
    @include('landing-page.sections.galeri')
    @include('landing-page.sections.karir')
    @include('landing-page.sections.reviews')
@endsection