<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Procedures\KaryawanProcedures;
use App\Functions\KaryawanFunctions;
use Illuminate\Http\Request;

// Membaca Logika Pemrograman Mengacu pada Kinerja Statement Akses (Operasi CRUD)

class KaryawanController extends Controller
{
    protected $procedures;
    protected $functions;

    public function __construct()
    {
        $this->procedures = new KaryawanProcedures();
        $this->functions = new KaryawanFunctions();
    }

    // Menentukan metode yang sesuai
    public function index(Request $request)
    {
        $search = $request->query('search');

        // Contoh field yang sesuai (Melakukan perbaikan).
        $sortField = $request->query('sortField', 'nama'); // Default sorting field

        $sortOrder = $request->query('sortOrder', 'asc'); // Default sorting order

        // mengambil data karyawan (Menerapkan Akses Basis Data di Laravel)
        $query = Karyawan::query();

        // Algoritma searching karyawan
        if ($search) {
            $query->where('nama', 'LIKE', "%{$search}%")
                ->orWhere('jabatan', 'LIKE', "%{$search}%");
        }

        // Algoritma searching karyawan simulasi bottleneck
        // if ($search) {
        //     $query->where(function ($q) use ($search) {
        //         // Menambahkan beberapa kondisi where untuk simulasi bottleneck
        //         for ($i = 0; $i < 1000; $i++) {
        //             $q->orWhere('nama', 'LIKE', "%{$search}%")
        //             ->orWhere('jabatan', 'LIKE', "%{$search}%");
        //         }
        //     });
        // }

        // Menggunakan prosedur untuk mendapatkan semua karyawan
        $karyawans = $this->procedures->getAllKaryawans();

        // Algoritma sorting pada query
        $karyawans = $query->orderBy($sortField, $sortOrder)->paginate(10);

        // var_dump($karyawans); // Menggunakan var_dump untuk debugging

        return view('karyawans.index', compact('karyawans', 'sortField', 'sortOrder'));
    }

    // Menentukan metode yang sesuai
    public function create()
    {
        return view('karyawans.create');
    }

    // Menentukan metode yang sesuai
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            // Menjelaskan tipe data sesuai kaidah pemrograman
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'gaji' => 'required|integer|min:0',
        ]);

        // Menjelaskan variable sesuai kaidah pemrograman
        $data = $request->except('_token');

        // Logika tambahan sebelum penyimpanan
        if (strlen($data['nama']) < 3) {
            return redirect()->back()->withErrors(['nama' => 'Nama terlalu pendek.']);
        }

        // Menyimpan Data ke Database (Menerapkan Akses Basis Data di Laravel)
        $this->procedures->addKaryawan($data);

        return redirect()->route('karyawans.index')->with('success', 'Karyawan created successfully.');
    }

    // Menentukan metode yang sesuai
    public function show(Karyawan $karyawan)
    {
        return view('karyawans.show', compact('karyawan'));
    }

    // Menentukan metode yang sesuai
    public function edit(Karyawan $karyawan)
    {
        return view('karyawans.edit', compact('karyawan'));
    }

    // Menentukan metode yang sesuai
    public function update(Request $request, Karyawan $karyawan)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'gaji' => 'required|integer|min:0',
        ]);

        // Menjelaskan variable sesuai kaidah pemrograman
        $data = $request->except('_token');

        // Logika tambahan sebelum penyimpanan
        if (strlen($data['nama']) < 3) {
            return redirect()->back()->withErrors(['nama' => 'Nama terlalu pendek.']);
        }

        // Mengupdate Data ke Database (Menerapkan Akses Basis Data di Laravel)
        $this->procedures->updateKaryawan($karyawan, $data);

        return redirect()->route('karyawans.index')->with('success', 'Karyawan updated successfully.');
    }

    // Menentukan metode yang sesuai
    public function destroy(Karyawan $karyawan)
    {
        // Menjelaskan variable sesuai kaidah pemrograman
        $this->procedures->deleteKaryawan($karyawan);

        return redirect()->route('karyawans.index')->with('success', 'Karyawan deleted successfully.');
    }
}
