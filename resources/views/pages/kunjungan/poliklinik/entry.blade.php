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
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">{{ $biodata->NAMA_PASIEN }} - ({{ $biodata->NO_MR }})</h5>
                    <div class="card-header-action">
                        <a data-collapse="#detail" class="btn btn-info btn-sm p-0 d-flex align-items-center justify-content-center" 
                           style="width: 30px; height: 30px; border-radius: 50%;">
                            <i class="fas fa-minus"></i>
                        </a>
                    </div>
                </div>
                <div class="collapse show" id="detail">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                @php
                                    use Carbon\Carbon;
                                    $dateOfBirth = Carbon::parse($biodata->TGL_LAHIR);
                                    $age = $dateOfBirth->age;
                                @endphp
            
                                @foreach ([
                                    'Rekanan' => $biodata->NAMAREKANAN ?? '',
                                    'Tanggal Lahir' => date('d-m-Y', strtotime($biodata->TGL_LAHIR)),
                                    'Jenis Kelamin' => $biodata->JENIS_KELAMIN == 'L' ? 'Laki-Laki' : 'Perempuan',
                                    'Umur' => $age . ' tahun',
                                    'Alamat' => $biodata->ALAMAT ?? '',
                                    'Nama Dokter' => $biodata->NAMA_DOKTER ?? ''
                                ] as $label => $value)
                                <div class="row">
                                    <div class="col-sm-4 col-5 font-weight-bold text-sm">{{ $label }}</div>
                                    <div class="col-sm-8 col-7">: {{ $value }}</div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-primary">Riwayat Medis Pasien</h5>
                    <div class="card-header-action">
                        <a data-collapse="#mycard-collapse" class="btn btn-info btn-sm p-0 d-flex align-items-center justify-content-center" 
                           style="width: 30px; height: 30px; border-radius: 50%;">
                            <i class="fas fa-minus"></i>
                        </a>
                    </div>
                </div>
                <div class="collapse" id="mycard-collapse">
                  <div class="card-body">
                    <div class="row">
                      <!-- Sidebar List -->
                      <div class="col-lg-2 col-md-3 col-sm-4 col-12 mb-3">
                        <div class="list-group" id="list-tab" role="tablist">
                          <a class="list-group-item list-group-item-action active" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab">Rawat Jalan</a>
                          <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab">Rawat Inap</a>
                          <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab">Rawat Darurat</a>
                          <a class="list-group-item list-group-item-action" data-toggle="list" href="#list-operasi" role="tab">Operasi</a>
                          <a class="list-group-item list-group-item-action" data-toggle="list" href="#list-lab" role="tab">Laboratorium</a>
                          <a class="list-group-item list-group-item-action" data-toggle="list" href="#list-radiologi" role="tab">Radiologi</a>
                        </div>
                      </div>
                      <!-- Main Content -->
                      <div class="col-lg-10 col-md-9 col-sm-8 col-12">
                        <div class="tab-content" id="nav-tabContent">
                          <div class="tab-pane fade show active" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                            <div class="row">
                              <div class="accordion accordion-rawatjalan w-100">
                                @for ($i = 1; $i <= 3; $i++)
                                <div class="accordion-item mb-2">
                                  <div class="accordion-header" role="button" data-toggle="collapse" data-target=".rawatjalan-panel-{{ $i }}" aria-expanded="true">
                                    <h5>Panel {{ $i }}</h5>
                                  </div>
                                  <div class="accordion-body collapse @if($i == 1) show @endif rawatjalan-panel-{{ $i }}">
                                    <div class="table-responsive">
                                      <table class="table table-bordered table-sm">
                                        <thead>
                                          <tr>
                                            <th>#</th>
                                            <th>Tanggal</th>
                                            <th>Dokter</th>
                                            <th>SOAP</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>1</td>
                                            <td>2017-01-09</td>
                                            <td>Dr Toumi</td>
                                            <td></td>
                                            <td><div class="badge badge-success">Rawat Jalan</div></td>
                                            <td><a href="#" class="btn btn-sm btn-secondary">Detail</a></td>
                                          </tr>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                                @endfor
                              </div>
                            </div>
                          </div>
              
                          <!-- Tab Pane Placeholder -->
                          <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list"></div>
                          <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                            <p>Lorem ipsum dolor sit amet...</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
              
            <!-- Tutup Detail Pasien -->
            <div class="row">
              <div class="col-12">
                <div class="card card-primary">
                  <div class="card-header">
                    <h4>List Pasien</h4>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-12 col-lg-8 offset-lg-2">
                        <div class="wizard-steps">
                          <div class="wizard-step wizard-step-active" data-step="1">
                            <div class="wizard-step-icon">
                              <i class="fas fa-book"></i>
                            </div>
                            <div class="wizard-step-label">Riwayat</div>
                          </div>
                          <div class="wizard-step" data-step="2">
                            <div class="wizard-step-icon">
                              <i class="fas fa-stethoscope"></i>
                            </div>
                            <div class="wizard-step-label">Asesmen</div>
                          </div>
                          <div class="wizard-step" data-step="3">
                            <div class="wizard-step-icon">
                              <i class="fas fa-vial"></i>
                            </div>
                            <div class="wizard-step-label">Penunjang</div>
                          </div>
                          <div class="wizard-step" data-step="4">
                            <div class="wizard-step-icon">
                              <i class="fas fa-briefcase-medical"></i>
                            </div>
                            <div class="wizard-step-label">Tindakan</div>
                          </div>
                          <div class="wizard-step" data-step="5">
                            <div class="wizard-step-icon">
                              <i class="fas fa-notes-medical"></i>
                            </div>
                            <div class="wizard-step-label">Resep</div>
                          </div>
                          <div class="wizard-step" data-step="6">
                            <div class="wizard-step-icon">
                              <i class="fas fa-check"></i>
                            </div>
                            <div class="wizard-step-label">Selesai</div>
                          </div>
                        </div>
                      </div>
                    </div>
                       <!-- Step 1 -->
                       <div class="wizard-pane" data-step="1">
                        <div class="col-12 col-md-12">
                            <div class="table-responsive">
                              <table class="table table-bordered table-md">
                                  <tr>
                                    <th>#</th>
                                    <th>Tanggal</th>
                                    <th>Dokter</th>
                                    <th>Subjective, Objective, Assesment, Planning</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>2017-01-09</td>
                                    <td>Dr Toumi</td>
                                    <td></td>
                                    <td><div class="badge badge-success">Rawat Jalan</div></td>
                                    <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                  </tr>
                              </table>
                            </div>
                        </div>
                        <div class="text-right">
                          <button type="button" class="btn btn-primary next-step">Next <i class="fas fa-arrow-right"></i></button>
                        </div>
                      </div>
                      <!-- Step 2 -->
                      <div class="wizard-pane active" data-step="2">
                        <form action="">
                            <div class="form-group">
                                <label>Anamnesa</label>
                                <textarea class="form-control" name="" id=""></textarea>
                              </div>
                              <div class="form-group">
                                <label>Pemeriksaan Fisik</label>
                                <textarea class="form-control" name="" id=""></textarea>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Tinggi Badan</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control phone-number">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        CM
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>  
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Berat Badan</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control phone-number">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        Kg
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>   
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Nadi</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control phone-number">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          x/menit
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Tekanan Darah</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control phone-number">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          mmHg
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>                 
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Suhu</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control phone-number">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                         C
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Respirasi</label>
                                    <div class="input-group">
                                      <input type="text" class="form-control phone-number">
                                      <div class="input-group-prepend">
                                        <div class="input-group-text">
                                          x/menit
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="text-right">
                                <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left"></i> Previous</button>
                                <button type="button" class="btn btn-primary next-step">Next <i class="fas fa-arrow-right"></i></button>
                              </div>
                        </form>
                      </div>
                      <!-- Step 3 -->
                      <div class="wizard-pane" data-step="3">
                        <h4>Penunjang Form</h4>
                        <div class="text-right">
                          <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left"></i> Previous</button>
                          <button type="button" class="btn btn-primary next-step">Next <i class="fas fa-arrow-right"></i></button>
                        </div>
                      </div>
                      <!-- Step 4 -->
                      <div class="wizard-pane" data-step="4">
                        <h4>Tindakan Form</h4>
                        <div class="text-right">
                          <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left"></i> Previous</button>
                          <button type="button" class="btn btn-primary next-step">Next <i class="fas fa-arrow-right"></i></button>
                        </div>
                      </div>
                      <!-- Step 5 -->
                      <div class="wizard-pane" data-step="5">
                        <h4>Resep Form</h4>
                        <div class="text-right">
                          <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left"></i> Previous</button>
                          <button type="button" class="btn btn-primary next-step">Next <i class="fas fa-arrow-right"></i></button>
                        </div>
                      </div>
                      <!-- Step 6 -->
                      <div class="wizard-pane" data-step="6">
                        <h4>Selesai</h4>
                        <p>Semua data telah selesai diisi.</p>
                        <div class="text-right">
                          <button type="button" class="btn btn-secondary prev-step"><i class="fas fa-arrow-left"></i> Previous</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>
                  </div>
                </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
      const nextButtons = document.querySelectorAll('.next-step');
      const prevButtons = document.querySelectorAll('.prev-step');
      const steps = document.querySelectorAll('.wizard-step');
      const panes = document.querySelectorAll('.wizard-pane');
      let currentStep = 1;
  
      function showStep(step) {
        panes.forEach(pane => {
          pane.classList.toggle('active', parseInt(pane.dataset.step) === step);
        });
        steps.forEach(wizardStep => {
          wizardStep.classList.toggle('wizard-step-active', parseInt(wizardStep.dataset.step) === step);
        });
      }
  
      nextButtons.forEach(button => {
        button.addEventListener('click', function () {
          if (currentStep < steps.length) {
            currentStep++;
            showStep(currentStep);
          }
        });
      });
  
      prevButtons.forEach(button => {
        button.addEventListener('click', function () {
          if (currentStep > 1) {
            currentStep--;
            showStep(currentStep);
          }
        });
      });
  
      showStep(currentStep);
    });
  </script>
  
  <style>
    .wizard-pane {
      display: none;
    }
    .wizard-pane.active {
      display: block;
    }
  </style>

@endpush