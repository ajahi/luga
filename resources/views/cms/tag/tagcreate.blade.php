@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Create a Tag.</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-4'>
    <form method='POST'action="/tag">
    @csrf
        <div class="form-floating my-3">
        <label for="title" class="text-secondary">Title <span class="font-normal text-danger">*</span></label>
            <input type="text" required class="form-control col-lg-7" name="title" placeholder="Title of the tag">
         </div>
        <div class="form-floating my-3">
        <label for="title" class="text-secondary">Description<span class="font-normal text-danger">*</span></label>
            <textarea required class="form-control col-lg-7" placeholder="Description" name="description" style="height: 100px"></textarea>
        </div>
       
        <button type='Submit' class="btn btn-success mb-4 px-4">Create</button>
    </form>
    </section>
    
</div>
@endsection