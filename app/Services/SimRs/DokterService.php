<?php

namespace App\Services\SimRs;

use App\Models\Simrs\Dokter;
use Illuminate\Support\Facades\DB;

class DokterService
{
    public function byBedahOperasi()
    {
        $params =  [
            'SPESIALIS BEDAH',
            'SPESIALIS KANDUNGAN',
            'SPESIALIS ORTHOPEDI',
            'SPESIALIS BEDAH MULUT',
            'SPESIALIS THT-KL',
            'SPESIALIS UROLOGI',
            'SPESIALIS BEDAH SARAF',
            'SPESIALIS MATA'
        ];
        return Dokter::whereIn('Spesialis', $params)->get();
    }

    public function allDokter()
    {
        $data = Dokter::where('Jenis_Profesi', 'DOKTER SPESIALIS')->get();
        return $data;
    }

    public function byCode($doctorCode)
    {
        return Dokter::where('Kode_Dokter', $doctorCode)->first();
    }

    public function byDokterSpesialis()
    {
        // First query for fisioterapi
        $fisioQuery = DB::connection('db_rsmm')
            ->table('DOKTER')
            ->select(
                'KODE_DOKTER as kode_dokter',
                'NAMA_DOKTER as nama_dokter'
            )
            ->where('Spesialis', 'FISIOTERAPI');

        // Second query for dokter spesialis
        $dokterQuery = DB::connection('db_rsmm')
            ->table('DOKTER')
            ->select(
                'KODE_DOKTER as kode_dokter',
                'NAMA_DOKTER as nama_dokter'
            )
            ->whereNotIn('KODE_DOKTER', ['140s', 'TM140', '01JKN'])
            ->where('JENIS_PROFESI', 'DOKTER SPESIALIS')
            ->orWhere('Kode_Dokter', '100');

        // Combine both queries using union
        $combinedQuery = $fisioQuery->union($dokterQuery);

        // Get the results as an array
        $data = $combinedQuery->get()->toArray();

        return $data;
    }
}
