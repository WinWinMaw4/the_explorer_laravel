@extends('master')

@section('content')
    <div class="container">
        <div class="row min-vh-100 justify-content-center align-items-center">
            <div class="col-12 col-lg-8">
                <div class="mb-4">
                    <div class="card border border-0 shadow p-3 bg-primary text-white">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-12 col-md-6">
                                    <div class="sign-in-form">
                                        <h3 class="fw-bold text-center">Sing Up</h3>
                                        <p class="text-center">
                                            Already have an account?
                                            <a href="{{ route('login') }}" class="text-warning">Sign in here</a>
                                        </p>
                                        <a href="#" class="btn btn-lg rounded btn-outline-dark w-100">
                                            Sign in with Google
                                        </a>

                                        <hr class="my-4">

                                        <form action="{{route('register')}}" method="post">
                                            @csrf
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-user"></i>
                                                    Full Name
                                                </label>
                                                <input type="text" class="form-control form-control-lg rounded @error('name') is-invalid @enderror" name="name">
                                                @error('name')
                                                <span class="invalid-feedback ps-2" role="alert" >
                                    <strong>{{$message}}</strong>
                                </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-envelope"></i>
                                                    Email
                                                </label>
                                                <input type="email" class="form-control form-control-lg rounded @error('email') is-invalid @enderror" name="email">
                                                @error('email')
                                                <span class="invalid-feedback ps-2" role="alert" >
                                    <strong>{{$message}}</strong>
                                </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-lock"></i>
                                                    Password
                                                </label>
                                                <input type="password" class="form-control form-control-lg rounded @error('password') is-invalid @enderror" name="password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-lock"></i>
                                                    Confirm Password
                                                </label>
                                                <input type="password" class="form-control form-control-lg rounded @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                                                @error('password_confirmation')
                                                <span class="invalid-feedback ps-2" role="alert" >
                                    <strong>{{$message}}</strong>
                                </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" >
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        I accept the Term and Condition
                                                    </label>
                                                </div>
                                            </div>
                                            <button class="btn btn-secondary btn-lg text-white rounded w-100">Sign Up</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6 text-center align-self-center d-none d-md-block">
                                    <img src="{{asset('images/logo_hz.png')}}" class="img-fluid" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
