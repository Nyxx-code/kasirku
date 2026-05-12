@extends('layouts.auth')

@section('title', 'Login')
@section('heading', 'Masuk ke Sistem')

@section('content')
    <form action="{{ route('login.submit') }}" method="post" class="grid gap-4">
        @csrf
        <label class="grid gap-2 text-sm">
            Email
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="rounded-lg border px-3 py-2 placeholder:text-slate-400"
                placeholder="Masukkan email Anda"
                autocomplete="off"
                required
            />
        </label>
        <label class="grid gap-2 text-sm">
            Password
            <input
                type="password"
                name="password"
                class="rounded-lg border px-3 py-2 placeholder:text-slate-400"
                placeholder="Masukkan password Anda"
                autocomplete="off"
                required
            />
        </label>
        <button class="mt-2 rounded-lg bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
            Masuk
        </button>
    </form>
@endsection
