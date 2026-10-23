<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arsip FTK ITS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100 flex h-screen overflow-hidden">

    <!-- SIDEBAR KIRI -->
    <aside class="w-64 bg-blue-900 text-white flex flex-col hidden md:flex">
        <div class="h-16 flex items-center justify-center border-b border-blue-800 font-bold text-xl">
            ARSIP FTK ITS
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('dashboard') }}" class="block px-4 py-2 rounded hover:bg-blue-800">🏠 Beranda</a>
            
            <div class="pt-4 pb-1 text-xs text-blue-300 uppercase font-bold">Kategori Arsip</div>
            <!-- Sub-menu Arsip -->
            <a href="{{ route('arsip.index', 'pendidikan') }}" class="block px-4 py-2 rounded hover:bg-blue-800 pl-6">📂 Pendidikan</a>
            <a href="{{ route('arsip.index', 'keuangan') }}" class="block px-4 py-2 rounded hover:bg-blue-800 pl-6">📂 Keuangan</a>
            <a href="{{ route('arsip.index', 'sdm-organisasi') }}" class="block px-4 py-2 rounded hover:bg-blue-800 pl-6">📂 SDM & Organisasi</a>
            <a href="{{ route('arsip.index', 'kerjasama-kealumnian') }}" class="block px-4 py-2 rounded hover:bg-blue-800 pl-6">📂 Kerjasama & Alumni</a>

            <div class="pt-4 pb-1 text-xs text-blue-300 uppercase font-bold">Lainnya</div>
            <a href="{{ route('laporan') }}" class="block px-4 py-2 rounded hover:bg-blue-800">📊 Laporan</a>
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded hover:bg-blue-800">⚙️ Pengaturan</a>
            
            <!-- Tombol Logout -->
            <form method="POST" action="{{ route('logout') }}" class="pt-8">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 rounded bg-red-600 hover:bg-red-700">🚪 Logout</button>
            </form>
        </nav>
    </aside>

    <!-- AREA KONTEN KANAN -->
    <div class="flex-1 flex flex-col h-screen overflow-y-auto">
        <!-- Header Atas (Opsional) -->
        <header class="h-16 bg-white shadow flex items-center px-6 justify-between">
            <h2 class="font-semibold text-gray-800">
                {{ $header ?? 'Dashboard Admin' }}
            </h2>
            <div class="text-sm text-gray-500">Halo, {{ Auth::user()->name }}</div>
        </header>

        <!-- Isi Konten Halaman -->
        <main class="p-6">
            {{ $slot }}
        </main>
    </div>

</body>
</html>