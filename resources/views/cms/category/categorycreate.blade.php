@extends('layouts.mastercms')


@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Create a category.</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-4'>
    <form method='POST'action="/category">
    @csrf
        <div class="form-floating my-3">
        <label for="title" class="text-secondary">Title <span class="font-normal text-danger">*</span></label>
            <input type="text" required class="form-control col-lg-7" name="title" placeholder="Title of the category">
         </div>
        <div class="form-floating my-3">
        <label for="description" class="text-secondary">Description <span class="font-normal text-danger">*</span></label>
            <textarea required class="form-control col-lg-7" placeholder="Description" name="description" style="height: 100px"></textarea>
        </div>
       
        <button type='Submit' class="btn btn-success px-4 mb-4">Create</button>
    </form>
    </section>
    
</div>
@endsection

