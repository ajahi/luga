@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
@include('flash')
    <div class="section">
        <table class='table'>
            <thead>
                <tr>
                <th scope='col'>id</th>
                <th scope='col'>title</th>
                <th scope='col'>description</th>
                <th scope='col'>Website</th> 
                <th scope='col'>Action</th>
                </tr>
            </thead>
            
            @foreach($site as $posts)
            <tbody>
                <tr>
                <td scope="col">{{$posts->id}}</td>
                <td scope="col"><a href="/site/{{$posts->id}}">{{$posts->title}}</a></td>
                <td scope="col">{{$posts->description}}</td>
                <td scope="col">{{$posts->website}}</td>
                <td scope="col">
                <a href="/siteedit/{{$posts->id}}"><i class="nav-icon fas fa-pen pr-5"></i></a>
               
                </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection