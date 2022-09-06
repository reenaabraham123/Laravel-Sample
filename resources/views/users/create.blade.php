@extends('layouts.app')
@section('title','Crud Application')
@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3>Add New User</h3>
       
            <form method="post" action="{{ route('users.save') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name">
                    @error('name') <p class="alert-danger">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter email id">
                    @error('email') <p class="alert-danger">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label>Mobile Number</label>
                    <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Enter mobile number">
                    @error('mobile_number') <p class="alert-danger">{{ $message }}</p>@enderror
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="image" id="image" >
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>                
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
      </div>
    </div>
</div>
  @endsection