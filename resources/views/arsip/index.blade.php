<x-app-layout>
    <x-slot name="header">
        Arsip Bidang: {{ $category->name }}
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow-sm">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">Daftar Dokumen {{ $category->name }}</h3>
            <!-- Tombol Tambah (nanti kita buat fungsinya) -->
            <a href="{{ route('arsip.create', $category->slug) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 inline-block relative z-10">
            + Unggah Arsip
            </a>
        </div>
        <div class="mt-4 mb-4">
            <form method="GET" action="{{ route('arsip.index', $category->slug) }}" class="flex">
                <input type="text" name="cari" value="{{ request('cari') }}" placeholder="Cari judul dokumen atau nomor surat..." class="border-gray-300 rounded-l px-4 py-2 w-full max-w-md focus:ring-blue-500">
                 <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-r hover:bg-gray-900">🔍 Cari</button>
            </form>
        </div>

        <table class="w-full border-collapse border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-200 px-4 py-2 text-left">No. Arsip</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Judul</th>
                    <th class="border border-gray-200 px-4 py-2 text-left">Tanggal</th>
                    <th class="border border-gray-200 px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($archives as $archive)
                    <tr>
                        <td class="border border-gray-200 px-4 py-2">{{ $archive->archive_number }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $archive->title }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $archive->archive_date }}</td>
                        <td class="border border-gray-200 px-4 py-2 text-center flex justify-center space-x-2">
                            <a href="{{ route('arsip.download', $archive->id) }}" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                            Unduh
                            </a>
                            <form action="{{ route('arsip.destroy', $archive->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus dokumen arsip ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-gray-500 py-4">Belum ada arsip di kategori ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>