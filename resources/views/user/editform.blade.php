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
                        <label for="username" class="col-md-2 offset-1 control-label text-right col-form-label">
                            Username</label>
                        <div class="col-md-8">
                            <input type="hidden" name="id_user" id="id_user" class="form-control" required>
                            <input type="text" name="username" id="username" class="form-control" required readonly>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama_user" class="col-md-2 offset-1 control-label text-right col-form-label">Nama
                            User</label>
                        <div class="col-md-8">
                            <input type="text" name="nama_user" id="nama_user" class="form-control" required autofocus>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email"
                            class="col-md-2 offset-1 control-label text-right col-form-label">Email</label>
                        <div class="col-md-8">
                            <input type="email" name="email" id="email" class="form-control" required>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="roles"
                            class="col-md-2 offset-1 control-label text-right col-form-label">Role</label>
                        <div class="col-md-8">
                            <select id="roles" name="roles"
                                class="form-control select2 @error('roles') is-invalid @enderror" required
                                autocomplete="roles">
                                <option value="" selected disabled>Choose a role</option>
                                @foreach ($roles as $item)
                                <option value="{{ $item->name }}" {{ old('roles')==$item->name ? 'selected'
                                    : '' }}>
                                    {{ $item->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors" style="color:red"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="aktif"
                            class="col-md-2 offset-1 control-label text-right col-form-label">Status</label>
                        <div class="col-md-8">
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" id="aktif" name="aktif" value="1" class="form-control">
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