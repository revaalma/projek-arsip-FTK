<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archive;
use App\Models\Category;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $archives = collect(); // Koleksi kosong sebagai nilai awal

        // Jika tombol filter diklik (ada input tanggal)
        if ($request->has('start_date') && $request->has('end_date')) {
            $query = Archive::whereBetween('archive_date', [$request->start_date, $request->end_date]);

            // Jika filter kategori tidak di set ke "Semua"
            if ($request->category_id != 'all') {
                $query->where('category_id', $request->category_id);
            }

            $archives = $query->latest()->get();
        }

        return view('laporan.index', compact('categories', 'archives'));
    }
}