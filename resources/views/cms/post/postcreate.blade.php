@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">

    <section class="content-header ml-2">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Create a Post.</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class="mx-4">
    <form method='POST'action="/posts" enctype="multipart/form-data">
    @csrf
        <div class="form-floating my-3">
        <label for="title" class="text-secondary">Title <span class="font-normal text-danger">*</span></label>
            <input type="text" class="form-control col-lg-7" name="title" placeholder="Title of the post" required>
         </div>
        <div class="form-floating my-3">
        <label for="description" class="text-secondary">Description <span class="font-normal text-danger">*</span></label>
            <textarea class="form-control col-lg-7" placeholder="Description" name="description" style="height: 100px" required></textarea>
        </div>
        <div class="form-floating my-3">
        <label for="Category_id" class="text-secondary">Category <span class="font-normal text-danger">*</span></label>
            <div class="dropdown" >
            <select class="form-select custom-select col-lg-7" name="category_id" aria-label="filter by category" placeholder="Filter by category">          
                @foreach($category as $category)
                <option value='{{$category->id}}'>{{$category->title}}</option>             
                @endforeach
            </select>
            </div>
            
        </div>
        <div class="form-floating my-3">
        <label for="Category_id" class="text-secondary">Status</label><br/>
            <select class="form-select custom-select col-lg-7" name="status" aria-label="Floating label select example"> 
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
        </div>
        <div class="form-floating my-3" >
            <label for="images" class="text-secondary">Image <span class="font-normal text-danger">*</span></label>
            <input required type="file" class="form-control col-lg-7" name="image" placeholder="Image">
        </div>
        <button type='Submit' class="btn btn-success px-4 mb-4">Create</button>
    </form>
    </section>
    
</div>
@endsection
