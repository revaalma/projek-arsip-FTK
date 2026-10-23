<x-app-layout>
    <x-slot name="header">
        Laporan Arsip FTK ITS
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        
        <!-- Form Filter Tanggal (Bagian ini akan disembunyikan saat dicetak berkat class print:hidden) -->
        <form method="GET" action="{{ route('laporan') }}" class="mb-6 flex flex-wrap gap-4 items-end print:hidden bg-gray-50 p-4 rounded border">
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1">Dari Tanggal</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="border-gray-300 rounded text-sm" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1">Sampai Tanggal</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="border-gray-300 rounded text-sm" required>
            </div>
            <div>
                <label class="block text-gray-700 text-sm font-bold mb-1">Pilih Kategori</label>
                <select name="category_id" class="border-gray-300 rounded text-sm">
                    <option value="all">Semua Bidang</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700">Tampilkan</button>
            </div>
            
            <!-- Tombol Cetak hanya muncul jika ada data -->
            @if(count($archives) > 0)
            <div class="ml-auto">
                <button type="button" onclick="window.print()" class="bg-green-600 text-white px-4 py-2 rounded text-sm hover:bg-green-700">
                    🖨️ Cetak / Simpan PDF
                </button>
            </div>
            @endif
        </form>

        <!-- Tabel Hasil Laporan -->
        @if(request()->has('start_date'))
            <div class="mb-4 hidden print:block">
                <h2 class="text-xl font-bold text-center">LAPORAN ARSIP DOKUMEN FTK ITS</h2>
                <p class="text-center text-sm">Periode: {{ request('start_date') }} s/d {{ request('end_date') }}</p>
                <hr class="mt-2 border-black">
            </div>

            <table class="w-full border-collapse border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">No</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">No. Arsip</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Judul Dokumen</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Bidang</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($archives as $index => $archive)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $archive->archive_number }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $archive->title }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $archive->category->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $archive->archive_date }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada arsip yang ditemukan pada rentang tanggal tersebut.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @else
            <div class="text-center text-gray-500 py-10 print:hidden">
                <p>Silakan masukkan rentang tanggal di atas untuk menampilkan laporan.</p>
            </div>
        @endif
    </div>
</x-app-layout>