@extends('backend.layouts.layout')

@section('title', 'Transaksi')

@section('content')
    <div class="card">
        <form action="javascript:onSave()" method="post" name="formTransaction" id="formTransaction"
            enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h5 class="card-title">Transaksi</h5>
            </div>
            <div class="card-body">
                <div class="row my-3">
                    <div class="col-9">
                        <select class="form-select" name="donatur_id" id="donatur_id"></select>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary rounded" type="button" onclick="onSelectDonatur()">Pilih</button>
                    </div>
                </div>

                <div class="d-none" id="biodata">
                </div>

                <hr>

                <div class="row my-3 d-none" id="transaction-container">
                    <div class="col-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Rutin</h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap mb-0 align-middle">
                                <thead>
                                    <tr class="text-dark fw-bold">
                                        <td>No</td>
                                        <td>Jenis</td>
                                        <td>Nominal</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody id="fix-body"></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5>Insidental</h5>
                            <div>
                                <button type="button" onclick="addItem(2)" class="btn btn-sm btn-primary">Tambah</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-nowrap mb-0 align-middle">
                                <thead>
                                    <tr class="text-dark fw-bold">
                                        <td>No</td>
                                        <td>Jenis</td>
                                        <td>Nominal</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody id="free-body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end d-none" id="footer-action">
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    <div class="modal fade" id="modalAddItem" aria-hidden="true" data-bs-keyboard="false" data-bs-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeadingAdd">Tambah Item</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formAddItem" name="formAddItem" class="form-horizontal" action="javascript:onAddItem()"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="item_id" class="col-sm-4 control-label">Jenis</label>
                            <div class="col-sm-12">
                                <select name="item_id" id="item_id" class="form-control" style="width:100%;" required></select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount" class="col-sm-4 control-label">Nominal</label>
                            <div class="col-sm-12">
                                <input type="number" name="amount" id="amount" class="form-control" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="toggleModalItem(false)">Close</button>
                    <button type="submit" class="btn btn-primary">Save
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- @includeIf('backend.transaction.form-print') --}}
@endsection

@include('backend.transaction.javascript')
