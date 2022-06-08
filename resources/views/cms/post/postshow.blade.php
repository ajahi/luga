@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>{{$product->title}}</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <p>{{$product->description}}</p>
                </div>
            </div>
        </div>
    </section>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <img src="{{$product->getFirstMediaUrl('')}}" alt="">
                </div>
            </div>
        </div>
    </section>


    
</div>
@endsection
