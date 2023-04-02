<div class="modal fade text-sm" id="modal-form">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal" id="formDokter">
                    @csrf
                    @method('post')
                    <div class="form-group row">
                        <label for="no_kamar" class="col-md-2 offset-1 control-label text-right col-form-label">No
                            Kamar</label>
                        <div class="col-md-8">
                            <input type="text" name="no_kamar" id="no_kamar" class="form-control form-control-sm"
                                required autofocus>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kode_ruangan"
                            class="col-md-2 offset-1 control-label text-right col-form-label">Ruangan</label>
                        <div class="col-md-8">
                            <select name="kode_ruangan" id="kode_ruangan"
                                class="form-control  form-control-sm select2bs4" required>
                                <option value="">Pilih Ruangan</option>
                                @foreach ($ruangan as $key => $item)
                                    <option value="{{ $key }}">{{ $item }} ({{ $key }})
                                    </option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_kelas"
                            class="col-md-2 offset-1 control-label text-right col-form-label">Kelas</label>
                        <div class="col-md-8">
                            <select name="id_kelas" id="id_kelas" class="form-control form-control-sm select2bs4"
                                required>
                                <option value="">Pilih Kelas</option>
                                @foreach ($kelas as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="flagbor" class="col-md-2 offset-1 control-label text-right col-form-label"></label>
                        <div class="col-md-2">
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="flagbor" name="flagbor" value="1"
                                        class="form-control">
                                    <label for="flagbor">
                                        BOR
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="aktif" name="aktif" value="1"
                                        class="form-control">
                                    <label for="aktif">
                                        Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="flagsetting" name="flagsetting" value="1"
                                        class="form-control">
                                    <label for="flagsetting">
                                        Setting
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm btn-flat" form="formDokter">Simpan</button>
            </div>
        </div>
    </div>
</div>
