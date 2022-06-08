@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Edit {{$post->title}}</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-4'>
    <form method='POST' action="/slider/{{$post->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="form-floating my-3">
        <label for="title" class="text-muted">Title <span class="font-normal text-danger">*</span></label>
            <input  type="text" class="form-control col-lg-7" name="title" placeholder="Title of the post" value='{{$post->title}}' required>
         </div>
        <div class="form-floating my-3">
        <label for="description" class="text-secondary">Description <span class="font-normal text-danger">*</span></label>
            <textarea required class="form-control col-lg-7" placeholder="Description" name="description" style="height: 100px">{{$post->description}}</textarea>
        </div>
        <div class="form-floating my-3">
            <label for="image" class="text-secondary">Slider Image</label>
            <input type="file" class="form-control col-lg-7" name="image" placeholder="Image" >
        </div>
        <div class="py-4">
        <a href="/slider" class="btn btn-danger mb-2 px-4 mr-4">Cancel</a><button type='Submit' class="btn btn-success mb-2 px-4">Update</button></div>
    </form>
    </section>
    
</div>
@endsection