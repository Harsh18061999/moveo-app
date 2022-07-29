@extends('layouts.app')

@section('content')
    
    <div class="d-flex justify-content-center align-items-center min-vh-100">
        <div class="card">
            @if(Session::has('error'))
                <div class="d-flex justify-content-center align-items-center">
                    <div class="alert alert-danger p-0 my-2" role="alert">
                        {{ Session::get('error') }}
                    </div>
                </div>
            @endif
            <div class="card-body">
                <h5 class="card-title text-center">Login</h5>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3 mt-3">
                      <label for="email" class="form-label">Email:</label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="Enter email">
                      @error('email')
                            <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                      <label for="pwd" class="form-label">Password:</label>
                      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                        @error('password')
                        <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
                <div class="text-center">
                    <a href="{{route('register')}}" class="text-center btn btn-secondary">Register</a>
                </div>
            </div>
        </div>
       
    </div>
@endsection