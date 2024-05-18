@extends('admin.layouts.app')
@section('title','Users')
@section('content')
<div class="card">
    <h1>
        User list
    </h1>
    @if (session('message'))
    <div class="text-primary">{{session('message')}}</div>
    @endif
    <div>
        <a class="btn btn-primary" href="{{route('users.create')}}">Create</a>
    </div>
    <div>
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td><img src="{{ $user->images ? asset('upload/users/' . $user->images->first()->url) : '' }}"
                        width="200px" height="200px" alt=""></td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" id="form-delete{{ $user->id }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-delete btn-danger" data-id="{{ $user->id }}"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </table>
        {{$users->links()}}
    </div>
</div>
@endsection
