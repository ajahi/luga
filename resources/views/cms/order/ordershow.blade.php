@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <div class="section">
    <a href="/order" class="btn text-primary my-1"><i class="fas fa-chevron-left mr-2"></i>Back</a>
        <table class='table'>
            <thead>
                <tr>
                <th scope='col'>ID</th>
                <th scope='col'>Product Details</th>
                <th scope='col'>Order_number</th>
                <th scope='col'>Quantity</th> 
                <th scope='col'>Action</th>
                </tr>
            </thead>
            
            @foreach($product as $posts)
            <tbody>
                <tr>
                <td scope="col">{{$posts->id}}
    
                </td>
                <td scope="col">
                <div>
                <p class="mb-1">Name: <span><strong>{{$posts->product->title}}</strong></span></p>
                <p class="mb-1">Selling price: <span><strong>{{$posts->product->sell_price}}</strong></span></p>
                <p class="mb-1">Quantity: <span><strong>{{$posts->product->quantity}}</strong></span></p>
                </div>
                </td>                
                <td scope="col">{{$posts->order_id}}</td>
                <td scope="col">{{$posts->quantity}}</td>
                <td scope="col">
                
                <form action="/orderdel/{{$posts->id}}" method='POST'>
                    @csrf
                    @method('DELETE')
                    <button class="btn"><i class="fas fa-trash text-danger"></i></button>
                </form>
               
                </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection
