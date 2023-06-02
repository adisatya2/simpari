@extends('layouts.master')
@section('title', 'Pasien Sedang Dirawat')
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
            <div class="row">
                <div class="col-md-4 row d-flex align-items-center">
                    <div class="col-md-12 mb-1 mt-1">
                        <form action="{{ route('pasiendirawat.data') }}" id="search-ruangan">
                            <div class="input-group">
                                <select name="ruangan" id="ruangan" class="form-control select2bs4">
                                    <option value="">Semua Ruangan</option>
                                    @foreach ($ruangan as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}
                                            ({{ $key }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="input-group-prepend">
                                    <button type="button" onclick="datapasiendirawat()" class="btn btn-info"><i
                                            class="fa-fw fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card mb-0">
                        <div class="card-body d-flex justify-content-beetwen p-0">
                            <table class="table table-bordered table-striped text-center">
                                <thead>
                                    <th class="p-0">BOR</th>
                                    <th class="p-0">Bed Kosong</th>
                                    <th class="p-0">Total Bed</th>
                                    <th class="p-0">Total Pasien</th>
                                    <th class="p-0">LOS >3 Hari</th>
                                    <th class="p-0">LOS 3 Hari</th>
                                </thead>
                                <tbody style="font-size: 2em;font-weight:bold;">
                                    <td class="p-1" id="bor"></td>
                                    <td class="p-1" id="bed_kosong"></td>
                                    <td class="p-1" id="total_bed"></td>
                                    <td class="p-1" id="total_pasien"></td>
                                    <td class="p-1" id="lebih3h"></td>
                                    <td class="p-1" id="kurang3h"></td>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                    <div class="col-lg-12 sticky-top">
                        <div class="card">
                            <div class="card-header bg-info text-center h3 text-bold" id="nama_ruangan">
                                Nama Ruangan
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body table-responsive">

                                <table id="table" class="table table-sm table-bordered table-hover">
                                    <thead>
                                        <th width="1%">Aksi</th>
                                        <th>No</th>
                                        <th>No Kamar</th>
                                        <th>Kelas</th>
                                        <th>LOS</th>
                                        <th>MRN</th>
                                        <th>Nama Pasien</th>
                                        <th>Diagnosa</th>
                                        <th>DPJP</th>
                                        <th>Dokter</th>
                                        <th>Jaminan</th>
                                        <th>Hak Pasien</th>
                                        <th>Hinai</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Beset Pasien/DPJP</th>
                                        <th>Catatan Perawat</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    <!-- /.content -->

    @includeIf('pasien_dirawat.form')
    @includeIf('pasien_dirawat.pulang')
    @includeIf('master_pasien.detail_pasien')
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
            $("body").addClass("sidebar-collapse");

            datapasiendirawat();
            countBOR();

            $('#ruangan').select2({
                theme: 'bootstrap4',
                placeholder: "Semua",
                allowClear: true,
                dropdownCssClass: 'text-sm p-0'
            })

            $('#id_dokter').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih DPJP",
                allowClear: true,
                dropdownCssClass: 'text-sm p-0'
            })

            $('#hak_pasien').select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Hak Kelas Pasien",
                allowClear: true,
                dropdownCssClass: 'text-sm p-0'
            })

            $('body').tooltip({
                selector: '[data-toggle="tooltip"]'
            });

            $('#search-ruangan').on('change', function(e) {
                datapasiendirawat();
                countBOR();
            });

            $('#mrn').on('keyup', function(e) {
                if (!e.preventDefault()) {
                    let mrn = $('#mrn').val();
                    if (mrn.length == 10) {
                        $.ajax({
                            type: 'get',
                            url: `{{ url('master/pasien') }}/` + mrn,
                            data: {
                                'pasien': mrn
                            },
                            success: function(response) {
                                $('#error-info').removeClass('text-danger').addClass(
                                    'text-success').text(
                                    'Data ditemukan. Silahkan edit data jika ada perubahan!'
                                );
                                $('#nama_pasien').val(response.nama_pasien);
                                $('#nama_pasien').val(response.nama_pasien);
                                $('#nik').val(response.nik);
                                $('#tempat_lahir').val(response.tempat_lahir);
                                $('#tanggal_lahir').val(response.tanggal_lahir);
                                if (response.jk == 'Perempuan') {
                                    $('#perempuan').prop("checked", true);
                                }
                                if (response.jk == 'Laki-Laki') {
                                    $('#laki-laki').prop("checked", true);
                                }
                                $('#no_telp').val(response.no_telp);
                                $('#alamat').val(response.alamat);
                                $('#agama').val(response.agama);
                            },
                            error: function() {
                                $('#error-info').removeClass('text-success').addClass(
                                    'text-danger').text(
                                    'Data tidak ditemukan. Silahkan isi data pasien dengan lengkap!'
                                );
                                $('#nama_pasien').val(null);
                                $('#nik').val(null);
                                $('#tempat_lahir').val(null);
                                $('#tanggal_lahir').val(null);
                                $('#perempuan').prop("checked", false).trigger('change');
                                $('#laki-laki').prop("checked", false).trigger('change');
                                $('#no_telp').val(null);
                                $('#alamat').val(null);
                                $('#agama').val(null);
                            }
                        });
                    }
                }
            });

            $('#modal-form').on('submit', function(e) {

                if (!e.preventDefault()) {
                    $.post($('#modal-form form').attr('action'), $('#modal-form form')
                            .serialize())
                        .done((response) => {
                            // console.log(response);
                            $('#modal-form').modal('hide');

                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });

                            datapasiendirawat();
                            countBOR();

                        })
                        .fail((errors) => {
                            if (errors.status == 422) {
                                $('#notifikasi').html(`
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-ban"></i> Error ` + errors.status + ` Duplicate!</h5>
                                    Pasien ` + nama_pasien + ` sudah teregistrasi.
                                </div>
                                `);
                            } else {
                                alert('Tidak dapat menyimpan data');
                            }
                            return;
                        })
                }
            });

            $('#modal-pulang').on('submit', function(e) {

                if (!e.preventDefault()) {
                    $.post($('#modal-pulang form').attr('action'), $('#modal-pulang form')
                            .serialize())
                        .done((response) => {
                            // console.log(response);
                            $('#modal-pulang').modal('hide');

                            $(document).Toasts('create', {
                                title: `Berhasil !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-success',
                                body: response.pesan
                            });

                            datapasiendirawat();
                            countBOR();

                        })
                        .fail((errors) => {
                            $(document).Toasts('create', {
                                title: `Error !`,
                                autohide: true,
                                delay: 3000,
                                class: 'bg-danger',
                                body: 'Gagal memulangkan pasien, harap dicek kembali datanya!!!'
                            });
                            return;
                        })
                }
            });

        });

        function datapasiendirawat() {
            let table;
            var ruangan = $("#ruangan option:selected").val();
            var nama_ruangan = $("#ruangan option:selected").text();

            $("#nama_ruangan").text(nama_ruangan);

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
                        extend: 'excelHtml5',
                        title: 'Pasien sedang dirawat',
                        text: `<i class="fa-fw fas fa-file-excel"></i>`,
                        className: 'btn-xs',
                        exportOptions: {
                            columns: ':not(.notexport)'
                        }
                    },
                    {
                        extend: 'print',
                        title: 'Pasien sedang dirawat',
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
                            countBOR();
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
                    url: '{{ route('pasiendirawat.data') }}',
                    type: 'post',
                    data: {
                        _token: $('[name=csrf-token]').attr('content'),
                        ruangan: ruangan
                    }
                },
                columns: [{
                        data: 'aksi',
                        className: "text-center align-middle notexport",
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'no_kamar2',
                        className: "text-center text-nowrap align-middle notexport"
                    },
                    {
                        data: 'no_kamar',
                        className: "text-center text-bold align-middle text-nowrap",
                        visible: false
                    },
                    {
                        data: 'kelas_bed.nama_kelas',
                        className: "align-middle"
                    },
                    {
                        data: 'los',
                        className: "text-center align-middle p-0"
                    },
                    {
                        data: 'mrn',
                        className: "align-middle"
                    },
                    {
                        data: 'nama_pasien',
                        className: "text-nowrap align-middle"
                    },
                    {
                        data: 'diagnosa',
                        className: "align-middle"
                    },
                    {
                        data: 'dokter',
                        className: "align-middle notexport",
                    },
                    {
                        data: 'nama_dokter',
                        className: "align-middle",
                        visible: false
                    },
                    {
                        data: 'nama_jaminan',
                        className: "align-middle"
                    },
                    {
                        data: 'hak_pasien',
                        className: "align-middle"
                    },
                    {
                        data: 'bed_hinai',
                        className: "align-middle"
                    },
                    {
                        data: 'tanggal_masuk',
                        className: "align-middle"
                    },
                    {
                        data: 'keterangan_fo'
                    },
                    {
                        data: 'keterangan_perawat'
                    },
                ],
            });

        }

        function registrasiForm(url, no_kamar) {
            resetForm();
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Registrasi Pasien');
            $('#modal-form [name=id_dokter]').val(null).trigger('change');
            $('#modal-form [name=hak_pasien]').val(null).trigger('change');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=no_kamar]').val(no_kamar).prop("disabled", true).prop("required", true);
            $('#modal-form [name=no_registrasi]').prop("disabled", true);
            $('#lama').text("");
            $('#modal-form').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            })

            $('#modal-form #mrn').prop("required", true);
            $('#modal-form #nama_pasien').prop("required", true);
            $('#modal-form #tanggal_lahir').prop("required", true);
            $('#modal-form [name=jk]').prop("required", true);

            $('#modal-form #diagnosa').prop("required", true);
            $('#modal-form #id_dokter').prop("required", true);
            $('#modal-form [name=jenis_jaminan]').prop("required", true);
            $('#modal-form [name=nama_jaminan]').prop("required", true);
            $('#modal-form [name=hak_pasien]').prop("required", true);
            $('#modal-form [name=tanggal_masuk]').prop("required", true);
        }

        function editForm(url) {
            resetForm();
            $('#modal-form').modal('show');
            $('#kamar_baru').html('');
            $('#modal-form .modal-title').text('Edit Data');
            $('#modal-form form')[0].reset();
            $('#modal-form [name=_method]').val('put');
            $('#lama').text("");

            $.get(url)
                .done((response) => {
                    $('#modal-form form').attr("action", "{{ url('bedmanagement/pasiendirawat/') }}/" + response
                        .no_kamar);

                    $('#modal-form #no_kamar').val(response.no_kamar).prop("disabled", true);

                    if (response.data_pasien) {
                        $('#modal-form #mrn').val(response.mrn).prop("required", true).prop("readonly", true);
                        $('#modal-form #nama_pasien').val(response.nama_pasien).prop("required", true);
                        $('#modal-form #nik').val(response.data_pasien.nik);
                        $('#modal-form #tempat_lahir').val(response.data_pasien.tempat_lahir);
                        $('#modal-form #tanggal_lahir').val(response.data_pasien.tanggal_lahir).prop("required", true);
                        $('#modal-form [name=jk]').prop("required", true);
                        if (response.data_pasien.jk == 'Perempuan') {
                            $('#modal-form #perempuan').prop("checked", true);
                        }
                        if (response.data_pasien.jk == 'Laki-Laki') {
                            $('#modal-form #laki-laki').prop("checked", true);
                        }
                        $('#modal-form #no_telp').val(response.data_pasien.no_telp);
                        $('#modal-form #alamat').val(response.data_pasien.alamat);
                        $('#modal-form #agama').val(response.data_pasien.agama);

                        $('#modal-form #no_registrasi').val(response.no_registrasi).prop("required", true).prop(
                            "readonly", true);
                        $('#modal-form #diagnosa').val(response.diagnosa).prop("required", true);
                        $('#modal-form #id_dokter').val(response.id_dokter).trigger('change');
                        $('#modal-form [name=jenis_jaminan]').prop("required", true);
                        if (response.data_registrasi.jenis_jaminan == 'JKN') {
                            $('#JKN').prop("checked", true);
                        }
                        if (response.data_registrasi.jenis_jaminan == 'Pribadi') {
                            $('#modal-form #Pribadi').prop("checked", true);
                        }
                        if (response.data_registrasi.jenis_jaminan == 'Asuransi') {
                            $('#modal-form #Asuransi').prop("checked", true);
                        }
                        if (response.data_registrasi.jenis_jaminan == 'Perusahaan') {
                            $('#modal-form #Perusahaan').prop("checked", true);
                        }
                        if (response.data_registrasi.jenis_jaminan == 'COB') {
                            $('#modal-form #COB').prop("checked", true);
                        }
                        if (response.data_registrasi.jenis_jaminan == 'KMK') {
                            $('#modal-form #KMK').prop("checked", true);
                        }
                        $('#modal-form #nama_jaminan').val(response.data_registrasi.nama_jaminan).prop("required",
                            true);
                        $('#modal-form #hak_pasien').val(response.hak_pasien).trigger('change').prop("required", true);
                        $('#modal-form #bed_hinai').val(response.bed_hinai);
                        $('#modal-form #tanggal_masuk').val(response.tanggal_masuk).prop("required", true);
                    }

                    if (!response.data_pasien) {
                        $('#modal-form #mrn').prop("disabled", true);
                        $('#modal-form #nama_pasien').prop("disabled", true);
                        $('#modal-form #nik').prop("disabled", true);
                        $('#modal-form #tempat_lahir').prop("disabled", true);
                        $('#modal-form #tanggal_lahir').prop("disabled", true);
                        $('#modal-form [name=jk]').prop("disabled", true);
                        $('#modal-form #no_telp').prop("disabled", true);
                        $('#modal-form #alamat').prop("disabled", true);
                        $('#modal-form #agama').prop("disabled", true);

                        $('#modal-form #no_registrasi').prop("disabled", true);
                        $('#modal-form #diagnosa').prop("disabled", true);
                        $('#modal-form #id_dokter').prop("disabled", true);
                        $('#modal-form [name=jenis_jaminan]').prop("disabled", true);
                        $('#modal-form #nama_jaminan').prop("disabled", true);
                        $('#modal-form #hak_pasien').prop("disabled", true);
                        $('#modal-form #bed_hinai').prop("disabled", true);
                        $('#modal-form #tanggal_masuk').prop("disabled", true);
                    }

                    $('#modal-form #keterangan_fo').val(response.keterangan_fo);
                    $('#modal-form #keterangan_perawat').val(response.keterangan_perawat);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function pindahForm(url) {
            resetForm();
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Pindah Kamar');
            $('#modal-form form')[0].reset();
            $('#modal-form [name=_method]').val('put');
            var htmlkamarbaru = '';

            $.get(url)
                .done((response) => {
                    $('#modal-form form').attr("action", "{{ url('bedmanagement/pindahkamar/') }}/" + response
                        .bed_ruangan.no_kamar);
                    $('#modal-form #mrn').val(response.bed_ruangan.mrn).prop("disabled", false).prop("readonly", true);
                    $('#modal-form #nama_pasien').val(response.bed_ruangan.nama_pasien).prop("disabled", false).prop(
                        "readonly", true);
                    $('#modal-form #nik').val(response.bed_ruangan.data_pasien.nik).prop("disabled", true);
                    $('#modal-form #tempat_lahir').val(response.bed_ruangan.data_pasien.tempat_lahir).prop("disabled",
                        true);
                    $('#modal-form #tanggal_lahir').val(response.bed_ruangan.data_pasien.tanggal_lahir).prop(
                        "disabled", true);
                    $('#modal-form [name=jk]').prop("disabled", true);
                    if (response.bed_ruangan.data_pasien.jk == 'Perempuan') {
                        $('#modal-form #perempuan').prop("checked", true);
                    }
                    if (response.bed_ruangan.data_pasien.jk == 'Laki-Laki') {
                        $('#modal-form #laki-laki').prop("checked", true);
                    }
                    $('#modal-form #no_telp').val(response.bed_ruangan.data_pasien.no_telp).prop("disabled", true);
                    $('#modal-form #alamat').val(response.bed_ruangan.data_pasien.alamat).prop("disabled", true);
                    $('#modal-form #agama').val(response.bed_ruangan.data_pasien.agama).prop("disabled", true);

                    $('#modal-form #no_registrasi').val(response.no_registrasi).prop("readonly", true);
                    $('#modal-form #no_kamar').val(response.bed_ruangan.no_kamar).prop("disabled", false).prop(
                        "readonly", true);
                    $('#modal-form #diagnosa').val(response.bed_ruangan.diagnosa);
                    $('#modal-form #id_dokter').val(response.bed_ruangan.id_dokter).prop("selected", true).trigger(
                        'change');
                    if (response.bed_ruangan.data_registrasi.jenis_jaminan == 'JKN') {
                        $('#modal-form #JKN').prop("checked", true);
                    }
                    if (response.bed_ruangan.data_registrasi.jenis_jaminan == 'Pribadi') {
                        $('#modal-form #Pribadi').prop("checked", true);
                    }
                    if (response.bed_ruangan.data_registrasi.jenis_jaminan == 'Asuransi') {
                        $('#modal-form #Asuransi').prop("checked", true);
                    }
                    if (response.bed_ruangan.data_registrasi.jenis_jaminan == 'Perusahaan') {
                        $('#modal-form #Perusahaan').prop("checked", true);
                    }
                    if (response.bed_ruangan.data_registrasi.jenis_jaminan == 'COB') {
                        $('#modal-form #COB').prop("checked", true);
                    }
                    if (response.bed_ruangan.data_registrasi.jenis_jaminan == 'KMK') {
                        $('#modal-form #KMK').prop("checked", true);
                    }
                    $('#modal-form #nama_jaminan').val(response.bed_ruangan.data_registrasi.nama_jaminan);
                    $('#modal-form #hak_pasien').val(response.bed_ruangan.hak_pasien).prop("selected", true).trigger(
                        'change');
                    $('#modal-form #bed_hinai').val(response.bed_ruangan.bed_hinai);
                    $('#modal-form #tanggal_masuk').val(response.bed_ruangan.tanggal_masuk);
                    $('#modal-form #keterangan_fo').val(response.bed_ruangan.keterangan_fo);
                    $('#modal-form #keterangan_perawat').val(response.bed_ruangan.keterangan_perawat);
                    $('#lama').text("Lama");
                    htmlkamarbaru = `
                    <div class="form-group">
                    <label for="no_kamar_baru">No Kamar Baru*</label>
                    <select name="no_kamar_baru" id="no_kamar_baru" class="form-control form-control-sm select2bs4" required>
                        <option value="">Pilih No Kamar Baru</option>`;
                    $.each(response.bed_kosong, function(key, value) {
                        htmlkamarbaru += `<option value="` + value.no_kamar + `">` + value.no_kamar +
                            `</option>`;
                    });

                    htmlkamarbaru += `
                    </select>
                    <span class="help-block with-errors" style="color:red"></span>
                    </div>
                    `;
                    $('#kamar_baru').html(htmlkamarbaru);

                    $('#modal-form #kamar_baru #no_kamar_baru').select2({
                        theme: 'bootstrap4',
                        placeholder: "Pilih No Kamar Baru",
                        allowClear: true,
                        dropdownCssClass: 'text-sm p-0'
                    }).prop('autofocus', true);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function pulangForm(url) {
            $('#modal-pulang').modal('show');
            $('#modal-pulang .modal-title').text('Yakin ingin pulangkan pasien?');
            $('#modal-pulang form')[0].reset();
            $('#modal-pulang [name=_method]').val('post');
            var htmlkamarbaru = '';

            $.get(url)
                .done((response) => {
                    $('#modal-pulang form').attr("action", "{{ url('bedmanagement/pulang/') }}/" + response
                        .bed_ruangan.no_kamar);
                    $('#modal-pulang #mrn').val(response.bed_ruangan.mrn).prop("readonly", true);
                    $('#modal-pulang #nama_pasien').val(response.bed_ruangan.nama_pasien).prop("readonly", true);

                    $('#modal-pulang #no_kamar').val(response.bed_ruangan.no_kamar).prop("readonly", true);
                    $('#modal-pulang #diagnosa').val(response.bed_ruangan.diagnosa).prop("readonly", true);
                    $('#modal-pulang #id_dokter').val(response.bed_ruangan.id_dokter).prop("readonly", true);
                    $('#modal-pulang #nama_dokter').val(response.bed_ruangan.dpjp.nama_dokter).prop("readonly", true);
                    $('#modal-pulang #kode_ruangan').val(response.bed_ruangan.kode_ruangan).prop("readonly", true);
                    $('#modal-pulang #nama_ruangan').val(response.bed_ruangan.ruangan_bed.nama_ruangan).prop("readonly",
                        true);
                    $('#modal-pulang [name=jenis_jaminan]').prop("disabled", true);
                    if (response.bed_ruangan.data_registrasi.jenis_jaminan == 'JKN') {
                        $('#modal-pulang #JKN').prop("checked", true);
                    }
                    if (response.bed_ruangan.data_registrasi.jenis_jaminan == 'Pribadi') {
                        $('#modal-pulang #Pribadi').prop("checked", true);
                    }
                    if (response.bed_ruangan.data_registrasi.jenis_jaminan == 'Asuransi') {
                        $('#modal-pulang #Asuransi').prop("checked", true);
                    }
                    if (response.bed_ruangan.data_registrasi.jenis_jaminan == 'Perusahaan') {
                        $('#modal-pulang #Perusahaan').prop("checked", true);
                    }
                    if (response.bed_ruangan.data_registrasi.jenis_jaminan == 'COB') {
                        $('#modal-pulang #COB').prop("checked", true);
                    }
                    if (response.bed_ruangan.data_registrasi.jenis_jaminan == 'KMK') {
                        $('#modal-pulang #KMK').prop("checked", true);
                    }
                    $('#modal-pulang #nama_jaminan').val(response.bed_ruangan.data_registrasi.nama_jaminan).prop(
                        "disabled", true);
                    $('#modal-pulang #hak_pasien').val(response.bed_ruangan.hak_pasien).prop("readonly", true);
                    $('#modal-pulang #bed_hinai').val(response.bed_ruangan.bed_hinai).prop("readonly", true);
                    $('#modal-pulang #tanggal_masuk').val(response.bed_ruangan.tanggal_masuk).prop("readonly", true);
                    $('#modal-pulang #keterangan_pulang').val(response.bed_ruangan.keterangan_pulang);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function countBOR() {
            var ruangan = $("#ruangan option:selected").val();

            $.ajax({
                url: '{{ route('pasiendirawat.countbor') }}',
                type: 'post',
                data: {
                    _token: $('[name=csrf-token]').attr('content'),
                    ruangan: ruangan
                },
                success: function(response) {
                    $('#bor').text(response.bor + ' %');
                    $('#bed_kosong').text(response.bed_kosong);
                    $('#total_bed').text(response.total_bed);
                    $('#total_pasien').text(response.total_pasien);
                    $('#lebih3h').text(response.lebih3h);
                    $('#kurang3h').text(response.kurang3h);
                },
                error: function() {

                }
            });

        }

        function resetForm() {
            $('#modal-form .modal-title').text('');

            $('#notifikasi').html('');
            $('#error-info').text(null).removeClass('text-danger').removeClass('text-success');
            $('#modal-form #mrn').prop("disabled", false).prop("readonly", false);
            $('#modal-form #nama_pasien').prop("disabled", false).prop("readonly", false);
            $('#modal-form #nik').prop("disabled", false).prop("readonly", false);
            $('#modal-form #tempat_lahir').prop("disabled", false).prop("readonly", false);
            $('#modal-form #tanggal_lahir').prop("disabled", false).prop("readonly", false);
            $('#modal-form [name=jk]').prop("disabled", false).prop("readonly", false);
            $('#perempuan').prop("disabled", false).prop("readonly", false).prop("checked", false).trigger('change');
            $('#laki-laki').prop("disabled", false).prop("readonly", false).prop("checked", false).trigger('change');
            $('#modal-form #no_telp').prop("disabled", false).prop("readonly", false);
            $('#modal-form #alamat').prop("disabled", false).prop("readonly", false);
            $('#modal-form #agama').prop("disabled", false).prop("readonly", false);
            $('#modal-form #no_kamar').prop("disabled", false).prop("readonly", false);

            $('#kamar_baru').html('');
            $('#modal-form #no_kamar').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form #no_registrasi').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form #diagnosa').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form [name=id_dokter]').val(null).prop("disabled", false).prop("readonly", false).trigger('change');
            $('#JKN').prop("disabled", false).prop("readonly", false).prop("checked", false).trigger('change');
            $('#Pribadi').prop("disabled", false).prop("readonly", false).prop("checked", false).trigger('change');
            $('#Asuransi').prop("disabled", false).prop("readonly", false).prop("checked", false).trigger('change');
            $('#Perusahaan').prop("disabled", false).prop("readonly", false).prop("checked", false).trigger('change');
            $('#COB').prop("disabled", false).prop("readonly", false).prop("checked", false).trigger('change');
            $('#KMK').prop("disabled", false).prop("readonly", false).prop("checked", false).trigger('change');
            $('#modal-form #nama_jaminan').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form [name=hak_pasien]').val(null).prop("disabled", false).prop("readonly", false).trigger('change');
            $('#modal-form #bed_hinai').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form #tanggal_masuk').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form #keterangan_fo').val(null).prop("disabled", false).prop("readonly", false);
            $('#modal-form #keterangan_perawat').val(null).prop("disabled", false).prop("readonly", false);

            $('#modal-form form')[0].reset();
        }

        function namaJaminan() {
            var jenis_jaminan = $('[name=jenis_jaminan]:checked').val();

            $('#modal-form [name=nama_jaminan]').val(null);
            if (jenis_jaminan == 'JKN') {
                $('#modal-form [name=nama_jaminan]').val('BPJS Kesehatan');
            }
            if (jenis_jaminan == 'Pribadi') {
                $('#modal-form [name=nama_jaminan]').val('Pribadi');
            }
            if (jenis_jaminan == 'KMK') {
                $('#modal-form [name=nama_jaminan]').val('Kementerian Kesehatan Republik Indonesia');
            }
        }

        function detailPasien(url) {
            $('#modal-detail').modal('show');
            $('#modal-detail .modal-title').text('Detail Data Pasien');
            $('#modal-detail form')[0].reset();
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
                        $('#perempuan2').prop("checked", true).trigger('change');
                    }
                    if (response.jk == 'Laki-Laki') {
                        $('#laki-laki2').prop("checked", true).trigger('change');
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
