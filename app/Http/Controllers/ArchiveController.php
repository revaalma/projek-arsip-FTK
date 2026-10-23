<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;
use App\Models\Category;

class ArchiveController extends Controller
{
    public function index(Request $request, $kategori)
    {
        $category = Category::where('slug', $kategori)->firstOrFail();
        
        // Memulai query pencarian data arsip
        $query = Archive::where('category_id', $category->id)->latest();

        // Jika ada input dari kolom pencarian
        if ($request->has('cari') && $request->cari != '') {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->cari . '%')
                  ->orWhere('archive_number', 'like', '%' . $request->cari . '%');
            });
        }

        $archives = $query->get();

        return view('arsip.index', compact('category', 'archives'));
    }

    // Fungsi untuk mengunduh file yang diproteksi
    public function download($id)
    {
        $archive = \App\Models\Archive::findOrFail($id);
        
        // Cari lokasi file aslinya di folder storage
        $path = storage_path('app/' . $archive->file_path);

        // Cek apakah file fisik benar-benar ada
        if (!file_exists($path)) {
            abort(404, 'File arsip tidak ditemukan di server.');
        }

        // Kembalikan file ke browser untuk di-download
        return response()->download($path, $archive->archive_number . ' - ' . $archive->title . '.' . pathinfo($path, PATHINFO_EXTENSION));
    }

    // Tambahkan ini di bawah fungsi index()

    public function create($kategori)
    {
        $category = Category::where('slug', $kategori)->firstOrFail();
        return view('arsip.create', compact('category'));
    }

    public function store(Request $request, $kategori)
    {
        $category = Category::where('slug', $kategori)->firstOrFail();

        $request->validate([
            'archive_number' => 'required|string',
            'title' => 'required|string',
            'archive_date' => 'required|date',
            'file' => 'required|mimes:pdf,doc,docx|max:10240', 
        ]);

        $filePath = $request->file('file')->store('arsip');

        Archive::create([
            'archive_number' => $request->archive_number,
            'title' => $request->title,
            'category_id' => $category->id,
            'file_path' => $filePath,
            'archive_date' => $request->archive_date,
        ]);

        return redirect()->route('arsip.index', $kategori)->with('success', 'Dokumen berhasil diunggah!');
    }

    public function destroy($id)
    {
        $archive = \App\Models\Archive::findOrFail($id);
        
        // Hapus file fisik PDF/Word dari folder storage
        if (\Illuminate\Support\Facades\Storage::exists($archive->file_path)) {
            \Illuminate\Support\Facades\Storage::delete($archive->file_path);
        }
        
        // Hapus data dari database
        $archive->delete();

        return back()->with('success', 'Dokumen berhasil dihapus.');
    }
}