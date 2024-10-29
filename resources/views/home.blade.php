@extends('template')
@section('content')
<br><br><br>
@if(auth()->check())
    <div class="alert alert-success">
        Halo {{ auth()->user()->name }} Selamat datang di halaman admin!!
    </div>
@else
    <div class="alert alert-warning">User Belum Login!</div>
@endif
<br>
{{-- Kartu informasi page --}}
<div class="row gy-4">
    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0" style="background-color: #eef5f9;">
            <div class="card-body text-center">
                <div class="icon-big mb-2">
                    <i class="fa fa-users text-success" style="font-size: 2.5rem;"></i>
                </div>
                <h6 class="card-title fw-bold">Anggota</h6>
                <a href="/anggota" class="stretched-link text-muted"> Data: {{ $data1 }}</a>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0" style="background-color: #fdf2f2;">
            <div class="card-body text-center">
                <div class="icon-big mb-2">
                    <i class="fa fa-calendar text-danger" style="font-size: 2.5rem;"></i>
                </div>
                <h6 class="card-title fw-bold">Event</h6>
                <a href="/event" class="stretched-link text-muted">Data: {{ $data2 }}</a>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0" style="background-color: #fef7e0;">
            <div class="card-body text-center">
                <div class="icon-big mb-2">
                    <i class="fa fa-bullhorn text-warning" style="font-size: 2.5rem;"></i>
                </div>
                <h6 class="card-title fw-bold">Pemenang Event</h6>
                <a href="/pemenang" class="stretched-link text-muted">Data: {{ $data3 }}</a>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card shadow-sm border-0" style="background-color: #e7f7fe;">
            <div class="card-body text-center">
                <div class="icon-big mb-2">
                    <i class="fa fa-user text-primary" style="font-size: 2.5rem;"></i>
                </div>
                <h6 class="card-title fw-bold">Pelatih</h6>
                <a href="/pelatih" class="stretched-link text-muted">Data: {{ $data4 }}</a>
            </div>
        </div>
    </div>
</div>

{{-- Section dengan gambar --}}
<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light">
                <h5 class="card-title mb-0">Klub Olahraga</h5>
                <p class="card-category text-muted"></p>
            </div>
            <div class="card-body p-0">
                <img src="{{ asset('vendor/assets/img/i.jpg') }}"  style="width: 100%; height: 300px; object-fit: cover; opacity: 0.9;">
            </div>
        </div>
    </div>
</div>

@endsection
