
@extends('layouts.mastercms')

@section('content')

<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Edit a Product.</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-4'>
    <form method='POST'action="/product/{{$product->id}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
        <div class="form-floating my-3">
        <label for="title" class="text-secondary">Title <span class="font-normal text-danger">*</span></label>
            <input type="text" required class="form-control col-lg-7" name="title" placeholder="Product title" value={{$product->title}} >
         </div>
        <div class="form-floating my-3">
        <label for="secription" class="text-secondary">Description <span class="font-normal text-danger">*</span></label>
            <textarea class="form-control col-lg-7" placeholder="Product description" name="description" style="height: 100px" required>{{$product->description}}</textarea>
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
            @if(count($productcategory)>0)
                @foreach($productcategory as $parent)
                    <input class="form-check-input" type="checkbox" name="categories_id[]" value={{$parent->id}} 
                    @foreach($product->categories as $procat)
                        @if($procat->id==$parent->id)
                            checked 
                        @endif
                     @endforeach
                     
                    >
                    <!-- checks input which was checked when creating product -->
                    <label class="form-check-label">{{$parent->title}}</label>   
                    <br>
                @endforeach
            @else
                <i>No product categories created. <a href="/productcategorycreate">create one</a></i>    
            @endif
            </div>
        </div>

        <div class="form-floating my-3">
        <label for="Category_id" class="text-secondary">Product Tag</label>
            <div class="form-check" >
            @foreach($tag as $tag)
                <input  class="form-check-input" type="checkbox" name="tags_id[]" value={{$tag->id}} 
                @foreach($product->tags as $protag)
                @if($protag->id==$tag->id)
                checked
                @endif
                @endforeach
                >
                <label class="form-check-label" for="defaultCheck1" >{{$tag->title}}</label>   
                <br>
            @endforeach
            </div>
        </div>
        <div class="row">
        <div class="col-sm-6 col-md-6">
        <div class="form-floating my-3">
        <label for="purchase_price" class="text-secondary">Purchase price <span class="font-normal text-danger">*</span></label>
            <input required type="number" class="form-control col-lg-7" name="purchase_price" placeholder="Purchase price" value={{$product->purchase_price}} >
         </div>
        </div>
        <div class="col-sm-6 col-md-6">
        <div class="form-floating my-3">
         <label for="sell_price" class="text-secondary">Selling price <span class="font-normal text-danger">*</span></label>
            <input  required type="number" class="form-control col-lg-7" name="sell_price" placeholder="Sell price" value={{$product->sell_price}}>
         </div>
        </div>
        </div>

        <!-- ----->
        <div class="row">
        <div class="col-sm-6 col-md-6">
        <div class="form-floating my-3">
         <label for="quantity" class="text-secondary">Stock quantity <span class="font-normal text-danger">*</span></label>
            <input required type="number" class="form-control col-lg-7" name="quantity" placeholder="quantity" value={{$product->quantity}}>
         </div>
        </div>
        <div class="col-sm-6 col-md-6">
        <div class="form-floating">
            <label for="discount" class="text-secondary">Discount</label>
            <input type="number" class="form-control col-lg-7" name="discount" placeholder="discount(optional)" value={{$product->discount}}>
        </div>
        </div>
        </div>
        <!--- ---->
        <div class="row">
        <div class="col-sm-6 col-md-6">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1"  name='featured'
            @if($product->featured==1)
            checked
            @endif
            >
            <label class="form-check-label" for="flexCheckIndeterminate">
                Featured
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="1" name="offer"
            @if($product->offer==1)
            checked
            @endif
            >
            <label class="form-check-label" for="Offer">
                Offer
            </label>
        </div>
        </div>
        <div class="col-sm-6 col-md-6">
        <div class="form-floating">
            <label for="status" class="text-secondary">Status <span class="font-normal text-danger">*</span></label><br/>
            <select class="form-select custom-select col-lg-7" name="status" aria-label="Floating label select example">  
                   
            <option value='draft' <?php if($product->status=='draft') {echo "selected";}?> >Draft</option>
            
            <option value='published' <?php if($product->status=='published') {echo "selected";}?>>Published</option>   
                    
            </select>
        </div>
        </div>
        </div> 
         
         
        <div class="form-floating pt-4 my-3">
            <img src="{{$product->getFirstMediaUrl('')}}" width="50%" height="130px" alt="">
            <p>Note: Old image will be replace by new one</p>
        </div>
        <div class="form-floating my-3">
        <label for="image" class="text-secondary">Product Image <span class="font-normal text-danger">*</span></label>
            <input type="file" class="form-control col-lg-7" name="image" placeholder="Image">
        </div>
        
        <div class="form-floating my-3">
            <label for="additional-image" class="text-secondary">Additional Image</label>
            <input type="file" class="form-control col-lg-7" name="addition-image" placeholder="Image" >
        </div>
        
        <div class="py-4">
        <a href="/product" class="btn btn-danger mb-2 px-4 mr-4">Cancel</a><button type='Submit' class="btn btn-success px-4 mb-2">Update</button>
        </div>
    </form>
    </section>
    
</div>
@endsection
