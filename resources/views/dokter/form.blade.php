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
                        <label for="id_dokter" class="col-md-2 offset-1 control-label text-right col-form-label">ID
                            Dokter</label>
                        <div class="col-md-8">
                            <input type="text" name="id_dokter" id="id_dokter" class="form-control" required
                                autofocus>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_dokter" class="col-md-2 offset-1 control-label text-right col-form-label">Nama
                            Dokter</label>
                        <div class="col-md-8">
                            <input type="text" name="nama_dokter" id="nama_dokter" class="form-control" required>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="departemen"
                            class="col-md-2 offset-1 control-label text-right col-form-label">Departemen</label>
                        <div class="col-md-8">
                            <input type="text" name="departemen" id="departemen" class="form-control">
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="aktif"
                            class="col-md-2 offset-1 control-label text-right col-form-label">Status</label>
                        <div class="col-md-8">
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="aktif" name="aktif" value="1"
                                        class="form-control">
                                    <label for="aktif">
                                        Aktif
                                    </label>
                                </div>
                            </div>
                            <span class="help-block with-errors" style="color:red"></span>
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
