<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Extracurricular Manager') }}</title>

    <!-- Tailwind CSS (Laravel 12 mặc định có sẵn) -->
    @vite('resources/css/app.css')

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-900 min-h-screen flex flex-col">

    <!-- 🌟 Thanh navbar -->
    <nav class="bg-indigo-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-lg font-semibold">
                <a href="{{ route('activities.index') }}">🎓 Extracurricular</a>
            </h1>

            <div class="flex items-center gap-6">
                <a href="{{ route('activities.index') }}" class="hover:underline">Hoạt động</a>
                @if(Auth::check() && Auth::user()->role === 'admin')
                    <a href="{{ route('categories.index') }}" class="hover:underline">Danh mục</a>
                @endif
                <span class="text-sm">👋 {{ Auth::user()->name ?? 'Khách' }}</span>
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button class="text-sm bg-white/20 px-3 py-1 rounded hover:bg-white/30">
                            Đăng xuất
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <!-- 🧱 Nội dung chính -->
    <main class="flex-grow container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- ⚡ Footer -->
    <footer class="bg-white border-t text-center py-4 text-gray-600 text-sm">
        © {{ date('Y') }} Hệ thống quản lý hoạt động ngoại khóa — Laravel x Material Design
    </footer>

</body>
</html>
