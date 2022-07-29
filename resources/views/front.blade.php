@extends('layouts.app')

@section('content')
<div class="d-flex align-items-center">
    <form action="{{ route('logout') }}" class="mx-4 mt-2" method="POST">
        @csrf
        <button type="submit" class="btn btn-danger mt-4">Logout</button>
    </form>
    <a href="{{route('booking.index')}}" class="btn btn-primary mt-3">Booking</a>
</div>
@endsection