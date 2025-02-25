@extends('layouts.app')

@section('title', $title)

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('library/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('library/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">

<!-- <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}"> -->
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('roles.index') }}">Manage User</a></div>
                <div class="breadcrumb-item">Role</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('roles.create')}}" class="btn btn-primary rounded-0">New Data</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-striped table" id="table-1">
                            <thead>
                                <tr>
                                    <th class="text-center">
                                        No
                                    </th>
                                    <th>Role Name</th>
                                    <th>Guard Name</th>
                                    <th>Permission</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td class="text-center" width="5%">
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->guard_name}}</td>
                                    <td>
                                        <button type="button" class="badge border-0
                                             @if($role->permissions->count() > 1)
                                                    badge-primary
                                                @elseif($role->permissions->count() == 1)
                                                    badge-success
                                                @else
                                                    badge-danger
                                                @endif" data-toggle="modal" data-target="#changePermission{{ $role->permissions->count() > 1 ? $role->id : ''}}">
                                            @if($role->permissions->count() > 1)
                                            {{$role->permissions->count()}} Permission
                                            @elseif($role->permissions->count() == 1)
                                            {{ $role->permissions[0]->name }}
                                            @else
                                            Not Permissions
                                            @endif
                                        </button>
                                    </td>
                                    <td width="15%">
                                        <a href="{{ route('roles.edit', $role->id )}}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                        <form id="delete-form-{{$role->id}}" action="{{ route('roles.delete', $role->id) }}" method="POST" style="display: none;">
                                            @method('delete')
                                            @csrf
                                        </form>
                                        <a class="btn btn-danger" confirm-delete="true" data-menuId="{{$role->id}}" href="#"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @endforeach
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
<script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<script src="{{ asset('library/sweetalert/dist/sweetalert.baru.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/modules-datatables.js') }}"></script>
{{-- Delete Data --}}
<script>
$(document).ready(function() {
    // Inisialisasi DataTable
    var table = $('#table-1').DataTable();

    // Event delegation untuk tombol delete
    $('#table-1').on('click', '[confirm-delete="true"]', function(event) {
        event.preventDefault();
        var menuId = $(this).data('menuid');
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6777EF',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus saja!'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = $('#delete-form-' + menuId);
                if (form.length) {
                    form.submit();
                } else {
                    console.error('Data will not be deleted!:', menuId);
                }
            }
        });
    });
});
</script>


@endpush