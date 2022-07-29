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
        <a href="{{route('user.create')}}" class="btn btn-primary">Add New User</a>
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
                <th scope="col">Image</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @if(count($users) > 0)
                    @foreach ($users as $item)
                        <tr class="text-center">
                            <td>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td> <img src="{{ $item->image ? asset($item->image) :  asset('image/download.jpg') }}" class="card-img-top" alt="..." width="140" height="60"></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('user.show', $item->id) }}" class="btn btn-primary mx-2">Edite</a>
                                        <button type="submit" class="btn btn-danger mx-2"  class="delete">Delete</button>
                                    </form>
                                </div>
                            </td>
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
        {{  $users->links('pagination::bootstrap-4')}}
    </div>
@endsection