@extends('layouts.mastercms')

@section('content')
<div class="content-wrapper container">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                 <div class="col-sm-6">
                     <h1>Create a User.</h1>
                 </div>
            </div>
        </div>
    </section>
    <section class='mx-4'>
    <form method='POST'action="/user">
    @csrf
        <div class="form-floating my-3">
        <label for="name" class="text-secondary">Name <span class="font-normal text-danger">*</span></label>
            <input type="text" class="form-control col-lg-7" name="name" placeholder="Your Name.">
         </div>
        <div class="form-floating my-3">
        <label for="email" class="text-secondary">Email <span class="font-normal text-danger">*</span></label>
            <input type="email" class="form-control col-lg-7" name="email" placeholder="Your email.">
        </div>
        <div class="form-floating my-3">
        <abel for="password" class="text-secondary">Password <span class="font-normal text-danger">*</span></label>
            <input type="password" class="form-control col-lg-7" name="password" placeholder="Your password.">
        </div>
        
        <div class="form-floating my-3">
        <label for="Category_id" class="text-secondary">Role <span class="font-normal text-danger">*</span></label><br/>
            <select class="form-select custom-select col-lg-7" name="role_id" aria-label="Floating label select example">         
                @foreach($role as $role)
                <option value={{$role->id}}>{{$role->name}}</option>
                @endforeach
            </select>
        </div>
        <button type='Submit' class="btn btn-success mb-4 px-4">Create</button>
    </form>
    </section>
    
</div>
@endsection
