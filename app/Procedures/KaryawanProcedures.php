<?php

namespace App\Procedures;

use App\Models\Karyawan;

class KaryawanProcedures
{
    // Prosedur: Menambahkan Karyawan
    public function addKaryawan($data)
    {
        return Karyawan::create($data);
    }

    // Prosedur: Mengambil Semua Karyawan
    public function getAllKaryawans()
    {
        return Karyawan::all();
    }

    // Prosedur: Mengupdate Karyawan
    public function updateKaryawan($karyawan, $data)
    {
        return $karyawan->update($data);
    }

    // Prosedur: Menghapus Karyawan
    public function deleteKaryawan($karyawan)
    {
        return $karyawan->delete();
    }
}


