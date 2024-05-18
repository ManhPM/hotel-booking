@extends('admin.layouts.app')
@section('title','Roles')
@section('content')
<div class="card">
    <h1>
        Role list
    </h1>
    @if (session('message'))
    <div class="text-primary">{{session('message')}}</div>
    @endif
    <div>
        <a class="btn btn-primary" href="{{route('roles.create')}}">Create</a>
    </div>
    <div>
        <table class="table table-hover">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>DisplayName</th>
                <th>Action</th>
            </tr>
            @foreach ($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>
                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('roles.destroy', $role->id) }}" id="form-delete{{ $role->id }}"
                        method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-delete btn-danger" data-id="{{ $role->id }}"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </table>
        {{$roles->links()}}
    </div>
</div>
@endsection
