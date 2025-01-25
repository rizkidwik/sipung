<div class="modal fade" id="modalDonatur" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-donatur" name="form-donatur" class="form-horizontal" action="javascript:onSave()"
                    method="POST">
                    @csrf
                    <input type="hidden" name="id" id="donatur_id">
                    <div class="form-group my-3">
                        <label for="name" class="col-sm-4 control-label">Nama</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                    </div>

                    <div class="form-group my-3">
                        <label for="name" class="col-sm-4 control-label">Alamat</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="address" id="address" required>
                        </div>
                    </div>

                    <div class="form-group my-3">
                        <label for="name" class="col-sm-4 control-label">Telepon</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="phone" id="phone" required>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-outline-secondary"
                    data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
