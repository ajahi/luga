@extends('layouts.mastercms')


@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Edit Category</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-4'>
    <form method='POST' action="/category/{{$post->id}}">
    @csrf
    @method('PUT')
        <div class="form-floating my-3">
        <label for="title" class="text-secondary">Title <span class="font-normal text-danger">*</span></label>
            <input required type="text" class="form-control col-lg-7" name="title" placeholder="Ttile of the post" value='{{$post->title}}'>
         </div>
        <div class="form-floating my-3">
        <label for="description" class="text-secondary">Description <span class="font-normal text-danger">*</span></label>
            <textarea  required class="form-control col-lg-7" placeholder="Description" name="description" style="height: 100px">{{$post->description}}</textarea>
        </div>
       
    <div class="py-4">
    <a href="/category" class="btn btn-danger mb-2 px-4 mr-4">Cancel</a><button type='Submit' class="btn btn-success px-4 mb-2">Update</button>
    </div>
    </form>
    </section>
    
</div>
@endsection
