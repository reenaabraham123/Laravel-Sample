@extends('layouts.app')
@section('title','Crud Application')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3>User Details</h3>
      
      
      <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email Id</th>
              <th scope="col">Mobile Numnber</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->mobile_number }}</td>
                <td>{{ $user->status==1?'Active':'Inactive' }}</td>
                
              </tr>
            @endforeach
           
          </tbody>
        </table>
       
       </div>
    </div>
</div>
@endsection
