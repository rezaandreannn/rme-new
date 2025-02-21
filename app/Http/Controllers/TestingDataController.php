<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SimRs\DokterService;
use App\Services\Emr\PenunjangService;
use App\Services\SimRs\PendaftaranService;

class TestingDataController extends Controller
{
    
    protected $dokterService;
    protected $pendaftaranService;
    protected $penunjangService;
 


    public function __construct()
    {
       
        $this->dokterService = new DokterService();
        $this->pendaftaranService = new PendaftaranService();
        $this->penunjangService = new PenunjangService();
       
    }

    public function index(Request $request)
    {
        //
        $kode_dokter = $request->input('kode_dokter');
        $tanggal = $request->input('tanggal');
        $dokters = $this->dokterService->byDokterSpesialis();
        $pasiens = $this->pendaftaranService->listPasien($kode_dokter, $tanggal);
  
        dd($pasiens);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  data penunjang EMR
    public function create($noReg)
    {
        // dd('ok penunjang');
        //
        // penunjang lab radioologi dan resep

        $resep = $this->penunjangService->resep($noReg);
        $labs = $this->penunjangService->lab($noReg);
        $rads = $this->penunjangService->radiologi($noReg);
        dd($rads);

        // penunjang lab radioologi dan resep
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
