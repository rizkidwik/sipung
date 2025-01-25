@extends('backend.layouts.layout')

@section('title', 'User')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold">User</h5>
            <div class="card-action">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUser">+
                    Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive datatable-minimal">
                <table class="table text-nowrap data-table w-100" id="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @includeIf('backend.user.form')
@endsection

@include('backend.user.javascript')
