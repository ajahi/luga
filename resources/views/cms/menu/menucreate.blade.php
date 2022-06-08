@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Create a Menu.</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-'>
    <form method='POST'action="/menu">
    @csrf
        <div class="form-floating my-3">
            <input required type="text" class="form-control col-lg-7" name="title" placeholder="Title of the menu">
         </div>
        <div class="form-floating my-3">
            <textarea required class="form-control col-lg-7" placeholder="Description" name="description" style="height: 100px"></textarea>
        </div>
        <div class="form-floating my-3">
        <label for="Category_id">ParentCategory</label>
            <select class="form-select" name="parent_id" aria-label="Floating label select example">         
                @foreach($parent as $parent)
                <option value={{$parent->id}}>{{$parent->title}}</option>
                @endforeach
            </select>
        </div>    
        <div class="form-floating my-3">
            <input type="url" class="form-control col-lg-7" name="url" placeholder="URL">
         </div>    
        <button type='Submit' class="btn btn-info"> Submit</button>
    </form>
    </section>
    
</div>
@endsection
