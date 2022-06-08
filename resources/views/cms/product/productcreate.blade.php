
@extends('layouts.mastercms')

@section('content')


<div class="content-wrapper container">
    <section class="content-header pl-4">
        <div class="container">
            <div class="container">
               @include('flash')
            </div>
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Create a Product</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='pl-4'>
    <form method='POST' action="/product" enctype="multipart/form-data">
    @csrf
        <div class="form-floating my-3">
        <label for="title" class="text-secondary">Title <span class="font-normal text-danger">*</span></label>
            <input type="text" class="col-lg-7 form-control" name="title" placeholder="Product Title" required>
           
         </div>
        <div class="form-floating my-3">
        <label for="secription" class="text-secondary">Description <span class="font-normal text-danger">*</span></label>
            <textarea class="form-control col-lg-7" placeholder="Product description" name="description" style="height: 100px" required></textarea>
        </div>
        <!-- <div class="form-floating my-3">
        <label for="Category_id">ProductCategory</label>
            <select class="form-select" name="categories_id" aria-label="Floating label select example">         
                @foreach($productcategory as $parent)
                <option value={{$parent->id}}>{{$parent->title}}</option>
                @endforeach
            </select>
        </div> -->

        <div class="form-floating my-3">
        <label for="Category_id" class="text-secondary">Product Category <span class="font-normal text-danger">*</span></label>
            <div class="form-check" >
            @if($count>0)
                @foreach($productcategory as $parent)
                    <input  class="form-check-input" type="checkbox" name="categories_id[]" value='{{$parent->id}}' >
                    <label class="form-check-label" for="defaultCheck1" >{{$parent->title}}</label>   
                    <br>
                @endforeach
            @else
                <i>no product categories available.</i>
            @endif
            
            </div>
        </div>

        <div class="form-floating my-3">
        <label for="Category_id" class="text-secondary">Product Tag</label>
            <div class="form-check" >
            @foreach($tag as $protag)
                <input class="form-check-input" type="checkbox" name="tags_id[]" value={{$protag->id}} >
                <label class="form-check-label" for="defaultCheck1" >{{$protag->title}}</label>   
                <br>
            @endforeach
            </div>
        </div>
        <div class="row">
        <div class="col-sm-6 col-md-6">
        <div class="form-floating my-3">
        <label for="purchase_price" class="text-secondary">Purchase price <span class="font-normal text-danger">*</span></label>
            <input type="number" class="form-control col-lg-7" name="purchase_price" placeholder="Purchase price" required>
         </div>
        </div>
        <div class="col-sm-6 col-md-6">
        <div class="form-floating my-3">
         <label for="sell_price" class="text-secondary">Selling price <span class="font-normal text-danger">*</span></label>
            <input type="number" class="form-control col-lg-7" name="sell_price" placeholder="Sell price" required>
         </div>
        </div>
        </div>
        
         <div class="row">
         <div class="col-sm-6 col-md-6">
         <div class="form-floating my-3">
         <label for="quantity" class="text-secondary">Stock quantity <span class="font-normal text-danger">*</span></label>
            <input type="number" class="form-control col-md-7" name="quantity" placeholder="Stock" required>
         </div></div>
         <div class="col-sm-6 col-md-6">
         <div class="form-floating my-3">
            <label for="discount" class="text-secondary">Discount %</label>
            <input type="number" class="form-control col-md-7" name="discount" placeholder="discount(optional)">
        </div>
         </div>
         </div>
         
         <div class="row">
         <div class="col-md-6">
         <div class="form-check" style="margin-top:15px;">
            <input class="form-check-input" type="checkbox" value="1" id="flexCheckIndeterminate" name='featured'>
            <label class="form-check-label" for="flexCheckIndeterminate">
                Featured 
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" id="flexCheckIndeterminate" name="offer">
            <label class="form-check-label" for="Offer">
                Offer
            </label>
        </div>
         </div>
         <div class="col-md-6">
         <div class="form-floating mt-2">
            <label for="status" class="text-secondary">Status <span class="font-normal text-danger">*</span></label><br/>
            <select class="form-select custom-select col-lg-7" name="status" aria-label="Floating label select example">          
            <option value=0>Draft</option>
            <option value=1>Published</option>             
            </select>
        </div>
         </div>
         </div>
      

        <div class="row">
        <div class="col-md-6">
        <div class="form-floating mt-2 mb-4">
            <label for="images" class="text-secondary">Product Image <span class="font-normal text-danger">*</span></label>
            <input type="file" class="form-control col-md-7" name="image" placeholder="Image" required>
        </div>
        </div>
        </div>
        
        
        <!-- <div class="form-floating">
            <label for="InStock">Stock</label>
            <div class="form-check">
            <input class="form-check-input" type="radio" id="flexRadioDefault1" checked name="InStock" value=1>
                <label class="form-check-label" for="InStock">
                    InStock
                </label>
                <br>
                <input class="form-check-input" type="radio" id="flexRadioDefault2" name="InStock" value=0>
                <label class="form-check-label" for="flexRadioDefault2">
                    Out of Stock
                </label>
            </div>  
        </div>
         -->
        <button type='Submit' class="btn btn-success px-4">Create</button>
    </form>
    </section>
    
</div>
@endsection
