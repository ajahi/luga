
@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Manage Order #{{$order->id}} <span style="margin-left: 15px;font-size:16px;"><a href="/order">All Order</span></h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-2'>
    <form method='POST'action="/orderedit/{{$order->id}}">
    @csrf
    @method('PUT')
        <div class="form-floating my-3">
        <label for="Category_id" class="text-secondary">Status <span class="font-normal text-danger">*</span></label><br/>
            <select class="form-select custom-select" name="status" aria-label="Floating label select example" style="width:200px;"> 
                <option value="confirmed">Confirmed</option>  
                <option value="cancelled">Cancelled</option>
            </select>
        </div>
        <button type='Submit' class="btn btn-primary">Update Order</button>
    </form>
    </section>
    
</div>
@endsection