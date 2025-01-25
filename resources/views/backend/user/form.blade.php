<div class="modal fade" id="modalUser" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-user" name="form-user" class="form-horizontal" action="javascript:onSave()"
                    method="POST">
                    @csrf
                    <input type="hidden" name="id" id="user_id">
                    <div class="form-group my-3">
                        <label for="nama" class="col-sm-4 control-label">Nama</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="email" class="col-sm-4 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="email" id="email" required>
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="username" class="col-sm-4 control-label">Username</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="username" id="username" required>
                        </div>
                    </div>
                    <div class="form-group my-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group my-3">
                        <label for="password2" class="form-label">Re-type Password</label>
                        <input type="password" class="form-control" id="password2" name="password2" required>
                    </div>
                    <div class="form-group my-3">
                        <label for="role" class="col-sm-4 control-label">Role</label>
                        <div class="col-sm-12">
                            <select name="role_id" id="role_id" class="form-control" style="width:100%;" required></select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
