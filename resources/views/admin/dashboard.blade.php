{{-- resources/views/admin/dashboard.blade.php --}}
@extends('admin.layouts.admin-layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@php
    $activeMenu = 'dashboard';
@endphp

@push('styles')
<style>
    .welcome-card {
        background: linear-gradient(135deg, #0a2540 0%, #1a3a5c 100%);
        padding: 2.5rem;
        border-radius: 12px;
        color: white;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .welcome-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: rgba(255, 215, 0, 0.1);
        border-radius: 50%;
        z-index: 0;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 2rem;
    }

    .welcome-avatar {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #ffd700;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0a2540;
        font-weight: 700;
        font-size: 2rem;
        flex-shrink: 0;
        border: 4px solid rgba(255, 215, 0, 0.3);
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .welcome-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .welcome-text {
        flex: 1;
    }

    .welcome-card h1 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .welcome-card p {
        font-size: 1.125rem;
        color: rgba(255,255,255,0.8);
        margin-bottom: 1rem;
    }

    .category-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .badge-bpc {
        background: #ffd700;
        color: #0a2540;
    }

    .badge-bpd {
        background: #3b82f6;
        color: white;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        padding: 1.75rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
        transition: all 0.3s;
    }

    .stat-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transform: translateY(-2px);
    }

    .stat-label {
        color: #6b7280;
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
        font-weight: 500;
    }

    .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #0a2540;
        margin-bottom: 0.5rem;
    }

    .stat-meta {
        font-size: 0.8125rem;
        color: #10b981;
        font-weight: 500;
    }

    .admin-section {
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        border: 1px solid #e5e7eb;
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f3f4f6;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0a2540;
    }

    .view-all-btn {
        color: #0a2540;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 600;
        transition: color 0.2s;
    }

    .view-all-btn:hover {
        color: #ffd700;
    }

    .admin-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .admin-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.25rem;
        background: #f9fafb;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        transition: all 0.2s;
    }

    .admin-item:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
        transform: translateX(4px);
    }

    .admin-avatar {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: #ffd700;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0a2540;
        font-weight: 700;
        font-size: 1.125rem;
        flex-shrink: 0;
        overflow: hidden;
        border: 2px solid #e5e7eb;
    }

    .admin-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .admin-info {
        flex: 1;
        min-width: 0;
    }

    .admin-name {
        font-weight: 600;
        color: #0a2540;
        margin-bottom: 0.25rem;
        font-size: 0.9375rem;
    }

    .admin-email {
        font-size: 0.8125rem;
        color: #6b7280;
    }

    .admin-badge {
        padding: 0.375rem 0.875rem;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    @media (max-width: 768px) {
        .welcome-content {
            flex-direction: column;
            text-align: center;
        }

        .welcome-avatar {
            width: 70px;
            height: 70px;
            font-size: 1.5rem;
        }

        .welcome-card {
            padding: 1.5rem;
        }

        .welcome-card h1 {
            font-size: 1.5rem;
        }

        .welcome-card p {
            font-size: 0.9375rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="welcome-card">
    <div class="welcome-content">
        <div class="welcome-avatar">
            @if(auth()->guard('admin')->user()->photo)
                <img src="{{ auth()->guard('admin')->user()->photo_url }}" alt="{{ auth()->guard('admin')->user()->name }}">
            @else
                {{ strtoupper(substr(auth()->guard('admin')->user()->name, 0, 2)) }}
            @endif
        </div>
        <div class="welcome-text">
            <h1>Selamat Datang, {{ auth()->guard('admin')->user()->name }}</h1>
            <p>Dashboard Admin HIPMI Jawa Barat</p>
            <span class="category-badge badge-{{ auth()->guard('admin')->user()->category }}">
                {{ strtoupper(auth()->guard('admin')->user()->category) }}
            </span>
        </div>
    </div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Admin</div>
        <div class="stat-value">{{ $totalAdmins }}</div>
        <div class="stat-meta">BPC: {{ $adminsBPC }} | BPD: {{ $adminsBPD }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Anggota</div>
        <div class="stat-value">0</div>
        <div class="stat-meta">Belum ada data</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Event</div>
        <div class="stat-value">0</div>
        <div class="stat-meta">Belum ada data</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Berita</div>
        <div class="stat-value">0</div>
        <div class="stat-meta">Belum ada data</div>
    </div>
</div>

<div class="admin-section">
    <div class="section-header">
        <h3 class="section-title">Daftar Admin Terdaftar</h3>
        <a href="{{ route('admin.info-admin') }}" class="view-all-btn">Lihat Semua</a>
    </div>
    <div class="admin-list">
        @foreach($recentAdmins as $adminItem)
        <div class="admin-item">
            <div class="admin-avatar">
                @if($adminItem->photo)
                    <img src="{{ $adminItem->photo_url }}" alt="{{ $adminItem->name }}">
                @else
                    {{ strtoupper(substr($adminItem->name, 0, 2)) }}
                @endif
            </div>
            <div class="admin-info">
                <div class="admin-name">{{ $adminItem->name }}</div>
                <div class="admin-email">{{ $adminItem->email }}</div>
            </div>
            <span class="admin-badge badge-{{ $adminItem->category }}">{{ strtoupper($adminItem->category) }}</span>
        </div>
        @endforeach
    </div>
</div>
@endsection