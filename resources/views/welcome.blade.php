@extends('layouts.app')

@section('title', 'Welcome - Frontend Hipmi Jabar')

@section('content')

    <section class="hero">
        <div class="hero-1">
            <h1>HIPMI Jawa Barat</h1>
            <p>Sebagai Jembatan Informasi</p>
            <h3>Hayu, kita maju babarengan!</h3>
            <a href="#" class="btn">Jadi Anggota</a>
        </div>
        <div class="hero-2">
            <img src="{{  asset('images/hipmi-logo.png') }}" alt="HIPMI Logo">
        </div>
    </section>

    <section class="main-info">
        <div class="info-card">
            <img src="{{ asset('images/icons/users.png')  }}" alt="" class="icon">
            <h2><span class="counter" data-target="23">0</span></h2>
            <h3>Anggota</h3>
        </div>
        <div class="info-card">
            <img src="{{ asset('images/icons/building.png')  }}" alt="" class="icon">
            <h2><span class="counter" data-target="23">0</span></h2>
            <h3>Perusahaan</h3>
        </div>
        <div class="info-card">
            <img src="{{ asset('images/icons/folder.png')  }}" alt="" class="icon">
            <h2><span class="counter" data-target="1">0</span></h2>
            <h3>Klasifikasi Usaha</h3>
        </div>
    </section>

@endsection