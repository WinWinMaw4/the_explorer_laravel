@extends('master')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
{{--            <h1 class="my-4 text-center">Mingalar Par</h1>--}}
            <div class="col-lg-10 col-xl-8">
                @auth
                    <div class="border rounded-3 p-4 d-flex justify-content-between align-items-center mb-4">
                        <h4 class="text-black-50">
                            Welcome
                            <br>
                            <span class="fw-bold text-primary">{{ auth()->user()->name }}</span>
                        </h4>
                        <a href="{{route('post.create')}}" class="btn btn-lg btn-primary text-light">Create Post</a>
                    </div>
                @endauth


{{--                    @if(session('status'))--}}
{{--                        <p class="text-success alert alert-success">--}}
{{--                            {{session('status')}}--}}
{{--                        </p>--}}
{{--                    @endif--}}
                    <form action="{{route('search')}}" method="get">
                        <div class="me-2 mb-3 row">
                            <div class="col-12 col-md-10">
                                <div class="input-group d-inline-flex">
                                    <input type="text"  name="search" value="{{request('search')}}" class="form-control border" placeholder="Search">
                                    <button class="btn btn-outline-primary">
                                        <i class="fa-solid fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-2">
                                    <button class="btn btn-primary">
                                        <a href="{{route('index')}}" class="text-white text-decoration-none">All Post</a>
                                    </button>
                            </div>
                        </div>
                    </form>



                    <div class="posts">
                        @forelse($posts as $post)
                            <div class="post mb-4">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <img src="{{ asset("storage/cover/".$post->cover) }}" class="cover-img rounded-3 w-100" alt="">
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="d-flex flex-column justify-content-between h-350 py-4">
                                            <div class="">
                                                <div class="d-flex justify-content-between align-items-center mb-2 position-relative">
                                                    <h4 class="fw-bold text-primary">{{ $post->title }}</h4>
                                                    <div class="text-nowrap">
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
                                                    </div>
                                                </div>
                                                <p class="text-black align-items-start text-start overflow-hidden" style="max-height: 160px;">
                                                    {{\Illuminate\Support\Str::wordCount($post->excerpt)}}
                                                    {{$post->excerpt}}
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex">
                                                    <a href="{{route('user.post',$post->user->name)}}" class="d-flex align-item-center text-decoration-none" >
                                                            <div class="position-relative">
                                                                <img src="{{ asset($post->user->photo) }}" class="user-img rounded-circle" alt="">
                                                                @if($post->user->isOnline())
                                                                    <span class="bg-success active-ball"></span>
                                                                @else
                                                                    <span class="active-ball" style="background-color: transparent"></span>
                                                                @endif
                                                            </div>
                                                        <p class="mb-0 ms-2 small">
                                                            <span class="text-primary">{{ $post->user->name }}</span>
                                                            <br>
                                                            <span class="text-black-50 ">
                                                                <i class="fas fa-calendar"></i>
                                                                {{--                                                        {{ $post->created_at->diffForHumans() }}--}}
                                                                {{$post->created_at->format("d M Y"),}}
                                                                {{$post->created_at->format("h:i a"),}}
                                                            </span>
                                                        </p>
                                                    </a>
                                                </div>
                                               <div class="d-flex justify-content-center align-items-center text-end my-2">
{{--                                                   viewer--}}
                                                   <div class="mx-1" title="viewer">
                                                    <span class="badge bg-dark rounded rounded-1">
                                                        <i class="fas fa-eye me-2"></i>{{$post->views}}
                                                    </span>
                                                   </div>
{{--                                                   comment--}}
                                                   <div class="mx-1" title="comments">
                                                       <div class="text-end my-2" title="comments">
                                                            <span class="badge bg-dark rounded rounded-1">
                                                                <i class="fas fa-comments"></i>
                                                                {{count($post->comments)}}
                                                            </span>
                                                       </div>
                                                       {{-- {{\App\Models\Comment::where('post_id',$post->id)->count('id')}} --}}
                                                   </div>
                                               </div>

                                                <a href="{{route('post.detail',$post->slug)}}" class="btn btn-outline-primary">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @empty
                                <div class="">
                                    <div class="row">
                                        <div class="col-12 text-center text-muted d-flex align-items-center justify-content-center" style="height: 55vh;width: 100%">
                                            <h1>
                                                There is no Post
                                            </h1>
                                        </div>
                                    </div>
                                </div>
                        @endforelse
                    </div>


                    <div class="d-flex justify-content-center align-items-center">
                        {{$posts->links()}}
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
