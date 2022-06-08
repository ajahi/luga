@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Edit {{$post->title}} Site.</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-4'>
    <form method='POST' action="/site/{{$post->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="form-floating my-3">
        <label for="title" class="text-secondary">Title <span class="font-normal text-danger">*</span></label>
            <input type="text" required class="form-control col-lg-7" name="title" placeholder="Title of the site" value='{{$post->title}}'>
         </div>
         <div class="form-floating mb-3">
            <label for="logos" class="text-secondary">Logo <span class="font-normal text-danger">*</span></label>
            <input type="file"  class="form-control col-lg-7" name="logo" placeholder="Image">    
        </div>

         <div class="form-floating my-3">
         <label for="slogan" class="text-secondary">Slogan <span class="font-normal text-danger">*</span></label>
            <input required type="text" class="form-control col-lg-7" name="slogan" placeholder="slogan" value='{{$post->slogan}}'>
         </div>
        <div class="form-floating my-3">
        <label for="description" class="text-secondary">Description <span class="font-normal text-danger">*</span></label>
            <textarea required class="form-control col-lg-7" placeholder="Description" name="description" style="height: 100px">{{$post->description}}</textarea>
        </div>
        <div class="form-floating my-3">
        <label for="website" class="text-secondary">Website <span class="font-normal text-danger">*</span></label>
            <input required type="url" class="form-control col-lg-7" name="website" placeholder="url of site" value='{{$post->website}}'>
         </div>
         <div class="form-floating my-3">
         <label for="email" class="text-secondary">Email <span class="font-normal text-danger">*</span></label>
            <input required type="email" class="form-control col-lg-7" name="email" placeholder="email of the site" value='{{$post->email}}'>
         </div>
         <div class="form-floating my-3">
         <label for="location" class="text-secondary">Location <span class="font-normal text-danger">*</span></label>
            <input required type="text" class="form-control col-lg-7" name="location" placeholder="location" value='{{$post->location}}'>
         </div>
         <div class="form-floating my-3">
         <label for="working_days" class="text-secondary">Working days</label>
            <input type="integer" class="form-control col-lg-7" name="working_days" placeholder="working days of the company" value='{{$post->working_days}}'>
         </div>
         <div class="form-floating my-3">
         <label for="telephone" class="text-secondary">Telephone <span class="font-normal text-danger">*</span></label>
            <input required type="number" class="form-control col-lg-7" name="telephone" placeholder="Telephone" value='{{$post->telephone}}'>
         </div>
         <div class="form-floating my-3">
         <label for="facebook" class="text-secondary">Facebook <span class="font-normal text-danger">*</span></label>
            <input type="text" required class="form-control col-lg-7" name="facebook" placeholder="facebook" value='{{$post->facebook}}'>
         </div>
         <div class="form-floating my-3">
         <label for="instagram" class="text-secondary">Instagram</label>
            <input type="text" class="form-control col-lg-7" name="instagram" placeholder="instagram" value='{{$post->instagram}}'>
         </div>
         <div class="form-floating my-3">
         <label for="twitter" class="text-secondary">Twitter</label>
            <input type="text" class="form-control col-lg-7" name="twitter" placeholder="twitter" value='{{$post->twitter}}'>
         </div>
         <div class="form-floating my-3">
         <label for="skype" class="text-secondary">Skype</label>
            <input type="text" class="form-control col-lg-7" name="skype" placeholder="skype" value='{{$post->skype}}'>
         </div>
         <div class="form-floating my-3">
         <label for="linkedin" class="text-secondary">LinkedIn</label>
            <input type="text" class="form-control col-lg-7" name="linkedin" placeholder="linkedin" value='{{$post->linkedin}}'>
         </div>
         <div class="form-floating my-3">
         <label for="google" class="text-secondary">Youtube</label>
            <input type="text" class="form-control col-lg-7" name="google" placeholder="Youtube" value='{{$post->google}}'>
         </div>
        <button type='Submit' class="btn btn-success mb-4 px-4">Update</button>
    </form>
    </section>
    
</div>
@endsection
