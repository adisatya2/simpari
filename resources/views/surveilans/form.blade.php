{{-- Header Phlebitis --}}
<div class="modal fade text-sm" id="modal-header-phlebitis">
    <form action="" id="formHeaderPhlebitis">
        @csrf
        @method('post')
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Phlebitis</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notifikasi"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="no_registrasi">No Registrasi Pasien<small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control form-control-sm" name="no_registrasi"
                                    id="no_registrasi" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="ruang_perawatan">Ruang Perawatan<small class="text-danger">*</small></label>
                                <select name="ruang_perawatan" id="ruang_perawatan"
                                    class="form-control form-control-sm ruang_perawatan" required>
                                    @foreach ($ruangan as $key => $item)
                                    <option value="{{ $key }}">
                                        {{ $item }} ({{ $key }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pemasangan_ke">Pemasangan IV Cath Ke<small
                                        class="text-danger">*</small></label>
                                <input type="number" class="form-control form-control-sm" name="pemasangan_ke"
                                    id="pemasangan_ke" min="1" max="99"
                                    value="{{ max_phlebitis_header($data_registrasi->no_registrasi) }}" autofocus
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="ruang_pemasangan_catheter">Ruang Pemasangan IV Catheter<small
                                        class="text-danger">*</small></label>
                                <select name="ruang_pemasangan_catheter" id="ruang_pemasangan_catheter"
                                    class="form-control form-control-sm ruanganpemasangan" required>
                                    <option value="" hidden>Pilih Ruangan</option>
                                    @foreach ($ruangan as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}
                                        ({{ $key }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="petugas_pasang">Petugas Pemasangan</label>
                                <input type="text" class="form-control form-control-sm" name="petugas_pasang"
                                    id="petugas_pasang">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nomor_catheter">Nomor IV Cath<small class="text-danger">*</small></label>
                                <input type="number" class="form-control form-control-sm" name="nomor_catheter"
                                    id="nomor_catheter" min="1" max="99" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_cairan">Jenis Cairan Infus<small class="text-danger">*</small></label>
                                <input type="text" class="form-control form-control-sm" name="jenis_cairan"
                                    id="jenis_cairan" required>
                                {{-- <select name="jenis_cairan" id="jenis_cairan"
                                    class="form-control form-control-sm jeniscairan" required>
                                    <option value="" hidden>Pilih Jenis Cairan</option>
                                    @foreach ($jenis_cairan as $jenis)
                                    <option value="{{ $jenis->nama_cairan }}">{{ $jenis->nama_cairan }}
                                    </option>
                                    @endforeach
                                </select> --}}
                            </div>
                            <div class="form-group">
                                <label for="lokasi_pemasangan">Lokasi Pemasangan<small
                                        class="text-danger">*</small></label>
                                <select name="lokasi_pemasangan" id="lokasi_pemasangan"
                                    class="form-control form-control-sm lokasicatheter" required>
                                    <option value="" hidden>Pilih Lokasi Pemasangan</option>
                                    @foreach ($lokasi_catheter as $lokasi)
                                    <option value="{{ $lokasi->lokasi }}">{{ $lokasi->lokasi }}
                                        ({{ $lokasi->lokasi2 }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pemasangan">Tanggal Pemasangan<small
                                        class="text-danger">*</small></label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_pemasangan"
                                    id="tanggal_pemasangan" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_dilepas">Tanggal Dilepas</label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_dilepas"
                                    id="tanggal_dilepas">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-default btn-reset mx-3">Batal</button>
                    <button type="submit" class="btn btn-primary mx-3" form="formHeaderPhlebitis"><i
                            class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Detail Phlebitis --}}
<div class="modal fade text-sm" id="modal-detail-phlebitis">
    <form action="" id="formDetailPhlebitis">
        @csrf
        @method('post')
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Phlebitis</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notifikasi"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="id_header">ID Header<small class="text-danger">*</small></label>
                                <input type="text" class="form-control form-control-sm" name="id_header" id="id_header"
                                    readonly required>
                                <input type="hidden" class="form-control form-control-sm" name="no_registrasi"
                                    id="no_registrasi" required>
                            </div>
                            <div class="form-group">
                                <label for="observasi_ke">Observasi Ke<small class="text-danger">*</small></label>
                                <input type="number" class="form-control form-control-sm" name="observasi_ke"
                                    id="observasi_ke" min="1" max="99" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_observasi">Tanggal Observasi<small
                                        class="text-danger">*</small></label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_observasi"
                                    id="tanggal_observasi" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="antibiotik_phlebitis">Antibiotik</label>
                                <textarea class="form-control form-control-sm" name="antibiotik_phlebitis"
                                    id="antibiotik_phlebitis" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="hasil_kultur_phlebitis">Hasil Kultur</label>
                                <textarea class="form-control form-control-sm" name="hasil_kultur_phlebitis"
                                    id="hasil_kultur_phlebitis" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pemeriksaan_kultur_phlebitis">Tanggal Pemeriksaan
                                    Kultur</label>
                                <input type="date" class="form-control form-control-sm"
                                    name="tanggal_pemeriksaan_kultur_phlebitis"
                                    id="tanggal_pemeriksaan_kultur_phlebitis">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Bundles Phlebitis</label>
                                @foreach ($phlebitis_bundle as $phlebitis)
                                <div class="form-check">
                                    <input class="form-check-input phlebitis_bundle" type="checkbox"
                                        value="{{ $phlebitis->bundle }}" name="phlebitis_bundle[]"
                                        id="{{ $phlebitis->bundle }}">
                                    <label class="form-check-label" for="{{ $phlebitis->bundle }}">
                                        {{ $phlebitis->bundle }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="">Tanda dan Gejala</label>
                                @foreach ($phlebitis_gejala as $phlebitisgejala)
                                <div class="form-check">
                                    <input class="form-check-input phlebitis_gejala" type="checkbox"
                                        value="{{ $phlebitisgejala->gejala }}" name="phlebitis_gejala[]"
                                        id="{{ $phlebitisgejala->gejala }}">
                                    <label class="form-check-label" for="{{ $phlebitisgejala->gejala }}">
                                        {{ $phlebitisgejala->gejala }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="status_phlebitis">Status Phlebitis<small
                                        class="text-danger">*</small></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_phlebitis"
                                        id="ya_phlebitis" value="Ya" required>
                                    <label class="form-check-label" for="ya_phlebitis">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_phlebitis"
                                        id="tidak_phlebitis" value="Tidak" required>
                                    <label class="form-check-label" for="tidak_phlebitis">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-default btn-reset mx-3">Batal</button>
                    <button type="submit" class="btn btn-primary mx-3" form="formDetailPhlebitis"><i
                            class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Header ISK --}}
<div class="modal fade text-sm" id="modal-header-isk">
    <form action="" id="formHeaderISK">
        @csrf
        @method('post')
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ISK</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notifikasi"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="no_registrasi">No Registrasi Pasien<small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control form-control-sm" name="no_registrasi"
                                    id="no_registrasi" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="ruang_perawatan">Ruang Perawatan<small class="text-danger">*</small></label>
                                <select name="ruang_perawatan" id="ruang_perawatan"
                                    class="form-control form-control-sm ruang_perawatan" required>
                                    @foreach ($ruangan as $key => $item)
                                    <option value="{{ $key }}">
                                        {{ $item }} ({{ $key }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pemasangan_ke">Pemasangan Urine Catheter Ke<small
                                        class="text-danger">*</small></label>
                                <input type="number" class="form-control form-control-sm" name="pemasangan_ke"
                                    id="pemasangan_ke" min="1" max="99"
                                    value="{{ max_isk_header($data_registrasi->no_registrasi) }}" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="ruang_pemasangan">Ruang Pemasangan Urine Catheter<small
                                        class="text-danger">*</small></label>
                                <select name="ruang_pemasangan" id="ruang_pemasangan"
                                    class="form-control form-control-sm ruanganpemasangan" required>
                                    <option value="" hidden>Pilih Ruangan</option>
                                    @foreach ($ruangan as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}
                                        ({{ $key }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="petugas_pasang">Petugas Pemasangan</label>
                                <input type="text" class="form-control form-control-sm" name="petugas_pasang"
                                    id="petugas_pasang">
                            </div>
                            <div class="form-group">
                                <label for="nomor_uc">Nomor Urine Catheter<small class="text-danger">*</small></label>
                                <input type="number" class="form-control form-control-sm" name="nomor_uc" id="nomor_uc"
                                    min="1" max="99" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pemasangan">Tanggal Pemasangan<small
                                        class="text-danger">*</small></label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_pemasangan"
                                    id="tanggal_pemasangan" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_dilepas">Tanggal Dilepas</label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_dilepas"
                                    id="tanggal_dilepas">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-default btn-reset mx-3">Batal</button>
                    <button type="submit" class="btn btn-primary mx-3" form="formHeaderISK"><i
                            class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Detail ISK --}}
<div class="modal fade text-sm" id="modal-detail-isk">
    <form action="" id="formDetailISK">
        @csrf
        @method('post')
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ISK</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notifikasi"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="id_header">ID Header<small class="text-danger">*</small></label>
                                <input type="text" class="form-control form-control-sm" name="id_header" id="id_header"
                                    readonly required>
                                <input type="hidden" class="form-control form-control-sm" name="no_registrasi"
                                    id="no_registrasi" required>
                            </div>
                            <div class="form-group">
                                <label for="observasi_ke">Observasi Ke<small class="text-danger">*</small></label>
                                <input type="number" class="form-control form-control-sm" name="observasi_ke"
                                    id="observasi_ke" min="1" max="99" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_observasi">Tanggal Observasi<small
                                        class="text-danger">*</small></label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_observasi"
                                    id="tanggal_observasi" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="antibiotik_isk">Antibiotik</label>
                                <textarea class="form-control form-control-sm" name="antibiotik_isk" id="antibiotik_isk"
                                    rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="hasil_kultur_isk">Hasil Kultur</label>
                                <textarea class="form-control form-control-sm" name="hasil_kultur_isk"
                                    id="hasil_kultur_isk" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pemeriksaan_kultur_isk">Tanggal Pemeriksaan
                                    Kultur</label>
                                <input type="date" class="form-control form-control-sm"
                                    name="tanggal_pemeriksaan_kultur_isk" id="tanggal_pemeriksaan_kultur_isk">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Bundles ISK</label>
                                @foreach ($isk_bundle as $isk)
                                <div class="form-check">
                                    <input class="form-check-input isk_bundle" type="checkbox"
                                        value="{{ $isk->bundle }}" name="isk_bundle[]" id="iskbundle{{ $isk->id }}">
                                    <label class="form-check-label" for="iskbundle{{ $isk->id }}">
                                        {{ $isk->bundle }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="">Tanda dan Gejala</label>
                                @foreach ($isk_gejala as $iskgejala)
                                <div class="form-check">
                                    <input class="form-check-input isk_gejala" type="checkbox"
                                        value="{{ $iskgejala->gejala }}" name="isk_gejala[]"
                                        id="iskgejala{{ $iskgejala->id }}">
                                    <label class="form-check-label" for="iskgejala{{ $iskgejala->id }}">
                                        {{ $iskgejala->gejala }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="status_isk">Status ISK<small class="text-danger">*</small></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_isk" id="ya_isk"
                                        value="Ya" required>
                                    <label class="form-check-label" for="ya_isk">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_isk" id="tidak_isk"
                                        value="Tidak" required>
                                    <label class="form-check-label" for="tidak_isk">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-default btn-reset mx-3">Batal</button>
                    <button type="submit" class="btn btn-primary mx-3" form="formDetailISK"><i
                            class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Header IADP --}}
<div class="modal fade text-sm" id="modal-header-iadp">
    <form action="" id="formHeaderIADP">
        @csrf
        @method('post')
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">IADP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notifikasi"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="no_registrasi">No Registrasi Pasien<small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control form-control-sm" name="no_registrasi"
                                    id="no_registrasi" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="ruang_perawatan">Ruang Perawatan<small class="text-danger">*</small></label>
                                <select name="ruang_perawatan" id="ruang_perawatan"
                                    class="form-control form-control-sm ruang_perawatan" required>
                                    @foreach ($ruangan as $key => $item)
                                    <option value="{{ $key }}">
                                        {{ $item }} ({{ $key }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pemasangan_ke">Pemasangan CVC Ke<small class="text-danger">*</small></label>
                                <input type="number" class="form-control form-control-sm" name="pemasangan_ke"
                                    id="pemasangan_ke" min="1" max="99"
                                    value="{{ max_iadp_header($data_registrasi->no_registrasi) }}" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="ruang_pemasangan">Ruang Pemasangan CVC<small
                                        class="text-danger">*</small></label>
                                <select name="ruang_pemasangan" id="ruang_pemasangan"
                                    class="form-control form-control-sm ruanganpemasangan" required>
                                    <option value="" hidden>Pilih Ruangan</option>
                                    @foreach ($ruangan as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}
                                        ({{ $key }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="petugas_pasang">Petugas Pemasangan</label>
                                <input type="text" class="form-control form-control-sm" name="petugas_pasang"
                                    id="petugas_pasang">
                            </div>
                            <div class="form-group">
                                <label for="nomor_cvc">Nomor CVC</label>
                                <input type="number" class="form-control form-control-sm" name="nomor_cvc"
                                    id="nomor_cvc" min="1" max="99">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pemasangan">Tanggal Pemasangan<small
                                        class="text-danger">*</small></label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_pemasangan"
                                    id="tanggal_pemasangan" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_dilepas">Tanggal Dilepas</label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_dilepas"
                                    id="tanggal_dilepas">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-default btn-reset mx-3">Batal</button>
                    <button type="submit" class="btn btn-primary mx-3" form="formHeaderIADP"><i
                            class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Detail IADP --}}
<div class="modal fade text-sm" id="modal-detail-iadp">
    <form action="" id="formDetailIADP">
        @csrf
        @method('post')
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">IADP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notifikasi"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="id_header">ID Header<small class="text-danger">*</small></label>
                                <input type="text" class="form-control form-control-sm" name="id_header" id="id_header"
                                    readonly required>
                                <input type="hidden" class="form-control form-control-sm" name="no_registrasi"
                                    id="no_registrasi" required>
                            </div>
                            <div class="form-group">
                                <label for="observasi_ke">Observasi Ke<small class="text-danger">*</small></label>
                                <input type="number" class="form-control form-control-sm" name="observasi_ke"
                                    id="observasi_ke" min="1" max="99" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_observasi">Tanggal Observasi<small
                                        class="text-danger">*</small></label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_observasi"
                                    id="tanggal_observasi" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="antibiotik_iadp">Antibiotik</label>
                                <textarea class="form-control form-control-sm" name="antibiotik_iadp"
                                    id="antibiotik_iadp" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="hasil_kultur_iadp">Hasil Kultur</label>
                                <textarea class="form-control form-control-sm" name="hasil_kultur_iadp"
                                    id="hasil_kultur_iadp" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pemeriksaan_kultur_iadp">Tanggal Pemeriksaan
                                    Kultur</label>
                                <input type="date" class="form-control form-control-sm"
                                    name="tanggal_pemeriksaan_kultur_iadp" id="tanggal_pemeriksaan_kultur_iadp">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Bundles IADP</label>
                                @foreach ($iadp_bundle as $iadp)
                                <div class="form-check">
                                    <input class="form-check-input iadp_bundle" type="checkbox"
                                        value="{{ $iadp->bundle }}" name="iadp_bundle[]" id="iadpbundle{{ $iadp->id }}">
                                    <label class="form-check-label" for="iadpbundle{{ $iadp->id }}">
                                        {{ $iadp->bundle }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="">Tanda dan Gejala</label>
                                @foreach ($iadp_gejala as $iadpgejala)
                                <div class="form-check">
                                    <input class="form-check-input iadp_gejala" type="checkbox"
                                        value="{{ $iadpgejala->gejala }}" name="iadp_gejala[]"
                                        id="iadpgejala{{ $iadpgejala->id }}">
                                    <label class="form-check-label" for="iadpgejala{{ $iadpgejala->id }}">
                                        {{ $iadpgejala->gejala }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="status_iadp">Status IADP<small class="text-danger">*</small></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_iadp" id="ya_iadp"
                                        value="Ya" required>
                                    <label class="form-check-label" for="ya_iadp">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_iadp" id="tidak_iadp"
                                        value="Tidak" required>
                                    <label class="form-check-label" for="tidak_iadp">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-default btn-reset mx-3">Batal</button>
                    <button type="submit" class="btn btn-primary mx-3" form="formDetailIADP"><i
                            class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Header VAP --}}
<div class="modal fade text-sm" id="modal-header-vap">
    <form action="" id="formHeaderVAP">
        @csrf
        @method('post')
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">VAP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notifikasi"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="no_registrasi">No Registrasi Pasien<small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control form-control-sm" name="no_registrasi"
                                    id="no_registrasi" value="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="ruang_perawatan">Ruang Perawatan<small class="text-danger">*</small></label>
                                <select name="ruang_perawatan" id="ruang_perawatan"
                                    class="form-control form-control-sm ruang_perawatan" required>
                                    @foreach ($ruangan as $key => $item)
                                    <option value="{{ $key }}">
                                        {{ $item }} ({{ $key }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="pemasangan_ke">Pemasangan ETT/Venti Ke<small
                                        class="text-danger">*</small></label>
                                <input type="number" class="form-control form-control-sm" name="pemasangan_ke"
                                    id="pemasangan_ke" min="1" max="99"
                                    value="{{ max_vap_header($data_registrasi->no_registrasi) }}" autofocus required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ruang_pemasangan">Ruang Pemasangan ETT/Venti<small
                                        class="text-danger">*</small></label>
                                <select name="ruang_pemasangan" id="ruang_pemasangan"
                                    class="form-control form-control-sm ruanganpemasangan" required>
                                    <option value="" hidden>Pilih Ruangan</option>
                                    @foreach ($ruangan as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}
                                        ({{ $key }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pemasangan">Tanggal Pemasangan<small
                                        class="text-danger">*</small></label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_pemasangan"
                                    id="tanggal_pemasangan" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_dilepas">Tanggal Dilepas</label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_dilepas"
                                    id="tanggal_dilepas">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-default btn-reset mx-3">Batal</button>
                    <button type="submit" class="btn btn-primary mx-3" form="formHeaderVAP"><i
                            class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Detail VAP --}}
<div class="modal fade text-sm" id="modal-detail-vap">
    <form action="" id="formDetailVAP">
        @csrf
        @method('post')
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">VAP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notifikasi"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="id_header">ID Header<small class="text-danger">*</small></label>
                                <input type="text" class="form-control form-control-sm" name="id_header" id="id_header"
                                    readonly required>
                                <input type="hidden" class="form-control form-control-sm" name="no_registrasi"
                                    id="no_registrasi" required>
                            </div>
                            <div class="form-group">
                                <label for="observasi_ke">Observasi Ke<small class="text-danger">*</small></label>
                                <input type="number" class="form-control form-control-sm" name="observasi_ke"
                                    id="observasi_ke" min="1" max="99" autofocus required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_observasi">Tanggal Observasi<small
                                        class="text-danger">*</small></label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_observasi"
                                    id="tanggal_observasi" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="antibiotik_vap">Antibiotik</label>
                                <textarea class="form-control form-control-sm" name="antibiotik_vap" id="antibiotik_vap"
                                    rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="hasil_kultur_vap">Hasil Kultur</label>
                                <textarea class="form-control form-control-sm" name="hasil_kultur_vap"
                                    id="hasil_kultur_vap" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pemeriksaan_kultur_vap">Tanggal Pemeriksaan
                                    Kultur</label>
                                <input type="date" class="form-control form-control-sm"
                                    name="tanggal_pemeriksaan_kultur_vap" id="tanggal_pemeriksaan_kultur_vap">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Bundles VAP</label>
                                @foreach ($vap_bundle as $vap)
                                <div class="form-check">
                                    <input class="form-check-input vap_bundle" type="checkbox"
                                        value="{{ $vap->bundle }}" name="vap_bundle[]" id="vapbundle{{ $vap->id }}">
                                    <label class="form-check-label" for="vapbundle{{ $vap->id }}">
                                        {{ $vap->bundle }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="">Tanda dan Gejala</label>
                                @foreach ($vap_gejala as $vapgejala)
                                <div class="form-check">
                                    <input class="form-check-input vap_gejala" type="checkbox"
                                        value="{{ $vapgejala->gejala }}" name="vap_gejala[]"
                                        id="vapgejala{{ $vapgejala->id }}">
                                    <label class="form-check-label" for="vapgejala{{ $vapgejala->id }}">
                                        {{ $vapgejala->gejala }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="status_vap">Status VAP<small class="text-danger">*</small></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_vap" id="ya_vap"
                                        value="Ya" required>
                                    <label class="form-check-label" for="ya_vap">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_vap" id="tidak_vap"
                                        value="Tidak" required>
                                    <label class="form-check-label" for="tidak_vap">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-default btn-reset mx-3">Batal</button>
                    <button type="submit" class="btn btn-primary mx-3" form="formDetailVAP"><i
                            class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Header IDO --}}
<div class="modal fade text-sm" id="modal-header-ido">
    <form action="" id="formHeaderIDO">
        @csrf
        @method('post')
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">VAP</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notifikasi"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="no_registrasi">No Registrasi Pasien<small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control form-control-sm" name="no_registrasi"
                                    id="no_registrasi" value="" readonly>
                                <input type="hidden" class="form-control form-control-sm" name="ido_header"
                                    id="ido_header" value=true>
                            </div>
                            <div class="form-group">
                                <label for="operasi_ke">Operasi Ke<small class="text-danger">*</small></label>
                                <input type="number" class="form-control form-control-sm" name="operasi_ke"
                                    id="operasi_ke" min="1" max="99" value="1" required>
                            </div>
                            <div class="form-group">
                                <label for="jadwal_operasi">Jadwal Operasi<small class="text-danger">*</small></label>
                                <input type="datetime-local" class="form-control form-control-sm" name="jadwal_operasi"
                                    id="jadwal_operasi" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_operasi">Jenis Operasi<small class="text-danger">*</small></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_operasi"
                                        id="elektif_operasi" value="Elektif" required>
                                    <label class="form-check-label" for="elektif_operasi">Elektif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_operasi" id="cito_operasi"
                                        value="CITO" required>
                                    <label class="form-check-label" for="cito_operasi">CITO / Darurat</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-default btn-reset mx-3">Batal</button>
                    <button type="submit" class="btn btn-primary mx-3" form="formHeaderIDO"><i
                            class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- Pre Operasi IDO --}}
<div class="modal fade text-sm" id="modal-preoperasi-ido">
    <form action="" id="formPreOperasiIDO">
        @csrf
        @method('post')
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Pre Operasi IDO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notifikasi"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="ruang_perawatan">Ruang Perawatan<small class="text-danger">*</small></label>
                                <select name="ruang_perawatan" id="ruang_perawatan"
                                    class="form-control form-control-sm ruang_perawatan" required>
                                    @foreach ($ruangan as $key => $item)
                                    <option value="{{ $key }}">
                                        {{ $item }} ({{ $key }})
                                    </option>
                                    @endforeach
                                </select>
                                <input type="hidden" class="form-control form-control-sm" name="ido_pre" id="ido_pre"
                                    value=true>
                            </div>
                            <div class="form-group">
                                <label for="jadwal_operasi">Jadwal Operasi<small class="text-danger">*</small></label>
                                <input type="datetime-local" class="form-control form-control-sm" name="jadwal_operasi"
                                    id="jadwal_operasi" required>
                            </div>
                            <div class="form-group">
                                <label for="suhu">Suhu</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control form-control-sm" name="suhu" id="suhu"
                                        min="1" max="99" />
                                    <div class="input-group-append">
                                        <div class="input-group-text text-bold"> °C</div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gds">GDS / Kadar Gula Darah</label>
                                <input type="number" class="form-control form-control-sm" name="gds" id="gds" min="1" />
                            </div>
                            <div class="form-group" id="screening_mrsa">
                                <label for="screening_mrsa">Screening MRSA<small class="text-danger">*</small></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="screening_mrsa"
                                        id="tidak_dilakukan_mrsa" value="Tidak Dilakukan" required>
                                    <label class="form-check-label" for="tidak_dilakukan_mrsa">Tidak Dilakukan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="screening_mrsa" id="positif_mrsa"
                                        value="Positif" required>
                                    <label class="form-check-label" for="positif_mrsa">Positif MRSA</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="screening_mrsa" id="negatif_mrsa"
                                        value="Negatif" required>
                                    <label class="form-check-label" for="negatif_mrsa">Negatif MRSA</label>
                                </div>
                            </div>
                            <div class="form-group" id="pencukuran_dengan">
                                <label for="pencukuran_dengan">Pencukuran Dengan<small
                                        class="text-danger">*</small></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pencukuran_dengan"
                                        id="tidak_dilakukan_pencukuran" value="Tidak Dilakukan" required>
                                    <label class="form-check-label" for="tidak_dilakukan_pencukuran">Tidak
                                        Dilakukan</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pencukuran_dengan"
                                        id="cliper_pencukuran" value="Cliper" required>
                                    <label class="form-check-label" for="cliper_pencukuran">Cliper</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="pencukuran_dengan"
                                        id="silet_pencukuran" value="Silet" required>
                                    <label class="form-check-label" for="silet_pencukuran">Silet</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="antibiotik_profilaksis">Antibiotik Profilaksis</label>
                                <textarea class="form-control form-control-sm" name="antibiotik_profilaksis"
                                    id="antibiotik_profilaksis" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="waktu_pemberian_profilaksis">Waktu Pemberian AB Profilaksis</label>
                                <input type="datetime-local" class="form-control form-control-sm"
                                    name="waktu_pemberian_profilaksis" id="waktu_pemberian_profilaksis">
                            </div>
                            <div class="form-group">
                                <label for="riwayat_penyakit">Riwayat Penyakit</label>
                                <textarea class="form-control form-control-sm" name="riwayat_penyakit"
                                    id="riwayat_penyakit" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Bundles Pre Operasi</label>
                                @foreach ($ido_bundle as $ido)
                                @if ($ido->waktu == 'Pre Operasi')
                                <div class="form-check">
                                    <input class="form-check-input bundle_pre" type="checkbox"
                                        value="{{ $ido->bundle }}" name="bundle_pre[]" id="idobundle{{ $ido->id }}">
                                    <label class="form-check-label" for="idobundle{{ $ido->id }}">
                                        {{ $ido->bundle }}
                                    </label>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-default btn-reset mx-3">Batal</button>
                    <button type="submit" class="btn btn-primary mx-3" form="formPreOperasiIDO"><i
                            class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>

    </form>
</div>
{{-- Intra Operasi IDO --}}
<div class="modal fade text-sm" id="modal-intraoperasi-ido">
    <form action="" id="formIntraOperasiIDO">
        @csrf
        @method('post')
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Intra Operasi IDO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notifikasi"></div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="jenis_operasi">Jenis Operasi</label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_operasi"
                                        id="elektif_operasi" value="Elektif" disabled>
                                    <label class="form-check-label" for="elektif_operasi">Elektif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="jenis_operasi" id="cito_operasi"
                                        value="CITO" disabled>
                                    <label class="form-check-label" for="cito_operasi">CITO / Darurat</label>
                                </div>
                                <input type="hidden" class="form-control form-control-sm" name="ido_intra"
                                    id="ido_intra" value=true>
                            </div>
                            <div class="form-group">
                                <label for="ruang_operasi">Ruang / Kamar Operasi<small
                                        class="text-danger">*</small></label>
                                <input type="text" class="form-control form-control-sm" name="ruang_operasi"
                                    id="ruang_operasi" required />
                            </div>
                            <div class="form-group">
                                <label for="nama_prosedur_operasi">Nama Prosedur Operasi</label>
                                <input type="text" class="form-control form-control-sm" name="nama_prosedur_operasi"
                                    id="nama_prosedur_operasi" />
                            </div>
                            <div class="form-group">
                                <label for="kualifikasi_daerah_operasi">Kualifikasi Daerah Operasi</label>
                                <select class="form-control form-control-sm" name="kualifikasi_daerah_operasi"
                                    id="kualifikasi_daerah_operasi">
                                    <option value="" hidden>Pilih</option>
                                    <option value="Bersih">Bersih</option>
                                    <option value="Bersih Terkontaminasi">Bersih Terkontaminasi</option>
                                    <option value="Terkontaminasi">Terkontaminasi</option>
                                    <option value="Kotor">Kotor</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lama_operasi">Lama Operasi</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control form-control-sm" name="lama_operasi"
                                        id="lama_operasi" min="1" max="9999" />
                                    <div class="input-group-append">
                                        <div class="input-group-text text-bold"> Menit</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="antibiotik_tambahan_intra">Antibiotik Tambahan Intra Operasi</label>
                                <textarea class="form-control form-control-sm" name="antibiotik_tambahan_intra"
                                    id="antibiotik_tambahan_intra" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Bundles Intra Operasi</label>
                                @foreach ($ido_bundle as $ido)
                                @if ($ido->waktu == 'Intra Operasi')
                                <div class="form-check">
                                    <input class="form-check-input bundle_intra" type="checkbox"
                                        value="{{ $ido->bundle }}" name="bundle_intra[]" id="idobundle{{ $ido->id }}">
                                    <label class="form-check-label" for="idobundle{{ $ido->id }}">
                                        {{ $ido->bundle }}
                                    </label>
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-default btn-reset mx-3">Batal</button>
                    <button type="submit" class="btn btn-primary mx-3" form="formIntraOperasiIDO"><i
                            class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>

    </form>
</div>
{{-- Post Operasi IDO --}}
<div class="modal fade text-sm" id="modal-postoperasi-ido">
    <form action="" id="formPostOperasiIDO">
        @csrf
        @method('post')
        <input type="hidden" class="form-control form-control-sm" name="ido_post" id="ido_post" value=true>
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Post Operasi IDO</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="notifikasi"></div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="">Bundles Post Operasi</label>
                                @foreach ($ido_bundle as $ido)
                                @if ($ido->waktu == 'Post Operasi')
                                <div class="form-check">
                                    <input class="form-check-input bundle_post" type="checkbox"
                                        value="{{ $ido->bundle }}" name="bundle_post[]" id="idobundle{{ $ido->id }}">
                                    <label class="form-check-label" for="idobundle{{ $ido->id }}">
                                        {{ $ido->bundle }}
                                    </label>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="">Tanda dan Gejala</label>
                                @foreach ($ido_gejala as $idogejala)
                                <div class="form-check">
                                    <input class="form-check-input ido_gejala" type="checkbox"
                                        value="{{ $idogejala->gejala }}" name="ido_gejala[]"
                                        id="idogejala{{ $idogejala->id }}">
                                    <label class="form-check-label" for="idogejala{{ $idogejala->id }}">
                                        {{ $idogejala->gejala }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control form-control-sm" name="keterangan" id="keterangan"
                                    rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="status_ido">Status IDO<small class="text-danger">*</small></label>
                                <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_ido" id="ya_ido"
                                        value="Ya" required>
                                    <label class="form-check-label" for="ya_ido">Ya</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status_ido" id="tidak_ido"
                                        value="Tidak" required>
                                    <label class="form-check-label" for="tidak_ido">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="reset" class="btn btn-default btn-reset mx-3">Batal</button>
                    <button type="submit" class="btn btn-primary mx-3" form="formPostOperasiIDO"><i
                            class="fas fa-save mr-2"></i>Simpan</button>
                </div>
            </div>
        </div>

    </form>
</div>