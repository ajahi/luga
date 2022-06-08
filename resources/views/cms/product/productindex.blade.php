@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
@include('flash')
    <div class="section px-2">

        <div class="row space-between">
        <div class="col-sm-12 col-md-2">
        <a href="/productcreate" class="btn btn-primary my-2"><i class="fas fa-plus mr-1"></i>Create</a>
        </div>
            <div class="col-sm-12 col-md-10">
                <div>
                    <form>
                        <span class=" d-inline-block my-2">
                            <select class="form-select custom-select catfilter" name="category" aria-label="filter by category" placeholder="Filter by category">
                                <option value="">Select Category</option>
                                @foreach($procat as $procat)
                                    <option value="{{$procat->id}}" {{ $procat->id == request('category') ? 'selected' : '' }}>{{$procat->title}}</option>
                                @endforeach
                            </select>
                        </span>
                        <span class=" d-inline-block my-2">
                            <select class="form-select custom-select" name="status" aria-label="filter by category" placeholder="Filter by status">
                                <option value="">Select Status</option>
                                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Draft</option>
                                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Published</option>
                            </select>
                        </span>
                        <span class=" d-inline-block my-2">
                            <select class="form-select custom-select" name="stock" aria-label="filter by category" placeholder="Filter by status">
                                <option value="">Stock Status</option>
                                <option value="1" {{ request('stock') == "1" ? 'selected' : '' }}>In Stock</option>
                                <option value="0" {{ request('stock') == "0" ? 'selected' : '' }}>Out Of Stock</option>
                            </select>
                        </span>
                        <div class="d-inline-block">
                            <button class="btn btn-secondary px-4">Filter</button>
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>

        <table class='table' id='product_data'>
            <thead>
                <tr>
                <th scope='col'>ID</th>
                <th scope='col'>Title</th>
                <th scope='col'>Purchase Price</th>
                <th scope='col'>Stock Quantity</th>
                <th scope='col'>Action</th>
                </tr>
            </thead>
            <p class='response'></p>

            @foreach($product as $posts)
            <tbody>
                <tr>
                <td scope="col">{{$posts->id}}</td>
                <td scope="col">
                  <img src="{{$posts->url()}}" height="60" width="60"><br/>
                  <a href="/product-detail/{{$posts->slug}}" target="_blank" class='product-name'>{{$posts->title}}</a>
                  <p class="text-secondary">Categories:<span class="text-dark mr-2"></p>
                </td>

                <td scope="col"><span class="text-secondary mr-2">Purchase Price:</span>Rs. {{$posts->purchase_price}}
                <div class="py-1">
                <p class="mb-0"><span class="text-secondary mr-2">Selling Price:</span>Rs. {{$posts->sell_price}}</p>
                @if($posts->discount && $posts->discount !='')
                <p class="mb-0"><span class="text-secondary mr-2">Discout: {{$posts->discount}}%</span>
                </p>@endif
                <p><span class="text-secondary mr-2">Status:</span>
                @if($posts->status==1)<span class="text-success">Published</span>@endif
                @if($posts->status==0)<span class="text-danger">Draft</span>@endif
                </p>
                </div>
                </td>
                <td scope="col">{{$posts->quantity}}
                <p><span class="text-secondary mr-2">Stock:</span>
                @if($posts->InStock==1)<span class="text-success">In Stock</span>@endif
                @if($posts->InStock==0)<span class="text-danger">Out Of Stock</span>@endif
                </p>
                </td>
                <td scope="col">
                <a href="/product/{{$posts->id}}"><i class="nav-icon fas fa-pen pr-5"></i></a>
                <form action="/productdel/{{$posts->id}}" class="d-inline" method='POST'>
                    @csrf
                    @method('DELETE')
                    <button class="btn" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fas fa-trash text-danger"></i></button>
                </form>

                </td>
                </tr>
            </tbody>
            @endforeach
        </table>

        <div>
            {!! $product->appends(request()->all())->links() !!}
        </div>
    </div>
</div>
@endsection
