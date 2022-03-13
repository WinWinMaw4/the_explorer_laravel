@extends('master');
@section("title") Create Post : {{env("APP_NAME")}} @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
               <div class="d-flex justify-content-between align-items-center mb-4">
                   <h4 class="mb-0 text-primary">Create New Post</h4>
                   <p class="mb-0">
                       <i class="fas fa-calendar"></i>
                       {{date('d M Y')}}
                   </p>
               </div>

                <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-floating mb-4">
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="postTitle" value="{{ old('title') }}" placeholder="no need">
                        <label for="postTitle">Post Title</label>
                        @error('title')
                            <div class="invalid-feedback">
                                <span>{{$message}}</span>
                            </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <img src="{{asset('image-default.png')}}" id="coverPreview" class="cover-img w-100 rounded @error('cover') border border-danger is-invalid @enderror" value="{{ old('cover') }}" alt="">
                        <input type="file" id="cover" name="cover" class="d-none" accept="image/jpeg,image/png">
                        @error('cover')
                        <div class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-4">
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 450px">
                        {{  old('description')  }}
                        </textarea>
                        <label for="floatingTextarea2">Share Your Experience</label>
                        @error('description')
                        <div class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="text-center mb-4">
                        <button class="btn btn-lg btn-primary text-light">
{{--                            <i class="fas fa-arrow-up fa-fw"></i>--}}
                            Create Post
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    <script>
        let coverPreview = document.getElementById('coverPreview');
        let cover = document.getElementById('cover');

        coverPreview.addEventListener('click',_=>cover.click());

        cover.addEventListener("change",_=>{
            let file = cover.files[0];
            let reader = new FileReader();
            reader.onload = function (){
                coverPreview.src = reader.result;
            }
            reader.readAsDataURL(file);
        })

    </script>
@endpush
