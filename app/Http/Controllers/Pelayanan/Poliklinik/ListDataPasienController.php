<?php

namespace App\Http\Controllers\Pelayanan\Poliklinik;

use Carbon\Carbon;
use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\Antrean;
use App\Models\Simrs\Dokter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SimRs\DokterService;
use App\Services\SimRs\PendaftaranService;

class ListDataPasienController extends Controller
{
    protected $view;
    protected $prefix;
    protected $rajal;
    protected $pasien;
    protected $antrean;
    protected $pendaftaranService;
    protected $dokterService;

    public function __construct(Rajal $rajal)
    {
        $this->rajal = $rajal;
        $this->view = 'pages.kunjungan.poliklinik.';
        $this->prefix = 'Pasien';
        $this->pasien = new Pasien;
        $this->antrean = new Antrean();
        $this->dokterService = new DokterService();
        $this->pendaftaranService = new PendaftaranService();
    }

    public function index(Request $request)
    {
        $title = 'List Pasien Poliklinik';

        $showForm = false;

        $kodeDokter = $request->input('kode_dokter');

        $dateNow = date('Y-m-d');


        $pasiens = collect();

        if (auth()->user()->hasRole('super-admin')) {
            // Super Admin: Mendapatkan semua data dokter spesialis
            $dokters = $this->dokterService->byDokterSpesialis();
            $showForm = true;
            if ($kodeDokter) {
                $pasiens = $this->pendaftaranService->listPasien($kodeDokter, $dateNow);
            }
        } elseif (auth()->user()->hasRole('perawat poli')) {
            // Perawat Poli: Mendapatkan daftar dokter spesialis
            $dokters = $this->dokterService->byDokterSpesialis();
            $showForm = true;
            if ($kodeDokter) {
                $pasiens = $this->pendaftaranService->listPasien($kodeDokter, $dateNow);
            }
        } elseif (auth()->user()->hasRole('dokter')) {
            // Dokter: Ambil data berdasarkan dokter yang login
            $dokters = collect();
            $kodeDokter = auth()->user()->username;
            $pasiens = $this->pendaftaranService->listPasien($kodeDokter, $dateNow);
        } else {
            // Jika user tidak memiliki role yang dikenali, kosongkan hasil
            $dokters = collect();
            $pasiens = collect();
        }


        return view($this->view . 'index', compact('title', 'dokters', 'showForm', 'pasiens'));
    }
}
