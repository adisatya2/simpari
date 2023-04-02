<div class="modal fade text-sm" id="modal-pulang">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="notifikasi"></div>
                <form action="" method="post" class="form-horizontal" id="formPulang">
                    @csrf
                    @method('post')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="mrn">MRN Pasien*</label>
                                <input type="text" class="form-control form-control-sm" name="mrn" id="mrn"
                                    placeholder="Enter MRN Pasien" required>
                                <span id="error-info"></span>
                            </div>
                            <div class="form-group">
                                <label for="nama_pasien">Nama Pasien*</label>
                                <input type="text" class="form-control form-control-sm" name="nama_pasien"
                                    id="nama_pasien" placeholder="Enter Nama Pasien" required>
                            </div>
                            <div class="form-group">
                                <label for="diagnosa">Diagnosa*</label>
                                <input type="text" class="form-control form-control-sm" name="diagnosa"
                                    id="diagnosa" placeholder="Enter No Diagnosa" required>
                                <span class="help-block with-errors" style="color:red"></span>
                            </div>
                            <div class="form-group">
                                <label for="id_dokter">DPJP*</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" name="id_dokter"
                                            id="id_dokter" required>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="nama_dokter">
                                    </div>
                                </div>
                                {{-- <select name="id_dokter" id="id_dokter" class="form-control form-control-sm select2bs4"
                                    required>
                                    <option value="">Pilih DPJP</option>
                                    @foreach ($dokter as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select> --}}
                                <span class="help-block with-errors" style="color:red"></span>
                            </div>
                            <div class="form-group">
                                <label for="hak_pasien">Hak Pasien*</label>
                                <input type="text" class="form-control form-control-sm" name="hak_pasien"
                                    id="hak_pasien" required>
                                <span class="help-block with-errors" style="color:red"></span>
                            </div>
                            <div class="form-group">
                                <label for="kode_ruangan">Ruangan*</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-sm" name="kode_ruangan"
                                            id="kode_ruangan" required>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control form-control-sm" id="nama_ruangan">
                                    </div>
                                </div>
                                <span class="help-block with-errors" style="color:red"></span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="no_kamar">No Kamar*</label>
                                <input type="text" class="form-control form-control-sm" name="no_kamar"
                                    id="no_kamar" placeholder="Enter No Kamar" required>
                                <span class="help-block with-errors" style="color:red"></span>
                            </div>
                            <div class="form-group">
                                <label for="jenis_jaminan">Jenis Jaminan*</label>
                                <br>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" onclick="namaJaminan()" id="JKN" name="jenis_jaminan"
                                        value="JKN" required>
                                    <label for="JKN" class="mr-3">
                                        JKN
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" onclick="namaJaminan()" id="Pribadi"
                                        name="jenis_jaminan" value="Pribadi" required>
                                    <label for="Pribadi" class="mr-3">
                                        Pribadi
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" onclick="namaJaminan()" id="Asuransi"
                                        name="jenis_jaminan" value="Asuransi" required>
                                    <label for="Asuransi" class="mr-3">
                                        Asuransi
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" onclick="namaJaminan()" id="Perusahaan"
                                        name="jenis_jaminan" value="Perusahaan" required>
                                    <label for="Perusahaan" class="mr-3">
                                        Perusahaan
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" onclick="namaJaminan()" id="COB"
                                        name="jenis_jaminan" value="COB" required>
                                    <label for="COB" class="mr-3">
                                        COB
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" onclick="namaJaminan()" id="KMK"
                                        name="jenis_jaminan" value="KMK" required>
                                    <label for="KMK" class="mr-3">
                                        KMK
                                    </label>
                                </div>
                                <span class="help-block with-errors" style="color:red"></span>
                            </div>
                            <div class="form-group">
                                <label for="nama_jaminan">Nama Jaminan*</label>
                                <input type="text" class="form-control form-control-sm" name="nama_jaminan"
                                    id="nama_jaminan" placeholder="Enter Nama Jaminan/Sponsor" required>
                                <span class="help-block with-errors" style="color:red"></span>
                            </div>
                            <div class="form-group">
                                <label for="bed_hinai">Bed di Hinai</label>
                                <input type="text" class="form-control form-control-sm" name="bed_hinai"
                                    id="bed_hinai" placeholder="Enter No Kamar di Hinai">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_masuk">Tanggal Masuk RS*</label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_masuk"
                                    id="tanggal_masuk" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pulang">Tanggal Pulang *</label>
                                <input type="datetime-local" class="form-control form-control-sm"
                                    name="tanggal_pulang" id="tanggal_pulang" value="{{ date('Y-m-d H:i:s') }}"
                                    required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="keterangan_pulang">Keterangan Pulang</label>
                                <textarea name="keterangan_pulang" id="keterangan_pulang" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm btn-flat" form="formPulang"><b>Ya</b>, Pulangkan
                    Pasien</button>
            </div>
        </div>
    </div>
</div>
