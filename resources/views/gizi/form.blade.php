<div class="modal fade text-sm" id="modal-form-gizi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal" id="formGizi">
                    @csrf
                    @method('post')
                    <div class="form-group row">
                        <label for="nama_pasien" class="col-md-2 offset-1 control-label text-right col-form-label">
                            No Registrasi</label>
                        <div class="col-md-8">
                            <input type="text" name="no_registrasi" id="no_registrasi" class="form-control" required
                                readonly>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_pasien" class="col-md-2 offset-1 control-label text-right col-form-label">
                            Nama Pasien</label>
                        <div class="col-md-8">
                            <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" required
                                readonly>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diet" class="col-md-2 offset-1 control-label text-right col-form-label">Diet</label>
                        <div class="col-md-8">
                            <input type="text" name="diet" id="diet" class="form-control" required autofocus>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan"
                            class="col-md-2 offset-1 control-label text-right col-form-label">Keterangan</label>
                        <div class="col-md-8">
                            <input type="text" name="keterangan" id="keterangan" class="form-control" required>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm btn-flat" form="formGizi">Simpan</button>
            </div>
        </div>
    </div>
</div>