@extends('master')
@section('title') Edit Profile @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-xl-5 min-vh-100 ">
                <div class="">
                    <a href="javascript:history.back()" class="text-black-50"><i class="fas fa-long-arrow-alt-left fa-2x fa-fw"></i></a>

                    <div class="text-center my-5 mt-2 shadow py-4 bg-primary rounded text-white">
                        <h4 class="fw-bold mb-4">Change Your Password</h4>

                        <img src="{{asset(auth()->user()->photo)}}" class="profile-image" alt=""><br>
                        <button class="btn btn-sm btn-secondary d-none" id="edit-photo" style="margin-top: -25px;">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <p class="mb-0">{{auth()->user()->name}}</p>
                        <p class="small text-white mb-0">{{auth()->user()->email}}</p>
                    </div>

                    <form action="{{ route('update-password') }}" method="post">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="password" name="old_password" class="form-control @error('old_password') is-invalid @enderror" id="yourPassword" value="{{ old('old_password') }}" placeholder="">
                            <label for="yourPassword">Password</label>
                            @error('old_password')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="newPassword" value="{{ old('password') }}" placeholder="">
                            <label for="newPassword">New Password</label>
                            @error('password')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPassword" value="" placeholder="">
                            <label for="confirmPassword">Confirm Password</label>
                            @error('password_confirmation')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button class="btn btn-lg btn-primary text-white">
                                Update Password
                            </button>
                        </div>
                        <a href="{{route('edit-profile')}}" class="float-end">Edit Profile</a>
                    </form>
                </div>
            </div>



        </div>
    </div>



@stop

@push('scripts')
    <script>

    </script>
@endpush
