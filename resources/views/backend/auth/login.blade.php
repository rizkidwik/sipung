@extends('backend.auth.layouts.master')
@section('title', 'Login')

@section('content')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="{{ url('/') }}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('uploads/' . $data['app_logo']) }}" width="180" alt="">
                                </a>
                                <p class="text-center">{{ env('APP_NAME') }}</p>
                                @if (Session::has('failed'))
                                    <span class="text-danger">{{ session('failed') }}</span>
                                @endif
                                <form action="{{ route('login') }}" method="POST" enctype="multipart/form-data"
                                    data-parsley-validate>
                                    @csrf
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Username</label>
                                        <input type="username" name="username" class="form-control" id="username"
                                            aria-describedby="emailHelp" data-parsley-required="true" autofocus>
                                        @if ($errors->has('username'))
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            id="exampleInputPassword1" required>
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>

                                    <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" type="submit">Sign
                                        in</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
