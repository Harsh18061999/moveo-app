@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <a class="btn btn-primary" href="{{ url('/') }}" title="Go back"> Go Back </a>
                </div>
                <h3 class="text-center">Create New User</h3>
                <form action="{{ route('userRegister') }}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group mb-2">
                        <label for="user_name">Name</label>
                        <input type="text" class="form-control" id="user_name" aria-describedby="emailHelp" required name="name" placeholder="Enter User name" autocomplete="off">
                        @error('name')
                            <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter user email" required autocomplete="off">
                        @error('email')
                            <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image" required>
                        @error('image')
                            <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                        @error('password')
                            <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>
@endsection