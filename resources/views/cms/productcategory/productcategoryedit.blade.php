
@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Edit {{$productcategory->title}} ProductCategory.</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-3'>
    <form method='POST' action="/productcategory/{{$productcategory->id}}">
    @csrf
    @method('PUT')
        <div class="form-floating my-3">
            <input type="text" class="form-control col-lg-7" name="title" placeholder="Productcategory title" value='{{$productcategory->title}}'>
         </div>
        <div class="form-floating my-3">
            <textarea class="form-control col-lg-7" placeholder="Description" name="description" style="height: 100px">{{$productcategory->description}}</textarea>
        </div>
        <div class="form-floating my-3">
        <label for="Category_id">ParentCategory</label>
            <select class="form-select" name="parent_id" aria-label="Floating label select example">      
            <option value=""></option>   
                @foreach($parent as $parent)
                <option value={{$parent->id}}
                @if($productcategory->parent)
                        @if($parent->id==$productcategory->parent->id)
                        selected
                        
                        @endif
                @endif        
                >{{$parent->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-floating">
        <label for="">Position</label>
            <input type="number" class="form-control col-lg-7" name="position" placeholder="Position" value="{{$productcategory->position}}">
        </div>
       
        <button type='Submit' class="btn btn-info"> Submit</button>
    </form>
    </section>
    
</div>
@endsection