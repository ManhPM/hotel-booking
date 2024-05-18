@extends('admin.layouts.app')
@section('title','Create users')
@section('content')
<form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class=" input-group-static col-5 mb-4">
            <label>Image</label>
            <input type="file" accept="image/*" name="image" id="image-input" class="form-control">

            @error('image')
            <span class="text-danger"> {{ $message }}</span>
            @enderror
        </div><br>
        <div class="col-5">
            <img src="" id="show-image" alt="" width="200px" height="200px" style="display: none;">
        </div>
    </div>

    <div class="input-group input-group-static mb-4">
        <label>Name</label>
        <input type="text" value="{{ old('name') }}" name="name" class="form-control">

        @error('name')
        <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>

    <div class="input-group input-group-static mb-4">
        <label>Email</label>
        <input type="text" value="{{ old('email') }}" name="email" class="form-control">
        @error('email')
        <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>

    <div class="input-group input-group-static mb-4">
        <label>Phone</label>
        <input type="text" value="{{ old('phone') }}" name="phone" class="form-control">
        @error('phone')
        <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>

    <div class="input-group input-group-static mb-4">
        <label>Address</label>
        <input type="text" value="{{ old('address') }}" name="address" class="form-control">

        @error('address')
        <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>

    <div class="input-group input-group-static mb-4">
        <label>Password</label>
        <input type="password" name="password" class="form-control">
        @error('password')
        <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>

    <div class="input-group input-group-static mb-4">
        <label for="exampleFormControlSelect1" class="ms-0">Gender</label>
        <select name="gender" class="form-control" id="exampleFormControlSelect1">
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
    @error('gender')
    <span class="text-danger">{{$message}}</span>
    @enderror

    <div class="form-group">
        <label for="">Roles</label>
        <div class="row">
            @foreach ($roles as $groupName => $role)
            <div class="col-5">
                <h4>{{ $groupName }}</h4>

                <div>
                    @foreach ($role as $item)
                    <div class="form-check">
                        <input class="form-check-input" name="role_ids[]" type="checkbox" value="{{ $item->id }}">
                        <label class="custom-control-label" for="customCheck1">{{ $item->display_name }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
<script>
    $(() => {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#show-image').attr('src', e.target.result).show();
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image-input").change(function() {
            readURL(this);
        });
    });
</script>
@endsection

@section('script')

<script defer src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script defer="" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script defer>
    $(() => {
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#show-image').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#image-input").change(function() {
                readURL(this);
            });
        });
</script>
@endsection