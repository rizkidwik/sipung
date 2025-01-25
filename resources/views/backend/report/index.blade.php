@extends('backend.layouts.layout')

@section('title', 'Laporan')

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title fw-semibold">Laporan</h5>
        </div>
        <div class="card-body">
            <div class="datatable-minimal">
                <table class="table text-nowrap data-table" id="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@include('backend.report.javascript')
