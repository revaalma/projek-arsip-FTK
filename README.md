# Sistem Informasi Manajemen Arsip - Fakultas Teknologi Kelautan (FTK) ITS

Aplikasi web internal berbasis Laravel untuk mengelola, mengarsipkan, dan memonitoring dokumen/surat di lingkungan Fakultas Teknologi Kelautan (FTK) Institut Teknologi Sepuluh Nopember (ITS).

## Fitur Utama
- **Autentikasi Admin:** Keamanan berbasis *username* login khusus admin internal FTK.
- **Manajemen Kategori Arsip:** Pengelolaan dokumen berdasarkan 4 bidang utama:
  1. Pendidikan
  2. Keuangan
  3. SDM & Organisasi
  4. Kerjasama & Kealumnian
- **CRUD Arsip Dokumen:** Unggah (upload), unduh (download) aman, dan hapus dokumen (PDF/Word).
- **Pencarian Cepat:** Fitur cari dokumen berdasarkan nomor arsip atau judul surat.
- **Modul Laporan:** Rekapitulasi arsip berdasarkan rentang tanggal dengan fitur cetak/simpan PDF.

## Tech Stack
- **Framework:** Laravel (PHP)
- **Styling:** Tailwind CSS & Blade Templates
- **Database:** MySQL
- **Server Storage:** Private Local Storage (`storage/app/arsip`)

---
*Dikembangkan selama kegiatan magang di Fakultas Teknologi Kelautan (FTK) ITS.*