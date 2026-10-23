<x-app-layout>
    <x-slot name="header">
        Unggah Arsip: {{ $category->name }}
    </x-slot>

    <div class="bg-white p-6 rounded-lg shadow-sm max-w-2xl">
        <form action="{{ route('arsip.store', $category->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nomor Arsip/Surat</label>
                <input type="text" name="archive_number" class="w-full border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Judul Dokumen</label>
                <input type="text" name="title" class="w-full border-gray-300 rounded" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal Dokumen</label>
                <input type="date" name="archive_date" class="w-full border-gray-300 rounded" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2">File (PDF/Word)</label>
                <input type="file" name="file" class="w-full" required accept=".pdf,.doc,.docx">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan Arsip</button>
            <a href="{{ route('arsip.index', $category->slug) }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </form>
    </div>
</x-app-layout>