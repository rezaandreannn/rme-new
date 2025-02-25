@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="">Kunjungan</a></div>
                <div class="breadcrumb-item"><a href="">Poliklinik</a></div>
                <div class="breadcrumb-item">{{ $title ?? ''}}</div>
            </div>
        </div>

        <div class="section-body">
            {{-- <div class="card card-primary">
                <form id="filterForm" action="" method="get">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="kode_dokter">Pilih Dokter</label>
                                    <select class="form-control select2" id="kode_dokter" name="kode_dokter">
                                        <option value="" selected disabled>-- silahkan pillih --</option>
                                        @foreach ($dokters as $dokter)
                                        <option value="{{ $dokter->kode_dokter }}" {{ request('kode_dokter') == $dokter->kode_dokter ? 'selected' : '' }}>{{ $dokter->nama_dokter }}</option>
            @endforeach
            </select>
        </div>
</div>
<div class="col-md-4 filter-buttons">
    <div class="form-group d-flex align-items-end">
        <button type="submit" class="btn btn-primary mr-2" style="margin-top: 30px;"><i class="fas fa-search"></i> Search</button>
        <button type="button" class="btn btn-danger" style="margin-top: 30px;" onclick="resetForm()"><i class="fas fa-sync"></i> Reset</button>
    </div>
</div>
</div>
</div>
</form>
</div> --}}
<div class="card">
    <div class="card-body">
        {{-- cek loginnya sebgai user apa --}}
        @if($showForm)
        <div class="row">
            <div class="col-12 col-md-6">
                <form id="filterForm" action="" method="get">
                    <div class="form-group">
                        <div class="input-group">
                            <select class="form-control-sm selectric" id="kode_dokter" name="kode_dokter">
                                <option value="" selected disabled>-- Pilih Dokter --</option>
                                @foreach ($dokters as $dokter)
                                <option value="{{ $dokter->kode_dokter }}" {{ request('kode_dokter') == $dokter->kode_dokter ? 'selected' : '' }}>
                                    {{ $dokter->nama_dokter }}
                                </option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-primary btn-sm" type="submit">
                                    <i class="fa-solid fa-filter"></i> <span class="d-none d-sm-inline"> Filter</span>
                                </button>
                                <button class="btn btn-secondary btn-sm" type="button" onclick="resetForm()">
                                    <i class="fas fa-sync"></i> <span class="d-none d-sm-inline"> Reset</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
        <div class="table-responsive">
            <table class="table-striped table" id="table-1">
                <thead>
                    <tr>
                        <th scope="col">No Antri</th>
                        <th scope="col">No MR</th>
                        <th scope="col">Nama Pasien</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Periksa</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pasiens as $pasien)
                    <tr>
                        <td class="text-center" width="5%">
                            <span class="badge badge-pill badge-primary">{{ $pasien->nomor_antrean }}</span>
                        </td>
                        <td>{{ $pasien->no_mr ??''}}</td>
                        <td>{{ $pasien->nama_pasien ??''}}</td>
                        <td>{{ $pasien->Alamat ??''}}</td>
                        <td>
                            {{-- @if($item->FS_STATUS == '')
                                        <div class="badge badge-warning text-white">Perawat</div>
                                        @elseif($item->FS_STATUS == '1')
                                        <div class="badge badge-danger">Dokter</div>
                                        @elseif($item->FS_STATUS == '2')
                                        @if($item->FS_TERAPI == '' or $item->FS_TERAPI == '<p>-</p>')
                                        <div class="badge badge-success">Selesai</div>
                                        @else
                                        <div class="badge badge-info">Farmasi</div>
                                        @endif
                                        @endif --}}
                        </td>
                        <td width="40%">
                            {{-- @if($item->FS_STATUS != '')
                                        <a href="{{ route('rj.edit', $item->No_Reg )}}" class="btn btn-sm btn-primary"><i class="fas fa-notes-medical"></i> Edit</a>
                            @else
                            <a href="{{ route('poliklinik.entry', $item->No_Reg )}}" class="btn btn-sm btn-primary"><i class="fas fa-notes-medical"></i> Entry</a>
                            @endif --}}
                            detail
                        </td>

                    </tr>
                    @empty

                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('library/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('library/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>

<script>
    function resetForm() {
        document.getElementById("filterForm").value = "";
        alert('Filter telah direset!');
        window.location.href = "{{ route('pelayanan.poliklinik.list-px') }}";
    }

</script>

@endpush
