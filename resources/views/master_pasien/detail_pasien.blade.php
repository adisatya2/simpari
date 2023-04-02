<div class="modal fade text-sm" id="modal-detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="formPasien">
                    <div class="form-group row">
                        <label for="mrn"
                            class="col-md-2 offset-1 control-label text-right col-form-label">MRN</label>
                        <div class="col-md-8">
                            <input type="text" name="mrn" id="mrn" class="form-control form-control-sm"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik"
                            class="col-md-2 offset-1 control-label text-right col-form-label">NIK</label>
                        <div class="col-md-8">
                            <input type="text" name="nik" id="nik" class="form-control form-control-sm"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_pasien" class="col-md-2 offset-1 control-label text-right col-form-label">Nama
                            Pasien</label>
                        <div class="col-md-8">
                            <input type="text" name="nama_pasien" id="nama_pasien"
                                class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="umur" class="col-md-2 offset-1 control-label text-right col-form-label">Umur
                            Pasien</label>
                        <div class="col-md-8">
                            <input type="text" name="umur" id="umur" class="form-control form-control-sm"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tempat_lahir"
                            class="col-md-2 offset-1 control-label text-right col-form-label">Tempat Lahir</label>
                        <div class="col-md-8">
                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_lahir"
                            class="col-md-2 offset-1 control-label text-right col-form-label">Tanggal Lahir</label>
                        <div class="col-md-8">
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                class="form-control form-control-sm" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jk" class="col-md-2 offset-1 control-label text-right col-form-label">Jenis
                            Kelamin</label>
                        <div class="col-md-8">
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="perempuan2" name="jk" value="Perempuan" readonly>
                                    <label for="perempuan" class="mr-3">
                                        Perempuan
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="laki-laki2" name="jk" value="Laki-Laki" readonly>
                                    <label for="laki-laki" class="mr-3">
                                        Laki-Laki
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_telp" class="col-md-2 offset-1 control-label text-right col-form-label">No
                            Telpon</label>
                        <div class="col-md-8">
                            <input type="text" name="no_telp" id="no_telp" class="form-control form-control-sm"
                                readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat"
                            class="col-md-2 offset-1 control-label text-right col-form-label">Alamat</label>
                        <div class="col-md-8">
                            <textarea name="alamat" id="alamat" class="form-control form-control-sm" readonly></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="agama"
                            class="col-md-2 offset-1 control-label text-right col-form-label">Agama</label>
                        <div class="col-md-8">
                            {{-- <select name="agama" id="agama" class="form-control form-control-sm" readonly>
                                <option value="">Pilih Agama</option>
                                @foreach ($agama as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select> --}}
                            <input type="text" name="agama" id="agama" class="form-control form-control-sm"
                                readonly>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
