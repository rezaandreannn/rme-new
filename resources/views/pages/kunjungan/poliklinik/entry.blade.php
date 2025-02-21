@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<!-- Select -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">



<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('rj.index') }}">Kunjungan</a></div>
                <div class="breadcrumb-item"><a href="{{ route('rj.index') }}">Poliklinik</a></div>
                <div class="breadcrumb-item">Detail Pasien</div>
            </div>
        </div>
        <div class="section-body">
            <!-- Detail Pasien -->
            @include('components.biodata-pasien-bynoreg')
            <!-- Tutup Detail Pasien -->
            <div class="card">
                <div class="card-body">
                  <div class="section-title">Menu</div>
                  <ul class="nav nav-pills">
                    <li class="nav-item">
                      <a class="nav-link active" href="#"> Assasmen Perawat</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#"> Assasmen Dokter</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#"> Lab</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#"> Resep</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#"> Radiologi</a>
                    </li>
                  </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- modal histori -->
    <div class="modal fade" id="modal-histori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Histori (SUPARNO BIN SUPARJO ) - (124411)</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="example1">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">Tgl Kunjungan</th>
                                        <th style="width: 30px">Dokter</th>
                                        <th style="width: 20px">Layanan</th>
                                        <th style="width: 20px">Catatan</th>
                                        <th style="width: 10px">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>26-03-2024</td>
                                        <td>dr. Agung B Prasetiyono, Sp.PD</td>
                                        <td>
                                            SPESIALIS PENYAKIT DALAM </td>
                                        <td> -</td>
                                        <td>
                                            <div class="badge badge-primary">
                                                Rawat Jalan
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>26-03-2024</td>
                                        <td>dr. Agung B Prasetiyono, Sp.PD</td>
                                        <td>
                                            SPESIALIS PENYAKIT DALAM </td>
                                        <td> -</td>
                                        <td>
                                            <div class="badge badge-primary">
                                                Rawat Jalan
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>26-03-2024</td>
                                        <td>dr. Agung B Prasetiyono, Sp.PD</td>
                                        <td>
                                            SPESIALIS PENYAKIT DALAM </td>
                                        <td> -</td>
                                        <td>
                                            <div class="badge badge-primary">
                                                Rawat Jalan
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-info" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>

<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    document.getElementById('td').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('suhu').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('nadi').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('bb').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('tb').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
    document.getElementById('respirasi').addEventListener('keypress', function(event) {
        const keyCode = event.keyCode;
        const allowedChars = /^[0-9+-/]*$/; // Regex untuk angka, tanda plus, dan tanda minus /

        if (!allowedChars.test(event.key)) {
            event.preventDefault();
        }
    });
</script>

<script type="text/javascript">
    function click1(selected) {
        var checkbox1 = selected.value
        $("#hasil_check1").html(checkbox1);
        score_skrining_asasmen_jatuh();
    }

    function click2(selected) {
        var checkbox2 = selected.value
        $("#hasil_check2").html(checkbox2);
        score_skrining_asasmen_jatuh();
    }

    function click3(selected) {
        var checkbox3 = selected.value
        $("#hasil_check3").html(checkbox3);
        score_skrining_asasmen_jatuh();
    }

    function sn1(selected) {
        var value1 = selected.value
        $("#hasil_sn1").html(value1);
        score_skrining_nutrisi();
    };

    function sn2(selected) {
        var value2 = selected.value
        $("#hasil_sn2").html(value2);
        score_skrining_nutrisi();
    };
</script>

<script type="text/javascript">
    // score skrining nutrisi
    function score_skrining_nutrisi() {
        var sn = parseInt($("#hasil_sn1").text()) + parseInt($("#hasil_sn2").text());
        $("#totalsn").html(sn);
        if (sn >= 2) {
            $("#kesimpulan_skrining_nutrisi").val("LAPORKAN KE DOKTER");
        } else if (sn < 2) {
            $("#kesimpulan_skrining_nutrisi").val("NORMAL");
        }
    }

    // score skrining asesmen jatuh
    function score_skrining_asasmen_jatuh() {
        var score_jatuh = parseInt($("#hasil_check1").text()) + parseInt($("#hasil_check2").text()) + parseInt($("#hasil_check3").text());
        $("#totalscore_jatuh").html(score_jatuh);

        if (score_jatuh >= 3) {
            $("#kesimpulan_asesmen_jatuh").val("RISIKO TINGGI");
        } else if (score_jatuh == 2) {
            $("#kesimpulan_asesmen_jatuh").val("RISIKO SEDANG");
        } else if (score_jatuh <= 1) {
            $("#kesimpulan_asesmen_jatuh").val("RISIKO RENDAH");
        }
    }
</script>

@endpush