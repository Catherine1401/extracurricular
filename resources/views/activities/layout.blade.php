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
        
        .category-academy { 
            background-color: #e3f2fd; 
            color: #1976d2; 
        }
        
        .category-sport { 
            background-color: #e8f5e8; 
            color: #2e7d32; 
        }
        
        .category-volunteer { 
            background-color: #fff3e0; 
            color: #f57c00; 
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
            color: #c62828;
        }
        
        .material-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 36px;
            padding: 0 16px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .material-button-primary {
            background-color: #1976d2;
            color: white;
            box-shadow: 0 2px 4px rgba(25, 118, 210, 0.3);
        }
        
        .material-button-primary:hover {
            background-color: #1565c0;
            box-shadow: 0 4px 8px rgba(25, 118, 210, 0.4);
        }
        
        .material-button-secondary {
            background-color: #f5f5f5;
            color: #424242;
        }
        
        .material-button-secondary:hover {
            background-color: #eeeeee;
        }
        
        .material-button-danger {
            background-color: #d32f2f;
            color: white;
            box-shadow: 0 2px 4px rgba(211, 47, 47, 0.3);
        }
        
        .material-button-danger:hover {
            background-color: #c62828;
            box-shadow: 0 4px 8px rgba(211, 47, 47, 0.4);
        }
        
        .material-fab {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background-color: #1976d2;
            color: white;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
            transition: all 0.3s cubic-bezier(0.4, 0.0, 0.2, 1);
            display: flex;
            align-items: center;
            justify-content: center;
            position: fixed;
            bottom: 24px;
            right: 24px;
            z-index: 1000;
        }
        
        .material-fab:hover {
            box-shadow: 0 6px 12px rgba(0,0,0,0.3);
            transform: scale(1.05);
        }
        
        .material-app-bar {
            background-color: #1976d2;
            color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .material-tab {
            color: rgba(255, 255, 255, 0.7);
            padding: 0 24px;
            height: 48px;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
            border-bottom: 2px solid transparent;
        }
        
        .material-tab.active {
            color: white;
            border-bottom-color: white;
        }
        
        .material-tab:hover {
            color: white;
        }
        
        .material-body {
            background-color: #fafafa;
            min-height: 100vh;
        }
        
        .material-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px;
        }
        
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
    </style>
</head>
<body class="material-body">
    <!-- App Bar -->
    <header class="material-app-bar">
        <div style="display: flex; align-items: center; height: 64px; padding: 0 24px;">
            <div style="flex: 1;">
                <h1 class="material-typography-h1" style="color: white; font-size: 20px; margin: 0;">Hoạt động ngoại khóa</h1>
            </div>
            <nav style="display: flex;">
                <a href="{{ route('activities.index') }}" 
                   class="material-tab {{ request()->routeIs('activities.index') ? 'active' : '' }}">
                    <span class="material-icons" style="margin-right: 8px;">list</span>
                    Danh sách
                </a>
                <a href="{{ route('activities.create') }}" 
                   class="material-tab {{ request()->routeIs('activities.create') ? 'active' : '' }}">
                    <span class="material-icons" style="margin-right: 8px;">add</span>
                    Tạo mới
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="material-container">
        @yield('content')
    </main>

    <!-- Floating Action Button for Create -->
    @if(request()->routeIs('activities.index'))
        <a href="{{ route('activities.create') }}" class="material-fab" title="Tạo hoạt động mới">
            <span class="material-icons">add</span>
        </a>
    @endif

    <script>
        // Ripple effect only for clickable cards
        document.addEventListener('click', function(e) {
            if (e.target.closest('.material-card.clickable')) {
                const card = e.target.closest('.material-card');
                const ripple = document.createElement('span');
                const rect = card.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                ripple.classList.add('ripple');
                
                card.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            }
        });
    </script>
</body>
</html>
