<?php

namespace App\Services\Operasi\ChecklistPembedahan;

use App\Models\Operasi\ChecklistPembedahan\SignIn;
use App\Models\Operasi\PostOperasi\AlatPostOperasi;
use App\Models\Operasi\PostOperasi\PemeriksaanFisikPostOperasi;
use App\Models\Operasi\PostOperasi\TindakanPostOperasi;
use Exception;
use Illuminate\Support\Facades\DB;

class ChecklistPembedahanSignOutService
{

    public function findById($kode_register)
    {

        return SignIn::where('kode_register', $kode_register)->first();
    }

    public function insert(array $data)
    {
        DB::beginTransaction();
        try {
            $sign = SignIn::create([
                'kode_register' => $data['kode_register'],
                'mata_pisau' => $data['mata_pisau'] ?? '',
                'mata_pisau_tambah' => $data['mata_pisau_tambah'] ?? '',
                'mata_pisau_total' => $data['mata_pisau_total'] ?? '',
                'jarum' => $data['jarum'] ?? '',
                'jarum_tambah' => $data['jarum_tambah'] ?? '',
                'jarum_total' => $data['jarum_total'] ?? '',
                'created_by' => auth()->user()->id
            ]);

            DB::commit();

            return $sign;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw new Exception("Gagal menambahkan Data Checklist Sign In: " . $th->getMessage());
        }
    }

    private function updateTable(string $modelClass, string $kodeRegister, array $fields)
    {
        // Fetch the existing record
        $record = $modelClass::where('kode_register', $kodeRegister)->first();

        // If no record exists, create a new one
        if (!$record) {
            $fields['kode_register'] = $kodeRegister;
            $modelClass::create($fields);
            return;
        }

        // Update the record only if there are changes
        $updatedFields = [];
        foreach ($fields as $key => $value) {
            if (array_key_exists($key, $record->getAttributes()) && $record->{$key} !== $value) {
                $updatedFields[$key] = $value;
            }
        }

        if (!empty($updatedFields)) {
            $record->update($updatedFields);
        }
    }


    public function update($kode_register, array $data)
    {
        DB::beginTransaction();
        try {

            // Update Table Tindakan Post Operasi
            $this->updateTable(SignIn::class, $kode_register, [
                'identitas_pasien' => $data['identitas_pasien'] ?? 0,
                'lokasi_operasi_pasien' => $data['lokasi_operasi_pasien'] ?? 0,
                'mesin_anestesi_lengkap' => $data['mesin_anestesi_lengkap'] ?? 0,
                'alergi_pasien' => $data['alergi_pasien'] ?? 0,
                'riwayat_asma_pasien' => $data['riwayat_asma_pasien'] ?? 0,
                'pemasangan_implant' => $data['pemasangan_implant'] ?? 0,
                'kehilangan_darah' => $data['kehilangan_darah'] ?? 0,
                'updated_by' => auth()->user()->id
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new Exception('Gagal memperbarui Data Post Operasi: ' . $e->getMessage());
        }
    }
}
