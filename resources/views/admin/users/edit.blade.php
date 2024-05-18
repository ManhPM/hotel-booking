@extends('admin.layouts.app')
@section('title','Edit users')
@section('content')
<form action="{{route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="input-group input-group-static mb-4">
        <label>Name</label>
        <input type="text" value="{{ old('name') ?? $user->name }}" name="name" class="form-control">

        @error('name')
        <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>

    <div class="input-group input-group-static mb-4">
        <label>Display Name</label>
        <input type="text" value="{{ old('display_name') ?? $user->display_name }}" name="display_name"
            class="form-control">
        @error('display_name')
        <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>

    <div class="input-group input-group-static mb-4">
        <label for="exampleFormControlSelect1" class="ms-0">Group</label>
        <select name="group" class="form-control" id="exampleFormControlSelect1" value={{$user->group}}>
            <option value="system">System</option>
            <option value="user">User</option>
        </select>
    </div>
    @error('group')
    <span class="text-danger">{{$message}}</span>
    @enderror

    <div class="form-group">
        <label for="">permission</label>
        <div class="row">
            @foreach ($permissions as $groupName => $permission)
            <div class="col-4">
                <h4>{{$groupName}}</h4>
                <div>
                    @foreach ($permission as $item)
                    <div class="form-check">
                        <input class="form-check-input" name="permission_ids[]" type="checkbox"
                            {{$user->permissions->contains('name',$item->name) ? 'checked' :''}}
                        value="{{$item->id}}">
                        <label class="custom-control-label" for="customCheck1">{{$item->display_name}}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection