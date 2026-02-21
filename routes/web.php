<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\BukberController;

// 1. Halaman Utama Undangan
Route::get('/', [BukberController::class, 'index'])->name('invitation');

// 2. Proses Simpan RSVP (Gunakan name agar sesuai dengan form)
Route::post('/rsvp', [BukberController::class, 'store'])->name('rsvp.store');

// 3. Dashboard Admin (Saya kasih 'secret' dikit biar gak gampang ketebak orang luar)
// Aksesnya nanti: link-kamu.vercel.app/admin-izzatishot
Route::get('/admin-izzatishot', [BukberController::class, 'admin'])->name('admin.dashboard');

/**
 * KHUSUS UNTUK VERCEL (Karena tidak ada Terminal/SSH)
 * Tambahkan KEY agar tidak sembarang orang bisa mereset DB kamu.
 * Aksesnya nanti: link-kamu.vercel.app/gas-migrate/izzatishot123
 */
Route::get('/gas-migrate/{key}', function ($key) {
    if ($key !== 'izzatishot123') { // Ganti 'izzatishot123' dengan password bebas kamu
        return "Akses Ditolak! Key salah.";
    }

    try {
        // Menjalankan migration
        Artisan::call('migrate:fresh', [
            '--force' => true,
        ]);
        
        return "<h1>BERHASIL!</h1><p>Database dan tabel berhasil diinstall ulang di Aiven MySQL.</p>";
    } catch (\Exception $e) {
        return "Gagal Install: " . $e->getMessage();
    }
});

// Route Tambahan: Clear Cache (Penting di Vercel jika ganti kodingan tapi gak berubah)
Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Semua cache berhasil dihapus!";
});