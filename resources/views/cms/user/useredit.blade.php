@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Edit {{$post->name}} User.</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-4'>
    <form method='POST' action="/user/{{$post->id}}">
    @csrf
    @method('PUT')
        <div class="form-floating my-3">
        <label for="name" class="text-secondary">Name <span class="font-normal text-danger">*</span></label>
            <input required type="text" class="form-control col-lg-7" name="name" placeholder="Ttile of the name" value='{{$post->name}}'>
         </div>
        <div class="form-floating my-3">
        <label for="name" class="text-secondary">Email<span class="font-normal text-danger">*</span></label>
            <input required type='email' class="form-control col-lg-7" placeholder="Email" name="email" value='{{$post->email}}' ></input>
        </div>
        <div class="form-floating my-3">
        <label for="password" class="text-secondary">Password<span class="font-normal text-danger"></span></label>
            <input type='password'class="form-control col-lg-7" placeholder="Password" name="password" ></input>
        </div>
        <div class="form-floating my-3">
        <label for="password_confirmation" class="text-secondary">Confirm Password<span class="font-normal text-danger"></span></label>
            <input type='password'class="form-control col-lg-7" placeholder="confirm-Password" name="password_confirmation" ></input>
        </div>
       
        <div class="pt-4">
        <a href="/user" class="btn btn-danger px-4 mr-4">Cancel</a><button type='Submit' class="btn btn-success px-4">Update</button>
        </div>
    </form>
    </section>
    
</div>
@endsection
