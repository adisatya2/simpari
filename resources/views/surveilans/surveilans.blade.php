@extends('layouts.master')
@section('title', 'Surveilans')
@push('head')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <style>
    </style>
@endpush

@section('breadcrumbs')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Surveilans</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Surveilans</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <section class="content">
                {{-- Data Registrasi Pasien --}}
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Pasien</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 row">
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>No Registrasi</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    {{ $data_registrasi->no_registrasi }}
                                </div>
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>MRN</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    {{ $data_registrasi->mrn }}
                                </div>
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>Nama Pasien</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end d-flex justify-content-end">
                                    {{ $data_registrasi->data_pasien->nama_pasien }}
                                </div>
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>Jenis Kelamin</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    {{ $data_registrasi->data_pasien->jk }}
                                </div>
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>No Telepon</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    {{ $data_registrasi->data_pasien->no_telp }}
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>Tanggal Lahir (Umur)</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    {{ tanggal_indonesia($data_registrasi->data_pasien->tanggal_lahir, false) }}
                                    ({{ hitung_umur($data_registrasi->data_pasien->tanggal_lahir) }})
                                </div>
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>Diagnosa</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    {{ $data_registrasi->diagnosa }}
                                </div>
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>DPJP</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end d-flex justify-content-end">
                                    {{ $data_registrasi->dpjp->nama_dokter }}
                                </div>
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>Tanggal Masuk RS</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    {{ tanggal_indonesia($data_registrasi->tanggal_registrasi) }}
                                </div>
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>Tanggal Pulang</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    {{ $data_registrasi->tanggal_pulang ? tanggal_indonesia($data_registrasi->tanggal_pulang) : 'Masih dirawat' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-phlebitis-tab" data-toggle="pill"
                                    href="#custom-tabs-four-phlebitis" role="tab"
                                    aria-controls="custom-tabs-four-phlebitis" aria-selected="true">Phlebitis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-ISK-tab" data-toggle="pill"
                                    href="#custom-tabs-four-ISK" role="tab" aria-controls="custom-tabs-four-ISK"
                                    aria-selected="false">ISK</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-IADP-tab" data-toggle="pill"
                                    href="#custom-tabs-four-IADP" role="tab" aria-controls="custom-tabs-four-IADP"
                                    aria-selected="false">IADP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-VAP-tab" data-toggle="pill"
                                    href="#custom-tabs-four-VAP" role="tab" aria-controls="custom-tabs-four-VAP"
                                    aria-selected="false">VAP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-IDO-tab" data-toggle="pill"
                                    href="#custom-tabs-four-IDO" role="tab" aria-controls="custom-tabs-four-IDO"
                                    aria-selected="false">IDO</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-phlebitis" role="tabpanel"
                                aria-labelledby="custom-tabs-four-phlebitis-tab">
                                {{-- Phlebitis --}}
                                <button type="button" class="btn btn-success w-100"
                                    onclick="tambah_header_phlebitis()"><i class="fa-fw fas fa-plus"></i> Tambah Data
                                    Intra Venaous Catheter</button>
                                <hr>
                                {{-- History Phlebitis --}}
                                <div class="row mt-3" id="log_phlebitis">
                                    @include('surveilans.log_phlebitis')
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-ISK" role="tabpanel"
                                aria-labelledby="custom-tabs-four-ISK-tab">
                                {{-- ISK --}}
                                <button type="button" class="btn btn-success w-100" onclick="tambah_header_isk()"><i
                                        class="fa-fw fas fa-plus"></i> Tambah Data Urine Catheter</button>
                                <hr>
                                {{-- History ISK --}}
                                <div class="row mt-3" id="log_isk">
                                    @include('surveilans.log_isk')
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-IADP" role="tabpanel"
                                aria-labelledby="custom-tabs-four-IADP-tab">
                                {{-- IADP --}}
                                <button type="button" class="btn btn-success w-100" onclick="tambah_header_iadp()"><i
                                        class="fa-fw fas fa-plus"></i> Tambah Data Central Venous Catheter</button>
                                <hr>
                                {{-- History IADP --}}
                                <div class="row mt-3" id="log_iadp">
                                    @include('surveilans.log_iadp')
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-VAP" role="tabpanel"
                                aria-labelledby="custom-tabs-four-VAP-tab">
                                {{-- VAP --}}
                                <button type="button" class="btn btn-success w-100" onclick="tambah_header_vap()"><i
                                        class="fa-fw fas fa-plus"></i> Tambah Data Endotracheal Tube/Ventilator</button>
                                <hr>
                                {{-- History VAP --}}
                                <div class="row mt-3" id="log_vap">
                                    @include('surveilans.log_vap')
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-IDO" role="tabpanel"
                                aria-labelledby="custom-tabs-four-IDO-tab">
                                {{-- IDO --}}
                                <button type="button" class="btn btn-success w-100" onclick="tambah_data_operasi()"><i
                                        class="fa-fw fas fa-plus"></i> Tambah Data
                                    Operasi</button>
                                <hr>
                                {{-- History IDO --}}
                                <div class="row mt-3" id="log_ido">
                                    @include('surveilans.log_ido')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    @includeIf('surveilans.form')
@endsection
@push('js')
    <script src="{{ asset('/') }}plugins/select2/js/select2.full.min.js"></script>

    <script src="{{ asset('/') }}plugins/popper/umd/popper.min.js"></script>
    <script src="{{ asset('/') }}plugins/popper/umd/popper-utils.min.js"></script>


    <script>
        $(function() {
            $('.ruang_perawatan').select2({
                theme: 'bootstrap4',
                placeholder: "Select a Ruang Perawatan",
                allowClear: true,
                dropdownCssClass: 'text-sm p-0'
            });
            $('.lokasicatheter').select2({
                theme: 'bootstrap4',
                placeholder: "Select a Lokasi Pemasangan Cath",
                allowClear: true,
                dropdownCssClass: 'text-sm p-0'
            })
            $('.ruanganpemasangan').select2({
                theme: 'bootstrap4',
                placeholder: "Select a Lokasi Pemasangan Cath",
                allowClear: true,
                dropdownCssClass: 'text-sm p-0'
            })
            $('.jeniscairan').select2({
                theme: 'bootstrap4',
                placeholder: "Select a Jenis Cairan",
                allowClear: true,
                dropdownCssClass: 'text-sm p-0'
            })
            $('.btn-reset').click(function() {
                resetForm();
            });

            $('#formHeaderPhlebitis').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: 'post',
                        url: $('#modal-header-phlebitis form').attr('action'),
                        data: $('#formHeaderPhlebitis').serialize(),
                        success: function(response) {
                            resetForm();
                            $('#formHeaderPhlebitis')[0].reset();
                            $('#log_phlebitis').html(response.view);
                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });
                        },
                        statusCode: {
                            409: function(data) {
                                $('#modal-header-phlebitis #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Duplikat!</h5>
                                    Data sudah pernah dimasukkan. Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                            500: function(data) {
                                $('#modal-header-phlebitis #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                        },
                    });
                }
            })

            $('#formDetailPhlebitis').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: 'post',
                        url: $('#modal-detail-phlebitis form').attr('action'),
                        data: $('#formDetailPhlebitis').serialize(),
                        success: function(response) {
                            resetForm();
                            $('#formDetailPhlebitis')[0].reset();
                            $('#log_phlebitis').html(response.view);
                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });

                        },
                        statusCode: {
                            409: function(data) {
                                $('#modal-detail-phlebitis #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Duplikat!</h5>
                                    Data dengan tanggal yang sama sudah pernah dimasukkan. Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                            500: function(data) {
                                $('#modal-detail-phlebitis #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                        },
                    });
                }
            })

            $('#formHeaderISK').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: 'post',
                        url: $('#modal-header-isk form').attr('action'),
                        data: $('#formHeaderISK').serialize(),
                        success: function(response) {
                            resetForm();
                            $('#formHeaderISK')[0].reset();
                            $('#log_isk').html(response.view);
                            $('#tes').text('berhasil');
                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });
                        },
                        statusCode: {
                            409: function(data) {
                                $('#modal-header-isk #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Duplikat!</h5>
                                    Data sudah pernah dimasukkan. Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                            500: function(data) {
                                $('#modal-header-isk #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                        },
                    });
                }
            })

            $('#formDetailISK').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: 'post',
                        url: $('#modal-detail-isk form').attr('action'),
                        data: $('#formDetailISK').serialize(),
                        success: function(response) {
                            resetForm();
                            $('#formDetailISK')[0].reset();
                            $('#log_isk').html(response.view);
                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });

                        },
                        statusCode: {
                            409: function(data) {
                                $('#modal-detail-isk #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Duplikat!</h5>
                                    Data dengan tanggal yang sama sudah pernah dimasukkan. Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                            500: function(data) {
                                $('#modal-detail-isk #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                        },
                    });
                }
            })

            $('#formHeaderIADP').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: 'post',
                        url: $('#modal-header-iadp form').attr('action'),
                        data: $('#formHeaderIADP').serialize(),
                        success: function(response) {
                            resetForm();
                            $('#formHeaderIADP')[0].reset();
                            $('#log_iadp').html(response.view);
                            $('#tes').text('berhasil');
                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });
                        },
                        statusCode: {
                            409: function(data) {
                                $('#modal-header-iadp #notifikasi').html(`
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Duplikat!</h5>
                        Data sudah pernah dimasukkan. Harap dicek kembali datanya!!!
                    </div>
                    `);
                            },
                            500: function(data) {
                                $('#modal-header-iadp #notifikasi').html(`
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        Harap dicek kembali datanya!!!
                    </div>
                    `);
                            },
                        },
                    });
                }
            })

            $('#formDetailIADP').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: 'post',
                        url: $('#modal-detail-iadp form').attr('action'),
                        data: $('#formDetailIADP').serialize(),
                        success: function(response) {
                            resetForm();
                            $('#formDetailIADP')[0].reset();
                            $('#log_iadp').html(response.view);
                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });

                        },
                        statusCode: {
                            409: function(data) {
                                $('#modal-detail-iadp #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Duplikat!</h5>
                                    Data dengan tanggal yang sama sudah pernah dimasukkan. Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                            500: function(data) {
                                $('#modal-detail-iadp #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                        },
                    });
                }
            })

            $('#formHeaderVAP').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: 'post',
                        url: $('#modal-header-vap form').attr('action'),
                        data: $('#formHeaderVAP').serialize(),
                        success: function(response) {
                            resetForm();
                            $('#formHeaderVAP')[0].reset();
                            $('#log_vap').html(response.view);
                            $('#tes').text('berhasil');
                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });
                        },
                        statusCode: {
                            409: function(data) {
                                $('#modal-header-vap #notifikasi').html(`
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Duplikat!</h5>
                        Data sudah pernah dimasukkan. Harap dicek kembali datanya!!!
                    </div>
                    `);
                            },
                            500: function(data) {
                                $('#modal-header-vap #notifikasi').html(`
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        Harap dicek kembali datanya!!!
                    </div>
                    `);
                            },
                        },
                    });
                }
            })

            $('#formDetailVAP').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: 'post',
                        url: $('#modal-detail-vap form').attr('action'),
                        data: $('#formDetailVAP').serialize(),
                        success: function(response) {
                            resetForm();
                            $('#formDetailVAP')[0].reset();
                            $('#log_vap').html(response.view);
                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });

                        },
                        statusCode: {
                            409: function(data) {
                                $('#modal-detail-vap #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Duplikat!</h5>
                                    Data dengan tanggal yang sama sudah pernah dimasukkan. Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                            500: function(data) {
                                $('#modal-detail-vap #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                        },
                    });
                }
            })

            $('#formHeaderIDO').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: 'post',
                        url: $('#modal-header-ido form').attr('action'),
                        data: $('#formHeaderIDO').serialize(),
                        success: function(response) {
                            resetForm();
                            $('#formHeaderIDO')[0].reset();
                            $('#log_ido').html(response.view);
                            $('#tes').text('berhasil');
                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });
                        },
                        statusCode: {
                            409: function(data) {
                                $('#modal-header-ido #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Duplikat!</h5>
                                    Data sudah pernah dimasukkan. Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                            500: function(data) {
                                $('#modal-header-ido #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                        },
                    });
                }
            })

            $('#formPreOperasiIDO').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: 'post',
                        url: $('#modal-preoperasi-ido form').attr('action'),
                        data: $('#formPreOperasiIDO').serialize(),
                        success: function(response) {
                            resetForm();
                            $('#formPreOperasiIDO')[0].reset();
                            $('#log_ido').html(response.view);
                            $('#tes').text('berhasil');
                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });
                        },
                        statusCode: {
                            409: function(data) {
                                $('#modal-preoperasi-ido #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Duplikat!</h5>
                                    Data sudah pernah dimasukkan. Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                            500: function(data) {
                                $('#modal-preoperasi-ido #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                        },
                    });
                }
            })

            $('#formIntraOperasiIDO').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: 'post',
                        url: $('#modal-intraoperasi-ido form').attr('action'),
                        data: $('#formIntraOperasiIDO').serialize(),
                        success: function(response) {
                            resetForm();
                            $('#formIntraOperasiIDO')[0].reset();
                            $('#log_ido').html(response.view);
                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });
                        },
                        statusCode: {
                            409: function(data) {
                                $('#modal-intraoperasi-ido #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Duplikat!</h5>
                                    Data sudah pernah dimasukkan. Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                            500: function(data) {
                                $('#modal-intraoperasi-ido #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                        },
                    });
                }
            })

            $('#formPostOperasiIDO').on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.ajax({
                        type: 'post',
                        url: $('#modal-postoperasi-ido form').attr('action'),
                        data: $('#formPostOperasiIDO').serialize(),
                        success: function(response) {
                            resetForm();
                            $('#formPostOperasiIDO')[0].reset();
                            $('#log_ido').html(response.view);
                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });
                        },
                        statusCode: {
                            409: function(data) {
                                $('#modal-postoperasi-ido #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Duplikat!</h5>
                                    Data sudah pernah dimasukkan. Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                            500: function(data) {
                                $('#modal-postoperasi-ido #notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                    Harap dicek kembali datanya!!!
                                </div>
                                `);
                            },
                        },
                    });
                }
            })
        });

        function tambah_header_phlebitis() {
            resetForm();
            $('#modal-header-phlebitis').modal('show');
            $('#modal-header-phlebitis .modal-title').text('Tambah Data Phlebitis');
            $('#modal-header-phlebitis form')[0].reset();
            $('#modal-header-phlebitis form').attr('action', `{{ route('surveilans.phlebitis') }}`);
            $('#modal-header-phlebitis [name=_method]').val('post');
            $('#modal-header-phlebitis .ruang_perawatan').val(
                '{{ $data_registrasi ? $data_registrasi->kode_ruangan : null }}').trigger(
                "change")
            $('#modal-header-phlebitis #no_registrasi').val('{{ $data_registrasi->no_registrasi }}').prop('readonly', true)
            $('#modal-header-phlebitis #pemasangan_ke').prop('readonly', false)
            $('#modal-header-phlebitis').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            })
        }

        function tambah_detail_phlebitis(id_header, obs = null) {
            resetForm();
            $('#modal-detail-phlebitis').modal('show');
            $('#modal-detail-phlebitis .modal-title').text('Tambah Bundle Phlebitis');
            $('#modal-detail-phlebitis form')[0].reset();
            $('#modal-detail-phlebitis form').attr('action', `{{ route('surveilans.phlebitis') }}`);
            $('#modal-detail-phlebitis [name=_method]').val('post');
            $('#modal-detail-phlebitis .ruang_perawatan').val(
                '{{ $data_registrasi ? $data_registrasi->kode_ruangan : null }}').trigger(
                "change")
            $('#modal-detail-phlebitis #no_registrasi').val('{{ $data_registrasi->no_registrasi }}')
            $('#modal-detail-phlebitis #id_header').val(id_header).prop('readonly', true)
            $('#modal-detail-phlebitis #observasi_ke').val(obs).prop('readonly', false)
            $('#modal-detail-phlebitis').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            })
        }

        function edit_header_phlebitis(id) {
            resetForm();
            $('#modal-header-phlebitis').modal('show');
            $('#modal-header-phlebitis .modal-title').text('Edit Data IV Catheter Phlebitis');
            $('#modal-header-phlebitis form')[0].reset();
            $.get("{{ url('surveilans/phlebitisheader') }}/" + id)
                .done((response) => {
                    $('#modal-header-phlebitis [name=_method]').val('put');
                    $('#modal-header-phlebitis form').attr("action", "{{ url('surveilans/phlebitis') }}/" + response
                        .id);
                    $('#modal-header-phlebitis #no_registrasi').val(response.no_registrasi).prop('readonly', true)
                    $('#modal-header-phlebitis #ruang_pemasangan_catheter').val(response.ruang_pemasangan).trigger(
                        'change')
                    $('#modal-header-phlebitis #petugas_pasang').val(response.petugas_pasang)
                    // $('#modal-header-phlebitis #jenis_cairan').val(response.jenis_cairan).trigger(
                    //     'change')
                    $('#modal-header-phlebitis #jenis_cairan').val(response.jenis_cairan)
                    $('#modal-header-phlebitis #ruang_perawatan').val(response.ruang_perawatan).trigger('change')
                    $('#modal-header-phlebitis #pemasangan_ke').val(response.pemasangan_ke).prop('readonly', true)
                    $('#modal-header-phlebitis #nomor_catheter').val(response.nomor_catheter)
                    $('#modal-header-phlebitis #lokasi_pemasangan').val(response.lokasi_pemasangan).trigger('change')
                    $('#modal-header-phlebitis #tanggal_pemasangan').val(response.tanggal_pemasangan)
                    $('#modal-header-phlebitis #tanggal_dilepas').val(response.tanggal_dilepas)
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function edit_detail_phlebitis(id) {
            resetForm();
            $('#modal-detail-phlebitis').modal('show');
            $('#modal-detail-phlebitis .modal-title').text('Edit Data Bundle Phlebitis');
            $('#modal-detail-phlebitis form')[0].reset();
            $.get("{{ url('surveilans/phlebitisdetail') }}/" + id)
                .done((response) => {
                    $('#modal-detail-phlebitis [name=_method]').val('put');
                    $('#modal-detail-phlebitis form').attr("action", "{{ url('surveilans/phlebitis') }}/" + response
                        .id);
                    $('#modal-detail-phlebitis #no_registrasi').val(response.header.no_registrasi).prop('readonly',
                        true)
                    $('#modal-detail-phlebitis #id_header').val(response.id_header).prop('readonly', true)
                    $('#modal-detail-phlebitis #observasi_ke').val(response.observasi_ke).prop('readonly', true)
                    $('#modal-detail-phlebitis #tanggal_observasi').val(response.tanggal_observasi)
                    $('#modal-detail-phlebitis #antibiotik_phlebitis').val(response.antibiotik)
                    $('#modal-detail-phlebitis #hasil_kultur_phlebitis').val(response.hasil_kultur).trigger('change')
                    $('#modal-detail-phlebitis #tanggal_pemeriksaan_kultur_phlebitis').val(response
                        .tanggal_pemeriksaan_kultur)
                    $('#modal-detail-phlebitis input[type=radio]').each(function() {
                        if ($(this).val() == response.status) {
                            $(this).prop('checked', true);
                        }
                    })

                    if (response.bundle) {
                        var bundle = response.bundle.split(', ');
                        $.each(bundle, function(key, value) {
                            $('#modal-detail-phlebitis input[type=checkbox]').each(function() {
                                if ($(this).val() == value) {
                                    $(this).prop('checked', true);
                                }
                            })
                        })
                    }

                    if (response.gejala) {
                        var gejala = response.gejala.split(', ');
                        $.each(gejala, function(key, value) {
                            $('#modal-detail-phlebitis input[type=checkbox]').each(function() {
                                if ($(this).val() == value) {
                                    $(this).prop('checked', true);
                                }
                            })
                        })
                    }

                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function tambah_header_isk() {
            resetForm();
            $('#modal-header-isk').modal('show');
            $('#modal-header-isk .modal-title').text('Tambah Data Urine Catheter ISK');
            $('#modal-header-isk form')[0].reset();
            $('#modal-header-isk form').attr('action', `{{ route('surveilans.isk') }}`);
            $('#modal-header-isk [name=_method]').val('post');
            $('#modal-header-isk .ruang_perawatan').val(
                '{{ $data_registrasi ? $data_registrasi->kode_ruangan : null }}').trigger(
                "change")
            $('#modal-header-isk #no_registrasi').val('{{ $data_registrasi->no_registrasi }}').prop('readonly', true)
            $('#modal-header-isk #pemasangan_ke').prop('readonly', false)
            $('#modal-header-isk').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            })
        }

        function tambah_detail_isk(id_header, obs = null) {
            resetForm();
            $('#modal-detail-isk').modal('show');
            $('#modal-detail-isk .modal-title').text('Tambah Bundle ISK');
            $('#modal-detail-isk form')[0].reset();
            $('#modal-detail-isk form').attr('action', `{{ route('surveilans.isk') }}`);
            $('#modal-detail-isk [name=_method]').val('post');
            $('#modal-detail-isk .ruang_perawatan').val(
                '{{ $data_registrasi ? $data_registrasi->kode_ruangan : null }}').trigger(
                "change")
            $('#modal-detail-isk #no_registrasi').val('{{ $data_registrasi->no_registrasi }}')
            $('#modal-detail-isk #id_header').val(id_header).prop('readonly', true)
            $('#modal-detail-isk #observasi_ke').val(obs).prop('readonly', false)
            $('#modal-detail-isk').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            })
        }

        function edit_header_isk(id) {
            resetForm();
            $('#modal-header-isk').modal('show');
            $('#modal-header-isk .modal-title').text('Edit Data Urine Catheter ISK');
            $('#modal-header-isk form')[0].reset();
            $.get("{{ url('surveilans/iskheader') }}/" + id)
                .done((response) => {
                    $('#modal-header-isk [name=_method]').val('put');
                    $('#modal-header-isk form').attr("action", "{{ url('surveilans/isk') }}/" + response
                        .id);
                    $('#modal-header-isk #no_registrasi').val(response.no_registrasi).prop('readonly', true)
                    $('#modal-header-isk #ruang_pemasangan').val(response.ruang_pemasangan).trigger(
                        'change')
                    $('#modal-header-isk #petugas_pasang').val(response.petugas_pasang)
                    $('#modal-header-isk #jenis_cairan').val(response.jenis_cairan).trigger(
                        'change')
                    $('#modal-header-isk #ruang_perawatan').val(response.ruang_perawatan).trigger('change')
                    $('#modal-header-isk #pemasangan_ke').val(response.pemasangan_ke).prop('readonly', true)
                    $('#modal-header-isk #nomor_uc').val(response.nomor_uc)
                    $('#modal-header-isk #lokasi_pemasangan').val(response.lokasi_pemasangan).trigger('change')
                    $('#modal-header-isk #tanggal_pemasangan').val(response.tanggal_pemasangan)
                    $('#modal-header-isk #tanggal_dilepas').val(response.tanggal_dilepas)
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function edit_detail_isk(id) {
            resetForm();
            $('#modal-detail-isk').modal('show');
            $('#modal-detail-isk .modal-title').text('Edit Data Bundle ISK');
            $('#modal-detail-isk form')[0].reset();
            $.get("{{ url('surveilans/iskdetail') }}/" + id)
                .done((response) => {
                    $('#modal-detail-isk [name=_method]').val('put');
                    $('#modal-detail-isk form').attr("action", "{{ url('surveilans/isk') }}/" + response
                        .id);
                    $('#modal-detail-isk #no_registrasi').val(response.header.no_registrasi).prop('readonly',
                        true)
                    $('#modal-detail-isk #id_header').val(response.id_header).prop('readonly', true)
                    $('#modal-detail-isk #observasi_ke').val(response.observasi_ke).prop('readonly', true)
                    $('#modal-detail-isk #tanggal_observasi').val(response.tanggal_observasi)
                    $('#modal-detail-isk #antibiotik_isk').val(response.antibiotik)
                    $('#modal-detail-isk #hasil_kultur_isk').val(response.hasil_kultur).trigger('change')
                    $('#modal-detail-isk #tanggal_pemeriksaan_kultur_isk').val(response
                        .tanggal_pemeriksaan_kultur)
                    $('#modal-detail-isk input[type=radio]').each(function() {
                        if ($(this).val() == response.status) {
                            $(this).prop('checked', true);
                        }
                    })

                    if (response.bundle) {
                        var bundle = response.bundle.split(', ');
                        $.each(bundle, function(key, value) {
                            $('#modal-detail-isk input[type=checkbox]').each(function() {
                                if ($(this).val() == value) {
                                    $(this).prop('checked', true);
                                }
                            })
                        })
                    }

                    if (response.gejala) {
                        var gejala = response.gejala.split(', ');
                        $.each(gejala, function(key, value) {
                            $('#modal-detail-isk input[type=checkbox]').each(function() {
                                if ($(this).val() == value) {
                                    $(this).prop('checked', true);
                                }
                            })
                        })
                    }

                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function tambah_header_iadp() {
            resetForm();
            $('#modal-header-iadp').modal('show');
            $('#modal-header-iadp .modal-title').text('Tambah Data Central Venous Catheter IADP');
            $('#modal-header-iadp form')[0].reset();
            $('#modal-header-iadp form').attr('action', `{{ route('surveilans.iadp') }}`);
            $('#modal-header-iadp [name=_method]').val('post');
            $('#modal-header-iadp .ruang_perawatan').val(
                '{{ $data_registrasi ? $data_registrasi->kode_ruangan : null }}').trigger(
                "change")
            $('#modal-header-iadp #no_registrasi').val('{{ $data_registrasi->no_registrasi }}').prop('readonly', true)
            $('#modal-header-iadp #pemasangan_ke').prop('readonly', false)
            $('#modal-header-iadp').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            })
        }

        function tambah_detail_iadp(id_header, obs = null) {
            resetForm();
            $('#modal-detail-iadp').modal('show');
            $('#modal-detail-iadp .modal-title').text('Tambah Bundle IADP');
            $('#modal-detail-iadp form')[0].reset();
            $('#modal-detail-iadp form').attr('action', `{{ route('surveilans.iadp') }}`);
            $('#modal-detail-iadp [name=_method]').val('post');
            $('#modal-detail-iadp .ruang_perawatan').val(
                '{{ $data_registrasi ? $data_registrasi->kode_ruangan : null }}').trigger(
                "change")
            $('#modal-detail-iadp #no_registrasi').val('{{ $data_registrasi->no_registrasi }}')
            $('#modal-detail-iadp #id_header').val(id_header).prop('readonly', true)
            $('#modal-detail-iadp #observasi_ke').val(obs).prop('readonly', false)
            $('#modal-detail-iadp').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            })
        }

        function edit_header_iadp(id) {
            resetForm();
            $('#modal-header-iadp').modal('show');
            $('#modal-header-iadp .modal-title').text('Edit Data Central Venous Catheter IADP');
            $('#modal-header-iadp form')[0].reset();
            $.get("{{ url('surveilans/iadpheader') }}/" + id)
                .done((response) => {
                    $('#modal-header-iadp [name=_method]').val('put');
                    $('#modal-header-iadp form').attr("action", "{{ url('surveilans/iadp') }}/" + response
                        .id);
                    $('#modal-header-iadp #no_registrasi').val(response.no_registrasi).prop('readonly', true)
                    $('#modal-header-iadp #ruang_pemasangan').val(response.ruang_pemasangan).trigger(
                        'change')
                    $('#modal-header-iadp #petugas_pasang').val(response.petugas_pasang)
                    $('#modal-header-iadp #jenis_cairan').val(response.jenis_cairan).trigger(
                        'change')
                    $('#modal-header-iadp #ruang_perawatan').val(response.ruang_perawatan).trigger('change')
                    $('#modal-header-iadp #pemasangan_ke').val(response.pemasangan_ke).prop('readonly', true)
                    $('#modal-header-iadp #nomor_cvc').val(response.nomor_cvc)
                    $('#modal-header-iadp #lokasi_pemasangan').val(response.lokasi_pemasangan).trigger('change')
                    $('#modal-header-iadp #tanggal_pemasangan').val(response.tanggal_pemasangan)
                    $('#modal-header-iadp #tanggal_dilepas').val(response.tanggal_dilepas)
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function edit_detail_iadp(id) {
            resetForm();
            $('#modal-detail-iadp').modal('show');
            $('#modal-detail-iadp .modal-title').text('Edit Data Bundle IADP');
            $('#modal-detail-iadp form')[0].reset();
            $.get("{{ url('surveilans/iadpdetail') }}/" + id)
                .done((response) => {
                    $('#modal-detail-iadp [name=_method]').val('put');
                    $('#modal-detail-iadp form').attr("action", "{{ url('surveilans/iadp') }}/" + response
                        .id);
                    $('#modal-detail-iadp #no_registrasi').val(response.header.no_registrasi).prop('readonly',
                        true)
                    $('#modal-detail-iadp #id_header').val(response.id_header).prop('readonly', true)
                    $('#modal-detail-iadp #observasi_ke').val(response.observasi_ke).prop('readonly', true)
                    $('#modal-detail-iadp #tanggal_observasi').val(response.tanggal_observasi)
                    $('#modal-detail-iadp #antibiotik_iadp').val(response.antibiotik)
                    $('#modal-detail-iadp #hasil_kultur_iadp').val(response.hasil_kultur).trigger('change')
                    $('#modal-detail-iadp #tanggal_pemeriksaan_kultur_iadp').val(response
                        .tanggal_pemeriksaan_kultur)
                    $('#modal-detail-iadp input[type=radio]').each(function() {
                        if ($(this).val() == response.status) {
                            $(this).prop('checked', true);
                        }
                    })

                    if (response.bundle) {
                        var bundle = response.bundle.split(', ');
                        $.each(bundle, function(key, value) {
                            $('#modal-detail-iadp input[type=checkbox]').each(function() {
                                if ($(this).val() == value) {
                                    $(this).prop('checked', true);
                                }
                            })
                        })
                    }

                    if (response.gejala) {
                        var gejala = response.gejala.split(', ');
                        $.each(gejala, function(key, value) {
                            $('#modal-detail-iadp input[type=checkbox]').each(function() {
                                if ($(this).val() == value) {
                                    $(this).prop('checked', true);
                                }
                            })
                        })
                    }

                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function tambah_header_vap() {
            resetForm();
            $('#modal-header-vap').modal('show');
            $('#modal-header-vap .modal-title').text('Tambah Data Endotracheal Tube/Ventilator VAP');
            $('#modal-header-vap form')[0].reset();
            $('#modal-header-vap form').attr('action', `{{ route('surveilans.vap') }}`);
            $('#modal-header-vap [name=_method]').val('post');
            $('#modal-header-vap .ruang_perawatan').val(
                '{{ $data_registrasi ? $data_registrasi->kode_ruangan : null }}').trigger(
                "change")
            $('#modal-header-vap #no_registrasi').val('{{ $data_registrasi->no_registrasi }}').prop('readonly', true)
            $('#modal-header-vap #pemasangan_ke').prop('readonly', false)
            $('#modal-header-vap').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            })
        }

        function tambah_detail_vap(id_header, obs = null) {
            resetForm();
            $('#modal-detail-vap').modal('show');
            $('#modal-detail-vap .modal-title').text('Tambah Bundle VAP');
            $('#modal-detail-vap form')[0].reset();
            $('#modal-detail-vap form').attr('action', `{{ route('surveilans.vap') }}`);
            $('#modal-detail-vap [name=_method]').val('post');
            $('#modal-detail-vap .ruang_perawatan').val(
                '{{ $data_registrasi ? $data_registrasi->kode_ruangan : null }}').trigger(
                "change")
            $('#modal-detail-vap #no_registrasi').val('{{ $data_registrasi->no_registrasi }}')
            $('#modal-detail-vap #id_header').val(id_header).prop('readonly', true)
            $('#modal-detail-vap #observasi_ke').val(obs).prop('readonly', false)
            $('#modal-detail-vap').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            })
        }

        function edit_header_vap(id) {
            resetForm();
            $('#modal-header-vap').modal('show');
            $('#modal-header-vap .modal-title').text('Edit Data Endotracheal Tube/Ventilator VAP');
            $('#modal-header-vap form')[0].reset();
            $.get("{{ url('surveilans/vapheader') }}/" + id)
                .done((response) => {
                    $('#modal-header-vap [name=_method]').val('put');
                    $('#modal-header-vap form').attr("action", "{{ url('surveilans/vap') }}/" + response
                        .id);
                    $('#modal-header-vap #no_registrasi').val(response.no_registrasi).prop('readonly', true)
                    $('#modal-header-vap #ruang_pemasangan').val(response.ruang_pemasangan).trigger(
                        'change')
                    $('#modal-header-vap #jenis_cairan').val(response.jenis_cairan).trigger(
                        'change')
                    $('#modal-header-vap #ruang_perawatan').val(response.ruang_perawatan).trigger('change')
                    $('#modal-header-vap #pemasangan_ke').val(response.pemasangan_ke).prop('readonly', true)
                    $('#modal-header-vap #lokasi_pemasangan').val(response.lokasi_pemasangan).trigger('change')
                    $('#modal-header-vap #tanggal_pemasangan').val(response.tanggal_pemasangan)
                    $('#modal-header-vap #tanggal_dilepas').val(response.tanggal_dilepas)
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function edit_detail_vap(id) {
            resetForm();
            $('#modal-detail-vap').modal('show');
            $('#modal-detail-vap .modal-title').text('Edit Data Bundle VAP');
            $('#modal-detail-vap form')[0].reset();
            $.get("{{ url('surveilans/vapdetail') }}/" + id)
                .done((response) => {
                    $('#modal-detail-vap [name=_method]').val('put');
                    $('#modal-detail-vap form').attr("action", "{{ url('surveilans/vap') }}/" + response
                        .id);
                    $('#modal-detail-vap #no_registrasi').val(response.header.no_registrasi).prop('readonly',
                        true)
                    $('#modal-detail-vap #id_header').val(response.id_header).prop('readonly', true)
                    $('#modal-detail-vap #observasi_ke').val(response.observasi_ke).prop('readonly', true)
                    $('#modal-detail-vap #tanggal_observasi').val(response.tanggal_observasi)
                    $('#modal-detail-vap #antibiotik_vap').val(response.antibiotik)
                    $('#modal-detail-vap #hasil_kultur_vap').val(response.hasil_kultur).trigger('change')
                    $('#modal-detail-vap #tanggal_pemeriksaan_kultur_vap').val(response
                        .tanggal_pemeriksaan_kultur)
                    $('#modal-detail-vap input[type=radio]').each(function() {
                        if ($(this).val() == response.status) {
                            $(this).prop('checked', true);
                        }
                    })

                    if (response.bundle) {
                        var bundle = response.bundle.split(', ');
                        $.each(bundle, function(key, value) {
                            $('#modal-detail-vap input[type=checkbox]').each(function() {
                                if ($(this).val() == value) {
                                    $(this).prop('checked', true);
                                }
                            })
                        })
                    }

                    if (response.gejala) {
                        var gejala = response.gejala.split(', ');
                        $.each(gejala, function(key, value) {
                            $('#modal-detail-vap input[type=checkbox]').each(function() {
                                if ($(this).val() == value) {
                                    $(this).prop('checked', true);
                                }
                            })
                        })
                    }

                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function tambah_data_operasi() {
            resetForm();
            $('#modal-header-ido').modal('show');
            $('#modal-header-ido .modal-title').text('Tambah Data Operasi');
            $('#modal-header-ido form')[0].reset();
            $('#modal-header-ido form').attr('action', `{{ route('surveilans.ido') }}`);
            $('#modal-header-ido [name=_method]').val('post');
            $('#modal-header-ido #no_registrasi').val('{{ $data_registrasi->no_registrasi }}').prop('readonly', true)
            $('#modal-header-ido #operasi_ke').prop('readonly', false)
            $('#modal-preoperasi-ido #jadwal_operasi').prop('readonly', false)
            $('#modal-header-ido').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            })
        }

        function edit_data_operasi(id) {
            resetForm();
            $('#modal-header-ido').modal('show');
            $('#modal-header-ido .modal-title').text('Input Data Pre Operasi');
            $('#modal-header-ido form')[0].reset();
            $.get("{{ url('surveilans/ido') }}/" + id)
                .done((response) => {
                    $('#modal-header-ido [name=_method]').val('put');
                    $('#modal-header-ido form').attr("action", "{{ url('surveilans/ido') }}/" + response
                        .id);

                    $('#modal-header-ido #no_registrasi').val('{{ $data_registrasi->no_registrasi }}').prop('readonly',
                        true)
                    $('#modal-header-ido #operasi_ke').val((response.operasi_ke)).prop('readonly', false)
                    $('#modal-header-ido #jadwal_operasi').val((response.jadwal_operasi)).prop('readonly', false)
                    $('#modal-header-ido input[type=radio]').each(function() {
                        if ($(this).val() == response.jenis_operasi) {
                            $(this).prop('checked', true);
                        }
                    })
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function tambah_preoperasi_ido(id) {
            resetForm();
            $('#modal-preoperasi-ido').modal('show');
            $('#modal-preoperasi-ido .modal-title').text('Input Data Pre Operasi');
            $('#modal-preoperasi-ido form')[0].reset();
            $.get("{{ url('surveilans/ido') }}/" + id)
                .done((response) => {
                    $('#modal-preoperasi-ido [name=_method]').val('put');
                    $('#modal-preoperasi-ido form').attr("action", "{{ url('surveilans/ido') }}/" + response
                        .id);
                    $('#modal-preoperasi-ido #ruang_perawatan').val(
                        '{{ $data_registrasi ? $data_registrasi->kode_ruangan : null }}').trigger(
                        'change')
                    $('#modal-preoperasi-ido #jadwal_operasi').val((response.jadwal_operasi)).prop('readonly', true)
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function edit_preoperasi_ido(id) {
            resetForm();
            $('#modal-preoperasi-ido').modal('show');
            $('#modal-preoperasi-ido .modal-title').text('Edit Data Pre Operasi');
            $('#modal-preoperasi-ido form')[0].reset();
            $.get("{{ url('surveilans/ido') }}/" + id)
                .done((response) => {
                    $('#modal-preoperasi-ido [name=_method]').val('put');
                    $('#modal-preoperasi-ido form').attr("action", "{{ url('surveilans/ido') }}/" + response
                        .id);

                    $('#modal-preoperasi-ido #ruang_perawatan').val(response.ruang_perawatan).trigger(
                        'change')
                    $('#modal-preoperasi-ido #jadwal_operasi').val((response.jadwal_operasi)).prop('readonly', true)
                    $('#modal-preoperasi-ido #suhu').val(response.suhu)
                    $('#modal-preoperasi-ido #gds').val(response.gds)
                    $('#modal-preoperasi-ido #screening_mrsa input[type=radio]').each(function() {
                        if ($(this).val() == response.screening_mrsa) {
                            $(this).prop('checked', true);
                        }
                    })
                    $('#modal-preoperasi-ido #pencukuran_dengan input[type=radio]').each(function() {
                        if ($(this).val() == response.pencukuran_dengan) {
                            $(this).prop('checked', true);
                        }
                    })
                    $('#modal-preoperasi-ido #antibiotik_profilaksis').val(response.antibiotik_profilaksis)
                    $('#modal-preoperasi-ido #waktu_pemberian_profilaksis').val(response.waktu_pemberian_profilaksis)
                    $('#modal-preoperasi-ido #riwayat_penyakit').val(response.riwayat_penyakit)

                    if (response.bundle_pre) {
                        var bundle = response.bundle_pre.split(', ');
                        $.each(bundle, function(key, value) {
                            $('#modal-preoperasi-ido input[type=checkbox]').each(function() {
                                if ($(this).val() == value) {
                                    $(this).prop('checked', true);
                                }
                            })
                        })
                    }
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function tambah_intraoperasi_ido(id) {
            resetForm();
            $('#modal-intraoperasi-ido').modal('show');
            $('#modal-intraoperasi-ido .modal-title').text('Input Data Intra Operasi');
            $('#modal-intraoperasi-ido form')[0].reset();
            $.get("{{ url('surveilans/ido') }}/" + id)
                .done((response) => {
                    $('#modal-intraoperasi-ido [name=_method]').val('put');
                    $('#modal-intraoperasi-ido form').attr("action", "{{ url('surveilans/ido') }}/" + response
                        .id);
                    $('#modal-intraoperasi-ido input[type=radio]').each(function() {
                        if ($(this).val() == response.jenis_operasi) {
                            $(this).prop('checked', true);
                        }
                    })
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function edit_intraoperasi_ido(id) {
            resetForm();
            $('#modal-intraoperasi-ido').modal('show');
            $('#modal-intraoperasi-ido .modal-title').text('Edit Data Intra Operasi');
            $('#modal-intraoperasi-ido form')[0].reset();
            $.get("{{ url('surveilans/ido') }}/" + id)
                .done((response) => {
                    $('#modal-intraoperasi-ido [name=_method]').val('put');
                    $('#modal-intraoperasi-ido form').attr("action", "{{ url('surveilans/ido') }}/" + response
                        .id);

                    $('#modal-intraoperasi-ido input[type=radio]').each(function() {
                        if ($(this).val() == response.jenis_operasi) {
                            $(this).prop('checked', true);
                        }
                    })
                    $('#modal-intraoperasi-ido #ruang_operasi').val(response.ruang_operasi)
                    $('#modal-intraoperasi-ido #nama_prosedur_operasi').val(response.nama_prosedur_operasi)
                    $('#modal-intraoperasi-ido #kualifikasi_daerah_operasi').val(response.kualifikasi_daerah_operasi)
                    $('#modal-intraoperasi-ido #lama_operasi').val(response.lama_operasi)
                    $('#modal-intraoperasi-ido #antibiotik_tambahan_intra').val(response.antibiotik_tambahan_intra)

                    if (response.bundle_intra) {
                        var bundle = response.bundle_intra.split(', ');
                        $.each(bundle, function(key, value) {
                            $('#modal-intraoperasi-ido input[type=checkbox]').each(function() {
                                if ($(this).val() == value) {
                                    $(this).prop('checked', true);
                                }
                            })
                        })
                    }
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function tambah_postoperasi_ido(id) {
            resetForm();
            $('#modal-postoperasi-ido').modal('show');
            $('#modal-postoperasi-ido .modal-title').text('Input Data Post Operasi');
            $('#modal-postoperasi-ido form')[0].reset();
            $.get("{{ url('surveilans/ido') }}/" + id)
                .done((response) => {
                    $('#modal-postoperasi-ido [name=_method]').val('put');
                    $('#modal-postoperasi-ido form').attr("action", "{{ url('surveilans/ido') }}/" + response
                        .id);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function edit_postoperasi_ido(id) {
            resetForm();
            $('#modal-postoperasi-ido').modal('show');
            $('#modal-postoperasi-ido .modal-title').text('Edit Data Post Operasi');
            $('#modal-postoperasi-ido form')[0].reset();
            $.get("{{ url('surveilans/ido') }}/" + id)
                .done((response) => {
                    $('#modal-postoperasi-ido [name=_method]').val('put');
                    $('#modal-postoperasi-ido form').attr("action", "{{ url('surveilans/ido') }}/" + response
                        .id);

                    if (response.bundle_post) {
                        var bundle = response.bundle_post.split('; ');
                        $.each(bundle, function(key, value) {
                            $('#modal-postoperasi-ido input[type=checkbox]').each(function() {
                                if ($(this).val() == value) {
                                    $(this).prop('checked', true);
                                }
                            })
                        })
                    }
                    if (response.gejala) {
                        var gejala = response.gejala.split(', ');
                        $.each(gejala, function(key, value) {
                            $('#modal-postoperasi-ido input[type=checkbox]').each(function() {
                                if ($(this).val() == value) {
                                    $(this).prop('checked', true);
                                }
                            })
                        })
                    }

                    $('#modal-postoperasi-ido #keterangan').val(response.keterangan)
                    $('#modal-postoperasi-ido input[type=radio]').each(function() {
                        if ($(this).val() == response.status) {
                            $(this).prop('checked', true);
                        }
                    })
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function resetForm() {
            $('.modal').modal('hide');
            $(".ruanganpemasangan").val(null).trigger("change");
            $(".ruang_perawatan").val(null).trigger("change");
            $(".lokasicatheter").val(null).trigger("change");
        }
    </script>
@endpush
