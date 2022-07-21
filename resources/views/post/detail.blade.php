@extends('master')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="post mb-4">
                    <div class="row">
                       <div class="d-flex justify-content-start my-2" style="cursor: pointer">
{{--                           <a href="javascript:history.back()" class="text-black-50"><i class="fas fa-long-arrow-alt-left fa-2x fa-fw"></i></a>--}}
                       </div>
                        <div class="d-flex mb-4 justify-content-start align-items-center">
                            <img src="{{ asset($post->user->photo) }}" class="user-img rounded-circle" alt="">
                            <p class="mb-0 ms-2">
                                <span class="text-primary">{{ $post->user->name }}</span>
{{--                                <i class="fas fa-calendar"></i>--}}
{{--                                {{ $post->created_at->diffForHumans() }}--}}
                                {{--                                                        {{$post->created_at->format("d M Y"),}}--}}
                            </p>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <h4 class="fw-bold text-primary">{{ $post->title }}</h4>

                                <span class="small text-muted">
                                    <i class="fas fa-calendar"></i>
                                    {{ $post->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                @auth
                                    @can('update',$post)
                                        <a href="{{route('post.edit',$post->id)}}" class="btn btn-outline-warning text-decoration-none me-1">
                                            <i class="fas fa-edit fa-fw fa-1x"></i>
                                        </a>
                                    @endcan
                                    @can('delete',$post)
                                        <form action="{{route('post.destroy',$post->id)}}" method="post" id="del{{$post->id}}" class="d-inline-block">
                                            @csrf
                                            @method('delete')

                                        </form>
                                            <button class="btn btn-outline-danger me-1 del-btn" form="del{{$post->id}}">
                                                <i class="fas fa-trash-alt fa-fw fa-1x"></i>
                                            </button>
                                    @endcan
                                @endauth
                                <a href="{{route('index')}}" class="btn btn-outline-primary">Read All</a>
                            </div>
                        </div>

                        <img src="{{ asset("storage/cover/".$post->cover) }}" class="cover-img rounded-3 w-100 my-4" alt="">
                        <p class="text-black post-detail">
                            {{ $post->description }}
                        </p>

                        @if($post->galleries->count())
                            <div class="gallery border rounded mb-4">
                                <h4 class="text-center fw-bold mt-4">Post Gallery</h4>
                                <div class="row g-4 py-4 px-2 justify-content-center">
                                    @foreach($post->galleries as $gallery)
                                        <div class="col-6 col-lg-4 col-xl-3">
                                            <a class="venobox" data-gall="gall{{$gallery->post_id}}" data-title="{{$post->title}}" data-maxwidth="800px" href="{{asset('storage/gallery/'.$gallery->photo)}}">
                                                <img src="{{asset('storage/gallery/'.$gallery->photo)}}" class="gallery-photo" alt="">
                                            </a>

                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif


                        <div class="my-5">
                            <h4 class="text-center fw-bold mb-4">Users Comment</h4>

                            <div class="row justify-content-center">
                                <div class="col-lg-10">

                                    @auth
                                        <form action="{{ route('comment.store') }}" method="post" id="comment-create" class="form-group">
                                            @csrf
                                            <input type="hidden" name="post_id"  value="{{ $post->id }}">
                                           <div class="row justify-content-center align-items-center">
                                               <div class="col-md-12 form-floating mb-3" class="">
                                                   <textarea class="form-control  @error('message') is-invalid @enderror" name="message" placeholder="Leave a comment here" style="height: 150px" id="floatingTextarea"></textarea>
                                                   <label for="floatingTextarea" class="ps-3">
                                                       <i class="fas fa-comment"></i>
                                                       Comments
                                                   </label>
                                                   @error('message')
                                                   <div class="invalid-feedback ps-2">{{ $message }}</div>
                                                   @enderror
                                               </div>
                                               <div class="col-md-3 text-center">
                                                   <button class="btn btn-primary text-white mb-3">
                                                       Comment
                                                       <i class="fas fa-paper-plane fa-fw"></i>
                                                   </button>
                                               </div>
                                           </div>
                                        </form>
                                    @endauth

                                        <div class="comments">
                                            @guest
                                                <p class="text-center mb-4">
                                                    <a href="{{route('login')}}" class="fw-bold text-center">Login</a> to comment.
                                                </p>
                                            @endguest

                                        @forelse($post->comments as $comment)

                                                <div class="border rounded p-3 mb-3">
                                                    <div class="d-flex justify-content-between mb-3">
                                                        <div class="d-flex">
                                                            <img src="{{ asset($comment->user->photo) }}" class="user-img rounded-circle" alt="">
                                                            <p class="mb-0 ms-2 small">
                                                                {{ $comment->user->name }}
                                                                <br>
                                                                <i class="fas fa-calendar"></i>
                                                                {{ $comment->created_at->diffforhumans() }}
                                                            </p>
                                                        </div>
                                                        @can('delete',$comment)
                                                            <form class="" method="post" action="{{ route('comment.destroy',$comment->id) }}">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="btn btn-outline-danger rounded-circle btn-sm">
                                                                    <i class="fas fa-trash-alt "></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                    </div>

                                                    <p class="mb-0">
                                                        {{ $comment->message }}
                                                    </p>
                                                </div>
                                            @empty
                                                <p class="text-center">There is no Comment yet !
                                                @auth
                                                    Start comment now.
                                                @endauth

                                                @guest
                                                    <a href="{{route('login')}}" class="fw-bold">Login</a> to comment.
                                                @endguest
                                                </p>
                                            @endforelse
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
@push('scripts')
    <script>
        let delBtn = document.getElementsByClassName('del-btn');
        for(let i=0; i<= delBtn.length ; i++){
            delBtn[i].addEventListener('click',function (){
                event.preventDefault();
                formId = this.getAttribute('form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#56923f',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(formId).submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })
            })

        }
    </script>
@endpush
