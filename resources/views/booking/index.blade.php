@extends('layouts.app')

@section('content')
    @if(Session::has('success'))
        <div class="d-flex justify-content-center align-items-center">
            <div class="alert alert-success my-2" role="alert">
                {{ Session::get('success') }}
            </div>
        </div>
    @endif
    <div class="text-end mt-4 d-flex  align-items-center">
        <a href="{{route('booking.create')}}" class="btn btn-primary">Add Booking</a>
        <form action="{{ route('logout') }}" class="mx-4" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mt-3">Logout</button>
        </form>
    </div>
    <div class="row">
        <table class="table shadow bg-white">
            <thead class="thead-dark">
              <tr class="text-center">
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Purpose</th>
                <th scope="col">Day</th>
                <th scope="col">Time</th>
              </tr>
            </thead>
            <tbody>
                @if(count($bookings) > 0)
                    @foreach ($bookings as $item)
                        <tr class="text-center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->purpose}}</td>
                            @php
                            $day = $item->time_solt->day;
                                 if($day == 0){
                                    $day = 'Sunday';
                                }else if($day == 1){
                                    $day = 'Monday';
                                }else if($day == 2){
                                    $day = 'Tuesday';
                                }else if($day == 3){
                                    $day = 'Wednesday';
                                }else if($day == 4){
                                    $day = 'Thursday';
                                }else if($day == 5){
                                    $day = 'Friday';
                                }else if($day == 6){
                                    $day = 'Saturday';
                                }
                            @endphp
                            <td>{{$day}}</td>
                            <td> {{$item->time_solt->start_time.' to '.$item->time_solt->end_time}}</td>
                    
                        </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="5" class="text-center">No Recourds Found !</td>
                </tr>
                @endif
               
            </tbody>
          </table>
    </div>
    <div class="d-felx justify-content-center mt-4">
        {{  $bookings->links('pagination::bootstrap-4')}}
    </div>
@endsection