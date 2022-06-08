
@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Edit Post</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-4'>
    <form method='POST'action="/post/{{$post->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="form-floating my-3">
        <label for="title" class="text-secondary">Title <span class="font-normal text-danger">*</span></label>
            <input type="text" class="form-control col-lg-7" name="title" placeholder="Ttile of the post" value='{{$post->title}}' required>
         </div>
        <div class="form-floating my-3">
        <label for="description" class="text-secondary">Description <span class="font-normal text-danger">*</span></label>
            <textarea required class="form-control col-lg-7" placeholder="Description" name="description" style="height: 100px">{{$post->description}}</textarea>
        </div>
        <div class="form-floating pt-4 my-3">
            <img src="{{$post->url()}}" width="50%" height="130px" alt="">
            <p>Note: Old image will be replace by new one</p>
        </div>
        <div class="form-floating my-3">
        <label for="images" class="text-secondary">Product Image <span class="font-normal text-danger">*</span></label>
            <input type="file" class="form-control col-lg-7" name="image" placeholder="Image">
        </div>
        <div class="form-floating my-3">
        <label for="Category_id" class="text-secondary">Category <span class="font-normal text-danger">*</span></label>
            <div class="form-check" >
            @foreach($category as $categories)
                <input required class="form-check-input" type="radio" name="category_id" value={{$categories->id}} 
              @foreach($categories->posts as $catpost)
                    @if($catpost->id==$post->id)
                        checked
                    @endif
              @endforeach
                >
                <label class="form-check-label" for="defaultCheck1" >{{$categories->title}}</label>   
                <br>
            @endforeach
            </div>
        </div>
        <div class="form-floating my-3">
        <label for="Category_id" class="text-secondary">Status <span class="font-normal text-danger">*</span></label><br/>
            <select class="form-select custom-select col-lg-7" name="status" aria-label="Floating label select example"> 
            
                <option value="published"  <?php if($post->status=='published') {echo "selected";} ?> >Published</option>
                
                <option value="draft"  <?php if($post->status=='draft') {echo "selected";} ?>>Draft</option>
                
            </select>
        </div>
        <div class="py-4">
        <a href="/post" class="btn btn-danger mb-2 px-4 mr-4">Cancel</a><button type='Submit' class="btn btn-success mb-2 px-4">Update</button>
        </div>
    </form>
    </section>
    
</div>
@endsection