{{-- dalam file resources/views/dashboard/setting-admin.blade.php --}}

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Setting Admin</h1>

        <h2 class="fs-5">Admin Management</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <th scope="row">{{$loop->index +1}}</th>
                    <td>{{$user->name}}<br /><span class="text-secondary">{{$user->email}}<br /><span class="badge text-danger bg-light">{{$user->unit->name}}</span></span></td>
                    <td>
                        @foreach ($user->getRoleNames() as $role)
                        <div class="badge bg-light text-primary">{{$role}}</div>
                        @endforeach
                    </td>
                    <td>
                        @if ($user->getRoleNames()[0] == "admin")
                        <form method="POST" action="{{route('dashboard.update-admin-role')}}">
                            @csrf
                            <input type="hidden" name="id_user" value="{{$user->id}}">
                            <button type="submit" class="btn btn-warning">un Admin</button>
                        </form>
                        @else
                        <form method="POST" action="{{route('dashboard.update-admin-role')}}">
                            @csrf
                            <input type="hidden" name="id_user" value="{{$user->id}}">
                            <button type="submit" class="btn btn-primary">be Admin</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
