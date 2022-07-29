@extends('layouts.app')

@section('content')
    <div class="mt-4">
        <div class="card">
            <div class="card-body">
                <div>
                    <a class="btn btn-primary" href="{{ route('booking.index') }}" title="Go back"> Go Back </a>
                </div>
                <h3 class="text-center">Booking</h3>
                <form action="{{ route('booking.store') }}"  method="POST" enctype="multipart/form-data">
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
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Purpose </label>
                        <textarea class="form-control" name="purpose" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlInput1">Date</label>
                        <input type="date" class="form-control" name="select_date" id="select_date">
                      </div>
                      <label for="exampleFormControlTextarea1" class="mt-2">Available Sloat Time </label>
                      <select class="form-select" id="sloat_time" name="sloat_time" aria-label="Default select example" required>
                        <option selected>Open this select menu</option>
                    </select>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">

        $("#select_date").change(function () {
  
            var ele = $(this).val();

            $.ajax({
                url: '{{ route('booking.sloat') }}',
                method: "get",
                data: {
                    _token: '{{ csrf_token() }}', 
                    date: ele, 
                },
                success: function (response) {
                    $("#sloat_time").html('');
                    $.each(response.time, function(key, value) {
                        $("#sloat_time").append($('<option>', { value: value.id, text: value.start_time+':'+value.end_time }));
                    });
                }
            });
        });
    </script>
@endsection