<div class="col-sm-12">
    @foreach ($logalatinvasif as $log)
        <div id="{{ $log->id }}">
            <div class="card card-info">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title w-100">
                        <a class="d-block w-100" data-toggle="collapse" href="#collapse{{ $log->id }}">
                            {{ $log->id }} - {{ $log->alat_invasif->nama_alat }} - Pemasangan ke
                            {{ $log->pemasangan_ke }} -
                            {{ $log->tanggal_pemasangan }}
                        </a>
                    </h4>
                </div>
                <div id="collapse{{ $log->id }}" class="collapse hide" data-parent="#{{ $log->id }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 row">
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>Alat yang Terpasang</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    {{ $log->alat_invasif->nama_alat }}
                                </div>
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>Pemasangan Ke</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    {{ $log->pemasangan_ke }}
                                </div>
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>Tanggal Pemasangan</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end d-flex justify-content-end">
                                    {{ tanggal_indonesia($log->tanggal_pemasangan) }}
                                </div>
                            </div>
                            <div class="col-lg-6 row">
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>Ruang Pemasangan Alat</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end">
                                    {{ $log->data_ruangan->nama_ruangan }}
                                </div>
                                <div class="col-sm-4 text-bold d-flex justify-content-between">
                                    <div>Tanggal Alat Dilepas</div>
                                    <div>:</div>
                                </div>
                                <div class="col-sm-7 d-flex justify-content-end d-flex justify-content-end">
                                    {{ $log->tanggal_dilepas ? tanggal_indonesia($log->tanggal_dilepas) : '' }}
                                </div>
                            </div>
                            <div class="col-sm-12 mt-3 mb-0 d-flex justify-content-center">
                                <button type="button" class="btn btn-xs btn-info"
                                    onclick="edit_alat_invasif('{{ $log->id }}')"
                                    data-id="{{ $log->id }}"><i class="fa-fw fas fa-pen"></i> Edit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
