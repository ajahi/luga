@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <div class="section">
        <table class='table'>
            <thead>
                <tr>
                <th scope='col'>id</th>
                <th scope='col'>Name</th>
                <th scope='col'>Email</th>
                <th scope='col'>Message</th> 
                <th scope='col'>Action</th>
                </tr>
            </thead>
            
            @foreach($contact as $posts)
            <tbody>
                <tr>
                <td scope="col">{{$posts->id}}</td>
                <td scope="col">{{$posts->name}}</td>
                <td scope="col">{{$posts->email}}</td>
                <td scope="col">{{$posts->message}}</td>
                <td scope="col">
                <form action="/contactdel/{{$posts->id}}" method='POST' class="d-inline">
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
