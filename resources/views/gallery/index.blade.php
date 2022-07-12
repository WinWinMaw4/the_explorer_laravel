@extends('master')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            {{--            <h1 class="my-4 text-center">Mingalar Par</h1>--}}
            <div class="col-lg-10 col-xl-8">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-primary">Your Galleries</h3>
                    </div>
                </div>
                <div class="gallery  min-vh-100">
                    <div class="row row-cols-5 g-0">
                       @forelse($galleries as $gallery)
                            <div class="col">
                                <div class="card w-100 overflow-hidden" style="height: 200px;">
{{--                                    <img src="{{asset('storage/gallery/'.$gallery->photo)}}" class="card-img" alt="" style="object-fit: cover;width: 100%;height: 100%">--}}
                                        <a class="venobox" data-gall="gall{{$gallery->user_id}}" data-maxwidth="500px" href="{{asset('storage/gallery/'.$gallery->photo)}}" style="object-fit: cover;width: 100%;height: 100%">
                                            <img src="{{asset('storage/gallery/'.$gallery->photo)}}" class="gallery-photo" alt="" style="object-fit: cover;width: 100%;height: 100%">
                                        </a>

                                </div>
                            </div>

                        @empty
                           There is no photo
                        @endforelse
                    </div>
                    <div class="d-flex justify-content-center align-items-center my-4">
                        {{$galleries->links()}}
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
