<div class="modal fade text-sm" id="modal-form">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="notifikasi"></div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="mrn">MRN Pasien*</label>
                            <input type="text" class="form-control form-control-sm" name="mrn" id="mrn"
                                placeholder="Enter MRN Pasien">
                            <span id="error-info"></span>
                        </div>
                        <div class="form-group">
                            <label for="nama_pasien">Nama Pasien*</label>
                            <input type="text" class="form-control form-control-sm" name="nama_pasien"
                                id="nama_pasien" placeholder="Enter Nama Pasien">
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control form-control-sm" name="nik" id="nik"
                                placeholder="Enter NIK Pasien">
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control form-control-sm" name="tempat_lahir"
                                id="tempat_lahir" placeholder="Enter Tempat Lahir Pasien">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir*</label>
                            <input type="date" class="form-control form-control-sm" name="tanggal_lahir"
                                id="tanggal_lahir" placeholder="Enter Tanggal Lahir Pasien">
                        </div>
                        <div class="form-group">
                            <label for="jk">Jenis Kelamin*</label>
                            <br>
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="perempuan" name="jk" value="Perempuan">
                                <label for="perempuan">
                                    Perempuan
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" id="laki-laki" name="jk" value="Laki-Laki">
                                <label for="laki-laki">
                                    Laki-Laki
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No Telpon</label>
                            <input type="text" class="form-control form-control-sm" name="no_telp" id="no_telp"
                                placeholder="Enter No Telpon Pasien">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" class="form-control form-control-sm"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <input type="text" class="form-control form-control-sm" name="agama" id="agama">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="no_registrasi">No Registrasi <span id="lama"></span>*</label>
                            <input type="text" class="form-control form-control-sm" name="no_registrasi"
                                id="no_registrasi" placeholder="Generate Otomatis">
                        </div>
                        <div class="form-group">
                            <label for="no_kamar">No Kamar <span id="lama"></span>*</label>
                            <input type="text" class="form-control form-control-sm" name="no_kamar" id="no_kamar"
                                placeholder="Enter No Kamar" required>

                        </div>
                        <div id="kamar_baru"></div>
                        <div class="form-group">
                            <label for="diagnosa">Diagnosa*</label>
                            <input type="text" class="form-control form-control-sm" name="diagnosa"
                                id="diagnosa" placeholder="Enter No Diagnosa">

                        </div>
                        <div class="form-group">
                            <label for="id_dokter">DPJP*</label>
                            <input type="text" class="form-control form-control-sm" name="id_dokter"
                                id="id_dokter">
                        </div>
                        <div class="form-group">
                            <label for="jenis_jaminan">Jenis Jaminan*</label>
                            <br>
                            <div class="icheck-primary d-inline">
                                <input type="radio" onclick="namaJaminan()" id="JKN" name="jenis_jaminan"
                                    value="JKN">
                                <label for="JKN" class="mr-3">
                                    JKN
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" onclick="namaJaminan()" id="Pribadi" name="jenis_jaminan"
                                    value="Pribadi">
                                <label for="Pribadi" class="mr-3">
                                    Pribadi
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" onclick="namaJaminan()" id="Asuransi" name="jenis_jaminan"
                                    value="Asuransi">
                                <label for="Asuransi" class="mr-3">
                                    Asuransi
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" onclick="namaJaminan()" id="Perusahaan" name="jenis_jaminan"
                                    value="Perusahaan">
                                <label for="Perusahaan" class="mr-3">
                                    Perusahaan
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" onclick="namaJaminan()" id="COB" name="jenis_jaminan"
                                    value="COB">
                                <label for="COB" class="mr-3">
                                    COB
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">
                                <input type="radio" onclick="namaJaminan()" id="KMK" name="jenis_jaminan"
                                    value="KMK">
                                <label for="KMK" class="mr-3">
                                    KMK
                                </label>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="nama_jaminan">Nama Jaminan*</label>
                            <input type="text" class="form-control form-control-sm" name="nama_jaminan"
                                id="nama_jaminan" placeholder="Enter Nama Jaminan/Sponsor">

                        </div>
                        <div class="form-group">
                            <label for="hak_pasien">Hak Pasien*</label><input type="text"
                                class="form-control form-control-sm" nname="hak_pasien" id="hak_pasien">
                        </div>
                        <div class="form-group">
                            <label for="bed_hinai">Bed di Hinai</label>
                            <input type="text" class="form-control form-control-sm" name="bed_hinai"
                                id="bed_hinai">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_masuk">Tanggal Masuk RS*</label>
                            <input type="date" class="form-control form-control-sm" name="tanggal_masuk"
                                id="tanggal_masuk">
                        </div>
                        <div class="form-group">
                            <label for="tanggal_pulang">Tanggal Pulang*</label>
                            <input type="datetime-local" class="form-control form-control-sm" name="tanggal_pulang"
                                id="tanggal_pulang">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
