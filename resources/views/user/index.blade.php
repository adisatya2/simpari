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
                            {{-- <button onclick="addForm('{{ route('user.store') }}')"
                                class="btn btn-sm  btn-success"><i class="fa fa-plus-circle"></i>
                                Tambah</button> --}}
                            <a href="{{ route('user.create') }}" class="btn btn-sm  btn-success"><i
                                    class="fa fa-plus-circle"></i>
                                Tambah</a>
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
                            <form action="" method="post" class="form-user">
                                @csrf
                                <table id="table" class="table table-bordered table-hover table-head-fixed text-nowrap">
                                    <thead>
                                        <th>Username</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Aktif</th>
                                        <th>Created At</th>
                                        <th width="10%">Aksi</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>
<!-- /.content -->

@includeIf('user.editform')
@includeIf('user.gantipasswordform')
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

        $(function() {
            table = $("#table").DataTable({
                "processing": true,
                "serverSide": true,
                "autoWidth": false,
                "stateSave": true,
                "order": [
                    [5, 'desc']
                ],
                "dom": 'Blfrtip',
                "buttons": [
                    "excel",
                    "print",
                    {
                        text: "Refresh",
                        action: function(e, dt, node, config) {
                            dt.ajax.reload(null, false);
                        },
                    },
                    "colvis"
                ],
                "ajax": {
                    url: '{{ route('user.data') }}',
                },
                columns: [{
                        data: 'username'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'role'
                    },
                    {
                        data: 'aktif',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    },
                ]
            });

            $('#modal-form').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.post($('#modal-form form').attr('action'), $('#modal-form form')
                            .serialize())
                        .done((response) => {
                            $('#modal-form').modal('hide');
                            alert(response);
                            table.ajax.reload(null,false);
                        })
                        .fail((errors) => {
                            alert(errors[0].message);
                            return;
                        })
                }
            });

            $('#modal-gantipassword').validator().on('submit', function(e) {
                if (!e.preventDefault()) {
                    $.post($('#modal-gantipassword form').attr('action'), $('#modal-gantipassword form')
                            .serialize())
                        .done((response) => {
                            $('#modal-gantipassword').modal('hide');
                            alert(response);
                            table.ajax.reload(null,false);
                        })
                        .fail((errors) => {
                            alert(errors[0].message);
                            return;
                        })
                }
            });

        });

        function editForm(url) {
            $('#modal-form').modal('show');
            $('#modal-form .modal-title').text('Edit Data User');
            $('#modal-form form')[0].reset();
            $('#modal-form form').attr('action', url);
            $('#modal-form [name=_method]').val('put');
            $('#modal-form [name=roles]').val('').trigger('change');
            $('#modal-form').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            })

            $.get(url)
                .done((response) => {
                    $('#modal-form [name=id_user]').val(response.id);
                    $('#modal-form [name=username]').val(response.username);
                    $('#modal-form [name=nama_user]').val(response.name);
                    $('#modal-form [name=email]').val(response.email);
                    if (response.aktif == 1) {
                        $('#aktif').prop("checked", true);
                    }
                    if(response.roles[0]){
                        $('#modal-form [name=roles]').val(response.roles[0].name).trigger('change')
                    }
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }

        function changePassword(url,show) {
            $('#modal-gantipassword').modal('show');
            $('#modal-gantipassword .modal-title').text('Ganti Password User');
            $('#modal-gantipassword form')[0].reset();
            $('#modal-gantipassword form').attr('action', url);
            $('#modal-gantipassword [name=_method]').val('put');
            $('#modal-gantipassword').on('shown.bs.modal', function() {
                $(this).find('[autofocus]').focus();
            })

            $.get(show)
                .done((response) => {
                    $('#modal-gantipassword [name=id_user2]').val(response.id);
                    $('#modal-gantipassword [name=username2]').val(response.username);
                })
                .fail((errors) => {
                    alert('Tidak dapat menampilkan data');
                    return;
                })
        }
</script>
@endpush