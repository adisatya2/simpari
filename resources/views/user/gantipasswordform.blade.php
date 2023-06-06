<div class="modal fade text-sm" id="modal-gantipassword">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" class="form-horizontal" id="formGantiPassword">
                    @csrf
                    @method('post')
                    <div class="form-group row">
                        <label for="username2" class="col-md-3 offset-1 control-label text-right col-form-label">
                            Username</label>
                        <div class="col-md-7">
                            <input type="hidden" name="id_user2" id="id_user2" class="form-control" required>
                            <input type="text" name="username2" id="username2" class="form-control" required readonly>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-3 offset-1 control-label text-right col-form-label">Password
                            Baru</label>
                        <div class="col-md-7">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" id="password" placeholder="Password" required autofocus>
                            @error('password')
                            <span class="help-block with-errors" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password_confirmation"
                            class="col-md-3 offset-1 control-label text-right col-form-label">Konfirmasi
                            Password Baru</label>
                        <div class="col-md-7">
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" id="password_confirmation"
                                placeholder="Password Confirmation" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-sm btn-flat" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-sm btn-flat" form="formGantiPassword">Simpan</button>
            </div>
        </div>
    </div>
</div>