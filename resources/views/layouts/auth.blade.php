<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Login')</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <style>
            body{
                font-family: 'Poppins', sans-serif;
            }
        </style>
    </head>

    <body class="min-h-screen overflow-hidden bg-gradient-to-br from-slate-100 via-slate-200 to-slate-300">

        <!-- Background Blur -->
        <div class="absolute top-[-80px] left-[-80px] h-72 w-72 rounded-full bg-blue-300 opacity-30 blur-3xl"></div>

        <div class="absolute bottom-[-80px] right-[-80px] h-72 w-72 rounded-full bg-indigo-300 opacity-30 blur-3xl"></div>

        <!-- Container -->
        <main class="relative mx-auto flex min-h-screen items-center justify-center px-6 py-12">

            <div class="w-full max-w-md">

                <!-- Card -->
                <div class="rounded-3xl border border-white/30 bg-white/80 p-10 shadow-2xl backdrop-blur-lg">

                    <!-- Header -->
                    <div class="mb-8 text-center">

                        <!-- Logo -->
                        <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-slate-900 text-3xl text-white shadow-lg">
                            🛒
                        </div>

                        <p class="text-sm uppercase tracking-[0.3em] text-slate-500">
                            Sistem Penjualan
                        </p>

                        <h1 class="mt-3 text-3xl font-bold text-slate-800">
                            @yield('heading', 'Masuk')
                        </h1>

                        <p class="mt-2 text-sm text-slate-500">
                            Silakan login untuk melanjutkan
                        </p>

                    </div>

                    @if (session('status'))
                        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700 shadow-sm">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700 shadow-sm">

                            <div class="mb-2 font-semibold">
                                Terjadi kesalahan:
                            </div>

                            <ul class="list-disc space-y-1 pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif

                    <!-- Content -->
                    @yield('content')

                </div>

            </div>

        </main>

    </body>
</html>