@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<!-- Select -->
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('ttd/css/jquery.signature.css') }}">

<style>
    .kbw-signature {
        width: 100%;
        height: 250px;
    }
    
    .eye-image {
         max-width: 100%;
         }
     .custom-judul{
         font-size: 18px;
         padding-left: 20px;
         color: #6777ef;
         margin-bottom: 0;
         width: 100%;
     }
     .no-margin {
         margin: 0;
     }
     .no-padding {
             padding: 0;
     }
     .align-items-center {
             display: flex;
             align-items: center;
             margin: 0;
     }
     @media (max-width: 768px) {
             .text-right-mobile {
                 text-align: right;
                 font-size: 6px;
             }
             .text-left-mobile {
                 text-align: left;
                 font-size: 6px;
             }
             .eye-image {
                 max-width:100px;
             }
             .my-mobile {
                 margin-top: 2rem !important;
                 margin-bottom: 1rem !important;
             }
            .kbw-signature {
                width: 100%;
                height: 250px;
            }
        }
        .my-0 {
                margin-top: -10px !important;
                margin-bottom: 0 !important;
        }
        .my-1 {
                margin-bottom: -30px !important;
        }
 </style>
<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Kondisi Pulang</a></div>
                <div class="breadcrumb-item">Rujuk Internal RS</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <!-- components biodata pasien by no reg -->
                    @include('components.biodata-pasien-bynoreg')
                    <form id="myForm" action="{{ route('kondisiPulang.rujukLuarUpdate', $rujuk->FS_KD_REG) }}" method="POST">
                        @csrf
                        @method('put')
                    <div class="card card-secondary">
                        <div class="card-header card-success">
                            <h4 class="card-title">EDIT SURAT RUJUKAN LUAR RS</h4>
                        </div>
                        <!-- include form -->
                        <div class="card-body">
                            <!-- <div class="row"> -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="FS_TUJUAN_RUJUKAN">Kepada : <code>* Wajib Diisi</code></label>
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="FS_KD_REG" value="{{ $rujuk->FS_KD_REG }}" />
                                        <input type="text" class="form-control" name="FS_TUJUAN_RUJUKAN" value="{{ $rujuk->FS_TUJUAN_RUJUKAN }}" id="FS_TUJUAN_RUJUKAN">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="FS_TUJUAN_RUJUKAN2">Rumah Sakit Tujuan : <code>* Wajib Diisi</code></label>
                                <div class="input-group mb-3">
                                    <input type="text" name="FS_TUJUAN_RUJUKAN2" value="{{ $rujuk->FS_TUJUAN_RUJUKAN2 }}" id="FS_TUJUAN_RUJUKAN2" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="FS_ALASAN_RUJUK">Alasan Dirujuk : <code>* Wajib Diisi</code></label>
                                <div class="input-group mb-3">
                                    <textarea class="form-control" rows="3" name="FS_ALASAN_RUJUK" id="FS_ALASAN_RUJUK" placeholder="Masukan ...">{{ $rujuk->FS_ALASAN_RUJUK }}</textarea>
                                </div>
                            </div>
                            <!-- </div> -->
                        </div>
                        <!-- include form -->
                    </div>
                    <div class="text-left">
                        {{-- <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button> --}}
                        {{-- <a href="{{ route('poliMata.assesmenAwal', ['noReg' => $biodata->NO_REG]) }}" class="btn btn-primary mb-2"><i class="fas fa-save"></i>Simpan</a> --}}
                        <button type="submit" class="btn btn-primary mb-2"> <i class="fas fa-save"></i> Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.min.js') }}"></script>
<script src="{{ asset('ttd/js/jquery.signature.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#myForm input').on('keypress', function(event) {
            if (event.which === 13) {
                event.preventDefault(); // Mencegah pengiriman form
            }
        });
    });
</script>

@endpush