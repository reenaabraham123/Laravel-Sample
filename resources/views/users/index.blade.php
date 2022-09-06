@extends('layouts.app')
@section('title','Crud Application')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h3>User Details</h3>
      @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}  
        </div><br />
      @endif
      <a href="{{ route('export') }}" class="btn btn-primary btn-sm pull-left">Export</a>
      <a href="{{ route('pdf') }}" class="btn btn-warning btn-sm pull-left">PDF</a>

      <a href="{{ route('users.create') }}" class="btn btn-success btn-sm pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New</a>
      
      <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Email Id</th>
              <th scope="col">Mobile Numnber</th>
              <th scope="col">Status</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($users as $user)
              <tr>
                <th scope="row">{{ $users->firstItem() + $loop->index }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->mobile_number }}</td>
                <td>{{ $user->status==1?'Active':'Inactive' }}</td>
                <td>
                  <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                  <a href="{{ route('users.delete',$user->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                </td>
              </tr>
            @endforeach
           
          </tbody>
        </table>
        @if ($users->links()->paginator->hasPages())
        {{-- <div class="mt-4 p-4 box has-text-centered"> --}}
            {{ $users->links() }}
        {{-- </div> --}}
    @endif
       </div>
    </div>
</div>
@endsection
