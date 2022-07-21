@extends('master')
@section('content')
    <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 my-5">
                    <div class="card shadow-lg">
                        <div class="card-header text-primary">Users</div>
                        <div class="card-body">
{{--                            @php use Illuminate\Support\Facades\DB;$users = DB::table('users')->get(); @endphp--}}
                            <div class="container">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Last Seen</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>
                                                @if($user->isOnline())
                                                    <li class="text-success">Online</li>
                                                @else
                                                    <li class="text-warning">Offline</li>
                                                @endif
                                            </td>
                                            <td>{{ \Illuminate\Support\Carbon::parse($user->last_seen)->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endsection
