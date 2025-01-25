@extends('backend.layouts.layout')

@section('title', 'Profile')

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
    <div class="page-heading">
        <h3>Profile</h3>
    </div>
    <div class="page-content">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col d-flex align-items-center">
                                <div class="badge rounded-circle bg-light-info fs-4">
                                    {{ substr(auth()->user()->name, 1, 1) }}
                                </div>
                                <div class="mx-3">
                                    <span
                                        class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary show-nama">{{ auth()->user()->name }}</span>
                                    <div class="text-muted show-hak_akses">{{ auth()->user()->username }}</div>
                                </div>
                            </div>
                            <div class="nav flex-column nav-pills mt-3" id="v-pills-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                                    href="#v-pills-biodata" role="tab" aria-controls="v-pills-home"
                                    aria-selected="true">Biodata</a>
                                <a class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" href="#v-pills-password"
                                    role="tab" aria-controls="v-pills-password" aria-selected="false">Ganti Password</a>
                                <a class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" href="#v-pills-activity"
                                    role="tab" aria-controls="v-pills-messages" aria-selected="false">Activity Log</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="row">
                    <div class="col">
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-biodata" role="tabpanel"
                                aria-labelledby="v-pills-home-tab">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between align-items-center pb-0">
                                        <h4>Biodata</h4>
                                        <button class="btn btn-sm btn-primary" onclick="onEdit()"
                                            id="btnEdit">Edit</button>
                                        <button class="btn btn-sm btn-warning" onclick="onCancel()" id="btnCancel"
                                            style="display: none;">Cancel</button>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <div class="img-container mb-5">
                                            <i class="bg-white fas fa-pencil-alt p-2 rounded-circle"
                                                style="position: absolute;right:2px;top:-2px;cursor: pointer;z-index:99;"
                                                onclick="onInputAvatar()"></i>
                                            <input type="file" name="avatar" id="avatar" style="display: none;"
                                                accept="image/*">
                                            <img src="{{ auth()->user()->avatar }}" id="img-avatar">
                                        </div>
                                        <form action="javascript:onSaveBiodata()" method="post"
                                            enctype="multipart/form-data" id="formBiodata" class="needs-validation"
                                            novalidate>
                                            @csrf
                                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row align-items-center">
                                                        <div class="col-lg-3 col-3">
                                                            <label class="col-form-label" for="name">Name</label>
                                                        </div>
                                                        <div class="col-lg-9 col-9">
                                                            <input type="text" id="name"
                                                                class="form-control form-control-sm" name="name"
                                                                placeholder="Name" value="{{ $user->name }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group row align-items-center">
                                                        <div class="col-lg-3 col-3">
                                                            <label class="col-form-label" for="email">Email</label>
                                                        </div>
                                                        <div class="col-lg-9 col-9">
                                                            <input type="text" id="email"
                                                                class="form-control form-control-sm" name="email"
                                                                placeholder="Email Address" value="{{ $user->email }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group row align-items-center">
                                                        <div class="col-lg-3 col-3">
                                                            <label class="col-form-label" for="first-name">Role</label>
                                                        </div>
                                                        <div class="col-lg-9 col-9">
                                                            <span>{{ $user->roles->role_name }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col" style="text-align: right;display:none;"
                                                    id="btnSaveBio">
                                                    <button type="submit"
                                                        class="btn btn-success btn-sm w-25">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-password" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <h4>Password</h4>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <form action="javascript:onChangePasword()" method="post"
                                            enctype="multipart/form-data" name="formUpdatePassword"
                                            id ="formUpdatePassword">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row align-items-center">
                                                        <div class="col-lg-3 col-3">
                                                            <label class="col-form-label" for="password">Password
                                                                Lama</label>
                                                        </div>
                                                        <div class="col-lg-9 col-9">
                                                            <input type="password" id="password"
                                                                class="form-control form-control-sm" name="oldPassword"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group row align-items-center">
                                                        <div class="col-lg-3 col-3">
                                                            <label class="col-form-label" for="email">Password
                                                                Baru</label>
                                                        </div>
                                                        <div class="col-lg-9 col-9">
                                                            <input type="password" id="newPassword"
                                                                class="form-control form-control-sm" name="newPassword"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group row align-items-center">
                                                        <div class="col-lg-3 col-3">
                                                            <label class="col-form-label" for="email">Ulangi
                                                                Password</label>
                                                        </div>
                                                        <div class="col-lg-9 col-9">
                                                            <input type="password" id="passwordConfirm"
                                                                class="form-control form-control-sm"
                                                                name="newPassword_confirmation" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col" style="text-align: right;">
                                                    <button class="btn btn-success btn-sm w-25">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="v-pills-activity" role="tabpanel"
                                aria-labelledby="v-pills-profile-tab">
                                <div class="card">
                                    <div class="card-header pb-0">
                                        <h4>Aktivitas Saya</h4>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <p class="text-center">Aktivitas Kosong</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@include('backend.profile.javascript')
