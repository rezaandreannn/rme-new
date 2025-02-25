<?php

namespace App\Services\Emr;

use Illuminate\Support\Facades\DB;

class PenunjangService
{
    public function resep($noReg)
    {
        $data = DB::connection('db_rsmm')
            ->table('TR_DETAIL_RESEP as a')
            ->join('TR_MASTER_RESEP as b', 'a.NO_RESEP', '=', 'b.NO_RESEP')
            ->join('OBAT as c', 'a.KODE_OBAT', '=', 'c.KODE_OBAT')
            ->join('SATUAN_OBAT as d', 'c.ID_SATUAN', '=', 'd.ID_SATUAN')
            ->where('b.NO_REG', $noReg)
            ->orderBy('c.Nama_Obat', 'ASC')
            ->get();
        return $data;
    }

    public function lab($noReg)
    {
        $data = DB::connection('db_rsmm')
            ->table('TR_MASTER_LAB as a')
            ->join('TR_DETAIL_LAB as b', 'b.Id_Lab', '=', 'a.Id_Lab')
            ->join('REGISTER_PASIEN as c', 'a.No_MR', '=', 'c.No_MR')
            ->join('LAB_HASIL as e', 'b.Kode_Hasil', '=', 'e.Kode_Hasil')
            ->join('DOKTER as f', 'a.Pengirim', '=', 'f.Kode_Dokter')
            ->select(
                'a.*',
                'b.Kode_Hasil',
                'b.Hasil',
                'b.Status',
                'c.Nama_Pasien',
                'e.Nilai_Normal',
                'e.Pemeriksaan',
                'f.Nama_Dokter',
            )
            ->where('a.No_Reg', $noReg)
            ->get();
        return $data;
    }

    public function radiologi($noReg)
    {
        $data = DB::connection('db_rsmm')
            ->table('TR_BIAYARINCI as a')
            ->leftJoin('TR_DETAIL_CATATANDOKTER as b', 'b.ID_BIAYA', '=', 'a.ID_BIAYA')
            ->join('M_RINCI_HEADER as c', 'c.NO_RINCI', '=', 'a.NO_RINCI')
            ->select(
                'a.*',
                'c.KET_TINDAKAN',
                'b.Ket'
            )
            ->where('a.NO_REG', $noReg)
            ->where('a.NO_RINCI', 'like', 'B%')
            ->get();

        return $data;
    }
}
