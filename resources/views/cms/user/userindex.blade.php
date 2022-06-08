@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <div class="section">
        <table class='table'>
            <thead>
                <tr>
                <th scope='col'>id</th>
                <th scope='col'>name</th>
                <th scope='col'>email</th>
                <th scope='col'>Action</th>
                </tr>
            </thead>
            
            @foreach($user as $posts)
            <tbody>
                <tr>
                <td scope="col">{{$posts->id}}</td>
                <td scope="col">{{$posts->name}}</td>
                <td scope="col">{{$posts->email}}</td>
                <td scope="col">
                <a href="/user/{{$posts->id}}"><i class="nav-icon fas fa-pen pr-5"></i></a>
                <form action="/userdel/{{$posts->id}}" method='POST' class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn"><i class="fas fa-trash text-danger"></i></button>
                </form>
                </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection
