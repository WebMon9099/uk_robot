@extends('admin.layout.auth-master')
@section('auth_section')
    <div class="row justify-content-center">
        <div class="col-6 mt-5">
            <div class="card mb-0">
                <div class="row g-0 align-items-center">
                    <div class="col-xxl-12 mx-auto">
                        <div class="card mb-0 border-0 shadow-none mb-0">
                            <div class="card-body p-sm-5 m-lg-2">
                                <div class="text-center">
                                    <h5 class="fs-3xl">Admin Login</h5>
                                    <p class="text-muted">Sign in to continue .</p>
                                    <div>
                                        <img src="{{ asset('images/logo.png') }}" alt=""
                                             class="img-fluid w-25">
                                    </div>
                                </div>
                                <div class="p-2 mt-3">
                                    <form action="{{ route('submit.login') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Email<span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative ">
                                                <input type="text" class="form-control  password-input" id="email"
                                                       placeholder="Enter your email" name="email">
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" for="password-input">Password <span
                                                    class="text-danger">*</span></label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input "
                                                       placeholder="Enter password" id="password-input" name="password">
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                                    type="button" id="password-addon"><i
                                                        class="ri-eye-fill align-middle"></i></button>
                                                @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                   id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember
                                                me</label>
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-primary w-100" type="submit">Login</button>
                                        </div>

                                    </form>
                                    <div class="text-center mt-5">
                                        <p class="mt-3">Forgot your password? <a href=""
                                                                                 class="fw-semibold text-secondary text-decoration-underline">forget
                                                password</a></p>
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