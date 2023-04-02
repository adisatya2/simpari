@extends('layouts.master')
@section('title', 'Surveilans')
@push('head')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('/') }}plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <style>
        .dataTables_length,
        .dataTables_filter {
            margin-left: 30px;
            float: right;
        }

        table.dataTable td {
            padding: 5px;
        }

        table.dataTable thead tr th {
            padding: 5px;
            text-align: center;
        }
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
                <div class="card">
                    <div class="card-header row">
                        <div class="col-sm-6">
                            <form action="{{ route('pasiendirawat.data') }}" id="search-ruangan">
                                <div class="input-group">
                                    <select name="ruangan" id="ruangan" class="form-control form-control-sm select2bs4">
                                        <option value="">Pilih Ruangan</option>
                                        @foreach ($ruangan as $key => $item)
                                            <option value="{{ $key }}">{{ $item }}
                                                ({{ $key }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-prepend">
                                        <button type="button" onclick="datapasiendirawat()" class="btn btn-info"><i
                                                class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-tools col-sm-6 d-flex justify-content-end">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <table id="table" class="table table-bordered table-hover">
                            <thead>
                                <th width="1%">Aksi</th>
                                <th>No</th>
                                <th>LOS</th>
                                <th>MRN</th>
                                <th>Nama Pasien</th>
                                <th>Diagnosa</th>
                                <th>DPJP</th>
                                <th>Hinai</th>
                                <th>Tanggal Masuk</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </section>
        </div>
    </section>

    @includeIf('master_pasien.detail_pasien')
    @includeIf('pasien_dirawat.form')
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


    <script>
        // let table;

        $(function() {

            $('#ruangan').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Ruangan",
                allowClear: true,
                dropdownCssClass: 'text-sm p-0'
            })

            datapasiendirawat();

            $('body').tooltip({
                selector: '[data-toggle="tooltip"]'
            });

            $('#search-ruangan').on('change', function(e) {
                datapasiendirawat();
            });

        });

        function datapasiendirawat() {
            let table;
            var ruangan = $("#ruangan option:selected").val();

            table = $("#table").DataTable({
                "processing": true,
                "serverSide": true,
                "paging": false,
                "autoWidth": false,
                "bDestroy": true,
                "stateSave": true,
                "order": [
                    [1, 'asc'],
                ],
                "dom": 'Blfrtip',
                "buttons": [{
                        extend: 'excel',
                        text: `<i class="fa-fw fas fa-file-excel"></i>`,
                        className: 'btn-xs'
                    },
                    {
                        extend: 'print',
                        text: `<i class="fa-fw fas fa-print"></i>`,
                        className: 'btn-xs'
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
                    url: '{{ route('surveilans.data') }}',
                    type: 'post',
                    data: {
                        _token: $('[name=csrf-token]').attr('content'),
                        ruangan: ruangan
                    }
                },
                columns: [{
                        data: 'aksi',
                        className: "text-center",
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'no_kamar',
                        className: "text-center text-nowrap"
                    },
                    {
                        data: 'los',
                        className: "text-center"
                    },
                    {
                        data: 'mrn'
                    },
                    {
                        data: 'nama_pasien'
                    },
                    {
                        data: 'diagnosa'
                    },
                    {
                        data: 'dokter'
                    },
                    {
                        data: 'bed_hinai'
                    },
                    {
                        data: 'tanggal_masuk'
                    },
                ],
            });

        }

        function detailForm(url) {
            resetForm();
            $('#modal-form').modal('show');
            $('#kamar_baru').html('');
            $('#modal-form .modal-title').text('Detail Data Registrasi');

            $.get(url)
                .done((response) => {
                    $('#modal-form form').attr("action", "{{ url('bedmanagement/pasiendirawat/') }}/" + response
                        .no_kamar);

                    $('#modal-form #no_kamar').val(response.no_kamar).prop("readonly", true);

                    if (response.data_pasien) {
                        $('#modal-form #mrn').val(response.mrn).prop("readonly", true);
                        $('#modal-form #nama_pasien').val(response.nama_pasien).prop("readonly", true);
                        $('#modal-form #nik').val(response.data_pasien.nik).prop("readonly", true);
                        $('#modal-form #tempat_lahir').val(response.data_pasien.tempat_lahir).prop("readonly", true);
                        $('#modal-form #tanggal_lahir').val(response.data_pasien.tanggal_lahir).prop("readonly", true);
                        $('#modal-form [name=jk]').prop("disabled", true);
                        if (response.data_pasien.jk == 'Perempuan') {
                            $('#modal-form #perempuan').prop("checked", true);
                        }
                        if (response.data_pasien.jk == 'Laki-Laki') {
                            $('#modal-form #laki-laki').prop("checked", true);
                        }
                        $('#modal-form #no_telp').val(response.data_pasien.no_telp).prop("readonly", true);
                        $('#modal-form #alamat').val(response.data_pasien.alamat).prop("readonly", true);
                        $('#modal-form #agama').val(response.data_pasien.agama).prop("readonly", true);

                        $('#modal-form #no_registrasi').val(response.no_registrasi).prop("readonly", true);
                        $('#modal-form #diagnosa').val(response.diagnosa).prop("readonly", true);
                        $('#modal-form #id_dokter').val(response.dpjp.nama_dokter).prop("readonly", true);
                        $('#modal-form [name=jenis_jaminan]').prop("disabled", true);
                        if (response.jenis_jaminan == 'JKN') {
                            $('#modal-form #JKN').prop("checked", true);
                        }
                        if (response.jenis_jaminan == 'Pribadi') {
                            $('#modal-form #Pribadi').prop("checked", true);
                        }
                        if (response.jenis_jaminan == 'Asuransi') {
                            $('#modal-form #Asuransi').prop("checked", true);
                        }
                        if (response.jenis_jaminan == 'Perusahaan') {
                            $('#modal-form #Perusahaan').prop("checked", true);
                        }
                        if (response.jenis_jaminan == 'COB') {
                            $('#modal-form #COB').prop("checked", true);
                        }
                        if (response.jenis_jaminan == 'KMK') {
                            $('#modal-form #KMK').prop("checked", true);
                        }
                        $('#modal-form #nama_jaminan').val(response.nama_jaminan).prop("readonly", true);
                        $('#modal-form #hak_pasien').val(response.hak_pasien).prop("readonly", true);
                        $('#modal-form #bed_hinai').val(response.bed_hinai).prop("readonly", true);
                        $('#modal-form #tanggal_masuk').val(response.tanggal_masuk).prop("readonly", true);
                    }
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function resetForm() {
            $('#modal-form .modal-title').text('');

            $('#notifikasi').html('');
            $('#error-info').removeClass('text-danger').removeClass('text-success');
            $('#modal-form #mrn').prop("disabled", false).prop("readonly", false);
            $('#modal-form #nama_pasien').prop("disabled", false).prop("readonly", false);
            $('#modal-form #nik').prop("disabled", false).prop("readonly", false);
            $('#modal-form #tempat_lahir').prop("disabled", false).prop("readonly", false);
            $('#modal-form #tanggal_lahir').prop("disabled", false).prop("readonly", false);
            $('#modal-form [name=jk]').prop("disabled", false).prop("readonly", false);
            $('#perempuan').prop("disabled", false).prop("readonly", false).prop("checked", false);
            $('#laki-laki').prop("disabled", false).prop("readonly", false).prop("checked", false);
            $('#modal-form #no_telp').prop("disabled", false).prop("readonly", false);
            $('#modal-form #alamat').prop("disabled", false).prop("readonly", false);
            $('#modal-form #agama').prop("disabled", false).prop("readonly", false);
            $('#modal-form #no_kamar').prop("disabled", false).prop("readonly", false);

            $('#kamar_baru').html('');
            $('#modal-form #no_kamar').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form #no_registrasi').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form #diagnosa').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form [name=id_dokter]').val(null).prop("disabled", false).prop("readonly", false);
            $('#JKN').prop("disabled", false).prop("readonly", false).prop("checked", false);
            $('#Pribadi').prop("disabled", false).prop("readonly", false).prop("checked", false);
            $('#Asuransi').prop("disabled", false).prop("readonly", false).prop("checked", false);
            $('#Perusahaan').prop("disabled", false).prop("readonly", false).prop("checked", false);
            $('#COB').prop("disabled", false).prop("readonly", false).prop("checked", false);
            $('#KMK').prop("disabled", false).prop("readonly", false).prop("checked", false);
            $('#modal-form #nama_jaminan').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form [name=hak_pasien]').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form #bed_hinai').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form #tanggal_masuk').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form #keterangan_fo').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form #keterangan_perawat').val(null).prop("disabled", false).prop("readonly", false);
        }

        function detailPasien(url) {
            $('#modal-detail').modal('show');
            $('#modal-detail .modal-title').text('Detail Data Pasien');
            $('#modal-detail form').attr('action', url);
            $('#modal-detail [name=_method]').val('get');

            $.get(url)
                .done((response) => {
                    $('#modal-detail [name=mrn]').val(response.mrn);
                    $('#modal-detail [name=nik]').val(response.nik);
                    $('#modal-detail [name=nama_pasien]').val(response.nama_pasien);
                    $('#modal-detail [name=umur]').val(response.umur);
                    $('#modal-detail [name=tempat_lahir]').val(response.tempat_lahir);
                    $('#modal-detail [name=tanggal_lahir]').val(response.tanggal_lahir);
                    if (response.jk == 'Perempuan') {
                        $('#perempuan2').prop("checked", true);
                    }
                    if (response.jk == 'Laki-Laki') {
                        $('#laki-laki2').prop("checked", true);
                    }
                    $('#modal-detail [name=no_telp]').val(response.no_telp);
                    $('#modal-detail [name=alamat]').val(response.alamat);
                    $('#modal-detail [name=agama]').val(response.agama);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }
    </script>
@endpush
