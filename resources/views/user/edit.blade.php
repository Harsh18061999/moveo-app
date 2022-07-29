@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <a class="btn btn-primary" href="{{ route('user.index') }}" title="Go back"> Go Back </a>
                </div>
                <h3 class="text-center">Update User</h3>
                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <label for="user_name">Name</label>
                        <input type="text" class="form-control" id="user_name" aria-describedby="emailHelp" value="{{$user->name}}" required name="name" placeholder="Enter User name" autocomplete="off">
                        @error('name')
                            <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter user email"value="{{$user->email}}" required autocomplete="off">
                        @error('email')
                            <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div><img src="{{ $user->image ? asset($user->image) : asset('image/download.jpg') }}" alt="" width="100" height="100"></div>
                    <div class="form-group mb-4">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                        @error('image')
                            <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="day">Select Day</label>
                    <select class="form-select" name="day" id="day" aria-label="Default select example" required>
                        <option selected>Open this select menu</option>
                        <option value="0" {{$day == 0 ? 'selected' : '' }}>Sunday</option>
                        <option value="1" {{$day == 1 ? 'selected' : '' }}>Monday</option>
                        <option value="2" {{$day == 2 ? 'selected' : '' }}>Tuesday</option>
                        <option value="3" {{$day == 3 ? 'selected' : '' }}>Wednesday</option>
                        <option value="4" {{$day == 4 ? 'selected' : '' }}>Thursday</option>
                        <option value="5" {{$day == 5 ? 'selected' : '' }}>Friday</option>
                        <option value="6" {{$day == 6 ? 'selected' : '' }}>Saturday</option>
                    </select>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="start_time">Strat Time</label>
                            <input value="{{$start}}" type="text" name='start_time' class="form-control" id="start_time" aria-describedby="emailHelp"  placeholder="Enter Start time" required maxlength="2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            @error('start_time')
                                <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="end_time">End Time</label>
                            <input type="text" value="{{$end}}" class="form-control" id="end_time" aria-describedby="emailHelp" name="end_time" placeholder="Enter End Time" required maxlength="2" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
                            @error('end_time')
                                <div class="alert alert-danger p-0 my-2">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>
@endsection