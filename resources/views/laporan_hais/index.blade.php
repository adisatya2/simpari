@extends('layouts.master')
@section('title', 'Laporan HAIs')
@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">


    <style>
        .dataTables_length,
        .dataTables_filter {
            margin-left: 30px;
            float: right;
        }

        .select2-dropdown {
            font-size: 12px;
        }

        tfoot {
            display: table-row-group;
        }
    </style>
@endpush
@section('breadcrumbs')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan HAIs</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Laporan HAIs</li>
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
                <div class="card">
                    <div class="card-body row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="ruangan">Ruangan</label>
                                <div class="input-group">
                                    <select name="ruangan" id="ruangan" class="form-control select2bs4">
                                        <option value="">Semua Ruangan</option>
                                        @foreach ($ruangan as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}
                                                ({{ $key }})
                                            </option>
                                        @endforeach
                                    </select>
                                    {{-- <div class="input-group-prepend">
                                    <button type="button" onclick="search()" class="btn btn-info"><i
                                            class="fa-fw fas fa-search"></i></button>
                                </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="tanggal_awal">Tanggal Observasi</label>
                                <div class="input-group">
                                    <input type="date" name="tanggal_awal" id="tanggal_awal"
                                        value="{{ date('Y-m-d', strtotime('-30 day', strtotime(date('Y-m-d')))) }}"
                                        class="form-control">
                                    <div class="input-group-prepend">
                                        <span class="m-2"><i class="fa-fw fas fa-minus"></i></span>
                                    </div>
                                    <input type="date" name="tanggal_akhir" id="tanggal_akhir"
                                        value="{{ date('Y-m-d') }}" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="button" onclick="search()" class="btn btn-info w-100"><i
                                    class="fa-fw fas fa-search"></i> Search</button>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-phlebitis-tab" data-toggle="pill"
                                    href="#custom-tabs-four-phlebitis" role="tab"
                                    aria-controls="custom-tabs-four-phlebitis" aria-selected="true"
                                    onclick="data_phlebitis()" value="phlebitis">Phlebitis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-isk-tab" data-toggle="pill"
                                    href="#custom-tabs-four-isk" role="tab" aria-controls="custom-tabs-four-isk"
                                    aria-selected="false" onclick="data_isk()" value="isk">ISK</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-iadp-tab" data-toggle="pill"
                                    href="#custom-tabs-four-iadp" role="tab" aria-controls="custom-tabs-four-iadp"
                                    aria-selected="false" onclick="data_iadp()" value="iadp">IADP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-vap-tab" data-toggle="pill"
                                    href="#custom-tabs-four-vap" role="tab" aria-controls="custom-tabs-four-vap"
                                    aria-selected="false" onclick="data_vap()" value="vap">VAP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-ido-tab" data-toggle="pill"
                                    href="#custom-tabs-four-ido" role="tab" aria-controls="custom-tabs-four-ido"
                                    aria-selected="false" onclick="data_ido()" value="ido">IDO</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade table-responsive show active" id="custom-tabs-four-phlebitis"
                                role="tabpanel" aria-labelledby="custom-tabs-four-phlebitis-tab">
                                <table class="table table-sm table-bordered table-hover" id="table-phlebitis">
                                    <thead>
                                        <th>Aksi</th>
                                        <th>Tanggal Input</th>
                                        <th>MRN</th>
                                        <th>Nama Pasien</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal MRS</th>
                                        <th>Ruang</th>
                                        <th>Pmsng Ke</th>
                                        <th>Ruang Pmsngn</th>
                                        <th>Jenis Cairan</th>
                                        <th>No IVC</th>
                                        <th>Lokasi Pasang</th>
                                        <th>Tanggal Pemasangan</th>
                                        <th>Tanggal Dilepas</th>
                                        <th>Obs Ke</th>
                                        <th>Bundle</th>
                                        <th>Gejala</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade table-responsive" id="custom-tabs-four-isk" role="tabpanel"
                                aria-labelledby="custom-tabs-four-isk-tab">
                                <table class="table table-sm table-bordered table-hover" id="table-isk">
                                    <thead>
                                        <th>Aksi</th>
                                        <th>Tanggal Input</th>
                                        <th>MRN</th>
                                        <th>Nama Pasien</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal MRS</th>
                                        <th>Ruang</th>
                                        <th>Pmsng Ke</th>
                                        <th>Ruang Pmsngn</th>
                                        <th>No UC</th>
                                        <th>Tanggal Pemasangan</th>
                                        <th>Tanggal Dilepas</th>
                                        <th>Obs Ke</th>
                                        <th>Bundle</th>
                                        <th>Gejala</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-iadp" role="tabpanel"
                                aria-labelledby="custom-tabs-four-iadp-tab">
                                <table class="table table-sm table-bordered table-hover" id="table-iadp">
                                    <thead>
                                        <th>Aksi</th>
                                        <th>Tanggal Input</th>
                                        <th>MRN</th>
                                        <th>Nama Pasien</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal MRS</th>
                                        <th>Ruang</th>
                                        <th>Pmsng Ke</th>
                                        <th>Ruang Pmsngn</th>
                                        <th>No CVC</th>
                                        <th>Tanggal Pemasangan</th>
                                        <th>Tanggal Dilepas</th>
                                        <th>Obs Ke</th>
                                        <th>Bundle</th>
                                        <th>Gejala</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-vap" role="tabpanel"
                                aria-labelledby="custom-tabs-four-vap-tab">
                                <table class="table table-sm table-bordered table-hover" id="table-vap">
                                    <thead>
                                        <th>Aksi</th>
                                        <th>Tanggal Input</th>
                                        <th>MRN</th>
                                        <th>Nama Pasien</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal MRS</th>
                                        <th>Ruang</th>
                                        <th>Pmsng Ke</th>
                                        <th>Ruang Pmsngn</th>
                                        <th>Tanggal Pemasangan</th>
                                        <th>Tanggal Dilepas</th>
                                        <th>Obs Ke</th>
                                        <th>Bundle</th>
                                        <th>Gejala</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-ido" role="tabpanel"
                                aria-labelledby="custom-tabs-four-ido-tab">
                                <table class="table table-sm table-bordered table-hover" id="table-ido">
                                    <thead>
                                        <th>Aksi</th>
                                        <th>Tanggal Input</th>
                                        <th>MRN</th>
                                        <th>Nama Pasien</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tanggal MRS</th>
                                        <th>Ruang</th>
                                        <th>OP Ke</th>
                                        <th>Jadwal OP</th>
                                        <th>Jenis OP</th>
                                        <th>Suhu °C</th>
                                        <th>GDS</th>
                                        <th>MRSA</th>
                                        <th>Pencukuran</th>
                                        <th>Antibiotik Profilaksis</th>
                                        <th>Waktu Pemberian AB</th>
                                        <th>Riwayat Penyakit</th>
                                        <th>Bundle Pre OP</th>
                                        <th>Ruang OP</th>
                                        <th>Nama Prosedur OP</th>
                                        <th>Kualifikasi Daerah OP</th>
                                        <th>Lama OP</th>
                                        <th>Bundle Intra OP</th>
                                        <th>Bundle Post OP</th>
                                        <th>Gejala</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Count Data HAIs</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover" id="table-count">
                                    <thead>
                                        <th>HAIs</th>
                                        <th>Ya</th>
                                        <th>Tidak</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- BAR CHART -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Bar Chart</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="barChart"
                                        style="min-height: 300px; height: 350px; max-height: 500px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Count Data Bundle</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="table-bundle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div><!-- /.container-fluid -->
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

    <!-- Select2 -->
    <script src="{{ asset('/') }}plugins/select2/js/select2.full.min.js"></script>

    <script src="{{ asset('/') }}plugins/popper/umd/popper.min.js"></script>
    <script src="{{ asset('/') }}plugins/popper/umd/popper-utils.min.js"></script>

    <!-- ChartJS -->
    <script src="{{ asset('/') }}plugins/chart.js/Chart.min.js"></script>


    <script>
        // let table;
        count();

        $(function() {
            $("body").addClass("sidebar-collapse");

            data_phlebitis();

            $('#ruangan').select2({
                theme: 'bootstrap4',
                placeholder: "Semua Ruangan",
                allowClear: true,
                dropdownCssClass: 'text-sm p-0'
            })

            let table_count;

            table_count = $("#table-count").DataTable({
                "processing": true,
                "autoWidth": false,
                "paging": false,
                "ordering": false,
                "bDestroy": true,
                "dom": 'Blfrtip',
                "buttons": [{
                        extend: 'excelHtml5',
                        title: 'Count Data HAIs',
                        text: `<i class="fa-fw fas fa-file-excel"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Count Data HAIs',
                        text: `<i class="fa-fw fas fa-print"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        text: `<i class="fa-fw fas fa-sync-alt"></i>`,
                        action: function(e, dt, node, config) {
                            dt.ajax.reload(null, false);
                        },
                        className: 'btn-xs'
                    },
                    {
                        extend: 'colvis',
                        text: `<i class="fa-fw fas fa-eye"></i>`,
                        className: 'btn-xs'
                    },
                ],
            });


        });

        function search() {
            var active = $('#custom-tabs-four-tab a.nav-link.active').attr('value');
            if (active == "phlebitis") {
                data_phlebitis();
            }
            if (active == "isk") {
                data_isk();
            }
            if (active == "iadp") {
                data_iadp();
            }
            if (active == "vap") {
                data_vap();
            }
            if (active == "ido") {
                data_ido();
            }
            count();
        }

        function data_phlebitis() {
            let table_phlebitis;
            var ruangan = $("#ruangan option:selected").val();
            var tanggal_awal = $("#tanggal_awal").val();
            var tanggal_akhir = $("#tanggal_akhir").val();

            table_phlebitis = $("#table-phlebitis").DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "stateSave": true,
                "bDestroy": true,
                "order": [
                    [1, 'desc'],
                ],
                "dom": 'Blfrtip',
                "buttons": [{
                        extend: 'excelHtml5',
                        title: 'Laporan HAIs Phlebitis',
                        text: `<i class="fa-fw fas fa-file-excel"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Laporan HAIs Phlebitis',
                        text: `<i class="fa-fw fas fa-print"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        text: `<i class="fa-fw fas fa-sync-alt"></i>`,
                        action: function(e, dt, node, config) {
                            dt.ajax.reload(null, false);
                        },
                        className: 'btn-xs'
                    },
                    {
                        extend: 'colvis',
                        text: `<i class="fa-fw fas fa-eye"></i>`,
                        className: 'btn-xs'
                    },
                ],
                "ajax": {
                    url: '{{ route('laporanhais.dataphlebitis') }}',
                    type: 'post',
                    data: {
                        _token: $('[name=csrf-token]').attr('content'),
                        ruangan: ruangan,
                        tanggal_awal: tanggal_awal,
                        tanggal_akhir: tanggal_akhir,
                    }
                },
                columns: [{
                        data: 'aksi',
                        searchable: false,
                        sortable: false,
                        className: "text-center notexport",
                    }, {
                        data: 'created_at',
                        className: "text-nowrap"
                    },
                    {
                        data: 'header.data_registrasi.mrn',
                        className: "text-nowrap",
                    },
                    {
                        data: 'header.data_registrasi.data_pasien.nama_pasien',
                    },
                    {
                        data: 'header.data_registrasi.data_pasien.jk',
                    },
                    {
                        data: 'header.data_registrasi.tanggal_registrasi',
                    },
                    {
                        data: 'header.ruang_perawatan',
                    },
                    {
                        data: 'header.pemasangan_ke',
                        className: "text-center"
                    },
                    {
                        data: 'header.ruang_pemasangan',
                    },
                    {
                        data: 'header.jenis_cairan',
                        visible: false,
                    },
                    {
                        data: 'header.nomor_catheter',
                        className: "text-center",
                        visible: false,
                    },
                    {
                        data: 'header.lokasi_pemasangan',
                        visible: false,
                    },
                    {
                        data: 'header.tanggal_pemasangan',
                        visible: false,
                    },
                    {
                        data: 'header.tanggal_dilepas',
                        visible: false,
                    },
                    {
                        data: 'observasi_ke'
                    },
                    {
                        data: 'bundle',
                        visible: false,
                    },
                    {
                        data: 'gejala',
                        visible: false,
                    },
                    {
                        data: 'status'
                    },
                ],
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('laporanhais.countbundle') }}",
                data: {
                    _token: $('[name=csrf-token]').attr('content'),
                    ruangan: ruangan,
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir,
                    hais: 'phlebitis'
                },
                success: function(response) {
                    // console.log(response);
                    $("#table-bundle").text('');
                    html = `
                    <table class="table table-sm table-bordered table-hover" id="table-bundle-phlebitis">
                        <thead>
                            <th class="text-center">Bundle Phlebitis</th>
                            <th class="text-center">Jumlah</th>
                        </thead>
                        <tbody>`;
                    $.each(response, function(key, value) {
                        html += `
                            <tr>
                                <td>${key}</td>
                                <td class="text-right">${value}</td>
                            </tr>
                        `;
                    });
                    html += `
                        </tbody>
                    </table>
                    `;
                    $("#table-bundle").html(html);
                    $("#table-bundle-phlebitis").DataTable({
                        "processing": true,
                        "autoWidth": false,
                        "paging": false,
                        "ordering": false,
                        "stateSave": true,
                        "bDestroy": true,
                        "dom": 'Blfrtip',
                        "buttons": [{
                                extend: 'excelHtml5',
                                title: 'Laporan Bundle Phlebitis',
                                text: `<i class="fa-fw fas fa-file-excel"></i>`,
                                className: 'btn-xs',
                                exportOptions: {
                                    columns: ':not(.notexport)'
                                }
                            },
                            {
                                extend: 'print',
                                title: 'Laporan Bundle Phlebitis',
                                text: `<i class="fa-fw fas fa-print"></i>`,
                                className: 'btn-xs',
                                exportOptions: {
                                    columns: ':not(.notexport)'
                                }
                            },
                            {
                                text: `<i class="fa-fw fas fa-sync-alt"></i>`,
                                action: function(e, dt, node, config) {
                                    dt.ajax.reload(null, false);
                                },
                                className: 'btn-xs'
                            },
                            {
                                extend: 'colvis',
                                text: `<i class="fa-fw fas fa-eye"></i>`,
                                className: 'btn-xs'
                            },
                        ],
                    });

                }
            });

        }

        function data_isk() {
            let table_isk;
            var ruangan = $("#ruangan option:selected").val();
            var tanggal_awal = $("#tanggal_awal").val();
            var tanggal_akhir = $("#tanggal_akhir").val();

            table_isk = $("#table-isk").DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "stateSave": true,
                "bDestroy": true,
                "order": [
                    [1, 'desc'],
                ],
                "dom": 'Blfrtip',
                "buttons": [{
                        extend: 'excelHtml5',
                        title: 'Laporan HAIs ISK',
                        text: `<i class="fa-fw fas fa-file-excel"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Laporan HAIs ISK',
                        text: `<i class="fa-fw fas fa-print"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        text: `<i class="fa-fw fas fa-sync-alt"></i>`,
                        action: function(e, dt, node, config) {
                            dt.ajax.reload(null, false);
                        },
                        className: 'btn-xs'
                    },
                    {
                        extend: 'colvis',
                        text: `<i class="fa-fw fas fa-eye"></i>`,
                        className: 'btn-xs'
                    },
                ],
                "ajax": {
                    url: '{{ route('laporanhais.dataisk') }}',
                    type: 'post',
                    data: {
                        _token: $('[name=csrf-token]').attr('content'),
                        ruangan: ruangan,
                        tanggal_awal: tanggal_awal,
                        tanggal_akhir: tanggal_akhir,
                    }
                },
                columns: [{
                        data: 'aksi',
                        searchable: false,
                        sortable: false,
                        className: "text-center notexport",
                    }, {
                        data: 'created_at',
                        className: "text-nowrap"
                    },
                    {
                        data: 'header.data_registrasi.mrn',
                        className: "text-nowrap",
                    },
                    {
                        data: 'header.data_registrasi.data_pasien.nama_pasien',
                    },
                    {
                        data: 'header.data_registrasi.data_pasien.jk',
                    },
                    {
                        data: 'header.data_registrasi.tanggal_registrasi',
                    },
                    {
                        data: 'header.ruang_perawatan',
                    },
                    {
                        data: 'header.pemasangan_ke',
                        className: "text-center"
                    },
                    {
                        data: 'header.ruang_pemasangan',
                    },
                    {
                        data: 'header.nomor_uc',
                        className: "text-center",
                        visible: false,
                    },
                    {
                        data: 'header.tanggal_pemasangan',
                        visible: false,
                    },
                    {
                        data: 'header.tanggal_dilepas',
                        visible: false,
                    },
                    {
                        data: 'observasi_ke'
                    },
                    {
                        data: 'bundle',
                        visible: false,
                    },
                    {
                        data: 'gejala',
                        visible: false,
                    },
                    {
                        data: 'status'
                    },
                ],
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('laporanhais.countbundle') }}",
                data: {
                    _token: $('[name=csrf-token]').attr('content'),
                    ruangan: ruangan,
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir,
                    hais: 'isk'
                },
                success: function(response) {
                    // console.log(response);
                    $("#table-bundle").text('');
                    html = `
                    <table class="table table-sm table-bordered table-hover" id="table-bundle-isk">
                        <thead>
                            <th class="text-center">Bundle ISK</th>
                            <th class="text-center">Jumlah</th>
                        </thead>
                        <tbody>`;
                    $.each(response, function(key, value) {
                        html += `
                            <tr>
                                <td>${key}</td>
                                <td class="text-right">${value}</td>
                            </tr>
                        `;
                    });
                    html += `
                        </tbody>
                    </table>
                    `;
                    $("#table-bundle").html(html);

                    $("#table-bundle-isk").DataTable({
                        "processing": true,
                        "autoWidth": false,
                        "paging": false,
                        "ordering": false,
                        "stateSave": true,
                        "bDestroy": true,
                        "dom": 'Blfrtip',
                        "buttons": [{
                                extend: 'excelHtml5',
                                title: 'Laporan Bundle ISK',
                                text: `<i class="fa-fw fas fa-file-excel"></i>`,
                                className: 'btn-xs',
                                exportOptions: {
                                    columns: ':not(.notexport)'
                                }
                            },
                            {
                                extend: 'print',
                                title: 'Laporan Bundle ISK',
                                text: `<i class="fa-fw fas fa-print"></i>`,
                                className: 'btn-xs',
                                exportOptions: {
                                    columns: ':not(.notexport)'
                                }
                            },
                            {
                                text: `<i class="fa-fw fas fa-sync-alt"></i>`,
                                action: function(e, dt, node, config) {
                                    dt.ajax.reload(null, false);
                                },
                                className: 'btn-xs'
                            },
                            {
                                extend: 'colvis',
                                text: `<i class="fa-fw fas fa-eye"></i>`,
                                className: 'btn-xs'
                            },
                        ],
                    });

                }
            });
        }

        function data_iadp() {
            let table_iadp;
            var ruangan = $("#ruangan option:selected").val();
            var tanggal_awal = $("#tanggal_awal").val();
            var tanggal_akhir = $("#tanggal_akhir").val();

            table_iadp = $("#table-iadp").DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "stateSave": true,
                "bDestroy": true,
                "order": [
                    [1, 'desc'],
                ],
                "dom": 'Blfrtip',
                "buttons": [{
                        extend: 'excelHtml5',
                        title: 'Laporan HAIs IADP',
                        text: `<i class="fa-fw fas fa-file-excel"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Laporan HAIs IADP',
                        text: `<i class="fa-fw fas fa-print"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        text: `<i class="fa-fw fas fa-sync-alt"></i>`,
                        action: function(e, dt, node, config) {
                            dt.ajax.reload(null, false);
                        },
                        className: 'btn-xs'
                    },
                    {
                        extend: 'colvis',
                        text: `<i class="fa-fw fas fa-eye"></i>`,
                        className: 'btn-xs'
                    },
                ],
                "ajax": {
                    url: '{{ route('laporanhais.dataiadp') }}',
                    type: 'post',
                    data: {
                        _token: $('[name=csrf-token]').attr('content'),
                        ruangan: ruangan,
                        tanggal_awal: tanggal_awal,
                        tanggal_akhir: tanggal_akhir,
                    }
                },
                columns: [{
                        data: 'aksi',
                        searchable: false,
                        sortable: false,
                        className: "text-center notexport",
                    }, {
                        data: 'created_at',
                        className: "text-nowrap"
                    },
                    {
                        data: 'header.data_registrasi.mrn',
                        className: "text-nowrap",
                    },
                    {
                        data: 'header.data_registrasi.data_pasien.nama_pasien',
                    },
                    {
                        data: 'header.data_registrasi.data_pasien.jk',
                    },
                    {
                        data: 'header.data_registrasi.tanggal_registrasi',
                    },
                    {
                        data: 'header.ruang_perawatan',
                    },
                    {
                        data: 'header.pemasangan_ke',
                        className: "text-center"
                    },
                    {
                        data: 'header.ruang_pemasangan',
                    },
                    {
                        data: 'header.nomor_cvc',
                        className: "text-center",
                        visible: false,
                    },
                    {
                        data: 'header.tanggal_pemasangan',
                        visible: false,
                    },
                    {
                        data: 'header.tanggal_dilepas',
                        visible: false,
                    },
                    {
                        data: 'observasi_ke'
                    },
                    {
                        data: 'bundle',
                        visible: false,
                    },
                    {
                        data: 'gejala',
                        visible: false,
                    },
                    {
                        data: 'status'
                    },
                ],
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('laporanhais.countbundle') }}",
                data: {
                    _token: $('[name=csrf-token]').attr('content'),
                    ruangan: ruangan,
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir,
                    hais: 'iadp'
                },
                success: function(response) {
                    // console.log(response);
                    $("#table-bundle").text('');
                    html = `
                    <table class="table table-sm table-bordered table-hover" id="table-bundle-iadp">
                        <thead>
                            <th class="text-center">Bundle IADP</th>
                            <th class="text-center">Jumlah</th>
                        </thead>
                        <tbody>`;
                    $.each(response, function(key, value) {
                        html += `
                            <tr>
                                <td>${key}</td>
                                <td class="text-right">${value}</td>
                            </tr>
                        `;
                    });
                    html += `
                        </tbody>
                    </table>
                    `;
                    $("#table-bundle").html(html);
                    $("#table-bundle-iadp").DataTable({
                        "processing": true,
                        "autoWidth": false,
                        "paging": false,
                        "ordering": false,
                        "stateSave": true,
                        "bDestroy": true,
                        "dom": 'Blfrtip',
                        "buttons": [{
                                extend: 'excelHtml5',
                                title: 'Laporan Bundle IADP',
                                text: `<i class="fa-fw fas fa-file-excel"></i>`,
                                className: 'btn-xs',
                                exportOptions: {
                                    columns: ':not(.notexport)'
                                }
                            },
                            {
                                extend: 'print',
                                title: 'Laporan Bundle IADP',
                                text: `<i class="fa-fw fas fa-print"></i>`,
                                className: 'btn-xs',
                                exportOptions: {
                                    columns: ':not(.notexport)'
                                }
                            },
                            {
                                text: `<i class="fa-fw fas fa-sync-alt"></i>`,
                                action: function(e, dt, node, config) {
                                    dt.ajax.reload(null, false);
                                },
                                className: 'btn-xs'
                            },
                            {
                                extend: 'colvis',
                                text: `<i class="fa-fw fas fa-eye"></i>`,
                                className: 'btn-xs'
                            },
                        ],
                    });

                }
            });
        }

        function data_vap() {
            let table_vap;
            var ruangan = $("#ruangan option:selected").val();
            var tanggal_awal = $("#tanggal_awal").val();
            var tanggal_akhir = $("#tanggal_akhir").val();

            table_vap = $("#table-vap").DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "stateSave": true,
                "bDestroy": true,
                "order": [
                    [1, 'desc'],
                ],
                "dom": 'Blfrtip',
                "buttons": [{
                        extend: 'excelHtml5',
                        title: 'Laporan HAIs IDO',
                        text: `<i class="fa-fw fas fa-file-excel"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Laporan HAIs IDO',
                        text: `<i class="fa-fw fas fa-print"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        text: `<i class="fa-fw fas fa-sync-alt"></i>`,
                        action: function(e, dt, node, config) {
                            dt.ajax.reload(null, false);
                        },
                        className: 'btn-xs'
                    },
                    {
                        extend: 'colvis',
                        text: `<i class="fa-fw fas fa-eye"></i>`,
                        className: 'btn-xs'
                    },
                ],
                "ajax": {
                    url: '{{ route('laporanhais.datavap') }}',
                    type: 'post',
                    data: {
                        _token: $('[name=csrf-token]').attr('content'),
                        ruangan: ruangan,
                        tanggal_awal: tanggal_awal,
                        tanggal_akhir: tanggal_akhir,
                    }
                },
                columns: [{
                        data: 'aksi',
                        searchable: false,
                        sortable: false,
                        className: "text-center notexport",
                    }, {
                        data: 'created_at',
                        className: "text-nowrap"
                    },
                    {
                        data: 'header.data_registrasi.mrn',
                        className: "text-nowrap",
                    },
                    {
                        data: 'header.data_registrasi.data_pasien.nama_pasien',
                    },
                    {
                        data: 'header.data_registrasi.data_pasien.jk',
                    },
                    {
                        data: 'header.data_registrasi.tanggal_registrasi',
                    },
                    {
                        data: 'header.ruang_perawatan',
                    },
                    {
                        data: 'header.pemasangan_ke',
                        className: "text-center"
                    },
                    {
                        data: 'header.ruang_pemasangan',
                    },
                    {
                        data: 'header.tanggal_pemasangan',
                        visible: false,
                    },
                    {
                        data: 'header.tanggal_dilepas',
                        visible: false,
                    },
                    {
                        data: 'observasi_ke'
                    },
                    {
                        data: 'bundle',
                        visible: false,
                    },
                    {
                        data: 'gejala',
                        visible: false,
                    },
                    {
                        data: 'status'
                    },
                ],
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('laporanhais.countbundle') }}",
                data: {
                    _token: $('[name=csrf-token]').attr('content'),
                    ruangan: ruangan,
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir,
                    hais: 'vap'
                },
                success: function(response) {
                    // console.log(response);
                    $("#table-bundle").text('');
                    html = `
                    <table class="table table-sm table-bordered table-hover" id="table-bundle-vap">
                        <thead>
                            <th class="text-center">Bundle VAP</th>
                            <th class="text-center">Jumlah</th>
                        </thead>
                        <tbody>`;
                    $.each(response, function(key, value) {
                        html += `
                            <tr>
                                <td>${key}</td>
                                <td class="text-right">${value}</td>
                            </tr>
                        `;
                    });
                    html += `
                        </tbody>
                    </table>
                    `;
                    $("#table-bundle").html(html);
                    $("#table-bundle-vap").DataTable({
                        "processing": true,
                        "autoWidth": false,
                        "paging": false,
                        "ordering": false,
                        "stateSave": true,
                        "bDestroy": true,
                        "dom": 'Blfrtip',
                        "buttons": [{
                                extend: 'excelHtml5',
                                title: 'Laporan Bundle VAP',
                                text: `<i class="fa-fw fas fa-file-excel"></i>`,
                                className: 'btn-xs',
                                exportOptions: {
                                    columns: ':not(.notexport)'
                                }
                            },
                            {
                                extend: 'print',
                                title: 'Laporan Bundle VAP',
                                text: `<i class="fa-fw fas fa-print"></i>`,
                                className: 'btn-xs',
                                exportOptions: {
                                    columns: ':not(.notexport)'
                                }
                            },
                            {
                                text: `<i class="fa-fw fas fa-sync-alt"></i>`,
                                action: function(e, dt, node, config) {
                                    dt.ajax.reload(null, false);
                                },
                                className: 'btn-xs'
                            },
                            {
                                extend: 'colvis',
                                text: `<i class="fa-fw fas fa-eye"></i>`,
                                className: 'btn-xs'
                            },
                        ],
                    });

                }
            });
        }

        function data_ido() {
            let table_ido;
            var ruangan = $("#ruangan option:selected").val();
            var tanggal_awal = $("#tanggal_awal").val();
            var tanggal_akhir = $("#tanggal_akhir").val();

            table_ido = $("#table-ido").DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "stateSave": true,
                "bDestroy": true,
                "order": [
                    [1, 'desc'],
                ],
                "dom": 'Blfrtip',
                "buttons": [{
                        extend: 'excelHtml5',
                        title: 'Laporan HAIs IDO',
                        text: `<i class="fa-fw fas fa-file-excel"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Laporan HAIs IDO',
                        text: `<i class="fa-fw fas fa-print"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        text: `<i class="fa-fw fas fa-sync-alt"></i>`,
                        action: function(e, dt, node, config) {
                            dt.ajax.reload(null, false);
                        },
                        className: 'btn-xs'
                    },
                    {
                        extend: 'colvis',
                        text: `<i class="fa-fw fas fa-eye"></i>`,
                        className: 'btn-xs'
                    },
                ],
                "ajax": {
                    url: '{{ route('laporanhais.dataido') }}',
                    type: 'post',
                    data: {
                        _token: $('[name=csrf-token]').attr('content'),
                        ruangan: ruangan,
                        tanggal_awal: tanggal_awal,
                        tanggal_akhir: tanggal_akhir,
                    }
                },
                columns: [{
                        data: 'aksi',
                        searchable: false,
                        sortable: false,
                        className: "text-center notexport",
                    }, {
                        data: 'created_at',
                        className: "text-nowrap"
                    },
                    {
                        data: 'data_registrasi.mrn',
                        className: "text-nowrap",
                    },
                    {
                        data: 'data_registrasi.data_pasien.nama_pasien',
                    },
                    {
                        data: 'data_registrasi.data_pasien.jk',
                    },
                    {
                        data: 'data_registrasi.tanggal_registrasi',
                    },
                    {
                        data: 'ruang_perawatan',
                    },
                    {
                        data: 'operasi_ke',
                        className: "text-center",
                    },
                    {
                        data: 'jadwal_operasi',
                    },
                    {
                        data: 'jenis_operasi',
                    },
                    {
                        data: 'suhu',
                        visible: false,
                    },
                    {
                        data: 'gds',
                        visible: false,
                    },
                    {
                        data: 'screening_mrsa',
                        visible: false,
                    },
                    {
                        data: 'pencukuran_dengan',
                        visible: false,
                    },
                    {
                        data: 'antibiotik_profilaksis',
                        visible: false,
                    },
                    {
                        data: 'waktu_pemberian_profilaksis',
                        visible: false,
                    },
                    {
                        data: 'riwayat_penyakit',
                        visible: false,
                    },
                    {
                        data: 'bundle_pre',
                        visible: false,
                    },
                    {
                        data: 'ruang_operasi',
                    },
                    {
                        data: 'nama_prosedur_operasi',
                    },
                    {
                        data: 'kualifikasi_daerah_operasi',
                        visible: false,
                    },
                    {
                        data: 'lama_operasi',
                    },
                    {
                        data: 'bundle_intra',
                        visible: false,
                    },
                    {
                        data: 'bundle_post',
                        visible: false,
                    },
                    {
                        data: 'gejala',
                        visible: false,
                    },
                    {
                        data: 'keterangan',
                        visible: false,
                    },
                    {
                        data: 'status'
                    },
                ],
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('laporanhais.countbundle') }}",
                data: {
                    _token: $('[name=csrf-token]').attr('content'),
                    ruangan: ruangan,
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir,
                    hais: 'ido',
                },
                success: function(response) {
                    // console.log(response);
                    $("#table-bundle").text('');
                    var waktu = '';
                    html = `
                    <table class="table table-sm table-bordered table-hover" id="table-bundle-ido">
                        <thead>
                            <th class="text-center">Bundle IDO</th>
                            <th class="text-center">Jumlah</th>
                        </thead>
                        <tbody>`;
                    $.each(response, function(key, value) {
                        if (waktu != key) {
                            html += `
                            <tr>
                                <th class="text-bold">${key}</th>
                                <td class="text-bold text-right"></td>
                            </tr>
                        `;
                            $.each(value, function(bundle, jumlah) {
                                html += `
                            <tr>
                                <td>${bundle}</td>
                                <td class="text-right">${jumlah}</td>
                            </tr>
                        `;
                            });
                        }


                    });
                    html += `
                        </tbody>
                    </table>
                    `;
                    $("#table-bundle").html(html);
                    $("#table-bundle-ido").DataTable({
                        "processing": true,
                        "autoWidth": false,
                        "paging": false,
                        "ordering": false,
                        "stateSave": true,
                        "bDestroy": true,
                        "dom": 'Blfrtip',
                        "buttons": [{
                                extend: 'excelHtml5',
                                title: 'Laporan Bundle IDO',
                                text: `<i class="fa-fw fas fa-file-excel"></i>`,
                                className: 'btn-xs',
                                exportOptions: {
                                    columns: ':not(.notexport)'
                                }
                            },
                            {
                                extend: 'print',
                                title: 'Laporan Bundle IDO',
                                text: `<i class="fa-fw fas fa-print"></i>`,
                                className: 'btn-xs',
                                exportOptions: {
                                    columns: ':not(.notexport)'
                                }
                            },
                            {
                                text: `<i class="fa-fw fas fa-sync-alt"></i>`,
                                action: function(e, dt, node, config) {
                                    dt.ajax.reload(null, false);
                                },
                                className: 'btn-xs'
                            },
                            {
                                extend: 'colvis',
                                text: `<i class="fa-fw fas fa-eye"></i>`,
                                className: 'btn-xs'
                            },
                        ],
                    });
                }
            });
        }

        function count() {

            var ruangan = $("#ruangan option:selected").val();
            var tanggal_awal = $("#tanggal_awal").val();
            var tanggal_akhir = $("#tanggal_akhir").val();

            $.ajax({
                type: 'POST',
                url: "{{ route('laporanhais.count') }}",
                data: {
                    _token: $('[name=csrf-token]').attr('content'),
                    ruangan: ruangan,
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir,
                },
                success: function(response) {
                    // console.log(response);
                    $("#table-count > tbody").text('');
                    $.each(response, function(key, value) {
                        $("#table-count > tbody").append(`
                            <tr>
                                <td>${key}</td>
                                <td>${value.Ya ? value.Ya : 0}</td>
                                <td>${value.Tidak ? value.Tidak : 0}</td>
                            </tr>
                        `);
                    });

                    var areaChartData = {
                        labels: ['Phlebitis', 'ISK', 'IADP', 'VAP', 'IDO'],
                        datasets: [{
                                label: 'Ya',
                                backgroundColor: 'rgba(214, 42, 35,0.9)',
                                borderColor: 'rgba(214, 42, 35,0.8)',
                                pointRadius: false,
                                pointColor: '#D62A23',
                                pointStrokeColor: 'rgba(214, 42, 35,1)',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(255, 3, 234,1)',
                                data: [
                                    response.Phlebitis.Ya,
                                    response.ISK.Ya,
                                    response.IADP.Ya,
                                    response.VAP.Ya,
                                    response.IDO.Ya
                                ]
                            },
                            {
                                label: 'Tidak',
                                backgroundColor: 'rgba(40, 167, 69, 1)',
                                borderColor: 'rgba(40, 167, 69, 1)',
                                pointRadius: false,
                                pointColor: 'rgba(40, 167, 69, 1)',
                                pointStrokeColor: '##28a745',
                                pointHighlightFill: '#fff',
                                pointHighlightStroke: 'rgba(38, 252, 0,1)',
                                data: [
                                    response.Phlebitis.Tidak,
                                    response.ISK.Tidak,
                                    response.IADP.Tidak,
                                    response.VAP.Tidak,
                                    response.IDO.Tidak
                                ]
                            },
                        ]
                    }

                    //-------------
                    //- BAR CHART -
                    //-------------
                    var barChartCanvas = $('#barChart').get(0).getContext('2d')
                    if (window.myChart != undefined) {
                        window.myChart.destroy();
                        window.myChart = new Chart(barChartCanvas, {});
                    }
                    var barChartData = $.extend(true, {}, areaChartData)
                    var temp0 = areaChartData.datasets[0]
                    var temp1 = areaChartData.datasets[1]
                    barChartData.datasets[0] = temp1
                    barChartData.datasets[1] = temp0

                    var barChartOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        datasetFill: false,
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }

                    window.myChart = new Chart(barChartCanvas, {
                        type: 'bar',
                        data: barChartData,
                        options: barChartOptions
                    })
                }
            });
        }
    </script>
@endpush
