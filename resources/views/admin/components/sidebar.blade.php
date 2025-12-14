{{-- resources/views/admin/components/sidebar.blade.php --}}
@props(['admin', 'activeMenu' => 'dashboard'])

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <div class="brand">
            <div class="brand-logo">
                <img src="{{ asset('images/hipmi-logo.png') }}" alt="HIPMI Logo" width="75" height="75" style="object-fit: contain;">
            </div>
            <div class="brand-text" style="margin-left: 20px;">
                <div class="brand-title">HIPMI</div>
                <div class="brand-subtitle">JAWA BARAT</div>
            </div>
        </div>
    </div>
    
    <div class="sidebar-menu">
        <div class="menu-section">
            <div class="menu-label">Menu Utama</div>
            
            {{-- Dashboard Dropdown --}}
            <div class="menu-dropdown">
                <div class="menu-item has-dropdown {{ in_array($activeMenu, ['dashboard', 'info-admin']) ? 'active' : '' }}" onclick="toggleDropdown(this)">
                    <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                        <svg viewBox="0 0 24 24">
                            <rect x="3" y="3" width="7" height="7" rx="1"/>
                            <rect x="14" y="3" width="7" height="7" rx="1"/>
                            <rect x="3" y="14" width="7" height="7" rx="1"/>
                            <rect x="14" y="14" width="7" height="7" rx="1"/>
                        </svg>
                        <span>Dashboard</span>
                    </div>
                    <svg class="dropdown-icon" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </div>
                <div class="submenu {{ in_array($activeMenu, ['dashboard', 'info-admin']) ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="submenu-item {{ $activeMenu === 'dashboard' ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24">
                            <polyline points="9 11 12 14 22 4"/>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/>
                        </svg>
                        <span>Overview</span>
                    </a>
                    
                    {{-- Info Admin hanya untuk BPD --}}
                    @if($admin->category === 'bpd')
                        <a href="{{ route('admin.info-admin') }}" class="submenu-item {{ $activeMenu === 'info-admin' ? 'active' : '' }}">
                            <svg viewBox="0 0 24 24">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                <circle cx="9" cy="7" r="4"/>
                                <line x1="19" y1="8" x2="19" y2="14"/>
                                <line x1="22" y1="11" x2="16" y2="11"/>
                            </svg>
                            <span>Info Admin</span>
                        </a>
                    @endif
                </div>
            </div>

            <a href="#" class="menu-item {{ $activeMenu === 'editor' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                <span>Editor</span>
            </a>
            <a href="#" class="menu-item {{ $activeMenu === 'anggota' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
                <span>Anggota</span>
            </a>
            <a href="#" class="menu-item {{ $activeMenu === 'pengaturan' ? 'active' : '' }}">
                <svg viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="3"/>
                    <path d="M12 1v6m0 6v6m-9-9h6m6 0h6"/>
                    <path d="M19.07 4.93l-3.53 3.53m-7.08 7.08l-3.53 3.53m15.14 0l-3.53-3.53m-7.08-7.08L4.93 4.93"/>
                </svg>
                <span>Pengaturan</span>
            </a>
        </div>

        <div class="menu-section">
            <div class="menu-label">Halaman Website</div>
            
            {{-- Beranda Dropdown (dengan Misi di dalamnya) --}}
            <div class="menu-dropdown">
                <div class="menu-item has-dropdown {{ in_array($activeMenu, ['beranda', 'misi']) ? 'active' : '' }}" onclick="toggleDropdown(this)">
                    <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                        <svg viewBox="0 0 24 24">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                            <polyline points="9 22 9 12 15 12 15 22"/>
                        </svg>
                        <span>Beranda</span>
                    </div>
                    <svg class="dropdown-icon" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </div>
                <div class="submenu {{ in_array($activeMenu, ['beranda', 'misi']) ? 'active' : '' }}">
                    <a href="{{ route('home') }}" class="submenu-item" target="_blank">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="2" y1="12" x2="22" y2="12"/>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                        <span>Lihat Halaman</span>
                    </a>
                    <a href="{{ route('admin.misi.index') }}" class="submenu-item {{ $activeMenu === 'misi' ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24">
                            <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/>
                            <polyline points="14 2 14 8 20 8"/>
                            <line x1="9" y1="15" x2="15" y2="15"/>
                            <line x1="9" y1="11" x2="15" y2="11"/>
                        </svg>
                        <span>Kelola Misi</span>
                    </a>
                </div>
            </div>

            {{-- Organisasi Dropdown --}}
            <div class="menu-dropdown">
                <div class="menu-item has-dropdown {{ $activeMenu === 'organisasi' ? 'active' : '' }}" onclick="toggleDropdown(this)">
                    <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                        <svg viewBox="0 0 24 24">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                            <circle cx="9" cy="7" r="4"/>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        <span>Organisasi</span>
                    </div>
                    <svg class="dropdown-icon" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </div>
                <div class="submenu {{ $activeMenu === 'organisasi' ? 'active' : '' }}">
                    <a href="{{ route('organisasi') }}" class="submenu-item" target="_blank">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="2" y1="12" x2="22" y2="12"/>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                        <span>Lihat Halaman</span>
                    </a>
                    <a href="{{ route('admin.organisasi.index') }}" class="submenu-item {{ $activeMenu === 'organisasi' ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        <span>Kelola Data</span>
                    </a>
                </div>
            </div>

            {{-- E-Katalog Dropdown --}}
            <div class="menu-dropdown">
                <div class="menu-item has-dropdown {{ $activeMenu === 'katalog' ? 'active' : '' }}" onclick="toggleDropdown(this)">
                    <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                        <svg viewBox="0 0 24 24">
                            <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                            <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                        </svg>
                        <span>E-Katalog</span>
                    </div>
                    <svg class="dropdown-icon" viewBox="0 0 24 24">
                        <polyline points="6 9 12 15 18 9"/>
                    </svg>
                </div>
                <div class="submenu {{ $activeMenu === 'katalog' ? 'active' : '' }}">
                    <a href="{{ route('e-katalog') }}" class="submenu-item" target="_blank">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="2" y1="12" x2="22" y2="12"/>
                            <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                        </svg>
                        <span>Lihat Halaman</span>
                    </a>
                    <a href="{{ route('admin.katalog.index') }}" class="submenu-item {{ $activeMenu === 'katalog' ? 'active' : '' }}">
                        <svg viewBox="0 0 24 24">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                        <span>Kelola Data</span>
                    </a>
                </div>
            </div>

            <a href="{{ route('berita') }}" class="menu-item" target="_blank">
                <svg viewBox="0 0 24 24">
                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/>
                    <polyline points="13 2 13 9 20 9"/>
                </svg>
                <span>Berita</span>
            </a>
            <a href="{{ route('umkm') }}" class="menu-item" target="_blank">
                <svg viewBox="0 0 24 24">
                    <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/>
                    <polyline points="3.27 6.96 12 12.01 20.73 6.96"/>
                    <line x1="12" y1="22.08" x2="12" y2="12"/>
                </svg>
                <span>UMKM</span>
            </a>
        </div>
    </div>
</div>

{{-- Mobile Menu Toggle --}}
<button class="mobile-menu-toggle" id="mobileMenuToggle">
    <svg viewBox="0 0 24 24">
        <line x1="3" y1="12" x2="21" y2="12"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <line x1="3" y1="18" x2="21" y2="18"/>
    </svg>
</button>

<div class="mobile-overlay" id="mobileOverlay"></div>

@once
    @push('scripts')
    <script>
        const sidebar = document.getElementById('sidebar');
        const mobileToggle = document.getElementById('mobileMenuToggle');
        const mobileOverlay = document.getElementById('mobileOverlay');

        if (mobileToggle && mobileOverlay) {
            mobileToggle.addEventListener('click', () => {
                sidebar.classList.toggle('mobile-active');
                mobileOverlay.classList.toggle('active');
            });

            mobileOverlay.addEventListener('click', () => {
                sidebar.classList.remove('mobile-active');
                mobileOverlay.classList.remove('active');
            });
        }

        function toggleDropdown(element) {
            element.classList.toggle('active');
            const submenu = element.nextElementSibling;
            submenu.classList.toggle('active');
        }
    </script>
    @endpush
@endonce