<?php

// Menerapkan library akses basis data - Eloquent ORM (Menerapkan Akses Basis Data di Laravel)
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    // Menentukan keamanan
    protected $fillable = [
        'nama', 'jabatan', 'gaji', '_token',
    ];
}


// Menerapkan Akses Basis Data di Laravel


// Menyimpan Data ke Database
// Untuk menyimpan data ke tabel karyawans:

// use App\Models\Karyawan;
// $karyawan = new Karyawan();
// $karyawan->nama = 'John Doe';
// $karyawan->jabatan = 'Manager';
// $karyawan->gaji = 5000000;
// $karyawan->save();

// Mengambil Data dari Database

// Untuk mengambil semua data karyawan:
// $karyawans = Karyawan::all();

// Untuk mengambil satu karyawan berdasarkan ID:
// $karyawan = Karyawan::find($id);

// Memperbarui Data di Database

// Untuk memperbarui data karyawan:
// $karyawan = Karyawan::find($id);
// $karyawan->nama = 'Jane Doe';
// $karyawan->save();

// Menghapus Data dari Database
// Untuk menghapus data karyawan:
// $karyawan = Karyawan::find($id);
// $karyawan->delete();
