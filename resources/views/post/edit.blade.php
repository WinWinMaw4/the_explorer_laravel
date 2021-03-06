@extends('master');
@section('title') Edit Post : {{env("APP_NAME")}} @endsection
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="">
{{--                        <a href="{{route('index')}}" class="btn btn-default"><i class="fas fa-long-arrow-alt-left fa-2x fa-fw"></i></a>--}}
                        <h4 class="mb-0 text-primary">Update Post</h4>
                    </div>
                    <p class="mb-0">
                        <i class="fas fa-calendar"></i>
                        {{date('d M Y')}}
                    </p>
                </div>

                <form action="{{route('post.update',$post->id)}}" method="post" id="post-create" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-floating mb-4">
                        <input type="text" name="title" value="{{old('title',$post->title)}}" class="form-control @error('title') is-invalid @enderror" id="postTitle" placeholder="no need">
                        <label for="postTitle">Post Title</label>
                        @error('title')
                        <div class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <img src="{{ asset('storage/cover/'.$post->cover) }}" id="coverPreview" class="cover-img w-100 rounded @error('cover') border border-danger is-invalid @enderror" alt="">
                        <input type="file" id="cover" name="cover" class="d-none" accept="image/jpeg,image/png">
                        @error('cover')
                        <div class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-4">
                        <textarea name="excerpt" class="form-control @error('excerpt') is-invalid @enderror" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px">
                        {{  old('excerpt',$post->excerpt)  }}
                        </textarea>
                        <label for="floatingTextarea2">Excerpt Text</label>
                        @error('excerpt')
                        <div class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                        @enderror
                    </div>
                    <div class="form-floating mb-4">
                        <textarea name="description" id="my_summernote" class="form-control @error('description')border border-danger is-invalid @enderror" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 450px">
                            {{old('description',$post->description)}}
                        </textarea>
{{--                        <label for="floatingTextarea2">Share Your Experience</label>--}}
                        @error('description')
                        <div class="invalid-feedback">
                            <span>{{$message}}</span>
                        </div>
                        @enderror
                    </div>

                </form>

                <div class="border rounded p-3 mb-4" id="gallery">
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="border px-4 rounded-1 d-flex justify-content-center align-items-center" id="upload-ui" style="height: 150px">
                            <i class="fas fa-upload"></i>
                        </div>
                        <div class="d-flex overflow-auto ms-1" style="height: 150px">
                            @forelse($post->galleries as $gallery)
                                <div class="position-relative " >
                                    <img src="{{asset('storage/gallery/'.$gallery->photo)}}" class="h-100 rounded me-2" alt="">
                                    <form action="{{route('gallery.destroy',$gallery->id)}}" method="post" class="position-absolute top-0 end-0" style="z-index:5;">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-link text-danger btn-sm gallery-img-delete">
                                            <i class="fas fa-times fa-fw fa-2x"></i>
                                        </button>
                                    </form>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                    <form action="{{route('gallery.store')}}" method="post" enctype="multipart/form-data" id="galley-upload">
                        @csrf
                        <div class="">
                            <input type="hidden" name="post_id" value="{{$post->id}}" >
                            <input type="file" name="galleries[]" id="gallery-input"  class="d-none @error('galleries') is-invalid @enderror @error('galleries.*') is-invalid @enderror" multiple />
                            @error('galleries')
                            <div class="invalid-feedback">
                                <span>{{$message}}</span>
                            </div>
                            @enderror
                            @error('galleries.*')
                            <div class="invalid-feedback">
                                <span>{{$message}}</span>
                            </div>
                            @enderror
                        </div>
{{--                        <button class="d-none">submit</button>--}}
                    </form>
                </div>
                <div class="text-center mb-4">
                    <button class="btn btn-lg btn-primary text-light" form="post-create">
{{--                        <i class="fas fa-arrow-up fa-fw"></i>--}}
                        Update Post
                    </button>
                </div>
            </div>

        </div>
    </div>

@stop

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

    //    Gallery
        let uploadUi = document.getElementById('upload-ui');
        let galleryInput = document.getElementById('gallery-input');
        let galleryUpload = document.getElementById('galley-upload');

        uploadUi.addEventListener('click',_=>galleryInput.click());
        galleryInput.addEventListener('change',_=>galleryUpload.submit());
    </script>
@endpush
