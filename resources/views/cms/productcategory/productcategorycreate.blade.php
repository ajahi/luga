@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Create a Product Category.</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-4'>
    <form method='POST'action="/productcategory">
    @csrf
        <div class="form-floating my-3">
        <label for="title" class="text-secondary">Title <span class="font-normal text-danger">*</span></label>
            <input type="text" required class="form-control col-lg-7" name="title" placeholder="Title of the post">
         </div>
        <div class="form-floating my-3">
        <label for="descrition" class="text-secondary">Description <span class="font-normal text-danger">*</span></label>
            <textarea class="form-control col-lg-7" required placeholder="Description" name="description" style="height: 100px"></textarea>
        </div>
        <div class="form-floating my-3">
        <label for="Category_id" class="text-secondary">Parent Category</label><br/>
            <select class="form-select custom-select col-lg-7" name="parent_id" aria-label="Floating label select example">         
            <option value=''></option>
                @foreach($productcategory as $parent)
                <option value={{$parent->id}}>{{$parent->title}}</option>
                @endforeach
            </select>
        </div>
        <button type='Submit' class="btn btn-success mb-4 px-4">Create</button>
    </form>
    </section>
    
</div>
@endsection
