
@extends('admin.layouts.master')
@section('content')

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>User List</h1>
                    </div>
                </div>
            </div>
           
            

        </div>
        @if(Session::has('message'))
                <div class="alert alert-success">{{ Session::get('message') }}</div>
            @endif

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        
                        <div class="card-body">
                  <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <th>SL</th>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>current Balance</th>
                        <th>Promo Code</th>
                        
                        
                    </thead>
                    <tbody>
                       @foreach ($user_list as $row)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->balance}}</td>
                            <td>{{$row->promo_code ?? ''}}</td>
                            
                            
                           
            
                       </tr>
                        @endforeach
          
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


        
@endsection

@section('script')

        
<script>
    $(document).ready(function () {
        $('#datatable').DataTable();
    });
</script>

        
@endsection

