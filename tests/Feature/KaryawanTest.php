<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Karyawan;
use App\Models\User;

class KaryawanTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    // Positive Testing

    public function test_can_create_karyawan()
    {
        // Menonaktifkan middleware untuk verifikasi CSRF
        $this->withoutMiddleware();

        $response = $this->post('/karyawans', [
            'nama' => 'John Doe',
            'jabatan' => 'Manager',
            'gaji' => 5000000,
        ]);

        $response->assertStatus(302); // Redirected after successful creation

        $this->assertCount(1, Karyawan::all());
    }

    public function test_can_read_karyawan()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $karyawan = Karyawan::factory()->create();

        $response = $this->get('/karyawans');

        $response->assertSee($karyawan->nama);
        $response->assertSee($karyawan->jabatan);
        $response->assertSee($karyawan->gaji);
    }

    public function test_can_update_karyawan()
    {
        // Buat data awal karyawan menggunakan factory
        $karyawan = Karyawan::factory()->create([
            'nama' => 'Initial Name',
            'jabatan' => 'Initial Jabatan',
            'gaji' => 5000000,
        ]);

        // Lakukan tindakan sebagai user
        $user = User::factory()->create();

        $this->actingAs($user);

        // Kirim permintaan update menggunakan ID dari karyawan yang baru dibuat
        $response = $this->put('/karyawans/' . $karyawan->id, [
            'nama' => 'Updated Name',
            'jabatan' => 'Updated Jabatan',
            'gaji' => 6000000,
        ]);

        // Pastikan tidak ada kesalahan dan diarahkan setelah update berhasil
        $response->assertSessionHasNoErrors()
            ->assertRedirect('/karyawans');

        // Refresh model untuk mengambil data terbaru dari database
        $karyawan->refresh();

        // Assert bahwa data telah diupdate dengan benar
        $this->assertSame('Updated Name', $karyawan->nama);
        $this->assertSame('Updated Jabatan', $karyawan->jabatan);
        $this->assertSame(6000000, $karyawan->gaji);
    }

    public function test_can_delete_karyawan()
    {
        // Buat data awal karyawan menggunakan factory
        $karyawan = Karyawan::factory()->create();

        // Lakukan tindakan sebagai user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Kirim permintaan delete menggunakan ID dari karyawan yang baru dibuat
        $response = $this->from('/karyawans')
            ->delete('/karyawans/' . $karyawan->id);

        // Pastikan tidak ada kesalahan dan diarahkan setelah delete berhasil
        $response->assertSessionHasNoErrors()
            ->assertRedirect('/karyawans');

        // Pastikan karyawan tidak ada lagi di database
        $this->assertNull(Karyawan::find($karyawan->id));
    }

    // Negative Testing

    public function test_cannot_create_karyawan_without_required_fields()
    {
        // Menonaktifkan middleware untuk verifikasi CSRF
        $this->withoutMiddleware();

        $response = $this->post('/karyawans', []);

        // Harus menghasilkan status 302 karena validasi gagal dan akan dialihkan kembali
        $response->assertStatus(302);

        // Pastikan tidak ada data yang disimpan dalam database
        $this->assertCount(0, Karyawan::all());
    }

    public function test_cannot_read_nonexistent_karyawan()
    {
        // Lakukan tindakan sebagai user
        $user = User::factory()->create();

        $this->actingAs($user);

        // Kirim permintaan untuk membaca karyawan dengan ID yang tidak ada
        $response = $this->get('/karyawans/999');

        // Harus menghasilkan status 404 karena karyawan yang diminta tidak ditemukan
        $response->assertStatus(404);
    }

    public function test_cannot_update_karyawan_without_required_fields()
    {
        // Buat data awal karyawan menggunakan factory
        $karyawan = Karyawan::factory()->create();

        // Lakukan tindakan sebagai user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Kirim permintaan update tanpa menyediakan data yang diperlukan
        $response = $this->put('/karyawans/' . $karyawan->id, []);

        // Harus menghasilkan status 302 karena validasi gagal dan akan dialihkan kembali
        $response->assertStatus(302);

        // Pastikan data karyawan tidak berubah
        $this->assertEquals($karyawan->nama, Karyawan::first()->nama);
        $this->assertEquals($karyawan->jabatan, Karyawan::first()->jabatan);
        $this->assertEquals($karyawan->gaji, Karyawan::first()->gaji);
    }

    public function test_cannot_delete_nonexistent_karyawan()
    {
        // Lakukan tindakan sebagai user
        $user = User::factory()->create();
        $this->actingAs($user);

        // Kirim permintaan delete menggunakan ID karyawan yang tidak ada
        $response = $this->delete('/karyawans/999');

        // Harus menghasilkan status 404 karena karyawan yang akan dihapus tidak ditemukan
        $response->assertStatus(404);
    }
}