@extends('layouts.master')
@section('title', 'Setting')
@push('head')
@endpush

@section('breadcrumbs')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item active">Setting</li>
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
                                <button onclick="openForm()" class="btn btn-sm btn-flat btn-success"><i
                                        class="fa fa-edit mr-2"></i>
                                    Edit</button>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row d-flex justify-content-center">
                                    <div class="col-lg-6">
                                        <form action="{{ route('setting.update', $setting->id_setting) }}" method="post"
                                            class="form-horizontal" id="formKategori" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            <div class="form-group">
                                                <label for="nama_rumahsakit">Nama Rumah Sakit</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="nama_rumahsakit" id="nama_rumahsakit"
                                                    value="{{ $setting->nama_rumahsakit }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="kode_rumahsakit">Kode Rumah Sakit</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="kode_rumahsakit" id="kode_rumahsakit"
                                                    value="{{ $setting->kode_rumahsakit }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="alias_rumahsakit">Alias Rumah Sakit</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="alias_rumahsakit" id="alias_rumahsakit"
                                                    value="{{ $setting->alias_rumahsakit }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="alamat">Alamat</label>
                                                <textarea name="alamat" id="alamat" class="form-control form-control-sm">{{ $setting->alamat }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="telepon">No Telepon</label>
                                                <input type="text" class="form-control form-control-sm" name="telepon"
                                                    id="telepon" value="{{ $setting->telepon }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="path_logo_square">Logo Square</label>
                                                <div class="input-group input-group-sm">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            name="path_logo_square" id="path_logo_square">
                                                        <label class="custom-file-label" for="path_logo_square">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                <span>{{ $setting->path_logo_square }}</span>
                                            </div>
                                            <div class="form-group">
                                                <label for="path_logo_login">Logo Login</label>
                                                <div class="input-group input-group-sm">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            name="path_logo_login" id="path_logo_login">
                                                        <label class="custom-file-label" for="path_logo_login">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                <span>{{ $setting->path_logo_login }}</span>
                                            </div>

                                            <div class="d-flex justify-content-center">
                                                <button type="reset" onclick="disableForm()"
                                                    class="btn btn-form btn-flat btn-default m-3">Batal</button>
                                                <button type="submit" class="btn btn-form btn-flat btn-primary m-3">
                                                    <i class="fas fa-save mr-2"></i> Simpan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
    <!-- bs-custom-file-input -->
    <script src="{{ asset('/') }}plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script>
        $(function() {
            disableForm()
            bsCustomFileInput.init();
        });

        function disableForm() {
            $('#nama_rumahsakit').prop('disabled', true);
            $('#kode_rumahsakit').prop('disabled', true);
            $('#alias_rumahsakit').prop('disabled', true);
            $('#alamat').prop('disabled', true);
            $('#telepon').prop('disabled', true);
            $('#path_logo_square').prop('disabled', true);
            $('#path_logo_login').prop('disabled', true);

            $(".btn-form").hide();
        }

        function openForm() {
            $('#nama_rumahsakit').prop('disabled', false);
            $('#kode_rumahsakit').prop('disabled', false);
            $('#alias_rumahsakit').prop('disabled', false);
            $('#alamat').prop('disabled', false);
            $('#telepon').prop('disabled', false);
            $('#path_logo_square').prop('disabled', false);
            $('#path_logo_login').prop('disabled', false);

            $(".btn-form").show();
        }
    </script>
@endpush
