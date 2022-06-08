@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                 <h1>Title:</h1>
                     <h1>{{$product->title}}</h1>
                 </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <label><h2>Description:</h2></label>
                <p>{{$product->description}}</p>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Slogan</h2>
                <p>{{$product->slogan}}</p>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Logo</h2>
                <img src="{{$product->logu()}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Website</h2>
                <h4>{{$product->website}}</h4>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Location</h2>
                <p>{{$product->location}}</p>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Telephone</h2>
                <h4>{{$product->telephone}}</h4>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Working days</h2>
                <h4>{{$product->working_days}}</h4>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>facebook</h2>
                <p>{{$product->facebook}}</p>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Google</h2>
                <p>{{$product->google}}</p>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Twitter</h2>
                <p>{{$product->twitter}}</p>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Instagram</h2>
                <p>{{$product->instagram}}</p>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Linkedin</h2>
                <p>{{$product->linkedin}}</p>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Skype</h2>
                <p>{{$product->skype}}</p>
                </div>
            </div>
        </div>
    </section>
    <hr>
    <section class='content'>
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                <h2>Attributes</h2>
                <p>{{$product->attributes}}</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
