@extends('backend.layouts.layout')

@section('title', 'Configuration')

@push('after-style')
    <style>
        .img-container {
            position: relative;
            width: 200px;
            height: 200px;
            /* overflow: hidden; */
        }

        .img-container img {
            width: 100%;
            height: 100%;
            border-radius: 16px;
            padding: 5px;
        }
    </style>
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Configuration</h5>
        </div>
        <div class="card-body">
            <div class="img-container mb-5">
                <i class="bg-white fas fa-pencil-alt p-2 rounded-circle"
                    style="position: absolute;right:2px;top:-2px;cursor: pointer;z-index:99;" onclick="onInputLogo()"></i>
                <input type="file" name="logo" id="logo" style="display: none;" accept="image/*">
                <img src="" id="img-logo">
            </div>
            <form action="javascript:onSave()" method="post" id="form-configuration">
                <div class="col-md-6 my-5">
                    <div class="form-group row align-items-center">
                        <div class="col-lg-4 col-4">
                            <label class="col-form-label required" for="first-name">Application Name</label>
                        </div>
                        <div class="col-lg-8 col-8">
                            <input type="text" id="app_name" class="form-control" name="app_name" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 my-5">
                    <div class="form-group row align-items-center">
                        <div class="col-lg-4 col-4">
                            <label class="col-form-label required" for="">Description</label>
                        </div>
                        <div class="col-lg-8 col-8">
                            <textarea type="text" id="app_description" class="form-control" name="app_description"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="text-align: right;">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@include('backend.configuration.javascript')
