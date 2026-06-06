<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Sistem Penjualan')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Poppins', sans-serif;
            overflow-y: scroll; /* <-- TAMBAHKAN INI AGAR SCROLLBAR SELALU ADA DAN NAVBAR GA BERGESER */
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-100 via-slate-200 to-slate-300 text-slate-800">

    <header class="sticky top-0 z-50 border-b border-white/20 bg-white/80 backdrop-blur-lg shadow-sm">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            <div class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-900 text-white shadow-lg">
                    🛒
                </div>
                <div>
                    <h1 class="text-lg font-bold leading-none">Sistem Penjualan</h1>
                    <p class="text-xs text-slate-500">Management Dashboard</p>
                </div>
            </div>

            @auth
            <nav class="hidden md:flex items-center gap-2">
                
                {{-- NAVIGASI DEVELOPER --}}
                @if (auth()->user()->role === 'Developer' || auth()->user()->role === 'developer')
                    <a href="{{ route('developer.dashboard') }}" 
                       class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ request()->routeIs('developer.dashboard') ? 'bg-slate-200 text-slate-900' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        Dashboard
                    </a>
                    
                    <a href="{{ route('developer.admin.index') }}" 
                       class="rounded-xl px-4 py-2 text-sm font-semibold transition {{ request()->routeIs('developer.admin.index') || request()->routeIs('developer.register.admin') ? 'bg-slate-200 text-slate-900' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        Kelola Admin
                    </a>

                {{-- NAVIGASI ADMIN --}}
                @elseif (auth()->user()->role === 'admin' || auth()->user()->role === 'Admin')
                    <a href="{{ route('admin.dashboard') }}" class="rounded-xl px-4 py-2 text-sm font-medium transition hover:bg-slate-100">Dashboard</a>
                    <a href="{{ route('admin.products.index') }}" class="rounded-xl px-4 py-2 text-sm font-medium transition hover:bg-slate-100">Produk</a>
                    <a href="{{ route('admin.reports.index') }}" class="rounded-xl px-4 py-2 text-sm font-medium transition hover:bg-slate-100">Laporan</a>

                {{-- NAVIGASI KASIR --}}
                @else
                    <a href="{{ route('kasir.dashboard') }}" class="rounded-xl px-4 py-2 text-sm font-medium transition hover:bg-slate-100">Dashboard</a>
                    <a href="{{ route('kasir.transactions.create') }}" class="rounded-xl px-4 py-2 text-sm font-medium transition hover:bg-slate-100">Transaksi</a>
                    <a href="{{ route('kasir.reports.index') }}" class="rounded-xl px-4 py-2 text-sm font-medium transition hover:bg-slate-100">Laporan</a>
                @endif

            </nav>
            @endauth

            <div class="flex items-center gap-4">
                @auth
                    <div class="hidden sm:block text-right">
                        <p class="text-sm font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500 uppercase">{{ auth()->user()->role }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-800 shadow-md">
                            Logout
                        </button>
                    </form>
                @else
                    <span class="text-sm text-slate-500">Guest</span>
                @endauth
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-8">
        @yield('content')
    </main>
</body>
</html>