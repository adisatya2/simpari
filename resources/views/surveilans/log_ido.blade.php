<div class="col-sm-12">
    @foreach ($logido as $log)
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h5 class="modal-title">Operasi ke-{{ $log->operasi_ke }}</h5>
                <div>
                    <button type="button" class="btn m-0" onclick="edit_data_operasi('{{ $log->id }}')"><i
                            class="fas fa-pen-square"></i>
                        Edit
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 table-responsive">
                    <table class="table table-sm">
                        <tr>
                            <td class="align-top text-nowrap text-bold">ID</td>
                            <td class="align-top">:</td>
                            <td>{{ $log->id }}</td>
                            <td class="align-top text-nowrap text-bold">Operasi ke</td>
                            <td class="align-top">:</td>
                            <td>{{ $log->operasi_ke }}</td>
                        </tr>
                        <tr>
                            <td class="align-top text-nowrap text-bold">Jadwal Operasi</td>
                            <td class="align-top">:</td>
                            <td>{{ $log->jadwal_operasi }}</td>
                            <td class="align-top text-nowrap text-bold">Jenis Operasi</td>
                            <td class="align-top">:</td>
                            <td>{{ $log->jenis_operasi }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <hr>
            <div id="accordion">
                {{-- Bundle Pre Operasi IDO --}}
                <div class="card card-danger">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            <a class="d-block w-100" data-toggle="collapse" href="#collapsePreOperasi">
                                Bundles Pre Operasi
                            </a>
                        </h4>
                    </div>
                    <div id="collapsePreOperasi" class="collapse show" data-parent="#accordion" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                @if (isset($log->data_ruang_perawatan))
                                <div class="col-lg-6 table-responsive">
                                    <table class="table table-sm">
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Ruang Perawatan</td>
                                            <td>:</td>
                                            <td>{{ $log->data_ruang_perawatan->nama_ruangan }}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Suhu</td>
                                            <td>:</td>
                                            <td>{{ $log->suhu }}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">GDS / Kadar Gula Darah
                                            </td>
                                            <td>:</td>
                                            <td>{{ $log->gds }}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Screening MRSA</td>
                                            <td>:</td>
                                            <td>{{ $log->screening_mrsa }}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Pencukuran Dengan</td>
                                            <td>:</td>
                                            <td>{{ $log->pencukuran_dengan }}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Antibiotik Profilaksis
                                            </td>
                                            <td class="align-top">:</td>
                                            <td>{{ nl2br($log->antibiotik_profilaksis) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Waktu Pmbr AB
                                                Profilaksis
                                            </td>
                                            <td class="align-top">:</td>
                                            <td>{{ $log->waktu_pemberian_profilaksis }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-6 table-responsive">
                                    <table class="table table-sm">
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Riwayat Penyakit</td>
                                            <td class="align-top">:</td>
                                            <td>{{ nl2br($log->riwayat_penyakit) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Bundles Pre Operasi</td>
                                            <td class="align-top">:</td>
                                            <td>
                                                @foreach ($ido_bundle as $ido)
                                                <?php $checked = '<i class="fa-fw far fa-square"></i>'; ?>
                                                @if ($ido->waktu == 'Pre Operasi')
                                                @foreach (explode(', ', $log->bundle_pre) as $bundle)
                                                <?php
                                                                    
                                                                    if ($bundle == $ido->bundle) {
                                                                        $checked = '<i class="fa-fw fas fa-check-square"></i>';
                                                                    }
                                                                    ?>
                                                @endforeach
                                                <div class="form-check p-0">
                                                    {!! $checked !!}

                                                    {{ $ido->bundle }}
                                                </div>
                                                @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">User</td>
                                            <td>:</td>
                                            <td>{{ isset($log->user_update_pre)?$log->user_update_pre:'' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <button type="button" class="btn btn-default btn-sm w-100 m-0"
                                        onclick="edit_preoperasi_ido('{{ $log->id }}')"><i
                                            class="fas fa-pen-square"></i>
                                        Edit Data Pre Operasi
                                    </button>
                                </div>
                                @else
                                <div class="col-sm-12 text-center">
                                    <button type="button" class="btn btn-default btn-sm w-100 m-0"
                                        onclick="tambah_preoperasi_ido('{{ $log->id }}')"><i
                                            class="fas fa-plus-square"></i>
                                        Input Data Pre Operasi
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                {{-- Bundle Intra Operasi IDO --}}
                <div class="card card-warning">
                    <div class="card-header">
                        <h4 class="card-title w-100">
                            <a class="d-block w-100" data-toggle="collapse" href="#collapseIntraOperasi">
                                Bundles Intra Operasi
                            </a>
                        </h4>
                    </div>
                    <div id="collapseIntraOperasi" class="collapse show" data-parent="#accordion" aria-expanded="true">
                        <div class="card-body">
                            <div class="row">
                                @if (isset($log->ruang_operasi) && isset($log->nama_prosedur_operasi))
                                <div class="col-lg-6 table-responsive">
                                    <table class="table table-sm">
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Ruang/Kamar Operasi</td>
                                            <td>:</td>
                                            <td>{{ $log->ruang_operasi }}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Nama Prosedur Operasi
                                            </td>
                                            <td>:</td>
                                            <td>{{ $log->nama_prosedur_operasi }}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Kualifikasi Daerah
                                                Operasi
                                            </td>
                                            <td>:</td>
                                            <td>{{ $log->kualifikasi_daerah_operasi }}</td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Lama Operasi</td>
                                            <td>:</td>
                                            <td>{{ $log->lama_operasi }} menit</td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Antibiotik Tambahan
                                                Intra Operasi</td>
                                            <td>:</td>
                                            <td>{{ nl2br($log->antibiotik_tambahan_intra) }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-6 table-responsive">
                                    <table class="table table-sm">
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">Bundles Intra Operasi
                                            </td>
                                            <td class="align-top">:</td>
                                            <td>
                                                @foreach ($ido_bundle as $ido)
                                                <?php $checked = '<i class="fa-fw far fa-square"></i>'; ?>
                                                @if ($ido->waktu == 'Intra Operasi')
                                                @foreach (explode(', ', $log->bundle_intra) as $bundle)
                                                <?php
                                                                    
                                                                    if ($bundle == $ido->bundle) {
                                                                        $checked = '<i class="fa-fw fas fa-check-square"></i>';
                                                                    }
                                                                    ?>
                                                @endforeach
                                                <div class="form-check p-0">
                                                    {!! $checked !!}

                                                    {{ $ido->bundle }}
                                                </div>
                                                @endif
                                                @endforeach
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="align-top text-nowrap text-bold">User</td>
                                            <td>:</td>
                                            <td>{{ isset($log->user_update_pre)?$log->user_update_intra:'' }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-sm-12 text-center">
                                    <button type="button" class="btn btn-default btn-sm w-100 m-0"
                                        onclick="edit_intraoperasi_ido('{{ $log->id }}')"><i
                                            class="fas fa-pen-square"></i>
                                        Edit Data Intra Operasi
                                    </button>
                                </div>
                                @else
                                <div class="col-sm-12 text-center">
                                    <button type="button" class="btn btn-default btn-sm w-100 m-0"
                                        onclick="tambah_intraoperasi_ido('{{ $log->id }}')"><i
                                            class="fas fa-plus-square"></i>
                                        Input Data Intra Operasi
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
                {{-- Bundle Post Operasi IDO --}}
                <div class="card card-info">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-9">
                                <h4 class="card-title w-100">
                                    <a class="d-block w-100" data-toggle="collapse" href="#collapsePostOperasi">
                                        Bundles Post Operasi
                                    </a>
                                </h4>
                            </div>
                            <div class="col-sm-3 text-right">
                                <button type="button" class="btn btn-xs m-0"
                                    onclick="tambah_postoperasi_ido('{{ $log->id }}',{{ max_ido_detail($log->id) }})"><i
                                        class="fas fa-plus-square"></i>
                                    Tambah Data
                                </button>
                            </div>
                        </div>
                    </div>
                    <div id="collapsePostOperasi" class="collapse show" data-parent="#accordion" aria-expanded="true">
                        <div class="card-body">
                            <div id="accordion">
                                @if (count($log->detail_list)>0)
                                @foreach ($log->detail_list as $list)
                                <div class="card card-gray w-100">
                                    <div class="card-header">
                                        <div class="row">
                                            <h4 class="card-title w-100">
                                                <a class="d-block w-100" data-toggle="collapse"
                                                    href="#collapse{{ $list->id }}">
                                                    Observasi ke-{{$list->observasi_ke}} |
                                                    {{tanggal_indonesia($list->tanggal_observasi)}}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                    <div id="collapse{{ $list->id }}" class="collapse" data-parent="#accordion"
                                        aria-expanded="true">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6 table-responsive">
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td class="align-top text-nowrap text-bold">Status IDO
                                                            </td>
                                                            <td>:</td>
                                                            <td>{{ $list->status }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-top text-nowrap text-bold">Ruang
                                                                Perawatan</td>
                                                            <td class="align-top">:</td>
                                                            <td>{{ nl2br($list->data_ruang_perawatan->nama_ruangan)
                                                                }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-top text-nowrap text-bold">Keterangan
                                                            </td>
                                                            <td class="align-top">:</td>
                                                            <td>{{ nl2br($list->keterangan) }}</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-lg-6 table-responsive">
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <td class="align-top text-nowrap text-bold">Bundles IDO
                                                            </td>
                                                            <td class="align-top">:</td>
                                                            <td>
                                                                @foreach ($ido_bundle as $ido)
                                                                <?php $checked = '<i class="fa-fw far fa-square"></i>'; ?>
                                                                @if ($ido->waktu == 'Post Operasi')
                                                                <?php foreach(explode('; ', $list->bundle_post) as
                                                                    $bundle){
                                                                        if ($bundle == $ido->bundle) {
                                                                            $checked = '<i class="fa-fw fas fa-check-square"></i>';
                                                                        }
                                                                    }
                                                                    ?>

                                                                <div class="form-check p-0">
                                                                    {!! $checked !!}

                                                                    {{ $ido->bundle }}
                                                                </div>
                                                                @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-top text-nowrap text-bold">Tanda dan
                                                                Gejala</td>
                                                            <td class="align-top">:</td>
                                                            <td>
                                                                @foreach ($ido_gejala as $idogejala)
                                                                <?php $checked = '<i class="fa-fw far fa-square"></i>'; ?>
                                                                @foreach (explode(', ', $list->gejala) as $gejala)
                                                                <?php
                                                                                    if ($gejala == $idogejala->gejala) {
                                                                                        $checked = '<i class="fa-fw fas fa-check-square"></i>';
                                                                                    }
                                                                                    ?>
                                                                @endforeach
                                                                <div class="form-check p-0">
                                                                    {!! $checked !!}
                                                                    {{ $idogejala->gejala }}
                                                                </div>
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="align-top text-nowrap text-bold">User</td>
                                                            <td>:</td>
                                                            <td>{{ isset($list->user_create)?$list->user_create:'' }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="col-sm-12 text-center">
                                                    <button type="button" class="btn btn-default btn-sm m-0"
                                                        onclick="edit_postoperasi_ido('{{ $list->id }}')"><i
                                                            class="fas fa-pen-square"></i>
                                                        Edit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                @endforeach
                                @else
                                <div class="col-sm-12 text-center">Data tidak ditemukan.</div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>