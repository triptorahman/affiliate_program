@extends('admin.layouts.master')
@section('content')

<div class="container">
  <h2>Add Affiliate</h2>

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif


  <form method="POST" enctype="multipart/form-data">
    {{@csrf_field()}}
    {{-- <div class="form-group">
      <label for="Blood Group">Select Blood Group:</label>
      <select class="form-control" aria-label="blood_group" name="blood_group">
        <option selected value="">Select Your Blood Group</option>
        @foreach($blood_group as $row)
        
        <option value="{{$row->id}}">{{$row->group_name}}</option>

        @endforeach

      </select>
    </div> --}}

    

    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name">
    </div>

    <div class="form-group">
      <label for="name">Email:</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
    </div>

    {{-- <div class="form-group">
      <label for="name">Code:</label>
      <input type="text" class="form-control"  name="code" id="cde" placeholder="Enter Code">
    </div> --}}

    

    <div class="form-group">
        
        <input type="submit" class="btn btn-secondary" value="Post" name="Add">
    </div>

  </form>

</div>



@endsection