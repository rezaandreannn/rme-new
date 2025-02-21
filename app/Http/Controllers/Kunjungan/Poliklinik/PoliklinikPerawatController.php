<?php

namespace App\Http\Controllers\Kunjungan\Poliklinik;

use App\Models\Rajal;
use App\Models\Pasien;
use App\Models\Antrean;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PoliklinikPerawatController extends Controller
{
    protected $view;
    protected $prefix;
    protected $rajal;
    protected $pasien;
    protected $antrean;

    public function __construct(Rajal $rajal)
    {
        $this->rajal = $rajal;
        $this->view = 'pages.kunjungan.poliklinik.';
        $this->prefix = 'Pasien';
        $this->pasien = new Pasien;
        $this->antrean = new Antrean();
    }

    public function index(Request $request)
    {
        $title = $this->prefix . ' ' . 'Poliklinik';
        $kode_dokter = $request->input('kode_dokter');

        $dokters = $this->rajal->byKodeDokter();
        $data = $this->antrean->getDataPasienRajal($kode_dokter);

        return view($this->view . 'index', compact('title', 'data', 'dokters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function entry($noReg)
    {
        $title = $this->prefix . ' ' . 'Detail';
        $biodata = $this->rajal->pasien_bynoreg($noReg);

        return view($this->view . 'entry', compact('title', 'biodata'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
