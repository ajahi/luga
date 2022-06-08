@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Create a Slider.</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-4'>
    <form method='POST'action="/slider" enctype="multipart/form-data">
    @csrf
        <div class="form-floating my-3">
        <label for="title" class="text-muted">Title <span class="font-normal text-danger">*</span></label>
            <input required type="text" class="form-control col-lg-7" name="title" placeholder="Slider title" required>
         </div>
         <div class="form-floating my-3">
         <label for="description" class="text-secondary">Description <span class="font-normal text-danger">*</span></label>
            <textarea required class="form-control col-lg-7" placeholder="Description" name="description" style="height: 100px" required></textarea>
        </div>
        <div class="form-floating my-3">
            <label for="images" class="text-secondary">Slider Image <span class="font-normal text-danger">*</span></label>
            <input required type="file" class="form-control col-lg-7" name="image" placeholder="Image">
        </div>
       
        <button type='Submit' class="btn btn-success px-4">Create</button>
    </form>
    </section>
    
</div>
@endsection
