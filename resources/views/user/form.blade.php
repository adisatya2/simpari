@extends('layouts.master')
@section('title', 'Data User')
@push('head')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('/') }}plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="{{ asset('/') }}plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">

<style>
    .dataTables_length,
    .dataTables_filter {
        margin-left: 30px;
        float: right;
    }
</style>
@endpush

@section('breadcrumbs')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Data User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                    <li class="breadcrumb-item active">Data User</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->
@endsection

@section('content')
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <form action="{{ route('user.store') }}" method="post" class="form-horizontal"
                                id="formUser">
                                @csrf
                                @method('post')
                                <div class="form-group row">
                                    <label for="username"
                                        class="col-md-2 offset-1 control-label text-right col-form-label">Username</label>
                                    <div class="col-md-8">
                                        <input type="text" name="username" id="username"
                                            class="form-control @error('username') is-invalid @enderror"
                                            value="{{ old('username') }}" required autofocus>
                                        @error('username')
                                        <span class="help-block with-errors" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama_user"
                                        class="col-md-2 offset-1 control-label text-right col-form-label">Nama
                                        User</label>
                                    <div class="col-md-8">
                                        <input type="text" name="nama_user" id="nama_user"
                                            class="form-control @error('nama_user') is-invalid @enderror"
                                            value="{{ old('nama_user') }}" required>
                                        @error('nama_user')
                                        <span class="help-block with-errors" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email"
                                        class="col-md-2 offset-1 control-label text-right col-form-label">Email</label>
                                    <div class="col-md-8">
                                        <input type="email" name="email" id="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required>
                                        @error('email')
                                        <span class="help-block with-errors" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="roles"
                                        class="col-md-2 offset-1 control-label text-right col-form-label">Role</label>
                                    <div class="col-md-8">
                                        <select id="roles" name="roles"
                                            class="form-control select2 @error('roles') is-invalid @enderror" required
                                            autocomplete="roles">
                                            <option value="" selected disabled>Choose a role</option>
                                            @foreach ($roles as $item)
                                            <option value="{{ $item->name }}" {{ old('roles')==$item->name ? 'selected'
                                                : '' }}>
                                                {{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block with-errors" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="cabang"
                                        class="col-md-2 offset-1 control-label text-right col-form-label">Cabang</label>
                                    <div class="col-md-8">
                                        <select id="cabang" name="cabang"
                                            class="form-control select2 @error('cabang') is-invalid @enderror" required
                                            autocomplete="cabang">
                                            <option value="" selected disabled>Choose a cabang</option>
                                            @foreach ($cabang as $item)
                                            <option value="{{ $item->kode_rs }}" {{ old('cabang')==$item->kode_rs ||
                                                config('app.kode_rs')==$item->kode_rs ? 'selected' : '' }}>
                                                {{ $item->nama_cabang }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block with-errors" style="color:red"></span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password"
                                        class="col-md-2 offset-1 control-label text-right col-form-label">Password</label>
                                    <div class="col-md-8">
                                        <input type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            id="password" placeholder="Password" required>
                                        @error('password')
                                        <span class="help-block with-errors" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="password_confirmation"
                                        class="col-md-2 offset-1 control-label text-right col-form-label">Konfirmasi
                                        Password</label>
                                    <div class="col-md-8">
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            name="password_confirmation" id="password_confirmation"
                                            placeholder="Password Confirmation" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="aktif"
                                        class="col-md-2 offset-1 control-label text-right col-form-label">Status</label>
                                    <div class="col-md-8">
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="checkbox" id="aktif" name="aktif" value="1"
                                                    class="form-control">
                                                <label for="aktif">
                                                    Aktif
                                                </label>
                                            </div>
                                        </div>
                                        <span class="help-block with-errors" style="color:red"></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center">
                            <button type="button" onclick="history.back()" class="btn btn-default btn-sm btn-flat mr-3"
                                data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary btn-sm btn-flat"
                                form="formUser">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<!-- /.content -->

@endsection


@push('js')
<!-- DataTables  & Plugins -->
<script src="{{ asset('/') }}plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('/') }}plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('/') }}plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('/') }}plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('/') }}plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="{{ asset('/') }}plugins/select2/js/select2.full.min.js"></script>

<script src="{{ asset('/') }}plugins/popper/umd/popper.min.js"></script>
<script src="{{ asset('/') }}plugins/popper/umd/popper-utils.min.js"></script>


<script>
    let table;

        $('#cabang').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Cabang",
                allowClear: true,
                dropdownCssClass: 'text-sm p-0'
            })

        $('#roles').select2({
            theme: 'bootstrap4',
            placeholder: "Pilih Role",
            allowClear: true,
            dropdownCssClass: 'text-sm p-0'
        })

    

            // $('#formUser').validator().on('submit', function(e) {
            //     if (!e.preventDefault()) {
            //         $.post($('#formUser form').attr('action'), $('#formUser form')
            //                 .serialize())
            //             .done((response) => {
            //                 alert('Berhasil menyimpan data');
            //                 return;
            //             })
            //             .fail((errors) => {
            //                 alert('Tidak dapat menyimpan data');
            //                 return;
            //             })
            //     }
            // });

</script>
@endpush