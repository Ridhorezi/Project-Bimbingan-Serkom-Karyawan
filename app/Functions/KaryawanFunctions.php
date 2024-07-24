<?php

namespace App\Functions;

use App\Models\Karyawan;

class KaryawanFunctions
{
    // Fungsi: Mengecek Apakah Karyawan dengan Nama Tertentu Ada di Database
    public function checkKaryawanExists($nama)
    {
        return Karyawan::where('nama', $nama)->exists();
    }

    // Fungsi: Mengambil Karyawan Berdasarkan ID
    public function getKaryawanById($id)
    {
        return Karyawan::find($id);
    }
}
