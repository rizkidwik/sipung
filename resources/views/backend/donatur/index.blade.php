@extends('backend.layouts.layout')

@section('title', 'Donatur')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold">Donatur</h5>
            <div class="card-action">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDonatur">+
                    Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <div class="datatable-minimal">
                <table class="table text-nowrap data-table" id="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Telepon</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @includeIf('backend.donatur.form')
@endsection

@include('backend.donatur.javascript')
