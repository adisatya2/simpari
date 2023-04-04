<div class="col-sm-12">
    @foreach ($logisk as $log)
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="modal-title">{{ $log->id }}</h5>
                    <div>
                        <button type="button" class="btn m-0"
                            onclick="tambah_detail_isk('{{ $log->id }}',{{ max_isk_detail($log->id) }})"><i
                                class="fas fa-plus-square"></i>
                            Tambah Bundle
                        </button>
                        <button type="button" class="btn m-0" onclick="edit_header_isk('{{ $log->id }}')"><i
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
                    <div class="col-lg-6 table-responsive">
                        <table class="table table-sm">
                            <tr>
                                <td class="align-top text-nowrap text-bold">ID</td>
                                <td class="align-top">:</td>
                                <td>{{ $log->id }}</td>
                            </tr>
                            <tr>
                                <td class="align-top text-nowrap text-bold">Ruang Perawatan</td>
                                <td class="align-top">:</td>
                                <td>{{ $log->data_ruang_perawatan->nama_ruangan }}</td>
                            </tr>
                            <tr>
                                <td class="align-top text-nowrap text-bold">Pemasangan Urine Cath Ke</td>
                                <td class="align-top">:</td>
                                <td>{{ $log->pemasangan_ke }}</td>
                            </tr>
                            <tr>
                                <td class="align-top text-nowrap text-bold">Ruang Pemasangan UC</td>
                                <td class="align-top">:</td>
                                <td>{{ $log->data_ruang_pemasangan->nama_ruangan }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-6 table-responsive">
                        <table class="table table-sm">
                            <tr>
                                <td class="align-top text-nowrap text-bold">Petugas Pemasangan</td>
                                <td class="align-top">:</td>
                                <td>{{ $log->petugas_pasang }}</td>
                            </tr>
                            <tr>
                                <td class="align-top text-nowrap text-bold">Nomor Urine Catheter</td>
                                <td class="align-top">:</td>
                                <td>{{ $log->nomor_uc }}</td>
                            </tr>
                            <tr>
                                <td class="align-top text-nowrap text-bold">Tanggal Pemasangan</td>
                                <td class="align-top">:</td>
                                <td>{{ $log->tanggal_pemasangan ? tanggal_indonesia($log->tanggal_pemasangan) : '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="align-top text-nowrap text-bold">Tanggal Dilepas</td>
                                <td class="align-top">:</td>
                                <td>{{ $log->tanggal_dilepas ? tanggal_indonesia($log->tanggal_dilepas) : '' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <hr>
                {{-- Bundle ISK --}}
                <div id="accordion">
                    @foreach ($log->detail_list as $list)
                        <div class="card card-gray">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    <a class="d-block w-100" data-toggle="collapse"
                                        href="#collapse{{ $list->id }}">
                                        Observasi Ke-{{ $list->observasi_ke }} -
                                        {{ tanggal_indonesia($list->tanggal_observasi) }}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse{{ $list->id }}" class="collapse" data-parent="#accordion">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 table-responsive">
                                            <table class="table table-sm">
                                                <tr>
                                                    <td class="align-top text-nowrap text-bold">Status ISK</td>
                                                    <td>:</td>
                                                    <td>{{ $list->status }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="align-top text-nowrap text-bold">Antibiotik</td>
                                                    <td class="align-top">:</td>
                                                    <td>{{ nl2br($list->antibiotik) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="align-top text-nowrap text-bold">Hasil Kultur</td>
                                                    <td class="align-top">:</td>
                                                    <td>{{ nl2br($list->hasil_kultur) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="align-top text-nowrap text-bold">Tanggal Pmrksn Kultur
                                                    </td>
                                                    <td class="align-top">:</td>
                                                    <td>{{ $list->tanggal_pemeriksaan_kultur ? tanggal_indonesia($list->tanggal_pemeriksaan_kultur) : '' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-lg-6 table-responsive">
                                            <table class="table table-sm">
                                                <tr>
                                                    <td class="align-top text-nowrap text-bold">Bundle ISK</td>
                                                    <td class="align-top">:</td>
                                                    <td>
                                                        @foreach ($isk_bundle as $isk)
                                                            <?php $checked = '<i class="fa-fw far fa-square"></i>'; ?>
                                                            @foreach (explode(', ', $list->bundle) as $bundle)
                                                                <?php
                                                                if ($bundle == $isk->bundle) {
                                                                    $checked = '<i class="fa-fw fas fa-check-square"></i>';
                                                                }
                                                                ?>
                                                            @endforeach
                                                            <div class="form-check">
                                                                {!! $checked !!}
                                                                {{ $isk->bundle }}
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="align-top text-nowrap text-bold">Tanda dan Gejala</td>
                                                    <td class="align-top">:</td>
                                                    <td>
                                                        @foreach ($isk_gejala as $iskgejala)
                                                            <?php $checked = '<i class="fa-fw far fa-square"></i>'; ?>
                                                            @foreach (explode(', ', $list->gejala) as $gejala)
                                                                <?php
                                                                if ($gejala == $iskgejala->gejala) {
                                                                    $checked = '<i class="fa-fw fas fa-check-square"></i>';
                                                                }
                                                                ?>
                                                            @endforeach
                                                            <div class="form-check">
                                                                {!! $checked !!}
                                                                {{ $iskgejala->gejala }}
                                                            </div>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-sm-12 text-center">
                                            <button type="button" class="btn btn-default btn-sm m-0"
                                                onclick="edit_detail_isk('{{ $list->id }}')"><i
                                                    class="fas fa-pen-square"></i>
                                                Edit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
