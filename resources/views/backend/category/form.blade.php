<div class="modal fade" id="modalCategory" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading">Tambah Data</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-category" name="form-category" class="form-horizontal" action="javascript:onSave()" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="category_id">
                    <div class="form-group my-3">
                        <label for="name" class="col-sm-4 control-label">Kategori</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="name" id="name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="type" class="col-sm-4 control-label">Tipe</label>
                        <div class="col-sm-12">
                            <select class="form-select" id="type" name="type">
                                <option value="1">Nominal Tetap</option>
                                <option value="2" selected>Nominal Bebas</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group my-3 d-none" id="amount-container">
                        <label for="name" class="col-sm-4 control-label">Nominal</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" name="amount" id="amount">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" >Save changes
                </button>
                </form>
            </div>
        </div>
    </div>
</div>
