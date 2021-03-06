@extends('master')
@section('title') Edit Profile @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 col-xl-5 min-vh-100 ">
                <div class="">
{{--                    <a href="javascript:history.back()" class="text-black-50"><i class="fas fa-long-arrow-alt-left fa-2x fa-fw"></i></a>--}}

                    <div class="text-center my-5 mt-2 shadow py-4 bg-primary rounded text-white">
                        <h4 class="fw-bold mb-4">Edit Your Profile</h4>

                        <img src="{{asset(auth()->user()->photo)}}" class="profile-image" alt=""><br>
                        <button class="btn btn-sm btn-secondary" id="edit-photo" style="margin-top: -25px;">
                            <i class="fas fa-camera"></i>
                        </button>
                        <p class="mb-0">{{auth()->user()->name}}</p>
                        <p class="small text-white mb-0">{{auth()->user()->email}}</p>
                    </div>

                    <form action="{{ route('update-profile') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="">
                            <input type="file" name="photo" accept="image/jpeg,image/png" value="{{ old('photo',auth()->user()->photo) }}" class="d-none @error('photo') is-invalid @enderror">
                            @error('photo')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="yourName" value="{{ auth()->user()->name }}" placeholder="name@example.com">
                            <label for="yourName">Your Name</label>
                            @error('name')
                            <div class="invalid-feedback ps-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-floating mb-3">
                            <input disabled type="email"  class="form-control" id="yourEmail" value="{{ auth()->user()->email }}" placeholder="name@example.com">
                            <label for="yourEmail">Your Email</label>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-lg btn-primary text-white">
                                Update Profile
                            </button>
                        </div>
                        <a href="{{route('change-password')}}" class=" float-end">Change Password</a>
                    </form>
                </div>
            </div>



        </div>
    </div>



@stop

@push('scripts')
    <script>
        let profileImage = document.querySelector('.profile-image');
        let editPhoto = document.querySelector("#edit-photo");
        let photo = document.querySelector("[name='photo']");
        editPhoto.addEventListener('click',_=>photo.click());
        photo.addEventListener("change",_=>{
            let file = photo.files[0];
            let reader = new FileReader();
            reader.onload = function (){
                profileImage.src = reader.result;
            }
            reader.readAsDataURL(file);
        })
    </script>
@endpush
