<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Quản lý hoạt động ngoại khóa')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        * {
            font-family: 'Roboto', sans-serif;
        }
        
        body {
            margin: 0;
            background-color: #fafafa;
            min-height: 100vh;
        }
        
        .material-layout {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .material-sidebar {
            width: 280px;
            background: white;
            box-shadow: 2px 0 4px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        
        .material-sidebar.hidden {
            transform: translateX(-100%);
        }
        
        .material-sidebar-header {
            padding: 24px;
            border-bottom: 1px solid #e0e0e0;
            background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%);
            color: white;
        }
        
        .material-sidebar-title {
            font-size: 20px;
            font-weight: 500;
            margin: 0 0 8px 0;
        }
        
        .material-sidebar-subtitle {
            font-size: 14px;
            opacity: 0.8;
            margin: 0;
        }
        
        .material-sidebar-nav {
            padding: 16px 0;
        }
        
        .material-sidebar-item {
            display: flex;
            align-items: center;
            padding: 12px 24px;
            color: #424242;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .material-sidebar-item:hover {
            background-color: #f5f5f5;
            color: #1976d2;
        }
        
        .material-sidebar-item.active {
            background-color: #e3f2fd;
            color: #1976d2;
            border-left-color: #1976d2;
        }
        
        .material-sidebar-item-icon {
            margin-right: 16px;
            font-size: 20px;
        }
        
        .material-sidebar-item-text {
            font-size: 14px;
            font-weight: 500;
        }
        
        .material-sidebar-divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 8px 0;
        }
        
        .material-sidebar-section {
            padding: 16px 0 8px 0;
        }
        
        .material-sidebar-section-title {
            padding: 0 24px 8px 24px;
            font-size: 12px;
            font-weight: 500;
            color: #9e9e9e;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* Main Content */
        .material-main {
            flex: 1;
            margin-left: 280px;
            transition: margin-left 0.3s ease;
        }
        
        .material-main.full-width {
            margin-left: 0;
        }
        
        .material-topbar {
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        
        .material-topbar-left {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        
        .material-topbar-right {
            display: flex;
            align-items: center;
        }
        
        .material-topbar-title {
            font-size: 24px;
            font-weight: 400;
            color: #212121;
            margin: 0;
        }
        
        /* User Menu Styles */
        .material-user-menu {
            position: relative;
        }
        
        .material-user-button {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 8px 16px;
            background: none;
            border: none;
            border-radius: 24px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .material-user-button:hover {
            background-color: #f5f5f5;
        }
        
        .material-user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .material-user-name {
            font-size: 14px;
            font-weight: 500;
            color: #424242;
        }
        
        .material-user-arrow {
            font-size: 20px;
            color: #9e9e9e;
            transition: transform 0.3s ease;
        }
        
        .material-user-menu.open .material-user-arrow {
            transform: rotate(180deg);
        }
        
        .material-user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            min-width: 200px;
            padding: 8px 0;
            margin-top: 8px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .material-user-menu.open .material-user-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        .material-user-dropdown-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #424242;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        
        .material-user-dropdown-item:hover {
            background-color: #f5f5f5;
        }
        
        .material-user-dropdown-item.material-user-logout {
            color: #d32f2f;
        }
        
        .material-user-dropdown-item.material-user-logout:hover {
            background-color: #ffebee;
        }
        
        .material-user-dropdown-divider {
            height: 1px;
            background-color: #e0e0e0;
            margin: 8px 0;
        }
        
        .material-sidebar-toggle {
            display: none;
            background: none;
            border: none;
            padding: 8px;
            cursor: pointer;
            border-radius: 4px;
            color: #424242;
        }
        
        .material-sidebar-toggle:hover {
            background-color: #f5f5f5;
        }
        
        .material-content {
            padding: 24px;
        }
        
        /* Card Styles */
        .material-card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }
        
        .material-card:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }
        
        .material-card:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
        
        /* Button Styles */
        .material-button {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .material-button-primary {
            background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%);
            color: white;
        }
        
        .material-button-primary:hover {
            background: linear-gradient(135deg, #1565c0 0%, #0d47a1 100%);
            box-shadow: 0 4px 8px rgba(25, 118, 210, 0.3);
        }
        
        .material-button-secondary {
            background: transparent;
            color: #1976d2;
            border: 1px solid #1976d2;
        }
        
        .material-button-secondary:hover {
            background: #1976d2;
            color: white;
        }
        
        .material-button-danger {
            background: linear-gradient(135deg, #d32f2f 0%, #c62828 100%);
            color: white;
        }
        
        .material-button-danger:hover {
            background: linear-gradient(135deg, #c62828 0%, #b71c1c 100%);
            box-shadow: 0 4px 8px rgba(211, 47, 47, 0.3);
        }
        
        .material-fab {
            position: fixed;
            bottom: 24px;
            right: 24px;
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            z-index: 1000;
        }
        
        .material-fab:hover {
            transform: scale(1.1);
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
        }
        
        /* Typography */
        .material-typography-h1 {
            font-size: 32px;
            font-weight: 300;
            color: #212121;
            margin: 0 0 16px 0;
        }
        
        .material-typography-h2 {
            font-size: 24px;
            font-weight: 400;
            color: #212121;
            margin: 0 0 12px 0;
        }
        
        .material-typography-body1 {
            font-size: 16px;
            font-weight: 400;
            color: #424242;
            line-height: 1.5;
        }
        
        .material-typography-body2 {
            font-size: 14px;
            font-weight: 400;
            color: #616161;
            line-height: 1.4;
        }
        
        .material-typography-caption {
            font-size: 12px;
            font-weight: 400;
            color: #9e9e9e;
            line-height: 1.3;
        }
        
        /* Category Chips */
        .category-chip {
            display: inline-flex;
            align-items: center;
            height: 32px;
            padding: 0 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .category-1 { 
            background-color: #e3f2fd; 
            color: #1976d2; 
        }
        
        .category-2 { 
            background-color: #e8f5e8; 
            color: #2e7d32; 
        }
        
        .category-3 { 
            background-color: #fff3e0; 
            color: #f57c00; 
        }
        
        .category-4 { 
            background-color: #fce4ec; 
            color: #c2185b; 
        }
        
        .category-5 { 
            background-color: #f3e5f5; 
            color: #7b1fa2; 
        }
        
        .category-6 { 
            background-color: #e0f2f1; 
            color: #00695c; 
        }
        
        .category-7 { 
            background-color: #fff8e1; 
            color: #f57c00; 
        }
        
        .category-8 { 
            background-color: #e8eaf6; 
            color: #3f51b5; 
        }
        
        .category-9 { 
            background-color: #f1f8e9; 
            color: #558b2f; 
        }
        
        .category-10 { 
            background-color: #fce4ec; 
            color: #ad1457; 
        }
        
        .category-none { 
            background-color: #f5f5f5; 
            color: #9e9e9e; 
        }
        
        .points-chip {
            background: linear-gradient(135deg, #9c27b0 0%, #673ab7 100%);
            color: white;
            height: 32px;
            padding: 0 12px;
            border-radius: 16px;
            font-weight: 500;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
        }
        
        .status-chip {
            height: 24px;
            padding: 0 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }
        
        .status-open {
            background-color: #e8f5e8;
            color: #2e7d32;
        }
        
        .status-closed {
            background-color: #ffebee;
            color: #d32f2f;
        }
        
        .organization-chip {
            background-color: #e8f5e8;
            color: #2e7d32;
            height: 24px;
            padding: 0 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .material-sidebar {
                transform: translateX(-100%);
            }
            
            .material-sidebar.open {
                transform: translateX(0);
            }
            
            .material-main {
                margin-left: 0;
            }
            
            .material-sidebar-toggle {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="material-layout">
        <!-- Sidebar -->
        <aside class="material-sidebar" id="sidebar">
            <div class="material-sidebar-header">
                <h1 class="material-sidebar-title">🎓 Extracurricular</h1>
                <p class="material-sidebar-subtitle">Quản lý hoạt động ngoại khóa</p>
            </div>
            
            <nav class="material-sidebar-nav">
                @if(Auth::check() && !Auth::user()->isAdmin())
                    <div class="material-sidebar-section">
                        <div class="material-sidebar-section-title">Tổng quan</div>
                        <a href="{{ route('activities.index') }}" 
                           class="material-sidebar-item {{ request()->routeIs('activities.index') ? 'active' : '' }}">
                            <span class="material-icons material-sidebar-item-icon">dashboard</span>
                            <span class="material-sidebar-item-text">Dashboard</span>
                        </a>
                    </div>
                @endif
                
                <div class="material-sidebar-divider"></div>
                
                <div class="material-sidebar-section">
                    <div class="material-sidebar-section-title">Quản lý</div>
                    @if(Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isOrganization()))
                        <a href="{{ route('activities.my') }}" 
                           class="material-sidebar-item {{ request()->routeIs('activities.my') || request()->routeIs('activities.create') || request()->routeIs('activities.edit') ? 'active' : '' }}">
                            <span class="material-icons material-sidebar-item-icon">event_note</span>
                            <span class="material-sidebar-item-text">Quản lý hoạt động</span>
                        </a>
                    @endif
                    
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <a href="{{ route('categories.index') }}" 
                           class="material-sidebar-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                            <span class="material-icons material-sidebar-item-icon">category</span>
                            <span class="material-sidebar-item-text">Quản lý danh mục</span>
                        </a>
                    @endif
                </div>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="material-main" id="main">
            <!-- Top Bar -->
            <div class="material-topbar">
                <div class="material-topbar-left">
                    <button class="material-sidebar-toggle" onclick="toggleSidebar()">
                        <span class="material-icons">menu</span>
                    </button>
                    <h1 class="material-topbar-title">@yield('title', 'Quản lý hoạt động ngoại khóa')</h1>
                </div>
                <div class="material-topbar-right">
                    <div class="material-user-menu">
                        <button class="material-user-button" onclick="toggleUserMenu()">
                            <div class="material-user-avatar">
                                <span class="material-icons">person</span>
                            </div>
                            <span class="material-user-name">{{ Auth::user()->name ?? 'Khách' }}</span>
                            <span class="material-icons material-user-arrow">keyboard_arrow_down</span>
                        </button>
                        <div class="material-user-dropdown" id="userDropdown">
                            <a href="{{ route('profile.edit') }}" class="material-user-dropdown-item">
                                <span class="material-icons">person</span>
                                <span>Hồ sơ cá nhân</span>
                            </a>
                            <div class="material-user-dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                @csrf
                                <button type="submit" class="material-user-dropdown-item material-user-logout">
                                    <span class="material-icons">logout</span>
                                    <span>Đăng xuất</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Content -->
            <div class="material-content">
                @yield('content')
            </div>
        </main>
    </div>
    
    <!-- Floating Action Button for Create - Chỉ cho organization -->
    @if(request()->routeIs('activities.my') && Auth::user()->isOrganization())
        <a href="{{ route('activities.create') }}" class="material-fab" title="Tạo hoạt động mới">
            <span class="material-icons">add</span>
        </a>
    @endif
    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const main = document.getElementById('main');
            
            sidebar.classList.toggle('hidden');
            main.classList.toggle('full-width');
        }
        
        function toggleUserMenu() {
            const userMenu = document.querySelector('.material-user-menu');
            userMenu.classList.toggle('open');
        }
        
        // Close user menu when clicking outside
        document.addEventListener('click', function(e) {
            const userMenu = document.querySelector('.material-user-menu');
            if (!userMenu.contains(e.target)) {
                userMenu.classList.remove('open');
            }
        });
        
        // Ripple effect for clickable cards
        document.addEventListener('click', function(e) {
            if (e.target.closest('.material-card.clickable')) {
                const card = e.target.closest('.material-card');
                const rect = card.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                const ripple = document.createElement('span');
                ripple.classList.add('ripple');
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                
                card.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            }
        });
        
        // Close sidebar on mobile when clicking outside
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 768) {
                const sidebar = document.getElementById('sidebar');
                const toggle = document.querySelector('.material-sidebar-toggle');
                
                if (!sidebar.contains(e.target) && !toggle.contains(e.target)) {
                    sidebar.classList.add('hidden');
                    document.getElementById('main').classList.add('full-width');
                }
            }
        });
    </script>
</body>
</html>